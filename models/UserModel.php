<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel {
    
    public function findUserById($id) {
        $sql = 'SELECT * FROM users WHERE id = '.$id;
        $user = $this->select($sql);
        
        return $user;
    }
    
    public function findUser($keyword) {
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
    public function deleteUserById($id) {
        $sql = 'DELETE FROM users WHERE id = '.$id;
        return $this->delete($sql);
        
    }
    
    /**
    * Update user
    * @param $input
    * @return mixed
    */
    public function updateUser($input) {
        $version = 'SELECT version FROM users WHERE id = '. $input['id'] .'';
        $newVersion = $this->select($version);
        var_dump($version);
        if($newVersion[0]['version']==$input['version']){
        $sql = 'UPDATE users SET 
        name = "' . mysqli_real_escape_string(self::$_connection, $input['name']) .'", 
        password="'. md5($input['password']) .'", 
        fullname="'. $input['fullname'] .'", 
        email="'. $input['email'] .'", 
        version="'. $input['version']+1 .'", 
        type="'. $input['type'] .'"
        WHERE id = '. $input['id'];
        var_dump($sql);
        var_dump($input['id']);
        var_dump($vs);
        $user = $this->update($sql);
        header('location: list_users.php');
        return $user;
        }
        else{
            echo "<script>alert('Bạn đã thay đổi dữ liệu rùi')</script>";
        }
    }
    
    /**
    * Insert user
    * @param $input
    * @return mixed
    */
    public function insertUser($input) {
        $sql = "INSERT INTO `users`(`name`, `password`, `fullname`, `email`, `type`) VALUES (" .
        "'" . $input['name'] . "', '".md5($input['password'])."', '" . $input['fullname'] . "', '" . $input['email'] . "', '" . $input['type'] . "')";
        
        $user = $this->insert($sql);
        
        return $user;
    }
    
    
    
    /**
    * Search users
    * @param array $params
    * @return array
    */
    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';
            
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
}