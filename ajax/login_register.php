<?php
    require('../admin/component/db_config.php');
    require('../admin/component/essentials.php');
    require("../component/sendgrid/sendgrid-php.php");

    function send_mail($uemail, $name, $token) {
        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("phuongpd.13a2bb.1920@gmail.com", "T1 Hotel Support");
        $email->setSubject("Xác thực tài khoản của bạn");
        $email->addTo($uemail, $name);

        $email->addContent(
            "text/html", 
            "Nhấn vào đây để xác thực mail của bạn: <br>
                <a href='".SITE_URL."email_confirm.php?email_confirmation&email=$uemail&token=$token"."'>Nhấn vào đây</a>    
            "
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);

        try {
            $sendgrid->send($email);
            return 1;
        }
        catch (Exception $e) {
            return 0;
        }
    }
    
    if(isset($_POST['register'])){
        $data = filteration($_POST);

        if($data['pass'] != $data['cpass']) {
            echo 'pass_mismatch';
            exit;
        }

        // kiểm tra người dùng có tồn tại hay không

        $u_exist = select("SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1",
            [$data['email'], $data['phonenum']], "ss");
        if(mysqli_num_rows($u_exist) != 0) {
            $u_exist_fetch = mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
            exit;
        }

        // tải ảnh người dùng lên máy chủ

        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img') {
            echo 'inv_img';
            exit;
        }
        else if($img == 'upd_failed') {
            echo 'upd_failed';
            exit;
        }

        // gửi xác nhận đến mail của người dùng

        $token = bin2hex(random_bytes(16));

        if(!send_mail($data['email'], $data['name'], $token)){
            echo 'mail_failed';
            exit;
        }

        $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

        $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`,
            `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";

        $values = [$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode'],$data['dob'],
            $img,$enc_pass,$token];

        if(insert($query, $values,'sssssssss')){
            echo 1;
        }
        else {
            echo 'ins_failed';
        }
    }

?>