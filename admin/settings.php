<?php 
    require('component/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Cài đặt</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/settings.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Cài đặt hệ thống</h3>
                
                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-header-title m-0">Cài đặt chung</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
                            </button>
                        </div>
                        <h6 class="data-label mb-1">Tên trang web</h6>
                        <p class="data-text" id="site_title"></p>
                        
                        <h6 class="data-label mb-1">Về chúng tôi</h6>
                        <p class="data-text" id="site_about"></p>
                    </div>
                </div>

                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cài đặt chung</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tên trang web</label>
                                        <input type="text" class="form-control shadow-none" id="site_title_inp" name="site_title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Về chúng tôi</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn btn-custom-dark shadow-none">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-header-title m-0 text-danger">Chế độ bảo trì (Shutdown)</h5>
                            <div class="form-check form-switch ms-auto">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown_toggle" style="cursor: pointer; width: 3rem; height: 1.5rem;">
                                </form>
                            </div>
                        </div>
                        <p class="text-muted mb-0">
                            Khi bật tính năng này, trang web sẽ bị khóa đối với người dùng thường. Chỉ quản trị viên mới có thể truy cập.
                        </p>
                    </div>
                </div>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-header-title m-0">Thông tin liên hệ</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil-square me-1"></i> Chỉnh sửa
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Địa chỉ</h6>
                                    <p class="data-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Google Map Link</h6>
                                    <p class="data-text text-truncate" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Số điện thoại</h6>
                                    <p class="data-text mb-1">
                                        <i class="bi bi-telephone-fill me-1"></i> <span id="pn1"></span>
                                    </p>
                                    <p class="data-text">
                                        <i class="bi bi-telephone-fill me-1"></i> <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Email</h6>
                                    <p class="data-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Mạng xã hội</h6>
                                    <p class="data-text mb-1"><i class="bi bi-facebook me-2"></i> <span id="fb"></span></p>
                                    <p class="data-text mb-1"><i class="bi bi-instagram me-2"></i> <span id="insta"></span></p>
                                    <p class="data-text mb-1"><i class="bi bi-twitter me-2"></i> <span id="tw"></span></p>
                                    <p class="data-text"><i class="bi bi-linkedin me-2"></i> <span id="ln"></span></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="data-label mb-1">Bản đồ (iFrame)</h6>
                                    <iframe id="iframe" class="border rounded p-1 w-100" loading="lazy" style="height: 200px; background: #eee;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cập nhật liên hệ</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Địa chỉ</label>
                                                    <input type="text" class="form-control shadow-none" id="address_inp" name="address" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" class="form-control shadow-none" id="gmap_inp" name="gmap" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Số điện thoại</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" class="form-control shadow-none" id="pn1_inp" name="pn1" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" class="form-control shadow-none" id="pn2_inp" name="pn2">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="email" class="form-control shadow-none" id="email_inp" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Mạng xã hội</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="fb_inp" name="fb">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="insta_inp" name="insta">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="tw_inp" name="tw">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="ln_inp" name="ln">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame Bản đồ</label>
                                                    <input type="text" class="form-control shadow-none" id="iframe_inp" name="iframe" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn btn-custom-dark shadow-none">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4 justify-content-between">
                            <h5 class="card-header-title m-0">Đội ngũ quản lý</h5>
                            <button class="btn btn-custom-dark btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-lg me-1"></i> Thêm thành viên
                            </button>
                        </div>
                        
                        <div class="row" id="team-data">
                            </div>
                    </div>
                </div>

                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm thành viên</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Họ tên</label>
                                        <input type="text" class="form-control shadow-none" id="member_name_inp" name="member_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Hình ảnh</label>
                                        <input type="file" class="form-control shadow-none" id="member_image_inp" name="member_image" accept=".webp, .jpg, .jpeg, .png" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value='', member_image.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
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
    <script src="scripts/settings.js"></script>
</body>
</html>