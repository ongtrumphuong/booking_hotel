<?php 
    header('Content-Type: text/html; charset=utf-8');   
    session_start();
    
    require('admin/component/db_config.php'); 
    require('admin/component/essentials.php'); 
    require('admin/component/vnpay_config.php'); 

    // Lấy dữ liệu từ VNPay
    $vnp_SecureHash = isset($_GET['vnp_SecureHash']) ? $_GET['vnp_SecureHash'] : ''; 
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    unset($inputData['vnp_SecureHash']); 
    
    // Các biến mặc định
    $TxnRef = isset($inputData['vnp_TxnRef']) ? $inputData['vnp_TxnRef'] : '';
    $RspCode = isset($inputData['vnp_ResponseCode']) ? $inputData['vnp_ResponseCode'] : '';
    $vnp_TransactionNo = isset($inputData['vnp_TransactionNo']) ? $inputData['vnp_TransactionNo'] : '0';

    // XÁC MINH CHECKSUM
    ksort($inputData);
    $hashData = "";
    foreach ($inputData as $key => $value) {
        $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $hashData = substr($hashData, 0, -1);
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
    // XỬ LÝ KẾT QUẢ
    $booking_status = "";
    $trans_status = "";
    $message = "";

    if ($secureHash === $vnp_SecureHash) {
        
        if ($RspCode == '00') {
            // --- TRƯỜNG HỢP 1: THANH TOÁN THÀNH CÔNG ---
            $booking_status = "booked";
            $trans_status = "success"; // Hoặc lưu mã '00'
            $message = "Thanh toán thành công. Mã GD: " . $vnp_TransactionNo;
        } 
        elseif ($RspCode == '24') {
            // --- TRƯỜNG HỢP 2: KHÁCH HÀNG HỦY GIAO DỊCH ---
            $booking_status = "cancelled";
            $trans_status = "cancelled"; 
            $message = "Giao dịch đã bị hủy bởi khách hàng.";
        } 
        else {
            // --- TRƯỜNG HỢP 3: LỖI KHÁC (Sai thẻ, không đủ tiền...) ---
            $booking_status = "payment_failed";
            $trans_status = "failed"; 
            $message = "Giao dịch thất bại. Mã lỗi VNPay: " . $RspCode;
        }

        // CẬP NHẬT DATABASE (Chạy cho cả 3 trường hợp trên)
        $update_query = "UPDATE `booking_order` SET 
            `booking_status`=?, 
            `trans_id`=?, 
            `trans_status`=?, 
            `trans_msg`=? 
            WHERE `order_id`=?";
        
        if ($stmt = mysqli_prepare($con, $update_query)) {
            // Thứ tự bind: booking_status, trans_id, trans_status, trans_msg, order_id
            mysqli_stmt_bind_param($stmt, "sssss", $booking_status, $vnp_TransactionNo, $trans_status, $message, $TxnRef);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

    } else {
        // --- TRƯỜNG HỢP 4: SAI CHỮ KÝ BẢO MẬT ---
        $booking_status = "payment_failed";
        $message = "Lỗi bảo mật: Chữ ký không hợp lệ!";
        // Không cập nhật DB trường hợp này để tránh hacker dò dữ liệu
    }

    // XÓA SESSION VÀ CHUYỂN HƯỚNG
    unset($_SESSION['room']); 
    
    // Chuyển hướng về trang thông báo (Status hiển thị theo biến $booking_status)
    header("Location: payment_status.php?status=$booking_status&msg=".urlencode($message)."&ref=$TxnRef");
    die();
?>