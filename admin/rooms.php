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
    <title>Trang Quản Trị - Quản lý Phòng</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/rooms.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Quản lý Phòng</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">

                        <div class="text-end mb-4">
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-lg me-1"></i> Thêm phòng mới
                            </button>
                        </div>    

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: auto;">
                            <table class="table custom-table table-hover border text-center align-middle mb-0">
                                <thead class="sticky-top" style="z-index: 1;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên phòng</th>
                                        <th scope="col">Diện tích</th>
                                        <th scope="col">Khách (NL/TE)</th>
                                        <th scope="col">Giá / Đêm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm phòng mới</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên phòng</label>
                                <input type="text" class="form-control shadow-none" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diện tích (m²)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="area" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá (VNĐ)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số lượng phòng</label>
                                <input type="number" min="1" class="form-control shadow-none" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Người lớn (Tối đa)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Trẻ em (Tối đa)</label>
                                <input type="number" min="0" class="form-control shadow-none" name="children" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold mb-2">Tiện ích (Features)</label>
                                <div class="row g-2">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3'>
                                                    <div class='form-check'>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none' id='feature_$opt[id]'> 
                                                        <label class='form-check-label' for='feature_$opt[id]'>$opt[name]</label>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold mb-2">Tiện nghi (Facilities)</label>
                                <div class="row g-2">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3'>
                                                    <div class='form-check'>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none' id='facility_$opt[id]'> 
                                                        <label class='form-check-label' for='facility_$opt[id]'>$opt[name]</label>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả chi tiết</label>
                                <textarea name="desc" class="form-control shadow-none" rows="4" required></textarea>
                            </div>
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

    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa thông tin phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên phòng</label>
                                <input type="text" class="form-control shadow-none" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diện tích (m²)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="area" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá (VNĐ)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số lượng phòng</label>
                                <input type="number" min="1" class="form-control shadow-none" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Người lớn (Tối đa)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Trẻ em (Tối đa)</label>
                                <input type="number" min="0" class="form-control shadow-none" name="children" required>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold mb-2">Tiện ích (Features)</label>
                                <div class="row g-2">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3'>
                                                    <div class='form-check'>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none' id='edit_feature_$opt[id]'> 
                                                        <label class='form-check-label' for='edit_feature_$opt[id]'>$opt[name]</label>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold mb-2">Tiện nghi (Facilities)</label>
                                <div class="row g-2">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3'>
                                                    <div class='form-check'>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none' id='edit_facility_$opt[id]'> 
                                                        <label class='form-check-label' for='edit_facility_$opt[id]'>$opt[name]</label>
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả chi tiết</label>
                                <textarea name="desc" class="form-control shadow-none" rows="4" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-custom-dark shadow-none">Lưu thay đổi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Quản lý hình ảnh phòng</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Thêm hình ảnh mới</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control shadow-none" name="image" accept=".webp, .jpg, .jpeg, .png" required>
                                <button class="btn btn-custom-dark text-white shadow-none">
                                    <i class="bi bi-cloud-arrow-up-fill me-1"></i> Tải lên
                                </button>
                            </div>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: auto;">
                        <table class="table custom-table table-hover border text-center align-middle mb-0">
                            <thead class="sticky-top" style="z-index: 1;">
                                <tr class="bg-dark text-light">
                                    <th scope="col" width="60%">Hình ảnh</th>
                                    <th scope="col">Ảnh chính (Thumb)</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('component/scripts.php'); ?>
    <script src="scripts/rooms.js"></script>
</body>
</html>