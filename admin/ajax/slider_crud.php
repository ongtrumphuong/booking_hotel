<?php
    require('../component/db_config.php');
    require('../component/essentials.php');
    adminLogin();

    if(isset($_POST['add_image'])) {        
        $img_r = uploadImage($_FILES['image'], SLIDER_FOLDER);
       
        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if ($img_r == 'upd_failed') {
            echo $img_r;
        }
        else {
            $q = "INSERT INTO `slider`(`image`) VALUES (?)";
            $values = [$img_r];
            $res = insert($q, $values, 's');
            echo $res;
        }
    }

    if(isset($_POST['get_slider'])) {
        $res = selectAll('slider');
        
        while ($row = mysqli_fetch_assoc($res)) {
            $path = SLIDER_IMG_PATH;
            echo <<<data
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white">
                        <img src="$path$row[image]" class="card-img">
                        <div class="card-img-overlay text-end">
                            <button type="button" onclick="rem_image($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </div>
                </div>
            data;
        }
    }

    if(isset($_POST['rem_image'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_image']];

        $pre_q = "SELECT * FROM `slider` WHERE `sr_no`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'], SLIDER_FOLDER)){
            $q = "DELETE FROM `slider` WHERE `sr_no`=?";
            $res = delete($q, $values, 'i');
            echo $res;
        }
        else {
            echo 0;
        }
    }


?>