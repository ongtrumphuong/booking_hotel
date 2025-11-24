<?php
    require('admin/component/db_config.php');
    require('admin/component/essentials.php');
    
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
?>
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">T1 Hotel</a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Đặt phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Tiện nghi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Đăng nhập
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Đăng ký
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Đăng nhập
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control shadow-none">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">Login</button>
                        <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> Đăng ký
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Chú ý: Thông tin đăng ký của bạn phải trùng khớp với ID của bạn (CCCD/Hộ chiếu/Bằng lái xe) để tránh những rắc rối không đáng có trong quá trình nhận phòng.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control shadow-none">                                    
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" class="form-control shadow-none">                                    
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="name" class="form-label">Số điện thoại</label>
                                <input type="number" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="name" class="form-label">Minh chứng</label>
                                <input type="file" class="form-control shadow-none">
                            </div>

                            <div class="col-md-12 p-0 mb-3">
                                <label for="name" class="form-label">Địa chỉ</label>
                                <textarea class="form-control shadow-none" rows="1"></textarea>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="name" class="form-label">Mã PIN</label>
                                <input type="number" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="name" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control shadow-none">
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label for="name" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="name" class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control shadow-none">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark shadow-none">Đăng ký</button>
                    </div> 
                </div>
            </form>
        </div>
    </div>
</div>