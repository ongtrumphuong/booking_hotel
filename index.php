<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <?php require('component/links.php'); ?>
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
        @media (max-width: 768px) {
            iframe {
                border-radius: 10px;
            }
            form {
                padding: 0 10px;
            }
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

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
                        <div class="guest mb-4">
                            <h6 class="mb-1">Số lượng khách</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 người lớn 
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 trẻ em
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
                        <div class="guest mb-4">
                            <h6 class="mb-1">Số lượng khách</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 người lớn 
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 trẻ em
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
                        <div class="guest mb-4">
                            <h6 class="mb-1">Số lượng khách</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 người lớn 
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 trẻ em
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

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/testimonials/1.jpg" width="30px">
                        <h6 class="m-0 ms-2">Nguyễn Văn A</h6>
                    </div>
                    <p>Khách sạn rất tuyệt vời, dịch vụ chuyên nghiệp và nhân viên thân thiện. Tôi sẽ quay lại đây trong lần tới!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/testimonials/1.jpg">
                        <h6 class="m-0 ms-2">Nguyễn Văn A</h6>
                    </div>
                    <p>Khách sạn rất tuyệt vời, dịch vụ chuyên nghiệp và nhân viên thân thiện. Tôi sẽ quay lại đây trong lần tới!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="images/testimonials/1.jpg">
                        <h6 class="m-0 ms-2">Nguyễn Văn A</h6>
                    </div>
                    <p>Khách sạn rất tuyệt vời, dịch vụ chuyên nghiệp và nhân viên thân thiện. Tôi sẽ quay lại đây trong lần tới!</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>


            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Liên hệ với chúng tôi</h2>

    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12 mb-4">
                <div class="ratio ratio-4x3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125317.59141872505!2d106.57454237266471!3d11.025513529950134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d17273d88fa1%3A0x4ce77ac2d75e8e4c!2zVHAuIFRo4bunIEThuqd1IE3hu5l0LCBCw6xuaCBExrDGoW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1762225777782!5m2!1svi!2s" 
                        allowfullscreen
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên của bạn</label>
                        <input type="text" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email của bạn</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại của bạn</label>
                        <input type="tel" class="form-control shadow-none">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tin nhắn</label>
                        <textarea class="form-control shadow-none" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark shadow-none">Gửi tin nhắn</button>
                </form>
            </div>
        </div>
    </div>

    <?php require('component/footer.php'); ?>
    
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

        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            sliderPerView: "3",
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
  </script>
</body>
</html>