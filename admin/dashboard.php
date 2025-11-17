<?php 
    require('component/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <?php require('component/links.php'); ?>
</head>
<body class="bg-light">
    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Trang Quản Trị</h3>
        <a href="logout.php" class="btn btn-light btn-sm">Đăng xuất</a>
        
    </div>
    <?php require('component/scripts.php'); ?>
</body>
</html>