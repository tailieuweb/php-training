<?php
require_once 'models/UserModel.php';
require_once 'models/FactoryPattent.php';
// $userModel = new UserModel();
$factory = new FactoryPattent();
$userModel = $factory->make('user');

$users = $userModel->getUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">
        <?php if (!empty($users)) {?>
            <div class="alert alert-warning" role="alert">
                List of users!
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) {?>
                        <tr>
                            <th scope="row"><?php echo $user['id']?></th>
                            <td>
                                <?php echo $user['name']?>
                            </td>
                            <td>
                                <?php echo $user['fullname']?>
                            </td>
                            <td>
                                <?php echo $user['type']?>
                            </td>
                            <td>
                            <a href="form_user.php?id=<?php echo  rand(100, 999) . md5($user['id'] . "list-user") . rand(100, 999) ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo rand(100, 999) . md5($user['id'] . "list-user") . rand(100, 999) ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>

                                <a href="delete_user.php?id=<?php echo rand(100, 999) . md5($user['id'] . "list-user") . rand(100, 999) ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
</body>
</html>