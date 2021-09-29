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
                 name = "' . $input['name'] .'", 
                 fullname = "' . $input['fullname'] .'", 
                 email = "' . $input['email'] .'", 
                 type = "' . $input['type'] .'", 
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
        $sql = "INSERT INTO `users` (`name`,`fullname`, `email`, `type`, `password`) VALUES (" .
        "'" . $input['name'] . "', '".$input['fullname']."', '".$input['email']."', '".$input['type']."', '".$input['password']."')";

        $user = $this->insert($sql);

        return $user;
    }

    public function getUsers($params = []) {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] .'%"';
        } else {
            $sql = 'SELECT * FROM users join types on users.type = types.type_id';
        }

        $users = $this->select($sql);

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
}