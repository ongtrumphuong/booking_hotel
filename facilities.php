<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel - Cơ sở vật chất</title>
    <?php require('component/links.php'); ?>
    <style>
        .h-line {
            width: 110px;
            height: 1.7px !important;
            margin: 0 auto;
        }   
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Cơ sở vật chất</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Trải nghiệm tiện nghi đẳng cấp tại T1 Hotel</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                    <!-- Ảnh nằm tràn trên và hai bên -->
                    <img src="images/facilities/pool.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <!-- Nội dung có padding -->
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Hồ bơi vô cực</h5>
                        <p>Thư giãn và tận hưởng khung cảnh tuyệt đẹp từ hồ bơi vô cực trên tầng thượng của chúng tôi.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow- h-100">
                    <img src="images/facilities/spa.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Spa & Wellness</h5>
                        <p>Thư giãn và tái tạo năng lượng với các liệu pháp spa chuyên nghiệp và không gian yên tĩnh.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                    <img src="images/facilities/gym.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Phòng tập gym</h5>
                        <p>Duy trì thói quen tập luyện của bạn với trang thiết bị hiện đại tại phòng tập gym của chúng tôi.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                    <img src="images/facilities/restaurant.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Nhà hàng 5 sao</h5>
                        <p>Thưởng thức ẩm thực đa dạng và tinh tế tại nhà hàng sang trọng của chúng tôi.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                    <img src="images/facilities/conference.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Phòng hội nghị</h5>
                        <p>Tổ chức sự kiện và hội thảo chuyên nghiệp với các phòng hội nghị hiện đại và tiện nghi.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                    <img src="images/facilities/lounge.png" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Lounge sang trọng</h5>
                        <p>Thư giãn và tận hưởng không gian sang trọng tại lounge của chúng tôi với đồ uống và dịch vụ cao cấp.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <?php require('component/footer.php'); ?>
    
</body>
</html>