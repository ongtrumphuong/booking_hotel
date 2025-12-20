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
    <title>Trang Quản Trị - Tiện ích và tiện nghi</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/features_facilities.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Tiện ích & Tiện nghi</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <h5 class="card-header-title m-0">Danh sách Tiện ích (Features)</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#feature-s">
                                <i class="bi bi-plus-lg me-1"></i> Thêm mới
                            </button>
                        </div>    

                        <div class="table-responsive-md" style="height: 350px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center mb-0">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col">Tên Tiện ích</th>
                                        <th scope="col" width="20%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <h5 class="card-header-title m-0">Danh sách Tiện nghi (Facilities)</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-lg me-1"></i> Thêm mới
                            </button>
                        </div>    

                        <div class="table-responsive-md" style="height: 350px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center mb-0">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col" width="15%">Icon</th>
                                        <th scope="col" width="20%">Tên Tiện nghi</th>
                                        <th scope="col" width="35%">Mô tả chi tiết</th>
                                        <th scope="col" width="20%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Tiện ích</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên tiện ích</label>
                            <input type="text" class="form-control shadow-none" name="feature_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-custom-dark shadow-none">Lưu lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm Tiện nghi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên tiện nghi</label>
                            <input type="text" class="form-control shadow-none" name="facility_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh (Icon)</label>
                            <input type="file" class="form-control shadow-none" name="facility_image" accept=".webp, .jpg, .jpeg, .png" required>
                            <div class="form-text mt-1 text-muted small">Định dạng hỗ trợ: .svg, .png, .jpg</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-custom-dark shadow-none">Lưu lại</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
    <script src="scripts/features_facilities.js"></script>
</body>
</html>