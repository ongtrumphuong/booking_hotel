<?php 
    require('component/essentials.php');
    require('component/db_config.php'); 
    session_start();
    if(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true){
        redirect('dashboard.php');
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị viên</title>
    <?php require('component/links.php'); ?> 
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="bg-light">
    
    <div class="login-form">
        <form method="POST">
            <div class="login-header">
                <h4>QUẢN TRỊ WEBSITE</h4>
            </div>
            
            <div class="p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-secondary">Tên đăng nhập</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input name="admin_name" required type="text" class="form-control shadow-none" placeholder="Nhập tên admin...">
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label fw-bold small text-secondary">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        <input name="admin_pass" required type="password" class="form-control shadow-none" placeholder="Nhập mật khẩu...">
                    </div>
                </div>
                
                <button name="login" type="submit" class="btn btn-login w-100 shadow-none">
                    ĐĂNG NHẬP <i class="bi bi-box-arrow-in-right ms-2"></i>
                </button>
            </div>
        </form>
    </div>

    <?php 
        if(isset($_POST['login'])){
            $frm_data = filteration($_POST);

            $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
            $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

            $result = select($query, $values, "ss");
            if($result->num_rows == 1){
                $row = mysqli_fetch_assoc($result);
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['sr_no'];
                redirect('dashboard.php');
            }
            else{
                alert("error", "Sai tên đăng nhập hoặc mật khẩu!");
            }
        }
    ?>

    <?php require('component/scripts.php'); ?>
</body>
</html>