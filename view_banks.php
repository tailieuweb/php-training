<?php
// require_once 'models/BankModel.php';
// $bankModel = new BankModel();
require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

$userModel = $factory->make('user');

$bankModel = $factory->make('bank');

$params = [];

$banks = $bankModel->getBanks($params);

$user = NULL; //Add new user
$id = NULL;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $user = $bankModel->findBankById($id);//Update existing user
}


if (!empty($_POST['submit'])) {

    if (!empty($id)) {
        $bankModel->updateUser($_POST);
    } else {
        $bankModel->insertUser($_POST);
    }
    header('location: list_users.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
<?php include 'views/header.php'?>
<div class="container">

    <?php if ($user || empty($id)) { ?>
        <div class="alert alert-warning" role="alert">
            User profile
        </div>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <span><?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?></span>
            </div>
            <div class="form-group">
                <label for="cost">Cost</label>
                <span><?php if (!empty($user[0]['name'])) echo $banks[0]['cost'] ?></span>
            </div>
        </form>
    <?php } else { ?>
        <div class="alert alert-success" role="alert">
            User not found!
        </div>
    <?php } ?>
</div>
</body>
</html>