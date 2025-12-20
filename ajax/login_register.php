<?php
    require('../admin/component/db_config.php');
    require('../admin/component/essentials.php');
    require("../component/sendgrid/sendgrid-php.php");

    date_default_timezone_set("Asia/Ho_Chi_Minh");

    function send_mail($uemail, $token, $type) {

        if($type == "email_confirmation") {
            $page = 'email_confirm.php';
            $subject = "Xác thực tài khoản của bạn";
            $content = "Xác thực mail của bạn";
        }
        else {
            $page = 'index.php';
            $subject = "Đặt lại mật khẩu tài khoản của bạn";
            $content = "Đặt lại mật khẩu của bạn";
        }

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom(SENDGRID_EMAIL, SENDGRID_NAME);
        $email->setSubject($subject);
        $email->addTo($uemail);

        $full_link = SITE_URL . "$page?$type&email=$uemail&token=$token";

        $email_html = "
            <div style='background-color: #f3f4f6; padding: 40px 0; font-family: Arial, sans-serif; line-height: 1.6;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);'>
                    
                    <div style='background-color: #111827; padding: 30px; text-align: center;'>
                        <h2 style='color: #ffffff; margin: 0; font-size: 24px; font-weight: 600;'>XÁC NHẬN YÊU CẦU</h2>
                    </div>

                    <div style='padding: 40px 30px; text-align: center; color: #374151;'>
                        <h3 style='margin-top: 0; color: #111827;'>Xin chào,</h3>
                        <p style='margin-bottom: 25px; font-size: 16px;'>
                            Bạn vừa thực hiện yêu cầu: <strong style='color: #111827;'>$content</strong>.<br>
                            Vui lòng nhấn vào nút bên dưới để hoàn tất quá trình này.
                        </p>

                        <a href='$full_link' style='display: inline-block; background-color: #111827; color: #ffffff; text-decoration: none; padding: 14px 30px; border-radius: 50px; font-weight: bold; font-size: 16px; margin: 10px 0 25px 0; box-shadow: 0 4px 6px rgba(17, 24, 39, 0.2);'>
                            Xác nhận ngay
                        </a>

                        <p style='font-size: 14px; color: #6b7280; margin-top: 20px;'>
                            Nếu nút bấm không hoạt động, hãy copy đường dẫn sau và dán vào trình duyệt:
                        </p>
                        <p style='font-size: 13px; color: #3b82f6; word-break: break-all;'>
                            <a href='$full_link' style='color: #3b82f6;'>$full_link</a>
                        </p>
                    </div>

                    <div style='background-color: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb;'>
                        <p style='margin: 0;'>Đây là email tự động, vui lòng không trả lời.</p>
                        <p style='margin: 5px 0 0;'>&copy; 2025 Website Management System</p>
                    </div>
                </div>
            </div>
        ";

        $email->addContent("text/html", $email_html);

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

        if(!send_mail($data['email'], $token, "email_confirmation")){
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

    if(isset($_POST['login'])){
        $data = filteration($_POST);

        $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
            [$data['email_mob'], $data['email_mob']], "ss");
        if(mysqli_num_rows($u_exist) == 0) {
            echo 'inv_email_mob';
        }
        else {
            $u_fetch = mysqli_fetch_assoc($u_exist);
            if($u_fetch['is_verified'] == 0) {
                echo 'not_verified';
            }
            else if($u_fetch['status'] == 0) {
                echo 'inactive';
            }
            else {
                if(!password_verify($data['pass'],$u_fetch['password'])){
                    echo 'invalid_pass';
                }
                else {
                    session_start();
                    $_SESSION['login'] = true;
                    $_SESSION['uId'] = $u_fetch['id'];
                    $_SESSION['uName'] = $u_fetch['name'];
                    $_SESSION['uPic'] = $u_fetch['profile'];
                    $_SESSION['uPhone'] = $u_fetch['phonenum'];
                    echo 1;
                }
            }
        }
    }

    if(isset($_POST['forgot_pass'])){
        $data = filteration($_POST);
        
        $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",[$data['email']], "s");
        if(mysqli_num_rows($u_exist) == 0) {
            echo 'inv_email';
        }
        else {
            $u_fetch = mysqli_fetch_assoc($u_exist);
            if($u_fetch['is_verified'] == 0) {
                echo 'not_verified';
            }
            else if($u_fetch['status'] == 0) {
                echo 'inactive';
            }
            else {
                // gửi link đặt lại mật khẩu tới email
                $token = bin2hex(random_bytes(16));

                if(!send_mail($data['email'],$token,'account_recovery')){
                    echo 'mail_failed';
                }
                else {
                    $date = date('Y-m-d');

                    $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token', `t_expire`='$date' 
                        WHERE `id`='$u_fetch[id]'");
                    
                    if($query) {
                        echo 1;
                    }
                    else {
                        echo 'upd_failed';
                    }
                }
            }
        }
    }

    if(isset($_POST['recover_user'])){
        $data = filteration($_POST);

        $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

        $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=? WHERE `email`=? AND `token`=?";

        $values = [$enc_pass,null,null,$data['email'],$data['token']];

        if(update($query,$values,'sssss')){
            echo 1;
        }
        else {
            echo 'failed';
        }
    }

?>