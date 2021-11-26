<?php

use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
  // * getuser function start

  // * function testGetUsers string (finish)
  public function testGetUsersString()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = 'Tyga';
    $expected = 1;
    $arrUsers = $userModel->getUsers($params);
    $actual = count($arrUsers);
    $this->assertEquals($expected, $actual);
  }

  // * function testGetUsers null (finish)
  public function testGetUsersNull()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = null;
    $expected = 14;
    $arrUsers = $userModel->getUsers($params);
    $actual = count($arrUsers);
    $this->assertEquals($expected, $actual);
  }

  // * function testGetUsers number (finish)
  public function testGetUsersNumber()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = 1;
    $expected = 'error';
    $arrUsers = $userModel->getUsers($params);
    $actual = $arrUsers;
    $this->assertEquals($expected, $actual);
  }

  // * function testGetUsers boolean
  public function testGetUsersBoolean()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = true;
    $expected = 'error';
    $arrUsers = $userModel->getUsers($params);
    $actual = $arrUsers;
    $this->assertEquals($expected, $actual);
  }

  // * function testGetUsers array
  public function testGetUsersArray()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = ['true'];
    $expected = 'error';
    $arrUsers = $userModel->getUsers($params);
    $actual = $arrUsers;
    $this->assertEquals($expected, $actual);
  }

  // * function testGetUsers empty input
  public function testGetUsersEmptyInput()
  {
    $userModel = new UserModel();
    $params = [];
    $params['keyword'] = '';
    $expected = 14;
    $arrUsers = $userModel->getUsers($params);
    $actual = count($arrUsers);
    $this->assertEquals($expected, $actual);
  }
  // * getuser function end

  // * fuction insertUser start
  /**
   * th đầy đủ thông tin và thông tin hợp lệ
   * th user đã tồn tại
   * th input rỗng
   * th thiếu thông tin 
   * th thông tin không hợp lệ (boolean, null, array)
   */
  // * fuction insertUser input valid
  public function testInsertUserInputValid()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuongnew';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = "123";

    $expected = true;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser input exist
  public function testInsertUserInputIsExist()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong3';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = "123";

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password had white space
  public function testInsertUserPasswordWithSpaces()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong2';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = "1 2 3   ";

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password is null 
  public function testInsertUserPasswordIsNull()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong4';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = null;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password is boolean 
  public function testInsertUserPasswordIsBoolean()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong5';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = true;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password is array 
  public function testInsertUserPasswordIsArray()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong6';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = [];

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password is object 
  public function testInsertUserPasswordIsObject()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong7';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = $userModel;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser password is number
  public function testInsertUserPasswordIsNumber()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'thuong8';
    $input['fullname'] = 'tpthuong';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = 1;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser without name (finish)
  public function testInsertUserWithoutName()
  {
    $userModel = new UserModel();
    $input = [];
    // $input['name'] = 'thuong';
    $input['fullname'] = 'withoutname';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = '123';

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser without fullname (finish)
  public function testInsertUserWithoutFullName()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'withoutfullname3';
    // $input['fullname'] = 'withoutname';
    $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = '123';

    $expected = true;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser without email (finish)
  public function testInsertUserWithoutEmail()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'withoutemail3';
    $input['fullname'] = 'withoutemail';
    // $input['email'] = 'email';
    $input['type'] = 'user';
    $input['password'] = '123';

    $expected = true;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser without type (finish)
  public function testInsertUserWithoutType()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'withouttype';
    $input['fullname'] = 'withouttype';
    $input['email'] = 'email';
    // $input['type'] = 'user';
    $input['password'] = '123';

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser without type and email (finish)
  public function testInsertUserWithoutTypeAndEmail()
  {
    $userModel = new UserModel();
    $input = [];
    $input['name'] = 'withouttypeandemail';
    $input['fullname'] = 'withouttype';
    // $input['email'] = 'email';
    // $input['type'] = 'user';
    $input['password'] = '123';

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is empty (finish)
  public function testInsertUserWithInputIsEmpty()
  {
    $userModel = new UserModel();
    $input = [];

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is null (finish)
  public function testInsertUserWithInputIsNull()
  {
    $userModel = new UserModel();
    $input = null;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is boolean (finish)
  public function testInsertUserWithInputIsBoolean()
  {
    $userModel = new UserModel();
    $input = true;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is number (finish)
  public function testInsertUserWithInputIsNumber()
  {
    $userModel = new UserModel();
    $input = 1;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is Object (finish)
  public function testInsertUserWithInputIsObject()
  {
    $userModel = new UserModel();
    $input = $userModel;

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser with input is String (finish)
  public function testInsertUserWithInputIsString()
  {
    $userModel = new UserModel();
    $input = 'hello';

    $expected = false;

    $actual = $userModel->insertUser($input);
    $this->assertEquals($expected, $actual);
  }

  // * fuction insertUser end

}
