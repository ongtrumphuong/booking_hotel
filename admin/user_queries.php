<?php 
    require('component/essentials.php');
    require('component/db_config.php');
    adminLogin();

    if(isset($_GET['seen'])){
        $frm_data = filteration($_GET);

        if($frm_data['seen'] == 'all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values = [1];
            if(update($q,$values,'i')){
                alert('success','Tất cả lời nhắn đã được đánh dấu là đã xem!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
        else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
            $values = [1,$frm_data['seen']];
            if(update($q,$values,'ii')){
                alert('success','Lời nhắn đã được đánh dấu là đã xem!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
    }

    if(isset($_GET['del'])){
        $frm_data = filteration($_GET);

        if($frm_data['del'] == 'all'){
            $q = "DELETE FROM `user_queries`";
            if(mysqli_query($con,$q)){
                alert('success','Tất cả lời nhắn đã được xóa thành công!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
        else{
            $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
            $values = [$frm_data['del']];
            if(delete($q,$values,'i')){
                alert('success','Lời nhắn đã được xóa thành công!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Lời nhắn từ khách hàng</title>
    <?php require('component/links.php'); ?>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
            z-index: 11;
        }
        @media screen and (max-width: 991px) {
            #dashboard-menu {
                height: auto;
                width: 100%;
            }
            #main-content {
                margin-top: 60px;
            }
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Slider</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm">
                                <i class="bi bi-check-all"></i> Đánh dấu tất cả là đã xem
                            </a>
                            <a href="?del=all" class="btn btn-danger rounded-pill shadow-none btn-sm">
                                <i class="bi bi-trash"></i> Xóa tất cả
                            </a>
                        </div>


                        <div class="table-responsive-md" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center align-middle mb-0">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Lời nhắn</th>
                                        <th scope="col">Ngày gửi</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                        $data = mysqli_query($con, $q);
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($data)){
                                            $seen = '';
                                            if($row['seen'] != 1){
                                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary'>Đánh dấu là đã xem</a>";
                                            }
                                            $seen .= " <a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger mt-2'>Xóa</a>";
                                            echo<<<query
                                                <tr>
                                                    <td>$i</td>
                                                    <td>$row[name]</td>
                                                    <td>$row[email]</td>
                                                    <td>$row[subject]</td>
                                                    <td>$row[message]</td>
                                                    <td>$row[date]</td>
                                                    <td>$seen</td>
                                                    
                                                </tr>
                                            query;
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
</body>
</html>