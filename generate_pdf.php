<?php
    require('admin/component/essentials.php');
    require('admin/component/db_config.php');
    require('admin/component/mpdf/vendor/autoload.php');

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }

    if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
        $frm_data = filteration($_GET);

        $query = "SELECT bo.*, bd.*, uc.email FROM `booking_order` bo
                INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
                INNER JOIN `user_cred` uc ON bo.user_id = uc.id
                WHERE bo.booking_id = '$frm_data[id]'";
        $res = mysqli_query($con, $query);
        
        // Check row > 0 và lấy $data, xử lý ngày tháng, tính tiền...
        if(mysqli_num_rows($res) == 0) { header('location: index.php'); exit; }
        $data = mysqli_fetch_assoc($res);
        
        // ĐOẠN XỬ LÝ LOGIC (DATE, PRICE, STATUS...)
        $booking_date = date("H:i | d/m/Y", strtotime($data['datentime']));
        $checkin_date = date("d/m/Y", strtotime($data['check_in']));
        $checkout_date = date("d/m/Y", strtotime($data['check_out']));
        
        $checkin_ts = strtotime($data['check_in']);
        $checkout_ts = strtotime($data['check_out']);
        $nights = abs($checkout_ts - $checkin_ts) / (60 * 60 * 24);
        if($nights == 0) $nights = 1; 

        $price_per_night = number_format($data['price'], 0, ',', '.');
        $total_amount_fmt = number_format($data['trans_amount'], 0, ',', '.');
        
        $status_text = "";
        $status_color = "#333";
        $payment_label = "Tổng thanh toán";

        // Switch Case trạng thái
        switch ($data['booking_status']) {
            case 'booked':
                $status_text = "ĐẶT PHÒNG THÀNH CÔNG";
                $status_color = "#28a745"; 
                $room_no_info = ($data['room_no'] != NULL) ? $data['room_no'] : "Đang chờ xếp";
                $booking_note = "Số phòng: <b>$room_no_info</b>";
                break;
            case 'cancelled':
                $status_text = "ĐÃ HỦY";
                $status_color = "#dc3545"; 
                $refund_status = ($data['refund']) ? "Đã hoàn tiền" : "Chưa hoàn tiền";
                $booking_note = "Trạng thái hoàn tiền: $refund_status";
                $payment_label = "Số tiền đã giao dịch";
                break;
            case 'payment_failed':
                $status_text = "THANH TOÁN THẤT BẠI";
                $status_color = "#dc3545";
                $booking_note = "Lỗi: " . $data['trans_msg'];
                $payment_label = "Số tiền giao dịch lỗi";
                break;
            case 'pending':
                $status_text = "CHỜ THANH TOÁN";
                $status_color = "#ffc107"; 
                $booking_note = "Đơn hàng đang chờ xử lý.";
                $payment_label = "Số tiền chờ thanh toán";
                break;
        }

        // HTML CONTENT 
        $html_content = "
        <table class='header-tbl'>
            <tr>
                <td width='50%' style='vertical-align: middle;'>
                    <div class='brand-logo'>T1 HOTEL</div>
                    <div class='brand-sub'>Luxury & Comfort</div> 
                </td>
                <td width='50%' class='company-info'>
                    <div class='company-name'>T1 HOTEL</div>
                    <div>06 Trần Văn Ơn, Phú Hoà, Thủ Dầu Một, Bình Dương</div>
                    <div>Hotline: 0274 382 2518</div>
                    <div>Email: 2224801030012@student.tdmu.edu.vn</div>
                </td>
            </tr>
        </table>

        <div class='invoice-title'>Hóa Đơn Xác Nhận</div>

        <div style='text-align: center; margin-bottom: 30px;'>
            <span style='margin-right: 20px;'><b>Mã đơn:</b> #$data[order_id]</span>
            <span><b>Ngày tạo:</b> $booking_date</span>
            <br><br>
            <span style='background-color: $status_color;' class='status-badge'>$status_text</span>
        </div>

        <table class='info-section-tbl'>
            <tr>
                <td class='info-box' style='padding-right: 20px;'>
                    <div class='info-title'>KHÁCH HÀNG</div>
                    <div class='info-row'><span class='info-label'>Họ tên:</span> $data[user_name]</div>
                    <div class='info-row'><span class='info-label'>SĐT:</span> $data[phonenum]</div>
                    <div class='info-row'><span class='info-label'>Email:</span> $data[email]</div>
                    <div class='info-row'><span class='info-label'>Địa chỉ:</span> $data[address]</div>
                </td>
                <td class='info-box' style='padding-left: 20px;'>
                    <div class='info-title'>THÔNG TIN PHÒNG</div>
                    <div class='info-row'><span class='info-label'>Check-in:</span> $checkin_date</div>
                    <div class='info-row'><span class='info-label'>Check-out:</span> $checkout_date</div>
                    <div class='info-row'><span class='info-label'>Thời gian:</span> $nights đêm</div>
                    <div class='info-row' style='border-bottom: none;'>$booking_note</div>
                </td>
            </tr>
        </table>

        <div class='info-title'>CHI TIẾT THANH TOÁN</div>
        <table class='booking-table'>
            <thead>
                <tr>
                    <th width='50%'>Dịch vụ</th>
                    <th width='15%' class='text-center'>SL</th>
                    <th width='15%' class='text-right'>Đơn giá</th>
                    <th width='20%' class='text-right'>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Phòng: <b>$data[room_name]</b></td>
                    <td class='text-center'>$nights</td>
                    <td class='text-right'>$price_per_night</td>
                    <td class='text-right'><b>$total_amount_fmt</b></td>
                </tr>
            </tbody>
        </table>

        <table class='total-section'>
            <tr>
                <td width='50%'></td> 
                <td width='50%'>
                    <table width='100%'>
                        <tr>
                            <td class='text-right' style='padding: 5px 0;'>Tạm tính:</td>
                            <td class='text-right' style='padding: 5px 0;'>$total_amount_fmt đ</td>
                        </tr>
                        <tr class='total-row'>
                            <td class='text-right'>$payment_label:</td>
                            <td class='text-right grand-total' style='color: $status_color;'>$total_amount_fmt đ</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class='footer'>
            Cảm ơn quý khách đã lựa chọn T1 Hotel!<br>
            Hóa đơn này được tạo tự động từ hệ thống.
        </div>
        ";

        // CẤU HÌNH MPDF & NẠP CSS 
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'default_font_size' => 10,
            'default_font' => 'dejavusans'
        ]);

        $mpdf->SetTitle("Hoa_don_" . $data['order_id']);

        // Đọc file CSS từ bên ngoài
        $stylesheet = file_get_contents('css/pdf_style.css'); 

        // Ghi CSS vào PDF (Mode 1: HTMLParserMode::HEADER_CSS)
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        // Ghi nội dung HTML vào PDF (Mode 2: HTMLParserMode::HTML_BODY)
        $mpdf->WriteHTML($html_content, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output('Invoice_' . $data['order_id'] . '.pdf', 'D');
    } else {
        header('location: dashboard.php');
    }
?>