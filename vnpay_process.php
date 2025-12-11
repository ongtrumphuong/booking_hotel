<?php
    session_start();
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    
    require('admin/component/db_config.php'); 
    require('admin/component/essentials.php'); 
    require('admin/component/vnpay_config.php'); 

    if(isset($_POST['submit_payment']) && isset($_SESSION['room']))
    {
        $frm_data = filteration($_POST);
        $room_id = $_SESSION['room']['id'];
        $user_id = $_SESSION['uId'];
        $amount = $_SESSION['room']['payment']; 
        
        // --- XỬ LÝ DB (LƯU ĐƠN HÀNG) ---
        $vnp_TxnRef = time() . "-" . $user_id; 
        
        $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `trans_amount`, `trans_status`, `booking_status`) VALUES (?,?,?,?,?,?,?,?)";
        $values1 = [$user_id, $room_id, $frm_data['checkin'], $frm_data['checkout'], $vnp_TxnRef, $amount, 'pending', 'pending'];
        
        if(insert($query1, $values1, "iissssss")){
            $booking_id = mysqli_insert_id($con); 
            $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
            $values2 = [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $amount, $frm_data['name'], $frm_data['phonenum'], $frm_data['address']];
            insert($query2, $values2, "isddsss");
        } else {
            redirect('rooms.php'); // Lỗi DB thì quay về
        }

        // --- TẠO URL VNPAY ---
        $vnp_Amount = $amount * 100;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        // $vnp_IpAddr = "127.0.0.1";
        $vnp_OrderInfo = "Thanh toan don hang " . $vnp_TxnRef;
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_Command" => "pay",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_CurrCode" => "VND",
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "other",
            "vnp_Locale" => "vn",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_CreateDate" => date('YmdHis'),
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        
        // Vòng lặp tạo chuỗi dữ liệu chuẩn
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        // Tạo mã Hash
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // CHUYỂN HƯỚNG
        header('Location: ' . $vnp_Url);
        die();
    }
    else {
        redirect('rooms.php');
    }
?>