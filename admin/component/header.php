<div class="container-fluid admin-header p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 brand-logo text-white">Quản trị T1 Hotel</h3>
    <a href="logout.php" class="btn btn-logout btn-sm">Đăng xuất</a>        
</div>

<div class="col-lg-2 admin-sidebar" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch px-0">
            <h4 class="mt-2 text-uppercase text-muted px-3 fs-6 ls-1">Admin Panel</h4>
            
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse flex-column mt-3 align-items-stretch" id="adminDropdown">
                <ul class="nav nav-pills flex-column px-2">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="bi bi-speedometer2 me-2"></i> Bảng điều khiển
                        </a>
                    </li>

                    <li class="nav-item">
                        <button class="btn nav-link w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks">
                            <span><i class="bi bi-calendar-check me-2"></i> Đặt phòng</span>
                            <span class="rotate-icon"><i class="bi bi-chevron-down"></i></span>
                        </button>
                        <div class="collapse show px-2 mb-1" id="bookingLinks">
                            <ul class="nav nav-pills flex-column bg-sub-menu rounded mt-1">
                                <li class="nav-item">
                                    <a class="nav-link sub-link" href="new_bookings.php">• Đơn đặt phòng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link sub-link" href="refund_bookings.php">• Đơn hoàn tiền</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link sub-link" href="booking_records.php">• Lịch sử đặt phòng</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="bi bi-people me-2"></i> Người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_queries.php">
                            <i class="bi bi-chat-dots me-2"></i> Lời nhắn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rate_review.php">
                            <i class="bi bi-star me-2"></i> Đánh giá & Review
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rooms.php">
                            <i class="bi bi-door-open me-2"></i> Phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="features_facilities.php">
                            <i class="bi bi-wifi me-2"></i> Tiện ích
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="slider.php">
                            <i class="bi bi-images me-2"></i> Slider
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">
                            <i class="bi bi-gear me-2"></i> Cài đặt
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>