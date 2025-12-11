<?php 
    require('component/links.php'); 
    require('component/header.php');
?>
<title><?php echo $settings_r['site_title'] ?> - Trạng thái Thanh toán</title>
<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">Trạng thái Thanh toán</h2>
        </div>

        <div class="col-lg-12 col-md-12 px-4">
            <div class="card p-3 shadow-sm rounded text-center">
                <?php
                    $filtered_data = filteration($_GET); 
                    $status = $filtered_data['status'];
                    $message = $filtered_data['msg'];
                    $ref = $filtered_data['ref'];
                    
                    if($status == 'booked') {
                        echo "
                            <h4 class='text-success'>Thành công! <i class='bi bi-check-circle-fill'></i></h4>
                            <p>$message</p>
                            <p>Mã tham chiếu: <b>$ref</b></p>
                            <a href='index.php' class='btn btn-success shadow-none'>Quay lại Trang chủ</a>
                        ";
                    } else {
                        echo "
                            <h4 class='text-danger'>Thất bại! <i class='bi bi-x-circle-fill'></i></h4>
                            <p>$message</p>
                            <p>Mã tham chiếu: <b>$ref</b></p>
                            <a href='rooms.php' class='btn btn-danger shadow-none'>Thử lại Đặt phòng</a>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require('component/footer.php'); ?>