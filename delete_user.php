<?php
session_start();
require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

$userRepository = $factory->make('user');


//23-4

$user = NULL; //Add new user
$id = NULL;
<<<<<<< HEAD

if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $newid = substr($id,23);
    $userModel->deleteUserById($newid);//Delete existing user
=======
if (!empty($_GET['id']) && !empty($_GET['token'])) {
    
     //var_dump( $_SESSION['token']);  var_dump($_GET['token']);die();
   if($_GET['token'] == $_SESSION['token']){
        $id = base64_decode($_GET['id']);
        $newid = substr($id,3,-2);
        $userRepository->deleteUserById($newid);//Delete existing user
    }
    
  
>>>>>>> 1-php-202109/2-groups/4-D/5-15-Huy-phpunit
}
header('location: list_users.php');
?>