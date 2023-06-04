<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['editpostid']) || $_GET['editpostid'] == null) {
    // header("Location:catlist.php");
    echo "<script>window.location = 'postlist.php';</script>";
} else {
    $postid = $_GET['editpostid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $fm->validation($_POST['title']);
            $cat = $fm->validation($_POST['cat']);
            $body = $fm->validation($_POST['body']);
            $aurthor = $fm->validation($_POST['aurthor']);
            $tags = $fm->validation($_POST['tags']);

            $title = $db->link->real_escape_string($title);
            $cat = $db->link->real_escape_string($cat);
            $body = $db->link->real_escape_string($body);
            $aurthor = $db->link->real_escape_string($aurthor);
            $tags = $db->link->real_escape_string($tags);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/" . $unique_image;

            if ($title == "" || $cat == "" || $body == "" || $tags == "" || $aurthor == "") {
                echo "<span class='error'>Field Must not be empty.</span>";
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image size should be less than 1MB!</span>";
                    } elseif (!in_array($file_ext, $permited)) {
                        echo "<span class='error'>You can only upload files with the following extensions: " . implode(', ', $permited) . "</span>";
                    } else { 

                        // Delete previous image 
                        $deloldimg = "SELECT * FROM tbl_post where id='$postid' order by id desc";
                        $getpostall = $db->select($deloldimg);
                        if ($getpostall) {
                        while ($postimge = $getpostall->fetch_assoc()) { 
                            $old_image = $postimge['image']; 
                            if (file_exists($old_image)) {
                                unlink($old_image);
                            }
                        }}

                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_post
                            SET
                            cat='$cat',
                            title='$title',
                            body='$body',
                            image='$uploaded_image',
                            aurthor='$aurthor',
                            tags='$tags'
                            WHERE id='$postid' ";

                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Data Updated successfully.</span>";
                        } else {
                            echo "<span class='error'>Failed to Update data.</span>";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_post
                        SET
                        cat='$cat',
                        title='$title',
                        body='$body',
                        aurthor='$aurthor',
                        tags='$tags'
                        WHERE id='$postid' ";

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Data Updated successfully.</span>";
                    } else {
                        echo "<span class='error'>Failed to Update data.</span>";
                    }
                }
            }
        }
        ?>

        <div class="block">
            <?php
            $query = "SELECT * FROM tbl_post where id='$postid' order by id desc";
            $getpost = $db->select($query);
            if ($getpost) {
                while ($postresult = $getpost->fetch_assoc()) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $postresult['title'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <option>Select Category</option>
                                        <?php
                                        $query = "SELECT * FROM tbl_category";
                                        $category = $db->select($query);
                                        if ($category) {
                                            while ($result = $category->fetch_assoc()) {
                                                ?>
                                                <option <?php
                                                if ($postresult['cat'] == $result['id']) { ?> selected="selected" <?php } ?>
                                                    value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option> --

                                            <?php }
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" /> <br>
                                    <img src="<?php echo $postresult['image'] ?>" style="width:150px; margin-top:10px;" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                        <?php echo $postresult['body'] ?>
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $postresult['tags'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Aurthor</label>
                                </td>
                                <td>
                                    <input type="text" name="aurthor" value="<?php echo $postresult['aurthor'] ?>"
                                        class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                }
            }
            ?>

        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>