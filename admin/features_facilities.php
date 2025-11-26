<?php 
    require('component/essentials.php');
    require('component/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Tiện ích và tiện nghi</title>
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
                <h3 class="mb-4">Tiện ích và tiện nghi</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Tiện ích</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#feature-s">
                                <i class="bi bi-plus-square"></i> Thêm
                            </button>
                        </div>    

                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border text-center align-middle mb-0">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Tiện nghi</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Thêm
                            </button>
                        </div>    

                        <div class="table-responsive-md" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border text-center align-middle mb-0">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col" width="40%">Mô tả</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">                             
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm tiện ích</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên</label>
                            <input type="text" class="form-control shadow-none" name="feature_name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">OK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm tiện nghi</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên</label>
                            <input type="text" class="form-control shadow-none" name="facility_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Hình ảnh</label>
                            <input type="file" class="form-control shadow-none" name="facility_image" accept=".webp, .jpg, .jpeg, .png" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">OK</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>


    <?php require('component/scripts.php'); ?>
    <script>
        let feature_s_form = document.getElementById('feature_s_form');
        let facility_s_form = document.getElementById('facility_s_form');

        feature_s_form.addEventListener('submit', function(e){
           e.preventDefault();
           add_feature();
        });

        function add_feature(){
            let data = new FormData();
            data.append('name', feature_s_form.elements['feature_name'].value);
            data.append('add_feature', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);

            xhr.onload = function(){
                var myModal = document.getElementById('feature-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success', 'Tính năng mới đã được thêm thành công!');
                    feature_s_form.elements['feature_name'].value = '';
                    get_features();
                }
                else{
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }

            xhr.send(data);
        }

        function get_features(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('features-data').innerHTML = this.responseText;
            }

            xhr.send('get_features');
        }

        function rem_feature(val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText == 1){
                    alert('success', 'Tính năng đã được xóa thành công!');
                    get_features();
                }
                else if(this.responseText == 'room_added'){
                    alert('error', 'Tính năng này không thể xóa vì đã được sử dụng trong một số phòng! Vui lòng xóa các phòng đó trước.');
                }
                else{
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }
            xhr.send('rem_feature='+val);
        }

        facility_s_form.addEventListener('submit', function(e){
           e.preventDefault();
           add_facility();
        });

        function add_facility(){
            let data = new FormData();
            data.append('name', facility_s_form.elements['facility_name'].value);
            data.append('image', facility_s_form.elements['facility_image'].files[0]);
            data.append('desc', facility_s_form.elements['facility_desc'].value);
            data.append('add_facility', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);

            xhr.onload = function(){
                var myModal = document.getElementById('facility-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 'inv_img'){
                    alert('error', 'Chỉ các định dạng hình ảnh JPG, JPEG, PNG và WEBP được phép!');
                }
                else if(this.responseText == 'inv_size'){
                    alert('error', 'Kích thước hình ảnh không được vượt quá 2MB!');
                }
                else if(this.responseText == 'upd_failed'){
                    alert('error', 'Không thể tải hình ảnh lên máy chủ! Vui lòng thử lại sau.');
                }
                else {
                    alert('success', 'Tiện nghi mới đã được thêm thành công!');
                    facility_s_form.reset();
                    get_facilities();
                }
            }

            xhr.send(data);
        }

        function get_facilities(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('facilities-data').innerHTML = this.responseText;
            }

            xhr.send('get_facilities');
        }

        function rem_facility(val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities.php", true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText == 1){
                    alert('success', 'Tiện nghi đã được xóa thành công!');
                    get_facilities();
                }
                else if(this.responseText == 'room_added'){
                    alert('error', 'Tiện nghi này không thể xóa vì đã được sử dụng trong một số phòng! Vui lòng xóa các phòng đó trước.');
                }
                else{
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }
            xhr.send('rem_facility='+val);
        }

        window.onload = function(){
            get_features();
            get_facilities();
        }
    </script>
</body>
</html>