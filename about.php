<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <?php require('component/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Về chúng tôi</title>
    <style>
        .h-line {
            width: 110px;
            height: 1.7px !important;
            margin: 0 auto;
        }   
        .box {
            border-top-color: var(--teal) !important;
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Về chúng tôi</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod.</p>
    </div>
    
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-6 col-md-6 mb-4">
                <img src="images/about/about_us.jpg" class="w-100 rounded shadow">
            </div>
            <div class="col-lg-6 col-md-6 mb-4">
                <h3 class="mb-3">Chào mừng đến với T1 Hotel</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 text-center box border-top border-4 box h-100">
                    <h4 class="mb-2">10+</h4>
                    <h5 class="mb-3">Năm kinh nghiệm</h5>
                    <p>Chúng tôi đã phục vụ khách hàng trong hơn một thập kỷ với dịch vụ xuất sắc.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 text-center box border-top border-4 box h-100">
                    <h4 class="mb-2">500+</h4>
                    <h5 class="mb-3">Khách hàng hài lòng</h5>
                    <p>Hàng trăm khách hàng đã trải nghiệm dịch vụ tuyệt vời của chúng tôi.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 text-center box border-top border-4 box h-100">
                    <h4 class="mb-2">50+</h4>
                    <h5 class="mb-3">Nhân viên chuyên nghiệp</h5>
                    <p>Đội ngũ nhân viên tận tâm và chuyên nghiệp luôn sẵn sàng phục vụ bạn.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 text-center box border-top border-4 box h-100">
                    <h4 class="mb-2">1000+</h4>
                    <h5 class="mb-3">Phòng đã đặt</h5>
                    <p>Hàng ngàn phòng đã được đặt bởi khách hàng trên toàn thế giới.</p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">Đội ngũ của chúng tôi</h3>

    <div class="container px-4">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                    $about_r = selectAll('team_details');
                    $path = ABOUT_IMG_PATH;
                    while($row = mysqli_fetch_assoc($about_r)){
                        echo<<<data
                            <div class="swiper-slide bg-white rounded overflow-hidden text-center">
                                <img src="$path$row[image]" class="w-100">
                                <h5 class="text-center">$row[name]</h5>
                            </div>
                        data;
                    }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>



    <?php require('component/footer.php'); ?>    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });
    </script>
</body>
</html>