<?php
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();
$user = NULL; //Add new user
$uid = NULL;
$result = NULL;
//
if (!empty($_GET['token']) && hash_equals($_SESSION['token'], $_GET['token'])) {
  if (!empty($_GET['uid'])) {
    $uid = $_GET['uid'];
    $user = $userModel->findUserByUId($uid); //Update existing user
  }
  if (!empty($_POST['submit'])) {
    if (!empty($uid)) {
      $userModel->updateUser($_POST);
    }
    header("location: list_users.php");
  }
}
if (!empty($_POST['submit'])) {
  $userModel->insertUser($_POST);
  header("location: list_users.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>User form</title>
  <?php include 'views/meta.php' ?>
</head>

<body>
  <?php include 'views/header.php' ?>
  <div class="container">
    <?php if ($user || empty($uid)) { ?>
      <div class="alert alert-warning" role="alert">
        User form
      </div>
      <form method="POST">
        <input type="hidden" name="uid" value="<?php echo $uid ?>">
        <div class="form-group">
          <label for="name">Name</label>
          <input class="form-control" name="name" placeholder="Name" value="<?php if (!empty($user[0]['name'])) echo $user[0]['name'] ?>">
        </div>
        <div class="form-group">
          <label for="fullname">Fullname</label>
          <input name="fullname" class="form-control" placeholder="Fullname" value="<?php if (!empty($user[0]['fullname'])) echo $user[0]['fullname'] ?>">
        </div>
        <?php
        if (!isset($user[0]['password'])) {
        ?>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password" value="<?php if (!empty($user[0]['password'])) echo $user[0]['password'] ?>">
          </div>
        <?php
        }
        ?>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if (!empty($user[0]['email'])) echo $user[0]['email'] ?>">
        </div>
        <div class="form-group">
          <label for="type">Type</label>
          <select name="type" id="type" class="form-control">
            <option value="" selected disabled hidden>Select type</option>
            <option value="admin" <?php if (!empty($user[0]['type']) && $user[0]['type'] = "admin") echo "selected" ?>>
              Admin</option>
            <option value="user" <?php if (!empty($user[0]['type']) && $user[0]['type'] = "user") echo "selected" ?>>User
            </option>
            <option value="guest" <?php if (!empty($user[0]['type']) && $user[0]['type'] = "guest") echo "selected" ?>>
              Guest</option>
          </select>
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