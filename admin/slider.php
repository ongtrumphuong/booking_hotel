<?php 
    require('component/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị - Slider</title>
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
                <h3 class="mb-4">Slider</h3>

                <!--Slider section-->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3 justify-content-between">
                            <h5 class="card-title m-0">Hình ảnh</h5>
                            <button class="btn btn-dark btn-sm ms-auto" data-bs-toggle="modal" data-bs-target="#slider-s">
                                <i class="bi bi-plus-square"></i> Thêm
                            </button>
                        </div>
                        
                        <div class="row" id="slider-data">

                        </div>
                    </div>
                </div>

                <!--Slider modal-->
                <div class="modal fade" id="slider-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="slider_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Thêm hình ảnh</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Hình ảnh</label>
                                        <input type="file" class="form-control shadow-none" id="slider_image_inp" name="slider_image" accept=".webp, .jpg, .jpeg, .png" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="slider_image.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Thoát</button>
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
    <script src="scripts/slider.js"></script>
</body>
</html>