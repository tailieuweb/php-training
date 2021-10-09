<?php
require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

$userModel = $factory->make('user');

$user = NULL; //Add new user

$id = NULL;
$version = NULL;
if (!empty($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $newid = substr($id,3,-2);
    $user = $userModel->findUserById($newid);//Update existing user 
if (!empty($_GET['version'])) {
    $version =  $_GET['version'];   
}
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
if (!empty($_POST['submit'])) {

    if (!empty($id) && !empty($version)) {     
        if($userModel->getVersion($newid) == $version){           
            $userModel->updateUser($_POST);          
            $userModel->updateVersion($_POST);
        }else{
           echo '<script>alert("Phiên bản đã hết hạn, vui lòng cập nhật")</script>';

        }      
    } else {
        $userModel->insertUser($_POST);
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
        
        <?php if ($user || !isset($_id)) { ?>

        <div class="container">

            <?php if ($user || isset($newsid)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">                
                    <input type="hidden" name="id" value="<?php if(!empty($newid)){echo $newid;}else{echo $id;}?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" placeholder="Name" value="<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full Name</label>
                        <input class="form-control" name="fullname" placeholder="FullName" value="<?php if (!empty($user[0]['fullname'])) echo $user[0]['fullname'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" placeholder="Email" value="<?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" value="1" placeholder="Type">
                            <option value="admin" <?php if (!empty($user[0]['type'])&&$user[0]['type'] =='admin') echo "selected=\"selected\""; ?>>Admin</option>
                            <option value="user" <?php if (!empty($user[0]['type'])&&$user[0]['type'] =='user') echo "selected=\"selected\"";?> >User</option>
                            <option value="guest" <?php if (!empty($user[0]['type'])&& $user[0]['type']=='guest') echo "selected=\"selected\"";?>>Guest</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
                
            <?php } ?>
        </div>
    </body>
</html>