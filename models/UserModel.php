<?php

use Symfony\Component\ErrorHandler\Error\FatalError;

require_once 'BaseModel.php';

class UserModel extends BaseModel
{
    private static $_user_instance;

    // Singleton pattern:
    public static function getInstance()
    {
        if (self::$_user_instance !== null) {
            return self::$_user_instance;
        }
        self::$_user_instance = new self();
        return self::$_user_instance;
    }

    // Get the lastest user id:
    public function getTheID()
    {
        $sql = 'SELECT MAX(id) as user_id FROM users';
        $user = $this->select($sql);

        return $user[0]["user_id"];
    }

    // Get user by id:
    public function findUserById($id)
    {
        if ($id instanceof stdClass || is_bool($id) || is_array($id) || is_null($id)) {
            throw new InvalidArgumentException('Invalid argument');
        }

        if (!isset($id)) {
            throw new ArgumentCountError("Too few argument");
        }

        $sql = 'SELECT * FROM users WHERE id = ' . $id;
        $user = $this->select($sql);

        return $user;
    }

    // Get user by keyword:
    public function findUser($keyword)
    {
        if ($keyword instanceof stdClass || is_bool($keyword) || is_array($keyword) || is_null($keyword)) {
            throw new InvalidArgumentException('Invalid argument');
        }

        if (!isset($keyword)) {
            throw new ArgumentCountError("Too few argument");
        }

        $sql = 'SELECT * FROM users WHERE users.name LIKE ' . '\'%' . $keyword . '%\'' . ' OR email LIKE ' . '\'%' . $keyword . '%\'';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password)
    {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "' . $md5Password . '"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id)
    {
        if ($id instanceof stdClass || is_bool($id) || is_array($id) || is_null($id)) {
            throw new InvalidArgumentException('Invalid argument');
        }

        if (!isset($id)) {
            throw new ArgumentCountError("Too few argument");
        }

        $sql = 'DELETE FROM users WHERE id = ' . $id;
        return $this->delete($sql);
    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input)
    {
        if (
            is_numeric(($input['ver'])) == false || $input['ver'] == 'e'
            || is_numeric(($input['id'])) == false || $input['id'] == 'e'
            || is_string($input['name']) == false || is_string($input['fullname']) == false || is_string($input['email']) == false
            || is_string($input['type']) == false || is_string($input['password']) == false
            || strlen($input['name']) == 0 || strlen($input['fullname']) == 0 || strlen($input['email']) == 0
            || strlen($input['type']) == 0 || strlen($input['password']) == 0) {
            return 0;
        }

        // Get time:
        $tz_object = new DateTimeZone('Asia/Ho_Chi_Minh');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);

        $sql = 'UPDATE users SET 
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name'])  . '", 
                 updated_at = "' . $datetime->format('Y\-m\-d\ h:i:sa') . '",
                 version = ' . ($input['ver'] + 1) . ',
                 fullname="' . ($input['fullname']) . '",
                 email="' . ($input['email']) . '",
                 password="' . (md5($input['password'])) . '",
                 type="' . $input['type'] . '"

                WHERE id = ' . ($input['id']);
        $user = $this->update($sql);

        return $user;
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input)
    {
        if (
            is_string($input['name']) == false || is_string($input['fullname']) == false || is_string($input['email']) == false
            || is_string($input['type']) == false || is_string($input['password']) == false
            || strlen($input['name']) == 0 || strlen($input['fullname']) == 0 || strlen($input['email']) == 0
            || strlen($input['type']) == 0 || strlen($input['password']) == 0) {
            throw new InvalidArgumentException('Invalid argument exception!');
        }

        // Specify the id to assign to the new user:
        $id = intval($this->getTheID()) + 1;

        // Get time:
        $tz_object = new DateTimeZone('Asia/Ho_Chi_Minh');
        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);

        $sql = "INSERT INTO `app_web1`.`users` (`id`, `name`, `password`, `updated_at`,`fullname`,`email`,`type`) VALUES (" .
            "'" .  $id . "', '"
            . mysqli_real_escape_string(self::$_connection, $input['name']) . "', '"
            . md5($input['password']) . "', '"
            . $datetime->format('Y\-m\-d\ h:i:sa') . "', '"
            . $input['fullname'] . "', '"
            . $input['email'] . "', '"
            . $input['type']
            . "')";

        $user = $this->insert($sql);

        return $user;
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getUsers($params = [])
    {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users 
            WHERE name LIKE "%' . mysqli_real_escape_string(self::$_connection, $params['keyword']) . '%"';
            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            //$users = self::$_connection->multi_query($sql);
            $users = $this->select($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }

    // Get version of data:
    public function getVersionByUserID($user_id)
    {
        $sql = 'SELECT version FROM users WHERE id = ' . $user_id;
        $user = $this->select($sql);

        return $user[0]["version"];
    }

    // Code for testing
    public function startTransaction()
    {
        self::$_connection->begin_transaction();
    }

    public function rollback()
    {
        self::$_connection->rollback();
    }
}
