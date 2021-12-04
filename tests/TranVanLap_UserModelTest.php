<?php

use PHPUnit\Framework\TestCase;

class TranVanLap_UserModelTest extends TestCase
{
    /**
     * Test auth function, 'Lập' do this 
     * */
    // Test case auth Ok
    public function testAuthOk()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(
            is_array($userLogin) &&
                isset($userLogin[0]) &&
                $userLogin[0]['id'] == $userId &&
                $userLogin[0]['name'] == $userName &&
                $userLogin[0]['password'] == md5($userPassword)
        );
    }
    // Test case auth With User name and password is not Exist
    public function testAuthWithUserNameAndPasswordNotExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userNameLogin = md5('abc');
        $userPasswordLogin = md5('abc');
        $userLogin = $userModel->auth($userNameLogin, $userPasswordLogin);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name not exist 
    public function testAuthWithNameNotExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userNameLogin = md5(md5('TranVanLap'));
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userNameLogin, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is Integer number 
    public function testAuthWithNameInteger()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 1;
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(
            is_array($userLogin) &&
                isset($userLogin[0]) &&
                $userLogin[0]['id'] == $userId &&
                $userLogin[0]['name'] == $userName &&
                $userLogin[0]['password'] == md5($userPassword)
        );
    }
    // Test case auth with name is Float Number
    public function testAuthWithNameFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 1.23;
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(
            is_array($userLogin) &&
                isset($userLogin[0]) &&
                $userLogin[0]['id'] == $userId &&
                $userLogin[0]['name'] == $userName &&
                $userLogin[0]['password'] == md5($userPassword)
        );
    }
    // Test case auth with name is Null 
    public function testAuthWithNameNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = NULL;
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is Object
    public function testAuthWithNameObject()
    {
        $userModel = new UserModel();
        $userName = new ResultClass();
        $userPassword = 'LapTranVan123';
        $userLogin = $userModel->auth($userName, $userPassword);
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is True 
    public function testAuthWithNameTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = true;
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is False 
    public function testAuthWithNameFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = false;
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is Empty Array 
    public function testAuthWithNameEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [];
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with name is Array 
    public function testAuthWithNameArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [1, 2, 3];
        $userPassword = 'LapTranVan123';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password not exist 
    public function testAuthWithPasswordNotExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = 'LapTranVan123';
        $userPasswordLogin = '123abc';
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPasswordLogin);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is Integer number 
    public function testAuthWithPasswordInteger()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = 123;
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(
            is_array($userLogin) &&
                isset($userLogin[0]) &&
                $userLogin[0]['id'] == $userId &&
                $userLogin[0]['name'] == $userName &&
                $userLogin[0]['password'] == md5($userPassword)
        );
    }
    // Test case auth with password is Float number 
    public function testAuthWithPasswordFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = 1.23;
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(
            is_array($userLogin) &&
                isset($userLogin[0]) &&
                $userLogin[0]['id'] == $userId &&
                $userLogin[0]['name'] == $userName &&
                $userLogin[0]['password'] == md5($userPassword)
        );
    }
    // Test case auth with password is Null 
    public function testAuthWithPasswordNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = NULL;
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is Object 
    public function testAuthWithPasswordObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = new ResultClass();
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is True 
    public function testAuthWithPasswordTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = true;
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is False 
    public function testAuthWithPasswordFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = false;
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is empty Array 
    public function testAuthWithPasswordEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = [];
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }
    // Test case auth with password is Array 
    public function testAuthWithPasswordArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'TranVanLap';
        $userPassword = [1, 2, 3];
        $userModel->insertUserWithId($userId, $userName, 'userFullName', 'testEmail@gmail.com', 'admin', $userPassword);
        $userLogin = $userModel->auth($userName, $userPassword);
        $userModel->rollBack();
        $this->assertTrue(empty($userLogin));
    }

    /**
     * Test updateUser function, 'Lập' do this 
     * */
    // Test case updateUser Ok
    public function testUpdateUserOk()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With User Id Not Exist
    public function testUpdateUserWithUserIdNotExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -999;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Không tìm thấy id của user'
        );
    }
    // Test case updateUser With User Id is Float
    public function testUpdateUserWithUserIdFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = 1.23;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Không tìm thấy id của user'
        );
    }
    // Test case updateUser With User Id is String
    public function testUpdateUserWithUserIdString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = 'This is String';
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Không tìm thấy id của user'
        );
    }
    // Test case updateUser With User Id is NULL
    public function testUpdateUserWithUserIdNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Id is Object
    public function testUpdateUserWithUserIdObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Id is True
    public function testUpdateUserWithUserIdTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Id is False
    public function testUpdateUserWithUserIdFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Id is empty Array
    public function testUpdateUserWithUserIdEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Id is Array
    public function testUpdateUserWithUserIdArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is Integer
    public function testUpdateUserWithUserNameInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 123;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With User Name is Float
    public function testUpdateUserWithUserNameFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 1.23;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With User Name is String
    public function testUpdateUserWithUserNameString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 'This is string';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With User Name is Null
    public function testUpdateUserWithUserNameNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is Null
    public function testUpdateUserWithUserNameObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is true
    public function testUpdateUserWithUserNameTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is False
    public function testUpdateUserWithUserNameFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is empty array
    public function testUpdateUserWithUserNameEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With User Name is array
    public function testUpdateUserWithUserNameArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => $userName,
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is integer
    public function testUpdateUserFullnameInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = 1;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            $userFullname,
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With fullname is float
    public function testUpdateUserFullnameFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = 1.23;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            $userFullname,
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With fullname is String
    public function testUpdateUserFullnameString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = 'This is String';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            $userFullname,
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With fullname is Null
    public function testUpdateUserFullnameNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is Object
    public function testUpdateUserFullnameObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is true
    public function testUpdateUserFullnameTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is false
    public function testUpdateUserFullnameFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is empty array
    public function testUpdateUserFullnameEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With fullname is array
    public function testUpdateUserFullnameArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => $userFullname,
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Email is not Email Type
    public function testUpdateUseWithEmailIsNotEmailType()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 'This is not Email Type';
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email Exist
    public function testUpdateUserWithEmailExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 'testUserEmail@gmail.com';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userModel->insertUserWithId(
            -2,
            'TranVanLap',
            'userFullName',
            $userEmail,
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email Integer
    public function testUpdateUserWithEmailInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 1;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email Float
    public function testUpdateUserWithEmailFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 1.23;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email NULL
    public function testUpdateUserWithEmailNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email Object
    public function testUpdateUserWithEmailObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email True
    public function testUpdateUserWithEmailTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email false
    public function testUpdateUserWithEmailFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email is Empty Array
    public function testUpdateUserWithEmailEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser with Email is Array
    public function testUpdateUserWithEmailArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => $userEmail,
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password is Integer
    public function testUpdateUserPasswordInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = 1;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'Trần Văn Lập',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With password is Float
    public function testUpdateUserPasswordFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = 1.23;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'Trần Văn Lập',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With password is String
    public function testUpdateUserPasswordString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = 'This is String';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'Trần Văn Lập',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With password NULL
    public function testUpdateUserPasswordNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password Object
    public function testUpdateUserPasswordObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password True
    public function testUpdateUserPasswordTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password false
    public function testUpdateUserPasswordFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password Empty Array
    public function testUpdateUserPasswordEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With password Array
    public function testUpdateUserPasswordArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $password = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullname',
            'email' => 'updatedEmail@gmail.com',
            'password' => $password,
            'type' => 'user',
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == null &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is Integer
    public function testUpdateUserWithTypeInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = 1;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With Type is Float
    public function testUpdateUserWithTypeFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = 1.23;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With Type is String
    public function testUpdateUserWithTypeString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = 'This is String';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $userVersion = $userModel->findUserById($userId)['version'];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userAfterUpdate = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == true &&
                $userUpdate->data == 'Đã update thành công' &&
                $userUpdate->error == NULL &&
                $userAfterUpdate['id'] == $userId &&
                $userAfterUpdate['name'] == $inputUpdate['name'] &&
                $userAfterUpdate['fullname'] == $inputUpdate['fullname'] &&
                $userAfterUpdate['email'] == $inputUpdate['email'] &&
                $userAfterUpdate['password'] == md5($inputUpdate['password']) &&
                $userAfterUpdate['type'] == $inputUpdate['type'] &&
                $userAfterUpdate['version'] == $userVersion + 1
        );
    }
    // Test case updateUser With Type is Null
    public function testUpdateUserWithTypeNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = NULL;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is Object
    public function testUpdateUserWithTypeObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = new ResultClass();
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is True
    public function testUpdateUserWithTypeTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = true;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is false
    public function testUpdateUserWithTypeFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = false;
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is empty array
    public function testUpdateUserWithTypeEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = [];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Type is array
    public function testUpdateUserWithTypeArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = [1, 2, 3];
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => $userType,
            'version' => 1
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is Integer but wrong at version of User
    public function testUpdateUserWithVersionIntButWrongAtVersionOfUser()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = -1;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Dữ liệu đã được cập nhật trước đó! Xin hãy reload lại trang'
        );
    }
    // Test case updateUser With Version is Float
    public function testUpdateUserWithVersionFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = 1.23;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Dữ liệu đã được cập nhật trước đó! Xin hãy reload lại trang'
        );
    }
    // Test case updateUser With Version is String
    public function testUpdateUserWithVersionString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = 'This is String';
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Dữ liệu đã được cập nhật trước đó! Xin hãy reload lại trang'
        );
    }
    // Test case updateUser With Version is Null
    public function testUpdateUserWithVersionNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = NULL;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is Object
    public function testUpdateUserWithVersionObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = new ResultClass();
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is True
    public function testUpdateUserWithVersionTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = true;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is false
    public function testUpdateUserWithVersionFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = false;
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is empty Array
    public function testUpdateUserWithVersionEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = [];
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }
    // Test case updateUser With Version is Array
    public function testUpdateUserWithVersionArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userVersion = [1, 2, 3];
        $userModel->insertUserWithId(
            $userId,
            'TranVanLap',
            'userFullName',
            'testEmail@gmail.com',
            'admin',
            'LapTranVan123'
        );
        $inputUpdate = [
            'id' => $userId,
            'name' => 'updatedName',
            'fullname' => 'updatedFullName',
            'email' => 'updatedEmail@gmail.com',
            'password' => 'updatedPassword',
            'type' => 'user',
            'version' => $userVersion
        ];
        $userUpdate = $userModel->updateUser($inputUpdate);
        $userModel->rollBack();
        $this->assertTrue(
            $userUpdate->isSuccess == false &&
                $userUpdate->data == NULL &&
                $userUpdate->error == 'Thông tin nhập vào không đúng !!'
        );
    }

    /**
     * Test insertUserWithId function, 'Lập' do this 
     * */
    // Test case insertUserWithId Ok
    public function testInsertUserWithIdOk()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId
        );
    }
    // Test case insertUserWithId With id have Exist
    public function testInsertUserWithIdWithUserIdExist()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id Float
    public function testInsertUserWithIdWithIdFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id string
    public function testInsertUserWithIdWithIdString()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = 'This is String';
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id NULL
    public function testInsertUserWithIdWithIdNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = NULL;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id Object
    public function testInsertUserWithIdWithIdObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id true
    public function testInsertUserWithIdWithIdTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id false
    public function testInsertUserWithIdWithIdFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = false;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id empty array
    public function testInsertUserWithIdWithIdEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId With id array
    public function testInsertUserWithIdWithIdArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = [1, 2, 3];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with User Name is Int
    public function testInsertUserWithIdWithUserNameInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['name'] == $userName
        );
    }
    // Test case insertUserWithId with User Name is Float
    public function testInsertUserWithIdWithUserNameFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['name'] == $userName
        );
    }
    // Test case insertUserWithId with User Name is Null
    public function testInsertUserWithIdWithUserNameNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = null;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with User Name is Object
    public function testInsertUserWithIdWithUserNameObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with User Name is true
    public function testInsertUserWithIdWithUserNameTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    } // Test case insertUserWithId with User Name is false
    public function testInsertUserWithIdWithUserNameFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = false;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    public function testInsertUserWithIdWithUserNameEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    public function testInsertUserWithIdWithUserNameArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userName = [1, 2, 3];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            $userName,
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname int
    public function testInsertUserWithIdWithFullNameInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = 1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['fullname'] == $userFullname
        );
    }
    // Test case insertUserWithId with fullname float
    public function testInsertUserWithIdWithFullNameFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['fullname'] == $userFullname
        );
    }
    // Test case insertUserWithId with fullname null
    public function testInsertUserWithIdWithFullNameNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = null;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname Object
    public function testInsertUserWithIdWithFullNameObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname True
    public function testInsertUserWithIdWithFullNameTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname false
    public function testInsertUserWithIdWithFullNameFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = false;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname empty array
    public function testInsertUserWithIdWithFullNameEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with fullname array
    public function testInsertUserWithIdWithFullNameArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userFullname = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            $userFullname,
            'tranvanlap_testEmail@gmail.com',
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email String but Wrong at Email type
    public function testInsertUserWithIdWithEmailWrongAtEmailType()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 'this is not email type';
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email Int
    public function testInsertUserWithIdWithEmailInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email float
    public function testInsertUserWithIdWithEmailFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email null
    public function testInsertUserWithIdWithEmailNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = null;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email object
    public function testInsertUserWithIdWithEmailObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email true
    public function testInsertUserWithIdWithEmailTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email false
    public function testInsertUserWithIdWithEmailFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = false;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email empty array
    public function testInsertUserWithIdWithEmailEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with email array
    public function testInsertUserWithIdWithEmailArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userEmail = [1, 2, 3];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            $userEmail,
            'admin',
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Type Int
    public function testInsertUserWithIdWithTypeInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = 1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            $userType,
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['type'] == $userType
        );
    }
    // Test case insertUserWithId with Type Float
    public function testInsertUserWithIdWithTypeFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            $userType,
            'tranvanlap123'
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['type'] == $userType
        );
    }
    // Test case insertUserWithId with Type Null
    public function testInsertUserWithIdWithTypeNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = null;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            $userType,
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Type Object
    public function testInsertUserWithIdWithTypeObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            $userType,
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Type True
    public function testInsertUserWithIdWithTypeTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userType = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            $userType,
            'tranvanlap123'
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
     // Test case insertUserWithId with Type false
     public function testInsertUserWithIdWithTypeFalse()
     {
         $userModel = new UserModel();
         $userModel->startTransaction();
         $userId = -1;
         $userType = false;
         $userInsert = $userModel->insertUserWithId(
             $userId,
             'tranVanLap',
             'Trần Văn Lập',
             'tranvanlap_testEmail@gmail.com',
             $userType,
             'tranvanlap123'
         );
         $userModel->rollBack();
         $this->assertTrue($userInsert == false);
     }
     // Test case insertUserWithId with Type empty array
     public function testInsertUserWithIdWithTypeEmptyArray()
     {
         $userModel = new UserModel();
         $userModel->startTransaction();
         $userId = -1;
         $userType = [];
         $userInsert = $userModel->insertUserWithId(
             $userId,
             'tranVanLap',
             'Trần Văn Lập',
             'tranvanlap_testEmail@gmail.com',
             $userType,
             'tranvanlap123'
         );
         $userModel->rollBack();
         $this->assertTrue($userInsert == false);
     }
      // Test case insertUserWithId with Type array
      public function testInsertUserWithIdWithTypeArray()
      {
          $userModel = new UserModel();
          $userModel->startTransaction();
          $userId = -1;
          $userType = [1,2,3];
          $userInsert = $userModel->insertUserWithId(
              $userId,
              'tranVanLap',
              'Trần Văn Lập',
              'tranvanlap_testEmail@gmail.com',
              $userType,
              'tranvanlap123'
          );
          $userModel->rollBack();
          $this->assertTrue($userInsert == false);
      }
      // Test case insertUserWithId with Password Int
    public function testInsertUserWithIdWithPasswordInt()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = 1;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['password'] == md5($userPassword)
        );
    }
    // Test case insertUserWithId with Password float
    public function testInsertUserWithIdWithPasswordFloat()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = 1.23;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $user = $userModel->findUserById($userId);
        $userModel->rollBack();
        $this->assertTrue(
            $userInsert == true &&
                $user != false &&
                $user['id'] == $userId &&
                $user['password'] == md5($userPassword)
        );
    }
    // Test case insertUserWithId with Password Null
    public function testInsertUserWithIdWithPasswordNull()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = null;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Password Object
    public function testInsertUserWithIdWithPasswordObject()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = new ResultClass();
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Password True
    public function testInsertUserWithIdWithPasswordTrue()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = true;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Password False
    public function testInsertUserWithIdWithPasswordFalse()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = false;
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Password empty array
    public function testInsertUserWithIdWithPasswordEmptyArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = [];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
    // Test case insertUserWithId with Password array
    public function testInsertUserWithIdWithPasswordArray()
    {
        $userModel = new UserModel();
        $userModel->startTransaction();
        $userId = -1;
        $userPassword = [1,2,3];
        $userInsert = $userModel->insertUserWithId(
            $userId,
            'tranVanLap',
            'Trần Văn Lập',
            'tranvanlap_testEmail@gmail.com',
            'admin',
            $userPassword
        );
        $userModel->rollBack();
        $this->assertTrue($userInsert == false);
    }
}