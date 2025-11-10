<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel - Đặt Phòng</title>
    <?php require('component/links.php'); ?>
    <style>
        .h-line {
            width: 110px;
            height: 1.7px !important;
            margin: 0 auto;
        }   
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Đặt phòng ngay hôm nay</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Trải nghiệm tiện nghi đẳng cấp 6 sao tại T1 Hotel</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 px-lg-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Bộ lọc</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column mt-2 align-items-stretch" id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">Kiểm tra phòng</h5>
                                <label class="form-label">Từ ngày:</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label  class="form-label">Đến ngày:</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">Tiện nghi</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="wifi" class="form-check-input shadow-none me-1">
                                    <label for="wifi" class="form-check-label">Wi-Fi miễn phí</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="breakfast" class="form-check-input shadow-none me-1">
                                    <label for="breakfast" class="form-check-label">Bữa sáng miễn phí</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="pool" class="form-check-input shadow-none me-1">
                                    <label for="pool" class="form-check-label">Hồ bơi</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">Số lượng khách</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Người lớn:</label>
                                        <input type="number" class="form-control shadow-none" min="1" value="1">
                                    </div>
                                    <div>
                                        <label class="form-label">Trẻ em:</label>
                                        <input type="number" class="form-control shadow-none" min="1" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-12 px-4">
                <div class="card mb-4 shadow border-0">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">Phòng Giường Đôi Nhỏ</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Đặc điểm</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 Giường đôi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Phòng tắm riêng
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-rulers me-1"></i> 15m²
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-soundwave me-1"></i> Hệ thống cách âm
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-snow me-1"></i> Có điều hòa
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Tiện nghi</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-wifi me-1"></i>Wifi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-cup-straw me-1"></i>Bữa sáng miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-bus-front-fill me-1"></i>Đưa đón sân bay miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-tv"></i> TV màn hình phẳng
                                </span>
                            </div>
                            <div class="guest">
                                <h6 class="mb-1">Số lượng khách</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    2 người lớn 
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 trẻ em
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                           <h6 class="mb-4">VND 639.900 <br> cho 1 đêm</h6>
                            <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow border-0">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">Phòng Giường Đôi Nhỏ</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Đặc điểm</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 Giường đôi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Phòng tắm riêng
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-rulers me-1"></i> 15m²
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-soundwave me-1"></i> Hệ thống cách âm
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-snow me-1"></i> Có điều hòa
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Tiện nghi</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-wifi me-1"></i>Wifi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-cup-straw me-1"></i>Bữa sáng miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-bus-front-fill me-1"></i>Đưa đón sân bay miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-tv"></i> TV màn hình phẳng
                                </span>
                            </div>
                            <div class="guest">
                                <h6 class="mb-1">Số lượng khách</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    2 người lớn 
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 trẻ em
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                           <h6 class="mb-4">VND 639.900 <br> cho 1 đêm</h6>
                            <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow border-0">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-3">Phòng Giường Đôi Nhỏ</h5>
                            <div class="features mb-3">
                                <h6 class="mb-1">Đặc điểm</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 Giường đôi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    Phòng tắm riêng
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-rulers me-1"></i> 15m²
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-soundwave me-1"></i> Hệ thống cách âm
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-snow me-1"></i> Có điều hòa
                                </span>
                            </div>
                            <div class="facilities mb-3">
                                <h6 class="mb-1">Tiện nghi</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-wifi me-1"></i>Wifi
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-cup-straw me-1"></i>Bữa sáng miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-bus-front-fill me-1"></i>Đưa đón sân bay miễn phí
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i class="bi bi-tv"></i> TV màn hình phẳng
                                </span>
                            </div>
                            <div class="guest">
                                <h6 class="mb-1">Số lượng khách</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    2 người lớn 
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 trẻ em
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                           <h6 class="mb-4">VND 639.900 <br> cho 1 đêm</h6>
                            <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    



    <?php require('component/footer.php'); ?>
    
</body>
</html>