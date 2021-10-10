<?php
// Start the session
session_start();
require_once 'models/BankModel.php';
$bankModel = new BankModel();
$params = [];
$banks = $bankModel->getBanks($params);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <?php include 'views/meta.php' ?>
</head>

<body>
    <?php include 'views/header.php' ?>
    <div class=" container">
        <?php if (!empty($banks)) { ?>
            <div class="alert alert-warning" role="alert">
                List of users! <br>
                Hacker: http://php.local/list_users.php?keyword=ASDF%25%22%3BTRUNCATE+banks%3B%23%23
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Bank ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banks as $bank) { ?>
                        <tr>
                            <th scope="row"><?php echo $bank['user_id'] ?></th>
                            <td>
                                <?php echo $bank['bank_id']?>
                            </td>
                            <td>
                                <?php echo $bank['name'] ?>
                            </td>
                            <td>
                                <?php echo $bank['fullname'] ?>
                            </td>
                            <td>
                                <?php echo $bank['cost'] ?>
                            </td>
                           
                            <td>
                                <a href="form_user.php?id=<?php echo  $bank['bank_id'] ?>" target="_blank">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true" title="Update"></i>
                                </a>
                                <a href="view_user.php?id=<?php echo $bank['bank_id'] ?>" target="_blank">
                                    <i class="fa fa-eye" aria-hidden="true" title="View"></i>
                                </a>
                              
                                <a href="delete_user.php?id=<?php echo $bank['bank_id'] ?>" target="_blank"?>
                                    <i class="fa fa-eraser" aria-hidden="true" title="Delete"></i>
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