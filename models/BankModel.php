<?php

require_once 'BaseModel.php';

class BankModel extends BaseModel
{
    private static $_instance;
    public function findBankById($id)
    {
        $sql1 = 'SELECT id FROM banks';
        $allUser = $this->select($sql1);
        $user = null;
        foreach ($allUser as $key) {
            $md5 = md5($key['id'] . "chuyen-de-web-1");
            if ($md5 == $id) {
                $sql = 'SELECT banks.id as bank_id,users.name,users.email,banks.cost,users.type,users.id,banks.user_id,banks.version 
                FROM `banks`,`users` 
                WHERE banks.user_id = users.id AND banks.id = ' . $key['id'];
                $user = $this->select($sql);
            }
        }
        return $user;
    }

    public function findUser($keyword)
    {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %' . $keyword . '%' . ' OR user_email LIKE %' . $keyword . '%';
        $user = $this->select($sql);

        return $user;
    }

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
    public function deleteBankById($id)
    {
        //Lấy id của tất cả user 
        // $sql1 = 'SELECT id FROM banks';
        // $allUser = $this->select($sql1);

        // foreach ($allUser as $key) {
        //     $md5 = md5($key['id'] . "chuyen-de-web-1");
        //     if ($md5 == $id) {
        //         $sql = 'DELETE FROM banks WHERE id = ' . $key['id'];
        //         return $this->delete($sql);
        //     }
        // }
        $sql = 'DELETE FROM banks WHERE id_bank = ' . $id;
        // var_dump($sql);
        // die();
        return $this->delete($sql);
    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */


    public function updateBank($input)
    {
        // $sql1 = 'SELECT id FROM banks';
        // $allUser = $this->select($sql1);
        // $id = 0;

        // $_id = $input['id'];
        // $id_start = substr($_id, 3);
        // $id_end = substr($id_start, 0, -3);

        // foreach ($allUser as $key) {
        //     $md5 = md5($key['id'] . "chuyen-de-web-1");
        //     $md5_start = substr($md5, 3);
        //     $md5_end = substr($md5_start, 0, -3);

        //     if ($md5_end == $id_end) {
        //         $id = $key['id'];
        //         $sql = 'SELECT * FROM banks WHERE id = ' . $key['id'];
        //         $userById = $this->select($sql);
        //     }
        // }

        $id = $_GET['id'];

        $sql = 'UPDATE banks SET cost = ' . $input['cost'] . ' WHERE user_id =' . $id;
        // var_dump($sql);
        // die();
        $user = $this->update($sql);
        return $user;
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertBanks($input)
    {
        $regex_not_special_sign = "/^-?(?:0|[1-9][0-9]*)\.?[0-9]+([e|E][+-]?[0-9]+)?$/";
        $regex_id = "/^[0-9]+$/";
        if (
            $input['user_id'] != null && $input['cost'] != null && is_numeric($input['user_id']) && is_numeric($input['cost']) &&
            preg_match($regex_id, $input['user_id']) && preg_match($regex_not_special_sign, $input['cost']) && is_bool($input['user_id']) != true && is_bool($input['cost']) != true && is_object($input['user_id']) != true && !is_object($input['cost'])
        ) {
            $sql = "INSERT INTO `banks` (`user_id`, `cost` ) VALUES (" .
                "'" . $input['user_id'] . "', '" . $input['cost'] . "')";
            // var_dump($sql);
            // die();
            $bank = $this->insert($sql);
            return $bank;
        } else {
            return false;
        }
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getBanks($params = [])
    {
        //Keyword
        if (!empty($params['keyword'])) {

            // $params['keyword'] = str_replace(
            //     array(
            //         ',', ';', '#', '/', '%', 'select', 'update', 'insert', 'delete', 'truncate',
            //         'union', 'or', '"', "'", 'SELECT', 'UPDATE', 'INSERT', 'DELETE', 'TRUNCATE', 'UNION', 'OR'
            //     ),
            //     array(''),
            //     $params['keyword']
            // );
            $sql = 'SELECT * FROM banks, users WHERE banks.user_id = users.id AND banks.cost LIKE "%' . $params['keyword'] .  '%"';
            // $sql = 'SELECT * FROM banks WHERE cost LIKE "%' . $params['keyword'] . '%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            // $banks = self::$_connection->multi_query($sql);
            $banks = $this->select($sql);
        } else {
            $sql = 'SELECT *
            FROM `banks`,`users` 
            WHERE banks.user_id = users.id';
            // $sql = 'SELECT * FROM `banks`';
            $banks = $this->select($sql);
        }
        return $banks;
    }
    function getAllBanks($user_id)
    {
        $sql = 'SELECT * FROM banks Where user_id = ' . $user_id;
        $banks = $this->select($sql);
        return $banks;
    }
    public static function getInstance()
    {
        if (self::$_instance !== null) {
            var_dump('returning instance bank');
            return self::$_instance;
        }
        var_dump('creating instance bank');
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
