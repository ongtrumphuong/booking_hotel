<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('component/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Liên hệ</title>
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
                    <iframe class="w-100 rounded mb-4" height="320px" src="<?php echo $contact_r['iframe']; ?>" loading="lazy"></iframe>
                    
                    <h5>Địa chỉ</h5>
                    <a href="<?php echo $contact_r['gmap']; ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address']; ?>
                    </a>

                    <h5 class="mt-4">Số điện thoại</h5>
                    <a href="tel:+<?php echo $contact_r['pn1']; ?>" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1']; ?>
                    </a>
                    
                    <?php
                        if($contact_r['pn2'] != '') {
                            echo<<<data
                                <br>
                                <a href="tel:+$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                                    <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                                </a>
                            data;
                        }
                    ?>

                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email']; ?>" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email']; ?>
                    </a>

                    <h5 class="mt-4">Theo dõi chúng tôi</h5>
                    <div>
                        <?php
                            if($contact_r['fb'] != '') {
                                echo<<<data
                                    <a href="$contact_r[fb]" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                data;
                            }
                            if($contact_r['insta'] != '') {
                                echo<<<data
                                    <a href="$contact_r[insta]" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                data;
                            }
                            if($contact_r['tw'] != '') {
                                echo<<<data
                                    <a href="$contact_r[tw]" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                data;
                            }
                            if($contact_r['ln'] != '') {
                                echo<<<data
                                    <a href="$contact_r[ln]" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                data;
                            }
                        ?>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Gửi tin nhắn cho chúng tôi</h5>
                        <div class="mt-3">
                            <label class="form-label">Tên của bạn</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Email của bạn</label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Tiêu đề</label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Tin nhắn</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn btn-dark shadow-none mt-3">Gửi tin nhắn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['send'])) {
            $frm_data = filteration($_POST);

            $query = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

            $res = insert($query, $values, 'ssss');

            if($res == 1) {
                alert('success', 'Tin nhắn của bạn đã được gửi thành công!');
            }
            else {
                alert('error', 'Gửi tin nhắn thất bại! Vui lòng thử lại sau.');
            }
        }
    ?>

    <?php require('component/footer.php'); ?>
    
</body>
</html>