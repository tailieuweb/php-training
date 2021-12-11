<?php
session_start();
// ----------Factory----------
require '../../models/FactoryPattentTwoAdmin.php';

if($_SESSION['role'] == 'Admin') { 
    $factory = new FactoryPattentTwoAdmin();
    $params = [];
    if (!empty($_GET['keyword'])) {
        $params['keyword'] = $_GET['keyword'];
        
    }
    $productModel = $factory->make('product');
    // ----------Factory----------
    
    $allProduct =  $productModel->getProducts($params);
    
} else {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="../../public/backend/css/font-face.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="../../public/backend/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../../public/backend/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"
        media="all">
    <link href="../../public/backend/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../../public/backend/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../public/backend/css/theme.css" rel="stylesheet" media="all">
</head>
<style>
.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1 px !important;
    margin: -1 px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1 px !important;
}
</style>

<body class="">

    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="../../public/backend/images/icon/logo-white.png" alt="CoolAdmin" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="../admin.php">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                    <span class="bot-line"></span>
                                </a>

                            </li>

                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-copy"></i>
                                    <span class="bot-line"></span>Pages</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <a href="../products/index.php">Products</a>
                                    </li>
                                    <li>
                                        <a href="../Manufacture/">Manufactures</a>
                                    </li>
                                    <li>
                                        <a href="../protype/index.php">Protype</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a href="../oders/index.php">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>Orders</a>

                            </li>
                            <li class="has-sub">
                                <a href="../zipcode/index.php">
                                    <i class="fas fa-desktop"></i>
                                    <span class="bot-line"></span>ZipCode</a>

                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">

                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="../../public/backend/images/icon/avatar-01.jpg" alt="John Doe" />
                                </div>
                                <?php 
            if (isset($_SESSION['lgUserID'])) {
                ?>
                                <div class="content">
                                    <a class="js-acc-btn" href="#"><?= $_SESSION['lgUserName'] ?></a>
                                </div>
                                <?php
            } ?>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="../../public/backend/images/icon/avatar-01.jpg"
                                                    alt="John Doe" />
                                            </a>
                                        </div>
                                        <?php 
                    if(isset($_SESSION['lgUserID'])) { 
                    
                ?>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="../../profile.php"><?= $_SESSION['lgUserName'] ?></a>
                                            </h5>
                                            <span class="email">ngoctam2303001@gmail.com</span>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <?php
            if (!empty($_SESSION["lgUserID"])) {
                $chuoi1 = <<<EOD
                <div class="account-dropdown__item">
                    <a href="../../profile.php">
                        <i class="zmdi zmdi-account"></i>Account</a>
                </div>
                <div class="account-dropdown__footer">
                    <a href="../../logout.php">
                    <i class="zmdi zmdi-power"></i>Logout</a>
                 </div>
                EOD;
                echo $chuoi1;
            } 

            ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- HEADER MOBILE-->
        <?php include('../../views/admin/layouts/header-mobile.php') ?>
        <!-- END HEADER MOBILE -->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">data table</h3>
                            <div class="active" style="display: flex; justify-content: space-between;">
                                <div class="table-data__tool">
                                    <a href="add.php"> <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add item</button></a>
                                </div>
                                <div class="table-data__tool">
                                    <a href="trash.php"> <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-delete"></i>trash</button></a>
                                </div>
                            </div>
                            <?php 
                                $keyword = '';
                                if(!empty($_GET['keyword'])) {
                                    $keyword = $_GET['keyword'];
                                }
                            ?>
                            <form method="get" class="form-horizontal">
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn"
                                                    style="background: #63c76a;color:white;">
                                                    <i class="fa fa-search"></i> Search
                                                </button>
                                            </div>
                                            <input type="text" id="input1-group2" name="keyword" value="<?= $keyword ?>"
                                                placeholder="Search users" class="form-control">
                                        </div>
                                    </div>
                                </div>


                            </form>
                            <?php if(!empty($allProduct)) { ?>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Cake</th>
                                            <th>Image</th>
                                            <th>Manufacture</th>
                                            <th>Protype</th>
                                            <th>Price</th>
                                            <th>Feature</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php  foreach ($allProduct as $product) {?>
                                        <tr class="tr-shadow">
                                            <td><?= htmlspecialchars($product['name'] )?></td>
                                            <td>
                                                <div class="img-cake">
                                                    <img class="anh-tam"
                                                        src="<?= htmlspecialchars($product['pro_image'])?>"
                                                        alt="<?= htmlspecialchars($product['name'] )?>">
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="block-email"><?= htmlspecialchars($productModel->getManuByProductId($product['manu_id'])[0]['manu_name']) ?></span>
                                            </td>
                                            <td class="desc">
                                                <?= htmlspecialchars($productModel->getProTypeByProductId($product['type_id'])[0]['type_name']) ?>
                                            </td>
                                            <td><?= htmlspecialchars(number_format($product['price']))?> VND</td>
                                            <td>
                                                <?php if ($product['feature'] == 1) {?>
                                                <span class="status--process">Popular</span>
                                                <?php }else{?>
                                                <span class="status--denied">Normal</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a
                                                        href="edit.php?id=<?= rand(100, 999) . md5($product['id'] . "chuyen-de-web-2") . rand(100, 999)?>">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    </button>
                                                    <a
                                                        href="delete.php?id=<?php echo rand(100, 999) . md5($product['id'] . "chuyen-de-web-2") . rand(100, 999) ?>"><button
                                                            class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php }  ?>
                                    </tbody>

                                </table>
                            </div>
                            <?php } else { ?>
                            <!-- Test Reflected XSS bằng htmlspecialchars -->
                            <?php if (!empty($params['keyword'])) { ?>
                            <div class="alert alert-warning" role="alert">
                                <?php echo htmlspecialchars($params['keyword']) ?>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

            <!-- COPYRIGHT-->
            <?php include('../../views/admin/partials/copyright.php') ?>
            <!-- END COPYRIGHT-->
        </div>

    </div>
    <!-- Jquery JS-->
    <script src="../../public/backend/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../../public/backend/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../../public/backend/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../../public/backend/vendor/slick/slick.min.js">
    </script>
    <script src="../../public/backend/vendor/wow/wow.min.js"></script>
    <script src="../../public/backend/vendor/animsition/animsition.min.js"></script>
    <script src="../../public/backend/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../../public/backend/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../../public/backend/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../../public/backend/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../../public/backend/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../public/backend/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../../public/backend/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../../public/backend/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="../../public/js/xss.js"></script>

</body>

</html>
<!-- end document-->