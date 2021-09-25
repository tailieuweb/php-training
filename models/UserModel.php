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

    public function auth($userName, $password) {
        $md5Password = $password;
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
        $sql = 'UPDATE users SET 
<<<<<<< HEAD
                 name = "' . $input['name'] .'",
                   fullname = "' . $input['fullname'] .'",  
=======
                 name = "' . $input['name'] .'", 
                 email = "'.$input['email'].'",
>>>>>>> 1-php-202109/2-groups/4-D/3-22-Khang
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

     //fix add new user
    public function insertUser($input) {
<<<<<<< HEAD
<<<<<<< HEAD
        $sql = "INSERT INTO `app_web1`.`users` (`name`,`fullname`, `email`, `type`, `password`) VALUES (" .
                "'" . $input['name'] . "','" . $input['fullname'] . "', '', '', '".$input['password']."')";
=======
        $sql = "INSERT INTO `app_web1`.`users` (`name`,`fullname`, `email`,`type`,`password`) VALUES (" .
                "'" . $input['name'] . "','','".$input['email']."','','".$input['password']."')";
>>>>>>> 1-php-202109/2-groups/4-D/1-21-Hung
=======
        $sql = "INSERT INTO `app_web1`.`users` (`name`,`fullname`,`email`,`type` ,`password`) VALUES (" .
                "'" . $input['name'] . "', '','','' ,'".$input['password']."')";
>>>>>>> 1-php-202109/2-groups/4-D/3-22-Khang

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
        } else {
            $sql = 'SELECT * FROM users';
        }

        $users = $this->select($sql);

        return $users;
    }
}