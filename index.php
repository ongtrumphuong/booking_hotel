<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;600&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">T1 Hotel</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link me-2" aria-current="page" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Đặt phòng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Tiện nghi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
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

    <!-- Slider -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/slider/1.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/2.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/3.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/4.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/5.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="images/slider/6.png" class="w-100 d-block"/>
                </div>
            </div>
        </div>
    </div>

    <!-- form kiểm tra xem phòng có sẵn -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded mb-4">
                <h5 class="mb-4">Tìm chỗ nghỉ ngơi</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Ngày nhận phòng</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Ngày trả phòng</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Người lớn</label>
                            <select class="form-select shadow-none">
                                <option value="1">1 Người lớn</option>
                                <option value="2">2 Người lớn</option>
                                <option value="3">3 Người lớn</option>
                                <option value="4">4 Người lớn</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Trẻ em</label>
                            <select class="form-select shadow-none">
                                <option value="0">0 Trẻ em</option>
                                <option value="1">1 Trẻ em</option>
                                <option value="2">2 Trẻ em</option>
                                <option value="3">3 Trẻ em</option>
                                <option value="4">4 Trẻ em</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Tìm phòng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Phòng của chúng tôi</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Phòng Giường Đôi Nhỏ</h5>
                        <h6 class="mb-4">VND 639.900 cho 1 đêm</h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Tiện nghi</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="bi bi-wifi me-1"></i>Wifi miễn phí
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
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Minibar
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Đánh giá</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Phòng Giường Đôi Nhỏ</h5>
                        <h6 class="mb-4">VND 639.900 cho 1 đêm</h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Tiện nghi</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="bi bi-wifi me-1"></i>Wifi miễn phí
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
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Minibar
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Đánh giá</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Phòng Giường Đôi Nhỏ</h5>
                        <h6 class="mb-4">VND 639.900 cho 1 đêm</h6>
                        <div class="features mb-4">
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
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Tiện nghi</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                <i class="bi bi-wifi me-1"></i>Wifi miễn phí
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
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Minibar
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Đánh giá</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Đặt phòng ngay</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm...</a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Cơ sở vật chất</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-3 my-3">
                <div class="facility-card text-center">
                    <div class="facility-img-container">
                        <img src="images/facilities/bathroom.png" alt="Phong tắm cao cấp">
                    </div>
                    <div class="p-3">
                        <h5 class="mt-2">Phòng tắm cao cấp</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 my-3">
                <div class="facility-card text-center">
                    <div class="facility-img-container">
                        <img src="images/facilities/breakfast.png" alt="Bữa sáng miễn phí">
                    </div>
                    <div class="p-3">
                        <h5 class="mt-2">Bữa sáng miễn phí</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 my-3">
                <div class="facility-card text-center">
                    <div class="facility-img-container">
                        <img src="images/facilities/spa.png" alt="Spa">
                    </div>
                    <div class="p-3">
                        <h5 class="mt-2">Spa</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 my-3">
                <div class="facility-card text-center">
                    <div class="facility-img-container">
                        <img src="images/facilities/pool.png" alt="Hồ bơi ngoài trời">
                    </div>
                    <div class="p-3">
                        <h5 class="mt-2">Hồ bơi ngoài trời</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 my-3">
                <div class="facility-card text-center">
                    <div class="facility-img-container">
                        <img src="images/facilities/gym.png" alt="Phòng tập gym">
                    </div>
                    <div class="p-3">
                        <h5 class="mt-2">Phòng tập gym</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm...</a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Đánh giá từ khách hàng</h2>

    <br><br><br>
    <br><br><br>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });
  </script>
</body>
</html>