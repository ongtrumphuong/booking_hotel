<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2">T1 Hotel</h3>
            <p>Khách sạn T1 cam kết mang đến cho bạn trải nghiệm nghỉ dưỡng tuyệt vời với dịch vụ chuyên nghiệp và tiện nghi hiện đại.</p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Liên kết nhanh</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Trang chủ</a><br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Đặt phòng</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Tiện nghi</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Liên hệ</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Theo dõi chúng tôi</h5>
            <a href="<?php echo $contact_r['fb']; ?>" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="<?php echo $contact_r['insta']; ?>" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="<?php echo $contact_r['tw']; ?>" target="_blank" class="d-inline-block text-dark fs-5 me-3">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="<?php echo $contact_r['ln']; ?>" target="_blank" class="d-inline-block text-dark fs-5">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');
        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];
            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }
    setActive();
</script>
