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
    <title>Trang Quản Trị - Phòng</title>
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
                <h3 class="mb-4">Phòng</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Thêm
                            </button>
                        </div>    

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center align-middle mb-0">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Khách</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Add room modal -->

    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên</label>
                                <input type="text" class="form-control shadow-none" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Area</label>
                                <input type="number" min="1" class="form-control shadow-none" name="area" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá</label>
                                <input type="number" min="1" class="form-control shadow-none" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số lượng</label>
                                <input type="number" min="1" class="form-control shadow-none" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Người lớn (Tối đa.)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Trẻ em (Tối đa.)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="children" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Tiện ích</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'> 
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Tiện nghi</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'> 
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả</label>
                                <textarea name="desc" class="form-control shadow-none" rows="4" required></textarea>
                            </div>
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

    <!-- Edit room modal -->

    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa phòng</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tên</label>
                                <input type="text" class="form-control shadow-none" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Area</label>
                                <input type="number" min="1" class="form-control shadow-none" name="area" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giá</label>
                                <input type="number" min="1" class="form-control shadow-none" name="price" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số lượng</label>
                                <input type="number" min="1" class="form-control shadow-none" name="quantity" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Người lớn (Tối đa.)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="adult" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Trẻ em (Tối đa.)</label>
                                <input type="number" min="1" class="form-control shadow-none" name="children" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Tiện ích</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'> 
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Tiện nghi</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'> 
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Mô tả</label>
                                <textarea name="desc" class="form-control shadow-none" rows="4" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
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

    <!-- Manage room images modal -->

    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tên phòng</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert">

                    </div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Thêm hình ảnh</label>
                            <input type="file" class="form-control shadow-none mb-3" name="image" accept=".webp, .jpg, .jpeg, .png" required>
                            <button class="btn custom-bg text-white shadow-none">Thêm</button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center align-middle mb-0">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Hình ảnh</th>
                                    <th scope="col">Đặt làm ảnh chính</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php require('component/scripts.php'); ?>
    <script>
        let add_room_form = document.getElementById('add_room_form');

        add_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_room();
        });

        function add_room(){
            let data = new FormData();

            data.append('add_room', '');
            data.append('name', add_room_form.elements['name'].value);
            data.append('area', add_room_form.elements['area'].value);
            data.append('price', add_room_form.elements['price'].value);
            data.append('quantity', add_room_form.elements['quantity'].value);
            data.append('adult', add_room_form.elements['adult'].value);
            data.append('children', add_room_form.elements['children'].value);
            data.append('desc', add_room_form.elements['desc'].value);

            let features = [];
            add_room_form.querySelectorAll("input[name='features']:checked").forEach(el => features.push(el.value));

            let facilities = [];
            add_room_form.querySelectorAll("input[name='facilities']:checked").forEach(el => facilities.push(el.value));

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success', 'Thêm phòng mới thành công!');
                    add_room_form.reset();
                    get_all_rooms();
                }
                else {
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }
            xhr.send(data);
        }

        function get_all_rooms(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('room-data').innerHTML = this.responseText;
            }
            xhr.send('get_all_rooms');
        }

        let edit_room_form = document.getElementById('edit_room_form');

        function edit_details(id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                let data = JSON.parse(this.responseText);

                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc'].value = data.roomdata.description;
                edit_room_form.elements['room_id'].value = data.roomdata.id;

                edit_room_form.querySelectorAll("input[name='features']").forEach(el => {
                    el.checked = data.features.includes(Number(el.value));
                });

                edit_room_form.querySelectorAll("input[name='facilities']").forEach(el => {
                    el.checked = data.facilities.includes(Number(el.value));
                });



            }
            xhr.send('get_room='+id);
        }

        edit_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            submit_edit_room();
        });

        function submit_edit_room(){
            let data = new FormData();

            data.append('edit_room', '');
            data.append('room_id', edit_room_form.elements['room_id'].value);
            data.append('name', edit_room_form.elements['name'].value);
            data.append('area', edit_room_form.elements['area'].value);
            data.append('price', edit_room_form.elements['price'].value);
            data.append('quantity', edit_room_form.elements['quantity'].value);
            data.append('adult', edit_room_form.elements['adult'].value);
            data.append('children', edit_room_form.elements['children'].value);
            data.append('desc', edit_room_form.elements['desc'].value);

            let features = [];
            edit_room_form.querySelectorAll("input[name='features']:checked").forEach(el => features.push(el.value));

            let facilities = [];
            edit_room_form.querySelectorAll("input[name='facilities']:checked").forEach(el => facilities.push(el.value));

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);

            xhr.onload = function(){
                var myModal = document.getElementById('edit-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success', 'Chỉnh sửa phòng thành công!');
                    edit_room_form.reset();
                    get_all_rooms();
                }
                else {
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }
            xhr.send(data);
        }

        function toggle_status(id, val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                if(this.responseText == 1) {
                    alert('success', 'Đã chuyển trạng thái thành công!');
                    get_all_rooms();
                }
                else {
                    alert('error', 'Lỗi không xác định! Vui lòng thử lại sau.');
                }
            }
            xhr.send('toggle_status='+id+'&value='+val);
        }

        let add_image_form = document.getElementById('add_image_form');

        add_image_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_image();
        });

        function add_image() {
            let data = new FormData();
            data.append('image', add_image_form.elements['image'].files[0]);
            data.append('room_id', add_image_form.elements['room_id'].value);
            data.append('add_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.onload = function() {
                if (this.responseText == 'inv_img') {
                    alert('error', 'Định dạng hình ảnh không hợp lệ','image-alert');
                }
                else if (this.responseText == 'inv_size') {
                    alert('error', 'Kích thước hình ảnh không hợp lệ','image-alert');
                }
                else if (this.responseText == 'upd_failed') {
                    alert('error', 'Tải hình ảnh thất bại. Vui lòng thử lại','image-alert');
                }
                else {
                    alert('success', 'Thêm ảnh mới thành công','image-alert');
                    room_images(add_image_form.elements['room_id'].value, document.querySelector("#room-images .modal-title").innerText);
                    add_image_form.reset();
                }
            }
            xhr.send(data);   
        }

        function room_images(id, rname) {
            document.querySelector("#room-images .modal-title").innerText = rname;
            add_image_form.elements['room_id'].value = id;
            add_image_form.elements['image'].value = '';

            let xhr = new XMLHttpRequest();
            xhr.open("POST","ajax/rooms.php",true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function(){
                document.getElementById('room-image-data').innerHTML = this.responseText;
            }
            xhr.send('get_room_images='+id);
        }

        function rem_image(img_id, room_id) {
            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('rem_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Xóa ảnh thành công','image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                }
                else {
                    alert('error', 'Xóa ảnh thất bại','image-alert');
                }
            }
            xhr.send(data);   
        }

        function thumb_image(img_id, room_id) {
            let data = new FormData();
            data.append('image_id', img_id);
            data.append('room_id', room_id);
            data.append('thumb_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Thay đổi ảnh chính thành công','image-alert');
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);
                }
                else {
                    alert('error', 'Cập nhật ảnh chính thất bại','image-alert');
                }
            }
            xhr.send(data);   
        }

        function remove_room(room_id) {
            if(confirm("Bạn có chắc chắn muốn xóa phòng này?")) {
                let data = new FormData();
                data.append('room_id', room_id);
                data.append('remove_room', '');

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert('success', 'Đã xóa phòng thành công');
                        get_all_rooms();
                    }
                    else {
                        alert('error', 'Xóa phòng thất bại');
                    }
                }
                xhr.send(data);   
            }

        }

        window.onload = function() {
            get_all_rooms();
        }
    </script>
</body>
</html>