<?php

use PHPUnit\Framework\TestCase;

class NguyenKhacDanh_BankModelTest extends TestCase
{
    /**
     * Test DeleteBankById Function in BankModel - 'Danh' do this
     */
    // Test case testDeleteBankById
    public function testDeleteBankByIdOK()
    {
        $bankModel = new BankModel();
        $bankModel->startTransaction();
        $id = -1;
        $bankModel->insertBank($id, '12345');
        $check = $bankModel->deleteBankByUserId($id);
        $findUser = $bankModel->getBankByUserId($id);
        $bankModel->rollBack();
        if (
            $check == true &&
            ($findUser) == false
        ) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
       // $bankModel->deleteBankByUserId($id);
    }
    // Test case testDeleteBankByIdString
    public function testDeleteBankByIdString()
    {
        $bankModel = new BankModel();
        $id = "a";
        $check = $bankModel->deleteBankByUserId($id);
        if ($check == false) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
        // Test case testDeleteBankByIdFloat
        public function testDeleteBankByIdFloat()
        {
            $bankModel = new BankModel();
            $bankModel->startTransaction();
            $id = -1.5;
            $bankModel->insertBank($id, '12345');
            $check = $bankModel->deleteBankByUserId($id);
            $findUser = $bankModel->getBankByUserId($id);
            $check = $findUser == false;
            $bankModel->rollBack();
            if (
                $check == true &&
                ($findUser) == false
            ) {
                $this->assertTrue(true);
            } else {
                $this->assertTrue(false);
            }
        }
         // Test case testDeleteBankByIdArray
         public function testDeleteBankByIdArray()
         {
             $bankModel = new BankModel();
             $bankModel->startTransaction();
             $id = array('a','b');
             $bankModel->insertBank($id, '12345');
             $check = $bankModel->deleteBankByUserId($id);
             $findUser = $bankModel->getBankByUserId($id);
             $check = $findUser == false;
             $bankModel->rollBack();
             if (
                 $check == true &&
                 ($findUser) == false
             ) {
                 $this->assertTrue(true);
             } else {
                 $this->assertTrue(false);
             }
         }
    // Test case testDeleteBankNotId
    public function testDeleteBankNotId()
    {
        $bankModel = new BankModel();
        $id = "";
        $check = $bankModel->deleteBankByUserId($id);
        if ($check == false) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    // Test case testDeleteBankBool
    public function testDeleteBankBool()
    {
        $bankModel = new BankModel();
        $id = true;
        $check = $bankModel->deleteBankByUserId($id);
        if ($check == false) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    // Test case testDeleteBankObject
    public function testDeleteBankObject()
    {
        $bankModel = new BankModel();
        $id = new UserModel;
        $check = $bankModel->deleteBankByUserId($id);
        if ($check == false) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
    // Test case testDeleteBankExpectedandActual
    public function testDeleteBankExpectedandActual()
    {
        $bankModel = new BankModel();
        $id = -1;
        $expected = $bankModel->deleteBankByUserId($id);
        $actual = true;
        $this->assertEquals($expected, $actual);
    }
    /**
     * Test getBankByUserId Function in BankModel - 'Danh' do this
     */
    // Test case testDeleteBankById
    public function testGetBankByUserIdOk()
    {
        $bankModel = new BankModel();
        $userModel = new UserModel();
        $bankModel->startTransaction();
        $userId = -1;
        $userModel->insertUserWithId($userId, 'Danh', 'Nguyen Khac Danh', 'nguyenkhacdanh@gmail.com', 'guest', '12345');
        $bankModel->insertBank($userId, '12345');
        $getBank = $bankModel->getBankByUserId($userId);
        $check = $getBank != false &&
            $getBank['user_id'] == $userId &&
            $getBank['cost'] == '12345';
             $bankModel->rollBack();
        if ($check === true) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
      // Test case testDeleteBankByIdArrray
      public function testDeleteBankByIdArrray()
      {
          $bankModel = new BankModel();
          $userModel = new UserModel();
          $bankModel->startTransaction();
          $userId = array('a','b');
          $userModel->insertUserWithId($userId, 'Danh', 'Nguyen Khac Danh', 'nguyenkhacdanh@gmail.com', 'guest', '12345');
          $bankModel->insertBank($userId, '12345');
          $getBank = $bankModel->getBankByUserId($userId);
          $check = $getBank != false &&
              $getBank['user_id'] == $userId &&
              $getBank['cost'] == '12345';
               $bankModel->rollBack();
          if ($check === false) {
              $this->assertTrue(true);
          } else {
              $this->assertTrue(false);
          }
      }
    // Test case testGetBankByUserIdUserIdFloat
    public function testGetBankByUserIdUserIdFloat()
    {
        $bankModel = new BankModel();
        $bankModel->startTransaction();
        $userId = -1.4;
        $getBank = $bankModel->getBankByUserId($userId);
        $check = $getBank == false;
        $bankModel->rollBack();
        if ($check === true) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }
     // Test case testGetBankByUserIdUserIdSpecial
     public function testGetBankByUserIdUserIdSpecial()
     {
         $bankModel = new BankModel();
         $bankModel->startTransaction();
         $userId = '#$#@#';
         $getBank = $bankModel->getBankByUserId($userId);
         $check = $getBank == false;
         $bankModel->rollBack();
         if ($check === true) {
             $this->assertTrue(true);
         } else {
             $this->assertTrue(false);
         }
     }
     // Test case testGetBankByUserIdUserIdString
     public function testGetBankByUserIdUserIdString()
     {
         $bankModel = new BankModel();
         $bankModel->startTransaction();
         $userId = 'Danh';
         $getBank = $bankModel->getBankByUserId($userId);
         $check = $getBank == false;
         $bankModel->rollBack();
         if ($check === true) {
             $this->assertTrue(true);
         } else {
             $this->assertTrue(false);
         }
     }
     
      // Test case testGetBankByUserIdUserIdObject
      public function testGetBankByUserIdUserIdObject()
      {
          $bankModel = new BankModel();
          $bankModel->startTransaction();
          $userId = new UserRepository;
          $getBank = $bankModel->getBankByUserId($userId);
          $check = $getBank == false;
          $bankModel->rollBack();
          if ($check === true) {
              $this->assertTrue(true);
          } else {
              $this->assertTrue(false);
          }
      }
       // Test case testGetBankByUserIdUserIdNull
       public function testGetBankByUserIdUserIdNull()
       {
           $bankModel = new BankModel();
           $bankModel->startTransaction();
           $userId = null;
           $getBank = $bankModel->getBankByUserId($userId);
           $check = $getBank == false;
           $bankModel->rollBack();
           if ($check === true) {
               $this->assertTrue(true);
           } else {
               $this->assertTrue(false);
           }
       }
}
