<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel - Liên hệ</title>
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
        <h2 class="fw-bold h-font text-center">Liên hệ với chúng tôi</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Trải nghiệm tiện nghi đẳng cấp tại T1 Hotel</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.7704107973123!2d106.67178467451959!3d10.98069455539375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d1085e2b1c37%3A0x73bfa5616464d0ee!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaOG7pyBE4bqndSBN4buZdA!5e0!3m2!1svi!2s!4v1762363368166!5m2!1svi!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    
                        <h5>Địa chỉ</h5>
                    <a href="https://maps.app.goo.gl/aAwBTPCr8BkuNsbt9" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> 06 Trần Văn Ơn, Phú Hoà, Thủ Dầu Một, Bình Dương, Việt Nam
                    </a>
                    
                    <h5 class="mt-4">Số điện thoại</h5>
                    <a href="tel:+842743822288" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-telephone-fill"></i> +84 274 3822 518
                    </a>
                    
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: 2224801030012@student.tdmu.edu.vn" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i> 2224801030012@student.tdmu.edu.vn
                    </a>

                    <h5 class="mt-4">Theo dõi chúng tôi</h5>
                    <div>
                        <a href="#" class="d-inline-block text-dark fs-5 me-3">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="d-inline-block text-dark fs-5 me-3">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="d-inline-block text-dark fs-5 me-3">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="d-inline-block text-dark fs-5">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form>
                        <h5>Gửi tin nhắn cho chúng tôi</h5>
                        <div class="mt-3">
                            <label class="form-label">Tên của bạn</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Email của bạn</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Tin nhắn</label>
                            <textarea class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark shadow-none mt-3">Gửi tin nhắn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <?php require('component/footer.php'); ?>
    
</body>
</html>