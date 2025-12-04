<?php
    require('admin/component/db_config.php');
    require('admin/component/essentials.php');

    if(isset($_GET['email_confirmation'])) {
        $data = filteration($_GET);

        $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? LIMIT 1",
            [$data['email'],$data['token']],'ss');

        if(mysqli_num_rows($query) == 1) {
            $fetch = mysqli_fetch_assoc($query);

            if($fetch['is_verified'] == 1) {
                echo "<script>alert('Email đã được xác minh!')</script>";
            }
            else {
                $update = update("UPDATE `user_cred` SET `is_verified` = ? WHERE `id` = ?",[1,$fetch['id']],'ii');
                if($update) {
                    echo "<script>alert('Email đã được xác minh thành công!')</script>";
                }
                else {
                    echo "<script>alert('Xác minh email thất bại! Vui lòng thử lại sau!')</script>";
                }
            }
            redirect("index.php");
        }
        else {
            echo "<script>alert('Link không hợp lệ!')</script>";
            redirect('index.php');
        }
    }
?>