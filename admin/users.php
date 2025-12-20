<?php 
    require('component/essentials.php');
    require('component/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Người dùng</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Quản lý Người dùng</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-end mb-4">
                            <div class="input-group w-50 w-md-25">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" oninput="search_user(this.value)" class="form-control shadow-none border-start-0 rounded-end-pill search-input ps-2" placeholder="Tìm kiếm tên, email, sđt...">
                            </div>
                        </div>    

                        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center align-middle mb-0" style="min-width: 1300px;">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Vị trí</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Xác thực</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày đăng ký</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data">                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('component/scripts.php'); ?>
    <script src="scripts/users.js"></script>
</body>
</html>