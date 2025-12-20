<?php 
    require('component/essentials.php');
    require('component/db_config.php');
    adminLogin();

    if(isset($_GET['seen'])){
        $frm_data = filteration($_GET);

        if($frm_data['seen'] == 'all'){
            $q = "UPDATE `rating_review` SET `seen`=?";
            $values = [1];
            if(update($q,$values,'i')){
                alert('success','Tất cả lời nhắn đã được đánh dấu là đã xem!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
        else{
            $q = "UPDATE `rating_review` SET `seen`=? WHERE `sr_no`=?";
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
            $q = "DELETE FROM `rating_review`";
            if(mysqli_query($con,$q)){
                alert('success','Tất cả lời nhắn đã được xóa thành công!');
            }
            else{
                alert('error','Lỗi không xác định! Vui lòng thử lại sau.');
            }
        }
        else{
            $q = "DELETE FROM `rating_review` WHERE `sr_no`=?";
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
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Quản lý Đánh giá</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/rate_review.css">
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4 section-title">Quản lý Đánh giá & Nhận xét</h3>

                <div class="card dashboard-card mb-4">
                    <div class="card-body p-4">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-custom-dark rounded-pill shadow-none btn-sm me-2">
                                <i class="bi bi-check-all me-1"></i> Đánh dấu tất cả đã xem
                            </a>
                            <a href="?del=all" class="btn btn-custom-danger rounded-pill shadow-none btn-sm">
                                <i class="bi bi-trash me-1"></i> Xóa tất cả
                            </a>
                        </div>

                        <div class="table-responsive-md">
                            <table class="table custom-table table-hover border text-center align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Phòng</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Điểm số</th>
                                        <th scope="col" width="30%">Nội dung nhận xét</th>
                                        <th scope="col">Ngày đăng</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT rr.*,uc.name AS uname, r.name AS rname FROM `rating_review` rr
                                            INNER JOIN `user_cred` uc ON rr.user_id = uc.id
                                            INNER JOIN `rooms` r ON rr.room_id = r.id
                                            ORDER BY `sr_no` DESC";
                                        $data = mysqli_query($con, $q);
                                        $i = 1;
                                        
                                        while($row = mysqli_fetch_assoc($data)){
                                            $date = date('d/m/Y',strtotime($row['datentime']));

                                            $seen = '';
                                            // Chỉ hiện nút "Đã xem" và xuống dòng nều chưa xem
                                            if($row['seen'] != 1){
                                                $seen .= "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-custom-dark mb-2 shadow-none' style='font-size: 0.8rem;'><i class='bi bi-check2'></i> Đã xem</a>";
                                                $seen .= "<br>"; // Chỉ xuống dòng khi có nút ở trên
                                            }
                                            
                                            // Nút xóa luôn hiện
                                            $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-outline-danger shadow-none' style='font-size: 0.8rem;'><i class='bi bi-trash'></i> Xóa</a>";
                                            
                                            // Icon sao
                                            $stars = "<span class='rating-badge'><i class='bi bi-star-fill'></i> $row[rating]</span>";

                                            echo<<<query
                                                <tr>
                                                    <td>$i</td>
                                                    <td><span class='fw-bold text-dark'>$row[rname]</span></td>
                                                    <td>$row[uname]</td>
                                                    <td>$stars</td>
                                                    <td class='text-start'>$row[review]</td>
                                                    <td>$date</td>
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