<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('component/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Đặt phòng của tôi</title>
    <style>
        .h-line {
            width: 110px;
            height: 1.7px !important;
            margin: 0 auto;
        }   
    </style>
</head>
<body class="bg-light">
    
    <?php 
        require('component/header.php'); 
        if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            redirect('index.php');
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 px-4">
                <h2 class="fw-bold">Đơn đặt phòng</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Trang chủ</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">Lịch sử đặt phòng</a>
                </div>
            </div>

            <?php
                $query = "SELECT bo.*, bd.* FROM `booking_order` bo
                    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                    WHERE ((bo.booking_status = 'booked')
                    OR (bo.booking_status = 'cancelled')
                    OR (bo.booking_status = 'payment_failed')         
                    OR (bo.booking_status = 'pending'))            
                    AND (bo.user_id = ?)
                    ORDER BY bo.booking_id DESC";

                $result = select($query,[$_SESSION['uId']],'i');

                while($data = mysqli_fetch_assoc($result)) {
                    $date = date("d/m/Y",strtotime($data['datentime']));
                    $checkin = date("d/m/Y",strtotime($data['check_in']));
                    $checkout = date("d/m/Y",strtotime($data['check_out']));
                    
                    // Format tiền tệ
                    $price_fmt = number_format($data['price'], 0, ',', '.');

                    $status_bg = "";
                    $status_text = ""; // Biến chứa text tiếng Việt
                    $btn = "";

                    // Xử lý logic hiển thị trạng thái và nút bấm
                    if($data['booking_status'] == 'booked')
                    {
                        $status_bg = "bg-success";
                        $status_text = "Đặt thành công";
                        
                        if($data['arrival'] == 1){
                            // Khách đã đến -> Hiện nút tải PDF và Đánh giá
                            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Tải hóa đơn PDF</a>";
                            if($data['rate_review']==0){
                                $btn .= "<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Đánh giá</button>";
                            }
                        }
                        else{
                            // Khách chưa đến -> Hiện nút Hủy
                            $btn = "<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>Hủy phòng</button>";
                        }
                    }
                    else if($data['booking_status'] == 'cancelled')
                    {
                        $status_bg = "bg-danger";
                        $status_text = "Đã hủy";

                        if($data['refund'] == 0){
                            $btn = "<span class='badge bg-primary'>Đang xử lý hoàn tiền!</span>";
                        }
                        else{
                            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Tải hóa đơn PDF</a>";
                        }
                    }
                    else if($data['booking_status'] == 'payment_failed')
                    {
                        $status_bg = "bg-danger";
                        $status_text = "Thanh toán lỗi";
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Tải hóa đơn PDF</a>";
                    }
                    else if($data['booking_status'] == 'pending')
                    {
                        $status_bg = "bg-warning text-dark";
                        $status_text = "Chờ thanh toán";
                        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Tải hóa đơn PDF</a>";
                    }

                    // Xuất HTML
                    echo<<<bookings
                        <div class='col-md-4 px-4 mb-4'>
                            <div class='bg-white p-3 rounded shadow-sm'>
                                <h5 class='fw-bold'>$data[room_name]</h5>
                                <p>$price_fmt VND / đêm</p>
                                <p>
                                    <b>Ngày nhận phòng: </b>$checkin<br>
                                    <b>Ngày trả phòng: </b>$checkout
                                </p>
                                <p>
                                    <b>Tổng tiền: </b>$price_fmt VND<br>
                                    <b>Mã đơn hàng: </b>$data[order_id]<br>
                                    <b>Ngày đặt: </b>$date
                                </p>
                                <p>
                                    <span class='badge $status_bg'>$status_text</span>
                                </p>
                                $btn
                            </div>
                        </div>
                    bookings;
                }
            ?>
        </div>
    </div>

    <div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="review-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i> Rate & Review
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Rating</label>
                            <select name="rating" class="form-select shadow-none" required>
                                <option value="" selected disabled>Chọn đánh giá</option>
                                <option value="1">Rất tệ</option>
                                <option value="2">Tệ</option>
                                <option value="3">Trung bình</option>
                                <option value="4">Tốt</option>
                                <option value="5">Xuất sắc</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Review</label>
                            <textarea type="text" name="review" rows="3" required class="form-control shadow-none"></textarea>
                        </div>

                        <input type="hidden" name="booking_id">
                        <input type="hidden" name="room_id">

                        <div class="text-end">
                            <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        if(isset($_GET['cancel_status'])){
            alert('success','Đã hủy đặt phòng thành công!');
        }
        else if(isset($_GET['review_status'])){
            alert('success','Cảm ơn bạn đã đánh giá!');
        }
    ?>

    <?php require('component/footer.php'); ?>
    
    <script>
        function cancel_booking(id){
            if(confirm('Bạn có chắc chắn muốn hủy đơn đặt phòng này không?')){
                
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/cancel_booking.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                xhr.onload = function() {
                    if(this.responseText == 1){
                        window.location.href="bookings.php?cancel_status=true";
                    }
                    else{
                        alert('error','Hủy phòng thất bại! Vui lòng thử lại.');
                    }
                }
                xhr.send('cancel_booking&id='+id);
            }
        }

        let review_form = document.getElementById('review-form');
        
        function review_room(bid, rid){
            review_form.elements['booking_id'].value = bid;
            review_form.elements['room_id'].value = rid;
        }

        review_form.addEventListener('submit', function(e){
            e.preventDefault();

            let data = new FormData();
            data.append('review_form', '');
            data.append('booking_id', review_form.elements['booking_id'].value);
            data.append('room_id', review_form.elements['room_id'].value);
            data.append('rating', review_form.elements['rating'].value);
            data.append('review', review_form.elements['review'].value);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/review_room.php", true);
            
            xhr.onload = function() {
                if(this.responseText == 1){
                    window.location.href = 'bookings.php?review_status=true';
                }
                else{
                    var myModal = document.getElementById('reviewModal');
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();
    
                    alert('error','Gửi đánh giá thất bại! Vui lòng thử lại.');
                }
            }
            xhr.send(data);
        });
    </script>
    
</body>
</html>