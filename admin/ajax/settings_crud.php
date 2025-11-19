<?php
    require('../component/db_config.php');
    require('../component/essentials.php');
    // adminLogin();

    if(isset($_POST['get_general'])){
        $res = select("SELECT * FROM `settings` WHERE `sr_no`=?", [1], 'i');
        $data = mysqli_fetch_assoc($res);
        echo json_encode($data);
        exit;
    }

    if(isset($_POST['upd_general'])){
        $frm_data = filteration($_POST);
        $q = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `sr_no`=?";
        $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
        $res = update($q, $values, 'ssi');
        echo $res;
    }

    if(isset($_POST['upd_shutdown'])){
        $frm_data = ($_POST['upd_shutdown'] == 0) ? 1 : 0;
        $q = "UPDATE `settings` SET `shutdown`=? WHERE `sr_no`=?";
        $values = [$frm_data, 1];
        $res = update($q, $values, 'ii');
        echo $res;
    }


?>