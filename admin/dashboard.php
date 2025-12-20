<?php 
    require('component/essentials.php');
    require('component/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Admin Dashboard</title>
    <?php require('component/links.php'); ?>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">

</head>
<body class="bg-light">
    
    <?php 
        require('component/header.php'); 

        $is_shutdown = mysqli_fetch_assoc(mysqli_query($con, "SELECT `shutdown` FROM `settings`"));

        $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
            COUNT(CASE WHEN booking_status='booked' AND arrival = 0 THEN 1 END) AS `new_bookings`,
            COUNT(CASE WHEN booking_status='cancelled' AND refund = 0 THEN 1 END) AS `refund_bookings`
            FROM `booking_order`"));

        $unread_queries = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` 
            FROM `user_queries` WHERE `seen` = 0"));

        $unread_reviews = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(sr_no) AS `count` 
            FROM `rating_review` WHERE `seen` = 0"));

        $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
            COUNT(id) AS `total`,
            COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
            COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
            COUNT(CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
            FROM `user_cred`"));

        // Lấy năm hiện tại và năm người dùng chọn (Nếu không chọn thì mặc định lấy năm nay)
        $date = new DateTime();
        $curr_year = $date->format("Y"); // Ví dụ: 2025
        // Nếu trên URL có ?year=2023 thì lấy 2023, ngược lại lấy năm nay
        $selected_year = isset($_GET['year']) ? $_GET['year'] : $curr_year;

        // Tạo mảng 12 tháng rỗng
        $chart_data = array_fill(1, 12, 0); 

        // Câu lệnh SQL (Đã sửa đoạn YEAR(...) = '$selected_year')
        $year_query = mysqli_query($con, "SELECT 
            MONTH(datentime) as month, 
            SUM(trans_amount) as total_money 
            FROM booking_order 
            WHERE booking_status = 'booked' 
            AND YEAR(datentime) = '$selected_year' 
            GROUP BY MONTH(datentime)");

        // Đổ dữ liệu
        while($row = mysqli_fetch_assoc($year_query)){
            $chart_data[$row['month']] = $row['total_money'];
        }

        $json_chart_data = json_encode(array_values($chart_data));
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h3 class="fw-bold">Tổng Quan Hệ Thống</h3>
                    <?php 
                        if($is_shutdown['shutdown']){
                            echo '<h6 class="badge bg-danger py-2 px-3 rounded shadow-sm"><i class="bi bi-exclamation-triangle-fill me-2"></i>Đang bật chế độ bảo trì!</h6>';
                        }
                    ?>
                </div>

                <div class="row mb-4">
                    <div class="col-md-3 mb-4">
                        <a href="new_bookings.php" class="text-decoration-none">
                            <div class="card dashboard-card border-left-success p-3">
                                <div class="card-body p-0">
                                    <h6 class="card-label text-success">Đặt phòng mới</h6>
                                    <div class="card-data"><?php echo $current_bookings['new_bookings'] ?></div>
                                    <i class="bi bi-journal-check card-icon text-success"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="refund_bookings.php" class="text-decoration-none">
                            <div class="card dashboard-card border-left-warning p-3">
                                <div class="card-body p-0">
                                    <h6 class="card-label text-warning">Đơn hoàn tiền</h6>
                                    <div class="card-data"><?php echo $current_bookings['refund_bookings'] ?></div>
                                    <i class="bi bi-cash-stack card-icon text-warning"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="user_queries.php" class="text-decoration-none">
                            <div class="card dashboard-card border-left-info p-3">
                                <div class="card-body p-0">
                                    <h6 class="card-label text-info">Yêu cầu hỗ trợ</h6>
                                    <div class="card-data"><?php echo $unread_queries['count'] ?></div>
                                    <i class="bi bi-envelope-exclamation card-icon text-info"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="rate_review.php" class="text-decoration-none">
                            <div class="card dashboard-card border-left-primary p-3">
                                <div class="card-body p-0">
                                    <h6 class="card-label text-primary">Đánh giá & Review</h6>
                                    <div class="card-data"><?php echo $unread_reviews['count'] ?></div>
                                    <i class="bi bi-star-half card-icon text-primary"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold">Thống Kê Đặt Phòng & Doanh Thu</h5>
                    <select class="form-select shadow-none bg-white w-auto rounded-3 border-0 shadow-sm" onchange="booking_analytics(this.value)">
                        <option value="1">30 ngày qua</option>
                        <option value="2">90 ngày qua</option>
                        <option value="3">1 năm qua</option>
                        <option value="4">Toàn thời gian</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <h6 class="card-label text-primary">Tổng số đơn</h6>
                            <h1 class="mt-2 mb-0 fw-bold" id="total_bookings">0</h1>
                            <small class="text-muted mt-2 d-block" id="total_amt">0 đ</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <h6 class="card-label text-success">Đơn thành công</h6>
                            <h1 class="mt-2 mb-0 fw-bold" id="active_bookings">0</h1>
                            <small class="text-muted mt-2 d-block" id="active_amt">0 đ</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <h6 class="card-label text-danger">Đơn đã hủy</h6>
                            <h1 class="mt-2 mb-0 fw-bold" id="cancelled_bookings">0</h1>
                            <small class="text-muted mt-2 d-block" id="cancelled_amt">0 đ</small>
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card dashboard-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="card-label text-dark" style="font-size: 1.1rem;">Biểu đồ doanh thu</h6>
                                <select class="form-select shadow-none bg-light w-auto border" 
                                    onchange="window.location.href='index.php?year='+this.value">
                                <?php 
                                    // Vòng lặp từ (Năm nay - 3) đến (Năm nay + 3)
                                    for($i = $curr_year - 3; $i <= $curr_year + 3; $i++){
                                        // Nếu $i trùng với năm đang chọn thì thêm thuộc tính 'selected'
                                        $selected = ($i == $selected_year) ? 'selected' : '';
                                        echo "<option value='$i' $selected>Năm $i</option>";
                                    }
                                ?>
                            </select>
                            </div>
                            <div style="height: 350px;">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-3 mt-4">
                    <h5 class="fw-bold">Dữ Liệu Người Dùng & Phản Hồi</h5>
                    <select class="form-select shadow-none bg-white w-auto rounded-3 border-0 shadow-sm" onchange="user_analytics(this.value)">
                        <option value="1">30 ngày qua</option>
                        <option value="2">90 ngày qua</option>
                        <option value="3">1 năm qua</option>
                        <option value="4">Toàn thời gian</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-label text-success">Đăng ký mới</h6>
                                    <h2 class="mt-2 mb-0 fw-bold" id="total_new_reg">0</h2>
                                </div>
                                <i class="bi bi-person-plus-fill fs-1 text-success opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-label text-primary">Câu hỏi/Hỗ trợ</h6>
                                    <h2 class="mt-2 mb-0 fw-bold" id="total_queries">0</h2>
                                </div>
                                <i class="bi bi-chat-left-text-fill fs-1 text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-label text-primary">Đánh giá</h6>
                                    <h2 class="mt-2 mb-0 fw-bold" id="total_reviews">0</h2>
                                </div>
                                <i class="bi bi-star-fill fs-1 text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mt-4 mb-3">Tổng Quan Thành Viên</h5>
                <div class="row mb-3">
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card bg-primary text-white p-3 h-100">
                            <div class="card-body p-0">
                                <h6 class="text-white-50 text-uppercase" style="font-size: 0.8rem;">Tổng thành viên</h6>
                                <h1 class="mt-2 mb-0 fw-bold"><?php echo $current_users['total'] ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3 h-100">
                            <h6 class="card-label text-success">Đang hoạt động</h6>
                            <h2 class="mt-2 mb-0 text-dark"><?php echo $current_users['active'] ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3 h-100">
                            <h6 class="card-label text-warning">Bị khóa / Ngưng</h6>
                            <h2 class="mt-2 mb-0 text-dark"><?php echo $current_users['inactive'] ?></h2>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card dashboard-card p-3 h-100">
                            <h6 class="card-label text-danger">Chưa xác thực</h6>
                            <h2 class="mt-2 mb-0 text-dark"><?php echo $current_users['unverified'] ?></h2>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('component/scripts.php'); ?>
    <script src="scripts/dashboard.js"></script>
    
    <script>
        const ctx = document.getElementById('revenueChart');

        // Lấy dữ liệu từ PHP gán vào biến Javascript
        // Dữ liệu này chính là cái chuỗi JSON mình tạo ở trên
        const revenueData = <?php echo $json_chart_data; ?>;

        new Chart(ctx, {
            type: 'line', 
            data: {
                // Nhãn hiển thị trục ngang (12 tháng)
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    
                    data: revenueData, 
                    
                    borderWidth: 3,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#4e73df',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: {
                        callbacks: {
                            // Format số tiền hiển thị cho đẹp (ví dụ: 1.000.000 đ)
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Format trục Y thành tiền tệ
                            callback: function(value, index, values) {
                                return new Intl.NumberFormat('vi-VN', { maximumSignificantDigits: 3 }).format(value);
                            }
                        },
                        grid: { borderDash: [2, 4], color: '#e2e8f0' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>