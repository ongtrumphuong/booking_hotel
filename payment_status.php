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
           <div class="card p-4 shadow-sm rounded text-center">
                <?php
                    $filtered_data = filteration($_GET); 
                    
                    // Lấy các tham số, kiểm tra tồn tại để tránh lỗi
                    $status = isset($filtered_data['status']) ? $filtered_data['status'] : '';
                    $message = isset($filtered_data['msg']) ? $filtered_data['msg'] : '';
                    $ref = isset($filtered_data['ref']) ? $filtered_data['ref'] : '';

                    if($status == 'booked') 
                    {
                        // --- TRƯỜNG HỢP THÀNH CÔNG (Màu Xanh) ---
                        echo "
                            <div class='mb-3'>
                                <i class='bi bi-check-circle-fill text-success' style='font-size: 4rem;'></i>
                            </div>
                            <h4 class='text-success fw-bold'>Thanh toán thành công!</h4>
                            <p class='mb-4'>$message</p>
                            
                            <div class='alert alert-light border shadow-sm d-inline-block px-4 py-2'>
                                Mã giao dịch: <b>$ref</b>
                            </div>
                            
                            <div class='mt-4'>
                                <a href='index.php' class='btn btn-success shadow-none btn-lg'>Về trang chủ</a>
                                <a href='bookings.php' class='btn btn-outline-success shadow-none btn-lg ms-2'>Xem đặt phòng</a>
                            </div>
                        ";
                    } 
                    else if ($status == 'cancelled') 
                    {
                        // --- TRƯỜNG HỢP HỦY (Màu Vàng Cam) ---
                        echo "
                            <div class='mb-3'>
                                <i class='bi bi-exclamation-triangle-fill text-warning' style='font-size: 4rem;'></i>
                            </div>
                            <h4 class='text-warning fw-bold'>Giao dịch đã bị hủy!</h4>
                            <p class='mb-4'>Bạn đã chủ động hủy quá trình thanh toán.</p>
                            
                            <div class='alert alert-light border shadow-sm d-inline-block px-4 py-2'>
                                Mã tham chiếu: <b>$ref</b>
                            </div>
                            
                            <div class='mt-4'>
                                <a href='rooms.php' class='btn btn-warning text-white shadow-none btn-lg'>Đặt lại phòng</a>
                            </div>
                        ";
                    } 
                    else 
                    {
                        // --- TRƯỜNG HỢP LỖI / THẤT BẠI (Màu Đỏ) ---
                        echo "
                            <div class='mb-3'>
                                <i class='bi bi-x-circle-fill text-danger' style='font-size: 4rem;'></i>
                            </div>
                            <h4 class='text-danger fw-bold'>Thanh toán thất bại!</h4>
                            <p class='mb-4'>$message</p>
                            
                            <div class='alert alert-light border shadow-sm d-inline-block px-4 py-2'>
                                Mã tham chiếu: <b>$ref</b>
                            </div>
                            
                            <div class='mt-4'>
                                <a href='rooms.php' class='btn btn-danger shadow-none btn-lg'>Thử lại ngay</a>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php require('component/footer.php'); ?>