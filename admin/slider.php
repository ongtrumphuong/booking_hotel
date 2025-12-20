<?php 
    require('component/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Slider</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/slider.css">
    
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Quản lý Slider</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <h5 class="card-header-title m-0">Danh sách hình ảnh</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#slider-s">
                                <i class="bi bi-plus-lg me-1"></i> Thêm mới
                            </button>
                        </div>
                        
                        <div class="row" id="slider-data">
                            </div>
                    </div>
                </div>

                <div class="modal fade" id="slider-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="slider_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm hình ảnh</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold mb-2">Chọn hình ảnh</label>
                                        <input type="file" class="form-control shadow-none" id="slider_image_inp" name="slider_image" accept=".webp, .jpg, .jpeg, .png" required>
                                        <div class="form-text mt-2 text-muted small">Hỗ trợ: .jpg, .png, .webp (Khuyên dùng ảnh ngang)</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="slider_image.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn btn-custom-dark shadow-none">Lưu lại</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
    <script src="scripts/slider.js"></script>
</body>
</html>