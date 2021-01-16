<?php

require_once 'config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['image']['name'])) {


        $fileinfo = pathinfo($_FILES['image']['name']);


        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $date = $_POST['date'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $status = $_POST['status'];



        $extension = $fileinfo['extension'];


        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
            echo 'Spatny format.';
        }

        //jpg-jpeg     
        if ($extension == "jpg" || $extension == "jpeg") {
            $uploadedfile = $_FILES['image']['tmp_name'];
            $src = imagecreatefromjpeg($uploadedfile);
            list($width, $height) = getimagesize($uploadedfile);

            //set new width
            $newwidth1 = 350;
            $newheight1 = ($height / $width) * $newwidth1;
            $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

            imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

            //new random name        
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            $filename1 = "img/" . $newfilename;

            imagejpeg($tmp1, $filename1, 100);

            imagedestroy($src);
            imagedestroy($tmp1);
            //insert in database
            $insert = mysqli_query($con, "INSERT INTO kits_products (kits_category_id, kits_brand_id, kits_product_date, kits_product_name, kits_product_desc, kits_product_price, kits_product_status, kits_product_img)
            VALUES ($category, $brand, '$date', '$name', '$desc', $price, $status, '$filename1');");

            echo "<html>
		<head>
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=produkty.php'>
			<script>
				alert('The image has been uploaded .');
			</script>
		</body>
        </html>";
        }

        //png
        else if ($extension == "png") {
            $uploadedfile = $_FILES['image']['tmp_name'];
            $src = imagecreatefrompng($uploadedfile);
            list($width, $height) = getimagesize($uploadedfile);

            //set new width            
            $newwidth1 = 350;
            $newheight1 = ($height / $width) * $newwidth1;
            $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);

            imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);

            //new random name
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            $filename1 = "img/" . $newfilename;

            imagejpeg($tmp1, $filename1, 100);

            imagedestroy($src);
            imagedestroy($tmp1);

            //insert in database
            $insert = mysqli_query($con, "INSERT INTO kits_products (kits_category_id, kits_brand_id, kits_product_date, kits_product_name, kits_product_desc, kits_product_price, kits_product_status, kits_product_img)
             VALUES ($category, $brand, '$date', '$name', '$desc', $price, $status, '$filename1');");

            echo "<html>$category
		<head>
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=produkty.php'>
			<script>
				alert('The image has been uploaded .');
			</script>
		</body>
        </html>";
        } else if ($extension == "gif") {
            $uploadedfile = $_FILES['image']['tmp_name'];

            //new random name

            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);

            $filename1 = "img/" . $newfilename;

            move_uploaded_file($uploadedfile, $filename1);

            //insert in database
            $insert = mysqli_query($con, "INSERT INTO kits_products (kits_category_id, kits_brand_id, kits_product_date, kits_product_name, kits_product_desc, kits_product_price, kits_product_status, kits_product_img)
            VALUES ($category, $brand, '$date', '$name', '$desc', $price, $status, '$filename1');");


            echo "<html>
    <head>
    </head>
    <body>
        <meta http-equiv='REFRESH' content='0 ; url=produkty.php'>
        <script>
            alert('The image has been uploaded .');
        </script>
    </body>
    </html>";
        } else {
            echo 'error';
        }
    }
}
