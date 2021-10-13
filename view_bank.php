<?php
require_once 'models/BankModel.php';
$bankModel = new BankModel();

$bank = NULL; //Add new user
$id = NULL;

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $bank = $bankModel->findBankById($id);//Update existing user
}


if (!empty($_POST['submit'])) {

    if (!empty($id)) {
        $bankModel->updateBank($_POST);
    } else {
        $bankModel->insertBank($_POST);
    }
    header('location: list_bank.php');
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

    <?php if ($bank || empty($id)) { ?>
        <div class="alert alert-warning" role="alert">
            User profile
        </div>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="form-group">
                <label for="user_id">User_id</label>
                <span><?php if (!empty($bank[0]['user_id'])) echo $bank[0]['user_id'] ?></span>
            </div>
            <div class="form-group">
                <label for="cost">Cost</label>
                <span><?php if (!empty($bank[0]['cost'])) echo $bank[0]['cost'] ?></span>
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