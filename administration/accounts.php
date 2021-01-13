</html>
<?php
//test_class.php  
include 'CRUD.php';
$data = new CRUD;
$success_message = '';
if (isset($_POST["submit"])) {
    $insert_data = array(
        'post_title'     =>     mysqli_real_escape_string($data->con, $_POST['post_title']),
        'post_desc'          =>     mysqli_real_escape_string($data->con, $_POST['post_desc'])
    );
    if ($data->insert('tbl_posts', $insert_data)) {
        $success_message = 'Post Inserted';
    }
}
if (isset($_POST["edit"])) {
    $update_data = array(
        'post_title'     =>     mysqli_real_escape_string($data->con, $_POST['post_title']),
        'post_desc'          =>     mysqli_real_escape_string($data->con, $_POST['post_desc'])
    );
    $where_condition = array(
        'post_id'     =>     $_POST["post_id"]
    );
    if ($data->update("tbl_posts", $update_data, $where_condition)) {
        header("location:test.php?updated=1");
    }
}
if (isset($_GET["updated"])) {
    $success_message = 'Post Updated';
}
if (isset($_GET["delete"])) {
    $where = array(
        'post_id'     =>     $_GET["post_id"]
    );
    if ($data->delete("tbl_posts", $where)) {
        header("location:test.php?deleted=1");
    }
}
if (isset($_GET["deleted"])) {
    $success_message = 'Post Deleted';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | Delete Data from Mysql Table using OOPS in PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <br /><br />
    <div class="container" style="width:700px;">
        <form method="post">
            <?php
            if (isset($_GET["edit"])) {
                if (isset($_GET["post_id"])) {
                    $where = array(
                        'post_id'     =>     $_GET["post_id"]
                    );
                    $single_data = $data->select_where("tbl_posts", $where);
                    foreach ($single_data as $post) {
            ?>
                        <label>Post Title</label>
                        <input type="text" name="post_title" value="<?php echo $post["post_title"]; ?>" class="form-control" />
                        <br />
                        <label>Post Description</label>
                        <textarea name="post_desc" class="form-control"><?php echo $post["post_desc"]; ?></textarea>
                        <br />
                        <input type="hidden" name="post_id" value="<?php echo $post["post_id"]; ?>" />
                        <input type="submit" name="edit" class="btn btn-info" value="Edit" />
                <?php
                    }
                }
            } else {
                ?>
                <label>Post Title</label>
                <input type="text" name="post_title" class="form-control" />
                <br />
                <label>Post Description</label>
                <textarea name="post_desc" class="form-control"></textarea>
                <br />
                <input type="submit" name="submit" class="btn btn-info" value="Submit" />
            <?php
            }
            ?>
            <span class="text-success">
                <?php
                if (isset($success_message)) {
                    echo $success_message;
                }
                ?>
            </span>
        </form>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td width="30%">Post Name</td>
                    <td width="50">Post Description</td>
                    <td width="10%">Edit</td>
                    <td width="10%">Delete</td>
                </tr>
                <?php
                $post_data = $data->select('tbl_posts');
                foreach ($post_data as $post) {
                ?>
                    <tr>
                        <td><?php echo $post["post_title"]; ?></td>
                        <td><?php echo substr($post["post_desc"], 0, 200); ?></td>
                        <td><a href="test.php?edit=1&post_id=<?php echo $post["post_id"]; ?>">Edit</a></td>
                        <td><a href="#" id="<?php echo $post["post_id"]; ?>" class="delete">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var post_id = $(this).attr("id");
            if (confirm("Are you sure you want to delete this post?")) {
                window.location = "test.php?delete=1&post_id=" + post_id + "";
            } else {
                return false;
            }
        });
    });
</script>