<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;
$_id_get = NULL;

if (!empty($_GET['id'])) {
    $_id_get = $_GET['id'];
    $id_manage = $userModel->substrID($_id_get);

    // var_dump($_id_get);
    // var_dump($id_manage);
    // die();
    $user = $userModel->findUserById($id_manage);//Update existing user
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
                <label for="fullname">Fullname</label>
                <span><?php if (!empty($user[0]['fullname'])) echo $user[0]['fullname'] ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <span><?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?></span>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <span><?php if (!empty($user[0]['type'])) echo $user[0]['type'] ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <span><?php if (!empty($user[0]['password'])) echo $user[0]['password'] ?></span>
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