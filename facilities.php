<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Hotel - Cơ sở vật chất</title>
    <?php require('component/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - Cơ sở vật chất</title>
    <style>
        .h-line {
            width: 110px;
            height: 1.7px !important;
            margin: 0 auto;
        }   
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>
<body class="bg-light">
    
    <?php require('component/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Cơ sở vật chất</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Trải nghiệm tiện nghi đẳng cấp tại T1 Hotel</p>
    </div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while($row = mysqli_fetch_assoc($res)){
                    echo<<<data
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow border-top border-4 border-dark pop overflow-hidden h-100">
                            <img src="$path$row[image]" class="w-100 rounded-top" style="height: 200px; object-fit: cover;">
                            <div class="p-4 text-center">
                                <h5 class="mb-2">$row[name]</h5>
                                <p>$row[description]</p>
                            </div>
                        </div>
                    </div>
                    data;
                }
            ?>
        </div>
    </div>



    <?php require('component/footer.php'); ?>
    
</body>
</html>