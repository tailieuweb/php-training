<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {

    protected static $_instance;
    
    public function findUserById($id) {
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $user = $this->select($sql);

        return $user;
    }

    public function findUser($keyword) {
        
        //$keyword = htmlentities($keyword, ENT_QUOTES, "UTF-8");
        
        $sql = 'SELECT * FROM users WHERE user_name LIKE %'.$keyword.'%'. ' OR user_email LIKE %'.$keyword.'%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password) {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "'.$md5Password.'"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id, $token) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        return $this->delete($sql, $token);

    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input) {
        $sql = 'UPDATE users SET 
<<<<<<< HEAD
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
=======
<<<<<<< HEAD
                 name = "' . $input['name'] .'", 
>>>>>>> 1-php-202109/2-groups/3-C/5-31-Nam
                 fullname = "' . $input['fullname'] .'", 
                 email = "' . $input['email'] .'", 
                 type = "' . $input['type'] .'", 
=======
                 name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
>>>>>>> main
                 password="'. md5($input['password']) .'"
                WHERE id = ' . $input['id'];

        $user = $this->update($sql);

        return $user;
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input) {

<<<<<<< HEAD
        $sql = "INSERT INTO `users` (`name`,`fullname`, `email`, `type`, `password`) VALUES (" .
            "'" . $input['name'] . "', '".$input['fullname']."', '".$input['email']."', '".$input['type']."', '".$input['password']."')";
=======
        $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`) VALUES (" .
                "'" . $input['name'] . "', '".md5($input['password'])."')";
<<<<<<< HEAD
>>>>>>> 1-php-202109/2-groups/3-C/5-31-Nam

=======
>>>>>>> main

        $user = $this->insert($sql);

        return $user;
    }

    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $key = str_replace('"','',$params['keyword']);
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $key .'%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            // $users = self::$_connection->multi_query($sql);
            $users = $this->select($sql);
            // var_dump($users).die();
        } else {
<<<<<<< HEAD

            $sql = 'SELECT * FROM users join types on users.type = types.type_id';
            $users = $this->select($sql);

        }

=======
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

>>>>>>> main
        return $users;
    }
    public function getTypes($params = []) {
        $sql = 'SELECT * FROM types';
        $types = $this->select($sql);

        return $types;
    }
    public function createToken(){
        $token = $this->get_token_value();
        return $token;
    }
    public static function getInstance() {
        if (self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new self();
        return self::$_instance;
    }
    //
   /**
     * For testing
     * @param $a
     * @param $b
     */
    public function sumb($a, $b) {
        if(!is_numeric($a) || !is_numeric($b))
        {
            return false;
        }
        else{
            return $a + $b;
        }
        
    }
    //Check string have work specical
    public function checkString($field){
        if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            return true;
        } else{
            return FALSE;
        }
    }
}