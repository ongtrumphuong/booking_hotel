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
    <script src="scripts/features_facilities.js"></script>
</body>
</html>