<<<<<<< HEAD
<?php
require_once 'BaseModel.php';

 class  BankModel extends BaseModel  {
    protected static $_instance;

    private function __contructor(){}

    public static function getInstance() {
        if (self::$_instance !== null){
            return self::$_instance;
        }
        self::$_instance = new BankModel();
        return self::$_instance;
    }

    public function updateUser($input){
        $rand = rand(5,100000);
        $sql = "UPDATE `banks` SET `cost`= $rand   WHERE user_id =  ".$input['id'];
        $bank = $this->query($sql);
            return $bank;
    }

    public function SelectCostByUserId($user_id){
        $sql = "SELECT   `cost` FROM `banks` WHERE `user_id` = $user_id "; 
        $banks = $this->select($sql);
        return $banks;
    }

     public function insertUser($input)
     {
         $normal = 0 ;
         $sql = "INSERT INTO `app_web1`.`banks` (`user_id`,`cost`) VALUES (" .
             "'" . $input['id'] . "', '".$normal."')";
         $user = $this->insert($sql);
         return $user;

     }

     public function deleteUserById($id)
     {
         $sql = 'DELETE FROM banks WHERE user_id = '.$id;
         return $this->delete($sql);
     }


 }
=======
<?php 
require_once 'BaseModel.php';
class BankModel extends BaseModel {
    public function getAll() {
        $sql = 'SELECT * FROM banks';
        $user = $this->select($sql);
        return $user;
    }

    // Singleton pattern:
    public static function getInstance() {
        if (self::$bankInstance !== null) {
            return self::$bankInstance;
        }
        self::$bankInstance = new self();
        return self::$bankInstance;
    }

    /**
     * Get bank account
     * @param array $params
     * @return array
     */
    public function getBank($params = [])
    {
        $sql = "SELECT * FROM `banks` INNER JOIN users ON banks.user_id=users.id";
        $banks = $this->select($sql);
        return $banks;
    }
    /**
     * Delete bank account balance
     * @param $id
     * @return mixed
     */
    public function deleteBalanceById($id)
    {
        $sql = 'UPDATE `banks` SET `cost`="0" WHERE `user_id` ='  . $id;
        return $this->update($sql);
    }

    public function findBankInfoById($id)
    {
        $sql = 'SELECT * FROM banks WHERE id = ' . $id;
        $items = $this->select($sql);

        return $items;
    }

    public function findBankInfoByUserID($user_id)
    {
        $sql = 'SELECT * FROM banks WHERE user_id = ' . $user_id;
        $items = $this->select($sql);

        return $items;
    }

    /**
     * Update bank info
     * @param $input
     * @return mixed
     */
    public function updateBankInfo($input)
    {
        $sql = 'UPDATE banks SET 
                 cost = "' . $input['cost']  . '"
                WHERE id = ' . ($input['id']);
        $item = $this->update($sql);

        return $item;
    }

    /**
     * Insert bank info
     * @param $input
     * @return mixed
     */
    public function insertBankInfo($input)
    {
        $sql = "INSERT INTO `banks` VALUES (" . 
            0 . ", "
            . $input['user_id'] . ", "
            . $input['cost']
         . ")";

        $item = $this->insert($sql);

        return $item;
    }

    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getBanksInfo($params = [])
    {
        //Keyword
        if (!empty($params['user_id'])) {
            $sql = 'SELECT * FROM banks 
            WHERE user_id = ' . $params['user_id'];
            $items = $this->select($sql);
        } else {
            $sql = 'SELECT * FROM banks';
            $items = $this->select($sql);
        }

        return $items;
    }
}
>>>>>>> 1-php-202109/2-groups/2-B/2-49-Viet
