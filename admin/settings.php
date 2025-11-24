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
            z-index: 11;
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
                
                <!--General settings section-->
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

                <!--General settings modal-->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
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
                                    <button type="submit" class="btn custom-bg text-white shadow-none">OK</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <!--Shutdown section-->
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

                <!--Contacts details section-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Cài đặt liên hệ</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil-square"></i> Chỉnh sửa
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Địa chỉ</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Số điện thoại</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i> 
                                        <span id="pn1"></span><br>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i> 
                                        <span id="pn2"></span><br>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Mạng xã hội</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook"></i>
                                        <span id="fb"></span><br>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram"></i>
                                        <span id="insta"></span><br>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter"></i>
                                        <span id="tw"></span><br>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-linkedin"></i>
                                        <span id="ln"></span><br>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Contacts details modal-->
                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cài đặt liên hệ</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Địa chỉ</label>
                                                    <input type="text" class="form-control shadow-none" id="address_inp" name="address" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map</label>
                                                    <input type="text" class="form-control shadow-none" id="gmap_inp" name="gmap" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Số điện thoại (kèm mã quốc gia)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" class="form-control shadow-none" id="pn1_inp" name="pn1" required>
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" class="form-control shadow-none" id="pn2_inp" name="pn2">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="email" class="form-control shadow-none" id="email_inp" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Mạng xã hội</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="fb_inp" name="fb">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="insta_inp" name="insta">
                                                    </div>
                                                    <div class="input-group my-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="tw_inp" name="tw">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                                                        <input type="text" class="form-control shadow-none" id="ln_inp" name="ln">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame</label>
                                                    <input type="text" class="form-control shadow-none" id="iframe_inp" name="iframe" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">OK</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>

                <!--Management Team section-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Đội ngũ quản lý</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i> Thêm
                            </button>
                        </div>
                        
                        <div class="row" id="team-data">

                        </div>
                    </div>
                </div>

                <!--Management Team modal-->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm thành viên</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Họ tên</label>
                                        <input type="text" class="form-control shadow-none" id="member_name_inp" name="member_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Hình ảnh</label>
                                        <input type="file" class="form-control shadow-none" id="member_image_inp" name="member_image" accept=".webp, .jpg, .jpeg, .png" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="member_name.value='', member_image.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">OK</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
    <script>
        let general_data, contacts_data;

        let general_s_form = document.getElementById('general_s_form');
        let site_title_inp = document.getElementById('site_title_inp');
        let site_about_inp = document.getElementById('site_about_inp');

        let contacts_s_form = document.getElementById('contacts_s_form');
        
        let team_s_form = document.getElementById('team_s_form');
        let member_name_inp = document.getElementById('member_name_inp');
        let member_image_inp = document.getElementById('member_image_inp');

        function get_general() {
            let site_title = document.getElementById('site_title');
            let site_about = document.getElementById('site_about');

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

        general_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_general(site_title_inp.value, site_about_inp.value)
        });

        function upd_general(site_title_val, site_about_val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                var myModal = document.getElementById('general-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 1) {
                    alert('success', 'Cập nhật thành công');
                    get_general();
                }
                else {
                    alert('error', 'Đã xảy ra lỗi');
                }
            }
            xhr.send('site_title=' + site_title_val + '&site_about=' + site_about_val + '&upd_general');
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

        function get_contacts() {
            let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw', 'ln'];
            let iframe = document.getElementById('iframe');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                contacts_data = JSON.parse(this.responseText);
                contacts_data = Object.values(contacts_data);
                
                for (i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i+1];
                }
                iframe.src = contacts_data[10];
                contacts_inp(contacts_data);
            }
            xhr.send('get_contacts');
        }

        function contacts_inp(data) {
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'ln_inp', 'iframe_inp'];
            for (i = 0; i < contacts_inp_id.length; i++) {
                document.getElementById(contacts_inp_id[i]).value = data[i+1];
            }
        }

        contacts_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            upd_contacts();
        });

        function upd_contacts() {
            let index = ['address', 'gmap', 'pn1', 'pn2', 'email', 'fb', 'insta', 'tw', 'ln', 'iframe'];
            let contacts_inp_id = ['address_inp', 'gmap_inp', 'pn1_inp', 'pn2_inp', 'email_inp', 'fb_inp', 'insta_inp', 'tw_inp', 'ln_inp', 'iframe_inp'];

            let data_str = "";

            for (i = 0; i < index.length; i++) {
                data_str += index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + "&";
            }
            data_str += "upd_contacts";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                var myModal = document.getElementById('contacts-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 1) {
                    alert('success', 'Cập nhật thành công');
                    get_contacts();
                }
                else {
                    alert('error', 'Đã xảy ra lỗi');
                }
            }
            xhr.send(data_str);
        }

        team_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_member();
        });

        function add_member() {
            let data = new FormData();
            data.append('name', member_name_inp.value);
            data.append('image', member_image_inp.files[0]);
            data.append('add_member', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.onload = function() {
                var myModal = document.getElementById('team-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                if (this.responseText == 'inv_img') {
                    alert('error', 'Định dạng hình ảnh không hợp lệ');
                }
                else if (this.responseText == 'inv_size') {
                    alert('error', 'Kích thước hình ảnh không hợp lệ');
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error', 'Tải hình ảnh thất bại. Vui lòng thử lại');
                }
                else {
                    alert('success', 'Thêm thành viên mới thành công');
                    member_name_inp.value = '';
                    member_image_inp.value = '';
                    get_members();
                }
            }
            xhr.send(data);
            
        }

        function get_members() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                document.getElementById('team-data').innerHTML = this.responseText;
            }
            xhr.send('get_members');
        }

        function rem_member(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Xóa thành viên thành công');
                    get_members();
                }
                else {
                    alert('error', 'Đã xảy ra lỗi');
                }
            }
            xhr.send('rem_member=' + val);
        }

        window.onload = function() {
            get_general();
            get_contacts();
            get_members();
        }

    </script>
</body>
</html>