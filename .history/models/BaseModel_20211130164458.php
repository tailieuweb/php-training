<?php
require_once 'configs/database.php';

abstract class BaseModel {
    // Database connection

    protected static $_connection;
    
    private $_csrf_value = '';

    public function __construct($check = false) {

        if (!isset(self::$_connection)) {
            self::$_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

            if ($check == true) {
                printf("Connect failed");
            }
//            var_dump($token);
        }

    }
    // Get token value
    function get_token_value(){
        return $this->_csrf_value;
    }
    /**
     * Query in database
     * @param $sql
     */
    protected function query($sql) {

        $result = self::$_connection->query($sql);
        return $result;
    }

    /**
     * Select statement
     * @param $sql
     */
    protected function select($sql) {
        $result = $this->query($sql);
        $rows = [];
        if (!empty($result)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    /**
     * Delete statement
     * @param $sql
     * @return mixed
     */
    protected function delete($sql, $token) {
        if($this->_csrf_value == $token){
            $result = $this->query($sql);
            return $result;
        }

    }

    /**
     * Update statement
     * @param $sql
     * @return mixed
     */
    protected function update($sql) {
        $result = $this->query($sql);
        return $result;
    }

    /**
     * Insert statement
     * @param $sql
     */
    protected function insert($sql) {
        $result = $this->query($sql);
        return $result;
    }

}