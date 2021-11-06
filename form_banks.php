<?php
// Start the session
session_start();
require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();
//$bankModel = new BankModel();
//proxy make bank & user
$bankModel = $factory->make('bank');
$userModel = $factory->make('users');

$user = $bankModel->getUsers();

$bank = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'] * 1;
    $bank = $bankModel->findBankById($_id);//Update existing user
}

//note 4/11 Proxy lien ket
if (!empty($_POST['submit'])) {

    if (!empty($_id)) {
        $userModel->updateUser($_POST);
        //no update proxy post,bank
        //          $userModel->updateUser($_POST,$bankModel);
    } else {
       $userModel->insertUser($_POST);
    }  
    header('location: list_bank.php');   
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bank form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">

            <?php  if ($bank || empty($_id)) { ?>
   

                <div class="alert alert-warning" role="alert">
                    Bank form
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php if (!empty($bank[0]['id'])) echo $bank[0]['id']?>">

                    
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select name="user_id" class="form-control">
                            <?php
                            foreach($user as $value) {
                                if($value['id'] == $bank[0]['user_id']){
                                ?>
                            <option selected value="<?php if (!empty($value['id'])) echo $value['id'] ?>"><?php if (!empty($value['name'])) echo $value['name'] ?></option>
                            <?php } else{ ?>
                                    <option value="<?php if (!empty($value['id'])) echo $value['id'] ?>"><?php if (!empty($value['name'])) echo $value['name'] ?></option>
                             <?php   }
                            }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost">cost</label>
                        <input class="form-control" name="cost" placeholder="Cost" value='<?php if (!empty($bank[0]['cost'])) echo $bank[0]['cost'] ?>'>
                    </div>                 
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    Bank not found!
                </div>
            <?php } ?>
    </div>
</body>
</html>