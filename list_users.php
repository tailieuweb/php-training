<?php
// Start the session
session_start();
require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

$userModel = $factory->make('user');

$bankModel = $factory->make('bank');

$key_code = "sdaknAnN67KbNJ234NK8oa2";

$params = [];
if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
}

if (isset($_GET['success'])) {
    echo "<script>alert('!!! Cập nhật thành công !!!')</script>";
    echo "<script>window.location.href = 'list_users.php'</script>";
}

if (isset($_GET['err'])) {
    echo "<script>alert('Có vẻ như dữ liệu của bạn đã được thay đổi trước đó rồi!!! Vui lòng kiểm tra lại dữ liệu')</script>";
    echo "<script>window.location.href = 'list_users.php'</script>";
}


$error = null;

if (!is_object($userModel)) {
    if ($userModel == 500) {
        $error = 1;
    }
} else {
    $users = $userModel->getUsers($params);
}
//$users = $userModel->getUsers($params);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <?php if (!empty($users)) { ?>
            <div class="alert alert-warning" role="alert">
                List of users! <br>
                Hacker: http://php.local/list_users.php?keyword=ASDF%25%22%3BTRUNCATE+banks%3B%23%23
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <input type="hidden" value="<?php echo $user['version'] ?>">
                        <tr>
                            <th scope="row"><?php echo $user['id'] ?></th>
                            <td>
                                <?php echo $user['name'] ?>
                            </td>
                            <td>
                                <?php echo $user['fullname'] ?>
                            </td>
                            <td>
                                <?php echo $user['email'] ?>
                            </td>
                            <td>
                                <?php echo $user['type'] ?>
                            </td>
                            <td>
                                <a href="form_user.php?id=<?php echo base64_encode($key_code . $user['id'])  ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $user['id'] ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <a href="delete_user.php?id=<?php echo base64_encode($key_code . $user['id']) ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <?php if ($error == 1) { ?>
                <div style="text-align: center; font-weight: bold; color: #aa1212;">
                    <p>>>> Connect Fail <<<< /p>
                            <hr>
                            <h3 style="font-size: 6rem;">404 | Database - Disconnect</h3>
                            <hr>
                </div>
            <?php } else { ?>
                <div class="alert alert-dark" role="alert">
                    This is a dark alert—check it out!
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>