<?php 
    require('component/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Cài đặt</title>
    <?php require('component/links.php'); ?>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
        }
        @media screen and (max-width: 991px) {
            #dashboard-menu {
                height: auto;
                width: 100%;
            }
            #main-content {
                margin-top: 60px;
            }
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Cài đặt</h3>
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Cài đặt chung</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Tên trang web</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">Về chúng tôi</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cài đặt chung</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tên trang web</label>
                                        <input type="text" class="form-control shadow-none" id="site_title_inp" name="site_title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Về chúng tôi</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="button" onclick="upd_general(site_title.value, site_about.value)" class="btn custom-bg text-white shadow-none">OK</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Tắt trang web</h5>
                            <div class="form-check form-switch ms-auto">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" class="form-check-input" type="checkbox" id="shutdown_toggle">
                                </form>
                            </div>

                            
                        </div>
                        <p class="card-text" id="site_about">
                            Tính năng này sẽ tắt trang web cho người dùng bình thường. Chỉ quản trị viên mới có thể truy cập trang web khi tính năng này được bật.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
    <script>
        let general_data;

        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');

            let site_title_inp = document.getElementById('site_title_inp');
            let site_about_inp = document.getElementById('site_about_inp');

            let shutdown_toggle = document.getElementById('shutdown_toggle');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                general_data = JSON.parse(this.responseText);

                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_inp.value = general_data.site_title;
                site_about_inp.value = general_data.site_about;
                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                }
                else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }
            xhr.send('get_general');
        }

        function upd_general(site_title, site_about) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                var myModal = document.getElementById('general-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 'success') {
                    alert('success', 'Cập nhật thành công');
                    get_general();
                }
                else {
                    alert('error', 'Đã xảy ra lỗi');
                }
            }
            xhr.send('site_title=' + site_title + '&site_about=' + site_about + '&upd_general');
        }

        function upd_shutdown(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if (this.responseText == 1 && general_data.shutdown == 0) {
                    alert('success', 'Trang web đã ngừng hoạt động');
                }
                else {
                    alert('success', 'Trang web đã hoạt động trở lại');
                }
                get_general();
            }
            xhr.send('upd_shutdown=' + val);
        }

        window.onload = function() {
            get_general();
        }

    </script>
</body>
</html>