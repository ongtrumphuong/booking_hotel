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
    <title>Trang Quản Trị - Đơn đặt phòng</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/new_bookings.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Đơn đặt phòng</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-end mb-4">
                             <div class="input-group w-50 w-md-25">
                                <span class="input-group-text bg-white border-end-0 rounded-start-pill ps-3">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none border-start-0 rounded-end-pill search-input ps-2" placeholder="Tìm kiếm...">
                            </div>
                        </div>    

                        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center align-middle mb-0" style="min-width: 1200px;">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Thông tin khách hàng</th>
                                        <th scope="col">Chi tiết phòng</th>
                                        <th scope="col">Chi tiết đặt phòng</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="assign_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Xếp phòng cho khách</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nhập số phòng</label>
                            <input type="text" class="form-control shadow-none" name="room_no" required placeholder="Ví dụ: P101, P205...">
                        </div>
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"></i>
                            <div class="small">
                                Chú ý: Chỉ thực hiện xếp phòng khi khách đã đến nhận phòng!
                            </div>
                        </div>
                        <input type="hidden" name="booking_id">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-custom-dark shadow-none">Xác nhận xếp phòng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require('component/scripts.php'); ?>
    <script src="scripts/new_bookings.js"></script>
</body>
</html>