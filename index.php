<?php
// Start the session
session_start();

require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();

// $bank = $factory->make('bank');
// // CODE FOR TESTING SINGLETON DESIGN PATTERN
// $bank1 = $factory->make('bank');
// if ($bank == $bank1) {
//     var_dump('2 Objects banks are the same instance');
// }
// die();

$userRepository = $factory->make('UserRepository');
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

$userAccounts = $userRepository->getBankAccounts($params);

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
        <a href="index.php">Home</a>

        <?php if (!empty($userAccounts)) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userAccounts as $userAcc) { ?>
                        <tr>
                            <!-- Sử dụng htmlentities để ngăn chặn việc thực thi code khi in dữ liệu ra màn hình -->
                            <th scope="row"><?php echo htmlentities($userAcc['id']) ?></th>
                            <td>
                                <?php echo htmlentities($userAcc['name']) ?>
                            </td>
                            <td>
                                <?php echo htmlentities($userAcc['fullname']) ?>
                            </td>
                            <td>
                                <?php echo $userAcc['email']?>
                            </td>
                            <td>
                                <?php echo $userAcc['type']?>
                            </td>
                            <td>
                                <?php echo $userAcc['cost']?>
                            </td>
                            <td>
                                <!-- Encode id with random number -->
                                <a href="form_user.php?id=<?php echo rand(10000,99999).$userAcc['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <!-- Encode id with random number -->
                                <a href="view_user.php?id=<?php echo rand(10000,99999).$userAcc['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                                <!-- Encode id with random number -->
                                <a href="delete_bank.php?id=<?php echo rand(10000,99999).$userAcc['id'].rand(10000,99999) ?>">
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
                                </a>
                                <a href="form_bank.php?id=<?php echo rand(10000,99999).$userAcc['id'].rand(10000,99999) ?>">
                                    <span aria-hidden="true" title="Update bank account">&#9998;</span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-dark" role="alert">
                This is a dark alert—check it out!
            </div>
        <?php } ?>
    </div>
</body>

</html>