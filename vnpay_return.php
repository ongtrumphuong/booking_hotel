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
    $final_status = "payment_failed";
    $message = "Giao dịch không thành công.";
    $TxnRef = isset($inputData['vnp_TxnRef']) ? $inputData['vnp_TxnRef'] : '';
    $RspCode = isset($inputData['vnp_ResponseCode']) ? $inputData['vnp_ResponseCode'] : '';
    $vnp_TransactionNo = isset($inputData['vnp_TransactionNo']) ? $inputData['vnp_TransactionNo'] : '';

    // XÁC MINH CHECKSUM
    ksort($inputData);
    $hashData = "";
    foreach ($inputData as $key => $value) {
        $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $hashData = substr($hashData, 0, -1);
    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
    // XỬ LÝ KẾT QUẢ
    if ($secureHash === $vnp_SecureHash) {
        if ($RspCode == '00') {
            // Thanh toán thành công
            $final_status = "booked";
            $message = "Thanh toán thành công. Mã GD: " . $vnp_TransactionNo;

            // UPDATE DATABASE
            $update_query = "UPDATE `booking_order` SET 
                `booking_status`='booked', 
                `trans_id`=?, 
                `trans_status`=?, 
                `trans_msg`=? 
                WHERE `order_id`=?";
            
            // Dùng mysqli_prepare để an toàn tuyệt đối
            if ($stmt = mysqli_prepare($con, $update_query)) {
                mysqli_stmt_bind_param($stmt, "ssss", $vnp_TransactionNo, $RspCode, $message, $TxnRef);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        } else {
            // Thanh toán thất bại (Khách hủy, sai thẻ...)
            $final_status = "payment_failed"; 
            $message = "Giao dịch thất bại. Mã lỗi VNPay: " . $RspCode;
        }
    } else {
        $final_status = "payment_failed";
        $message = "Lỗi bảo mật: Chữ ký không hợp lệ!";
    }

    // XÓA SESSION VÀ CHUYỂN HƯỚNG
    unset($_SESSION['room']); 
    
    header("Location: payment_status.php?status=$final_status&msg=".urlencode($message)."&ref=$TxnRef");
    die();
?>