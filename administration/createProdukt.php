<?php include('config/configLang.php');
include('config/config.php');
?>
<?php
$server = 'localhost';
$username = 'root';
$password = 'klobasakecup';
$database = 'kits';

$conn = mysqli_connect($server, $username, $password, $database) or die('can not connect');
mysqli_select_db($conn, "kits");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product id:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Auto increment" readonly>
        </div>
        <div class="form-group">
            <?php
            $stmt = $db->prepare("SELECT * FROM `kits_category`");
            $stmt->execute();
            $datas = $stmt->fetchAll(); ?>
            <label for="recipient-name" class="col-form-label">category id:</label>
            <select name="category" id="">
                <?php foreach ($datas as $data) { ?>
                    <option value="<?php echo $data['category_id']; ?>"><?php echo $data['category_title']; ?></option>
                <?php  } ?>
            </select>
        </div>
        <div class="form-group">
            <?php
            $stmt = $db->prepare("SELECT * FROM `kits_brands`");
            $stmt->execute();
            $datas = $stmt->fetchAll();
            ?>
            <label for="recipient-name" class="col-form-label">brand id:</label>
            <select name="brand" id="">
                <?php foreach ($datas as $data) { ?>
                    <option value="<?php echo $data['kits_brand_id']; ?>"><?php echo $data['kits_brand_title']; ?></option>
                <?php  } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product date:</label>
            <input type="date" class="form-control" name="date" id="recipient-name">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product name:</label>
            <input type="text" class="form-control" name="name" id="recipient-name">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product desc:</label>
            <input type="text" class="form-control" name="desc" id="recipient-name">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product price:</label>
            <input type="text" class="form-control" name="price" id="recipient-name">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product status:</label>
            <input type="text" class="form-control" name="status" id="recipient-name">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">product img:</label>
            <input type="file" name="image" accept="image/*" required id="image" name="img" onclick="selected_image();">
        </div>
        <div class="form-group">
            <input type="submit" name="submit">
        </div>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $date = $_POST['date'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $status = $_POST['status'];


        $file = $_FILES['image']['tmp_namee'];
        $pimageName = $_FILES['image']['name'];
        $pimage = mysqli_real_escape_string($conn, file_get_contents($_FILES["image"]["tmp_namee"]));


        $upload_image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
        $folder = "tmp/images/";
        move_uploaded_file($_FILES["image"]["tmp_namee "], "$folder" . $_FILES["image"]["name"]);
        $path = 'backend/' . $folder . $pimageName;



        $sql = "INSERT INTO `kits_products` (`kits_product_id`, `kits_category_id`, `kits_brand_id`, `kits_product_date`, `kits_product_name`, `kits_product_desc`, `kits_product_price`, `kits_product_status`, `kits_product_img`)
         VALUES (NULL, '$category', '$brand', '$date', '$name', '$desc', '$price', '$status', '$pimageName');";
        if (!$insert = mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'> alert('Unsuccessful Inserted  and Please try again!');
		 </script>" . mysqli_error($conn);
        } else {
            echo "<script type='text/javascript'> alert('Successfully Inserted the Product!')";
            header('Location: produkty.php');
        }
    }
    ?>
</body>

</html>