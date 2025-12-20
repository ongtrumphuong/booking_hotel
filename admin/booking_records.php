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
    <title>Trang Quản Trị - Lịch sử đặt phòng</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/booking_records.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Lịch sử đặt phòng</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-end mb-4">
                            <div class="input-group w-50 w-md-25">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" id="search_input" oninput="get_bookings(this.value)" class="form-control shadow-none border-start-0 rounded-end-pill search-input ps-2" placeholder="Tìm kiếm...">
                            </div>
                        </div>    

                        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center align-middle mb-0" style="min-width: 1200px;">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Thông tin khách hàng</th>
                                        <th scope="col">Thông tin phòng</th>
                                        <th scope="col">Thông tin đặt phòng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">                   
                                </tbody>
                            </table>
                        </div>

                        <nav class="mt-4">
                            <ul class="pagination justify-content-center" id="table_pagination">
                                </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('component/scripts.php'); ?>
    <script src="scripts/booking_records.js"></script>
</body>
</html>