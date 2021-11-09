<?php
// Start the session
session_start();

require_once 'models/FactoryPattern.php';
$factory = new FactoryPattern();
require_once 'models/InterestRate.php';

$bankModel = $factory->make('bank');

$params = [];
if (!empty($_GET['keyword'])) {
    $params['keyword'] = $_GET['keyword'];
}

//$banks = $bankModel->getBanks($params);
$bmd = new BankModel();
$iRate = new InterestRate();
$iRate->setbank($bmd);
$banks = $iRate->cost();
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
    <?php if (!empty($banks)) {?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User_ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">SDT</th>
                <th scope="col">Email</th>
                <th scope="col">Stk</th>
                <th scope="col">Số Dư</th>
                <th scope="col">Lãi Xuất</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($banks as $bank) {?>
                <tr>
                    <th scope="row"><?php echo $bank['id']?></th>
                    <td>
                        <?php echo $bank['user_id']?>
                    </td>
                    <td>
                        <?php echo $bank['fullname']?>
                    </td>
                    <td>
                        <?php  echo $bank['sdt'] ?>
                    </td>
                    <td>
                        <?php echo $bank['email'] ?>
                    </td>
                    <td>
                        <?php echo $bank['stk'] ?>
                    </td>
                    <td>
                        <?php echo number_format($bank['soDu']) ?>
                    </td>

                    <td>
                        <?php echo number_format($bank['laiXuat']) ?>
                    </td>
                    <td>
                        <a href="form_banks.php?user_id=<?php echo $bank['user_id'] ?>">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                        </a>
                        <a href="view_banks.php?id=<?php echo $bank['id'] ?>">
                            <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                        </a>
                        <a href="delete_bank.php?id=<?php echo $bank['id'] ?>">
                            <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
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