<?php
// Start the session
session_start();

require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

$userModel = $factory->make('user');

// var_dump($userModel); die();

$params = [];

if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
    //Kiểm tra keyword bằng regex trong PHP
    // $pattern = '/^[A-Za-z0-9]$/';
    // if (!preg_match($pattern, $params['keyword'])) {
    //     echo "Không đúng định dạng";
    //     $params['keyword'] = null;
    // }
}

if (is_numeric($userModel)) {
    if ($userModel == 400) {
        // Do nothing!
    }
}
else {
    $users = $userModel->getUsers($params);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
    <!-- Thêm meta tag CSP -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class="container">
        <!-- Đoạn này thêm vào để test Reflected XSS -->
        <?php if (!empty($params['keyword'])) { ?>
            <div class="alert alert-warning" role="alert">
                <h1>Search Result for <?php echo htmlentities($params['keyword']) ?></h1>
            </div>
        <?php } ?>
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
                        <tr>
                            <!-- Sử dụng htmlentities để ngăn chặn việc thực thi code khi in dữ liệu ra màn hình -->
                            <th scope="row"><?php echo htmlentities($user['id']) ?></th>
                            <td>
                                <?php echo htmlentities($user['name']) ?>
                            </td>
                            <td>
                                <?php echo htmlentities($user['fullname']) ?>
                            </td>
                            <td>
                                <?php echo $user['email']?>
                            </td>
                            <td>
                                <?php echo $user['type']?>
                            </td>
                            <td>
                                <!-- Encode id with random number -->
                                <a href="form_user.php?id=<?php echo rand(10000,99999).$user['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <!-- Encode id with random number -->
                                <a href="view_user.php?id=<?php echo rand(10000,99999).$user['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <!-- Encode id with random number -->
                                <a href="delete_user.php?id=<?php echo rand(10000,99999).$user['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else if ($userModel == 400) { ?>
            <div class="alert alert-warning" role="alert">
                Unable to connect to the database!
            </div>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
</body>

</html>