<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <?php require('component/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?></title>
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
                <?php
                    $res = selectAll('slider');
                    while($row = mysqli_fetch_assoc($res)){
                        $path = SLIDER_IMG_PATH;
                        echo<<<data
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="w-100 d-block"/>
                            </div>
                        data;
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- form kiểm tra xem phòng có sẵn -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded mb-4">
                <h5 class="mb-4">Tìm chỗ nghỉ ngơi</h5>
                <form action="rooms.php">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Ngày nhận phòng</label>
                            <input type="date" class="form-control shadow-none" name="checkin" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Ngày trả phòng</label>
                            <input type="date" class="form-control shadow-none" name="checkout" required>
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Người lớn</label>
                            <select class="form-select shadow-none" name="adult">
                                <?php
                                    $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` 
                                        FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                                    
                                    $guests_res = mysqli_fetch_assoc($guests_q);

                                    for($i=1; $i<=$guests_res['max_adult']; $i++){
                                        echo"<option value='$i'>$i Người lớn</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Trẻ em</label>
                            <select class="form-select shadow-none" name="children">
                                <?php
                                    for($i=0; $i<=$guests_res['max_children']; $i++){
                                        echo"<option value='$i'>$i Trẻ em</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="check_availability">
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
            <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                while($room_data = mysqli_fetch_assoc($room_res)){
                    // lấy thông tin đặc điểm phòng

                    $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                        WHERE rfea.room_id = '$room_data[id]'");
                    
                    $features_data = "";
                    while($fea_row = mysqli_fetch_assoc($fea_q)){
                        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fea_row[name]
                        </span>";
                    }
                    
                    // lấy thông tin tiện nghi phòng
                    
                    $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                        WHERE rfac.room_id = '$room_data[id]'");
                    
                    $facilities_data = "";
                    while($fac_row = mysqli_fetch_assoc($fac_q)){
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                            $fac_row[name]
                        </span>";
                    }

                    // lấy thông tin ảnh đại diện

                    $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                    $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` 
                        WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
                    
                    if(mysqli_num_rows($thumb_q) > 0){
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                    }

                    $book_btn = "";

                    if(!$settings_r['shutdown']) {
                        $login = 0;
                        if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                            $login = 1;
                        }
                        $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Đặt phòng ngay</button>";
                    }

                    $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` 
                        WHERE `room_id` = '$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

                    $rating_res = mysqli_query($con,$rating_q);
                    $rating_fetch = mysqli_fetch_assoc($rating_res);

                    $rating_data = "";

                    if($rating_fetch['avg_rating'] != NULL){
                        $rating_data =  "<div class='rating mb-4'>
                            <h6 class='mb-1'>Đánh giá</h6>
                            <span class='badge rounded-pill bg-light'>
                        ";

                        for($i = 0; $i < $rating_fetch['avg_rating']; $i++){
                            $rating_data .= "<i class='bi bi-star-fill text-warning'></i> ";
                        }

                        $rating_data .= "</span>
                            </div>
                        ";
                    }
                    
                    echo<<<data
                        <div class="col-lg-4 col-md-6 my-3">
                            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                <img src="$room_thumb" class="card-img-top">
                                <div class="card-body">
                                    <h5>$room_data[name]</h5>
                                    <h6 class="mb-4">VND $room_data[price] cho 1 đêm</h6>
                                    <div class="features mb-4">
                                        <h6 class="mb-1">Đặc điểm</h6>
                                        $features_data
                                    </div>
                                    <div class="facilities mb-4">
                                        <h6 class="mb-1">Tiện nghi</h6>
                                        $facilities_data
                                    </div>
                                    <div class="guest mb-4">
                                        <h6 class="mb-1">Số lượng khách</h6>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[adult] người lớn 
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            $room_data[children] trẻ em
                                        </span>
                                    </div>
                                    $rating_data
                                    <div class="d-flex justify-content-evenly mb-2">
                                        $book_btn
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    data;
                }
            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm...</a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Cơ sở vật chất</h2>

    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

            <?php
                $res = mysqli_query($con,'SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res)){
                    echo<<<data
                        <div class="col-lg-2 col-md-3 my-3">
                            <div class="facility-card text-center">
                                <div class="facility-img-container">
                                    <img src="$path$row[image]">
                                </div>
                                <div class="p-3">
                                    <h5 class="mt-2">$row[name]</h5>
                                </div>
                            </div>
                        </div>
                    data;
                }
            ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Xem thêm...</a>
            </div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Đánh giá từ khách hàng</h2>

    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <?php
                    $review_q = "SELECT rr.*,uc.name AS uname, uc.profile, r.name AS rname FROM `rating_review` rr
                        INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                        INNER JOIN `rooms` r ON rr.room_id = r.id
                        ORDER BY `sr_no` DESC LIMIT 6";

                    $review_res = mysqli_query($con,$review_q);
                    $img_path = USERS_IMG_PATH;

                    if(mysqli_num_rows($review_res) == 0){
                        echo 'No reviews yet!';
                    }
                    else {
                        while($row = mysqli_fetch_assoc($review_res)){
                            $stars = "<i class='bi bi-star-fill text-warning'></i> ";
                            for($i=1;$i<$row['rating'];$i++){
                                $stars .= " <i class='bi bi-star-fill text-warning'></i>";
                            }

                            echo<<<slides
                                <div class="swiper-slide bg-white p-4">
                                    <div class="profile d-flex align-items-center mb-3">
                                        <img src="$img_path$row[profile]" class="rounded-circle" loading="lazy" width="30px">
                                        <h6 class="m-0 ms-2">$row[uname]</h6>
                                    </div>
                                    <p>$row[review]</p>
                                    <div class="rating">
                                        $stars
                                    </div>
                                </div>
                            slides;
                        }
                    }
                
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Liên hệ với chúng tôi</h2>

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe']; ?>" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5 class="mb-3">Liên hệ thông tin</h5>
                    <a href="tel: +<?php echo $contact_r['pn1']; ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']; ?>
                    </a>
                    <br>
                    <?php
                        if($contact_r['pn2'] != ''){
                            echo<<<data
                                <a href="tel: $contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                                    <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                                </a>
                            data;
                        }
                    ?>

                    
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5 class="mb-3">Theo dõi chúng tôi</h5>
                    <a href="<?php echo $contact_r['fb']; ?>" class="d-inline-block mb-3 text-decoration-none text-dark">
                        <i class="bi bi-facebook me-1"></i> Facebook
                    </a>                   
                    <br>
                    <a href="<?php echo $contact_r['insta']; ?>" class="d-inline-block mb-3 text-decoration-none text-dark">
                        <i class="bi bi-instagram me-1"></i> Instagram
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['tw']; ?>" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-twitter me-1"></i> Twitter
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['ln']; ?>" class="d-inline-block mt-3 text-decoration-none text-dark">
                        <i class="bi bi-linkedin me-1"></i> LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Password reset modal and code -->

    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i> Thiết lập mật khẩu mới
                        </h5>
                    </div>
                    <div class="modal-body">
                        
                        <div class="mb-4">
                            <label for="email" class="form-label">Mật khẩu mới</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">
                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">Thoát</button>
                            <button type="submit" class="btn btn-dark shadow-none">Xác nhận</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require('component/footer.php'); ?>

    <?php 
        if(isset($_GET['account_recovery'])) {
            $data = filteration($_GET);

            $t_date = date("Y-m-d");

            $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
                [$data['email'],$data['token'],$t_date],'sss');
            
            if(mysqli_num_rows($query) == 1){
                echo<<<showModal
                    <script>
                        var myModal = document.getElementById('recoveryModal');

                        myModal.querySelector("input[name='email']").value = '$data[email]';
                        myModal.querySelector("input[name='token']").value = '$data[token]';

                        var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                        modal.show();
                    </script>
                showModal;
            }
            else {
                alert("error","Đường dẫn không hợp lệ hoặc đã hết hạn !");
            }
        }
    ?>
    
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

        // khôi phục tài khoản 
        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit', e => {
            e.preventDefault();

            let data = new FormData();

            data.append('email',recovery_form.elements['email'].value);
            data.append('token',recovery_form.elements['token'].value);
            data.append('pass',recovery_form.elements['pass'].value);
            data.append('recover_user','');

            var myModal = document.getElementById('recoveryModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/login_register.php",true);

            xhr.onload = function(){
                if(this.responseText == 'failed') {
                    alert('error',"Thiết lập lại tài khoản thất bại !");
                }
                else {
                    alert('success',"Thiết lập lại tài khoản thành công !");
                    recovery_form.reset();
                }
            }
            
            xhr.send(data);
        });
  </script>
</body>
</html>