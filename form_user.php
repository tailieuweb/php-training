<<<<<<< HEAD
<?php
session_start();



require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;
$Name_store = "";
$password_store = "";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $user = $userModel->findUserById($id);//Update existing user
    $Name_store = $user[0]['name'];
    $password_store = $user[0]['password'];
}

//Kiem tra nếu token bằng nhau thì thực hiện submit form theo yêu cầu:
if (!empty($_POST['submit'])&& $_SESSION['_token']===$_POST['_token']) {

    if (!empty($id)) {
<<<<<<< HEAD
        $userModel->updateUser($_POST);
    } else if($_POST['name']&& $_POST['fullname']&&$_POST['password']&&$_POST['type']) {
=======
       if(CheckuserdataBeforeUpdate($userModel,$id,$Name_store,$_POST['old_password'])){
           $userModel->updateUser($_POST);
       }
    } else {
>>>>>>> origin/1-php-202109/2-groups/2-B/4-7-Duyen
        $userModel->insertUser($_POST);

    }
    header('location: list_users.php');

<<<<<<< HEAD
}
$token = md5(uniqid());
=======
function CheckuserdataBeforeUpdate($userModel,$id,$Name_store,$old_password){
   $data_check = $userModel->findUserById($id);
   $check = true;
    if ($Name_store != $data_check[0]['name']){
    $check = false;
    }
    if($password_store != $old_password ){
        $check = false;
    }
    return $check;


}

>>>>>>> origin/1-php-202109/2-groups/2-B/4-7-Duyen
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
                    User form
                </div>
                <form method="POST">
<!--                   Ẩn token-->
                    <input type="hidden" name="_token" value="<?php echo $token ?>">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" placeholder="Name" value="<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>">
                    </div>
<<<<<<< HEAD
<!--                    add fullnname-->
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Fullname" value="<?php if (!empty($user[0]['fullname'])) echo $user[0]['fullname'] ?>">
                    </div>
<!--                    add email-->
                    <div class="form-group">
                        <label for="email">Password</label>

                        <input type="text" name="email" class="form-control" placeholder="Email" value="<?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?>">

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if (!empty($user[0]['password'])) echo $user[0]['password'] ?>">
=======
                     <?php if(!empty($_GET['id'])){?> 
            <div class="form-group">
                <label for="password">Old Password</label>
                <input type="password" name="old_password" class="form-control" placeholder="Password">
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="fullname" name="fullname" class="form-control" placeholder="Fullname" value="<?php if (!empty($user[0]['fullname'])) echo $user[0]['fullname'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?>">
                    </div>

                    <div class="form-group">
                        Type:
                        <br>
                        <label for="admin">Admin</label>
                        <input type="radio" id="admin" name="t1" value="admin" checked="t1" >
                        <label for="user">User</label>
                         <input type="radio" id="user" name="t1" value="user" > 
                         <label for="guest">Guest</label>
                         <input type="radio" id="guest" name="t1" value="guest">

>>>>>>> origin/1-php-202109/2-groups/2-B/4-7-Duyen
                    </div>
<<<<<<< HEAD
<!--                    select type-->
                    <select class="form-control" name="type">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                        <option value="Guest">Guest</option>
                    </select>


=======
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input name="fullname" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        Type:
                        <br>
                        <label for="admin">Admin</label>
                       <input type="radio" id="admin" name="type1" value="admin">
                        <label for="user">User</label>
                         <input type="radio" id="user" name="type1" value="user">
                    </div>
>>>>>>> origin/1-php-202109/2-groups/2-B/5-34-Phuong
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
<!--                    Lưu sesion_token-->
               <?php $_SESSION['_token']=$token;
               ?>
                </form>

            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php } ?>
    </div>
</body>
=======
<?php
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$id = NULL;

if (!empty(strip_tags($_GET['id']))) {
    $id = strip_tags($_GET['id']);
    $user = $userModel->findUserById($id);//Update existing user
}


if (!empty($_POST['submit'])) {

    if (!empty($id)) {
        $userModel->updateUser($_POST);
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
    <div class="container">

            <?php if ($user || empty($id)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" placeholder="Name" value="<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input name="fullname" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        Type:
                        <br>
                        <label for="admin">Admin</label>
                       <input type="radio" id="admin" name="t1" value="admin">
                        <label for="user">User</label>
                         <input type="radio" id="user" name="t1" value="user">
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
>>>>>>> origin/1-php-202109/2-groups/2-B/3-52-Nhu
</html>