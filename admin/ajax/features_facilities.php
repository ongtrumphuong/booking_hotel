<?php
    require('../component/db_config.php');
    require('../component/essentials.php');
    adminLogin();

    if(isset($_POST['add_feature'])) {
        $frm_data = filteration($_POST);
        
        $q = "INSERT INTO `features`(`name`) VALUES (?)";
        $values = [$frm_data['name']];
        $res = insert($q, $values, 's');
        echo $res;
    }

    if(isset($_POST['get_features'])) {
        $res = selectAll('features');
        $i = 1;
        
        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <tr>
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>
                        <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_feature'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_feature']];

        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    }

    if(isset($_POST['add_facility'])) {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['image'], FACILITIES_FOLDER);
        
        if($img_r == 'inv_img') {
            echo $img_r;
        }
        else if($img_r == 'inv_size') {
            echo $img_r;
        }
        else if($img_r == 'upd_failed') {
            echo $img_r;
        }
        else {
            $q = "INSERT INTO `facilities`(`name`, `description`, `image`) VALUES (?,?,?)";
            $values = [$frm_data['name'], $frm_data['desc'], $img_r];
            $res = insert($q, $values, 'sss');
            echo $res;
        }
    }

    if(isset($_POST['get_facilities'])) {
        $res = selectAll('facilities');
        $i = 1;
        $path = FACILITIES_IMG_PATH;
        
        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td><img src="$path$row[image]" width="100px"></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_facility'])) {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_facility']];

        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'], FACILITIES_FOLDER)) {
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $res = delete($q, $values, 'i');
            echo $res;
        
        }
        else {
            echo 0;
        }        
    }
?>