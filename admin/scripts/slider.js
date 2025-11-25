let slider_s_form = document.getElementById('slider_s_form');
let slider_image_inp = document.getElementById('slider_image_inp');

slider_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData();
    data.append('image', slider_image_inp.files[0]);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/slider_crud.php", true);
    xhr.onload = function() {
        var myModal = document.getElementById('slider-s');
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
            alert('success', 'Thêm ảnh mới thành công');
            slider_image_inp.value = '';
            get_slider();
        }
    }
    xhr.send(data);
    
}

function get_slider() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/slider_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('slider-data').innerHTML = this.responseText;
    }
    xhr.send('get_slider');
}

function rem_image(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/slider_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Xóa ảnh thành công');
            get_slider();
        }
        else {
            alert('error', 'Đã xảy ra lỗi');
        }
    }
    xhr.send('rem_image=' + val);
}

window.onload = function() {
    get_slider();
}

