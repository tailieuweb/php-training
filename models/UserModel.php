<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel
{
    
    public function findUserById($id)
    {
        if(is_object($id) || $id<0 || is_double($id) || empty($id)
        || is_array($id)){
            return 'Not invalid';
        }
        if (is_numeric($id) || is_string($id)) {
            $sql = 'SELECT * FROM users WHERE id = ' . $id;
            // var_dump($sql);
            // die();
            $user = $this->select($sql);
            return $user;
        } else {
            return false;
        }
    }

    public function findUser($keyword)
    {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %' . $keyword . '%' . ' OR user_email LIKE %' . $keyword . '%';
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
        if(is_object($id) || is_string($id) || $id<0 || is_double($id) || empty($id)
        || is_array($id)){
            return false;
        }
        else{
            $sql = 'DELETE FROM users WHERE id = ' . $id;
            return $this->delete($sql);
        }
    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input)
    {
        $sql = 'UPDATE users SET 
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) . '", 
                 password="' . md5($input['password']) . '"
                WHERE id = ' . $input['id'];

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
        $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`,`fullname`,`email`,`type`) VALUES (" .
            "'" . $input['name'] . "', '" . md5($input['password']) . "','" . $input['fullname'] . "','" . $input['email'] . "','" . $input['type'] . "')";

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
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] . '%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            $users = self::$_connection->multi_query($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }

    /**
     * For testing
     * @param $a
     * @param $b
     */
    public function sumb($a, $b) {
        if(!is_numeric($a)) return 'error';
        if(!is_numeric($b)) return 'error';

        return $a + $b;
    }

    public static function getInstance() {
        if (self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }
    public function startTransaction()
    {
        self::$_connection->begin_transaction();
    }

    public function rollback()
    {
        self::$_connection->rollback();
    }
}