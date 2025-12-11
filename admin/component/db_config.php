<?php 
    $hname = "localhost";
    $uname = "root";
    $pass = "";
    $db = "hbwebsite";

    $con = mysqli_connect($hname, $uname, $pass, $db);
    if(!$con){
        die("Database connection failed: ".mysqli_connect_error());
    }

    function filteration($data){
        if (!is_array($data)) {
            return []; // Ngăn lỗi nếu $data không phải là mảng
        }
        foreach($data as $key => $value){
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $value = strip_tags($value);
            $data[$key] = $value;
        }
        return $data;
    }
    
    function selectAll($table){
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table");
        return $res;
    }

    function select($sql, $values, $datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            return false;
        }
    }

    function update($sql, $values, $datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die ("Execution failed: ".mysqli_error($con));
            }
        } else {
            die ("Preparation failed: ".mysqli_error($con));
        }
    }

    function insert($sql, $values, $datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die ("Execution failed: ".mysqli_error($con));
            }
        } else {
            die ("Preparation failed: ".mysqli_error($con));
        }
    }

    function delete($sql, $values, $datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if (mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die ("Execution failed: ".mysqli_error($con));
            }
        } else {
            die ("Preparation failed: ".mysqli_error($con));
        }
    }
?>