<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == null) {
    // header("Location:catlist.php");
    echo "<script>window.location = 'sliderlist.php';</script>";
} else {
    $sliderid = $_GET['sliderid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $fm->validation($_POST['title']); 

            $title = $db->link->real_escape_string($title); 

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "upload/slider/" . $unique_image;
 
            if ($title == "") {
                echo "<span class='error'>Field Must not be empty.</span>";
            } else {
                if (!empty($file_name)) {
                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image size should be less than 1MB!</span>";
                    } elseif (!in_array($file_ext, $permited)) {
                        echo "<span class='error'>You can only upload files with the following extensions: " . implode(', ', $permited) . "</span>";
                    } else { 

                        // Delete previous image 
                        $deloldimg = "SELECT * FROM tbl_slider where id='$sliderid'";
                        $getslider = $db->select($deloldimg);
                        if ($getslider) {
                        while ($sliderdata = $getslider->fetch_assoc()) { 
                            $old_image = $sliderdata['image'];  
                            if (file_exists($old_image)) {
                                unlink($old_image);
                            }
                        }}

                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_slider
                            SET 
                            title='$title', 
                            image='$uploaded_image' 
                            WHERE id='$sliderid' ";

                        $updated_rows = $db->update($query);
                        if ($updated_rows) {
                            echo "<span class='success'>Data Updated successfully.</span>";
                        } else {
                            echo "<span class='error'>Failed to Update data.</span>";
                        }
                    }
                } else {
                    $query = "UPDATE tbl_slider
                        SET
                        title='$title'
                        WHERE id='$sliderid' ";

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
            $query = "SELECT * FROM tbl_slider where id='$sliderid'";
            $getslider = $db->select($query);
            if ($getslider) {
                while ($sliderall = $getslider->fetch_assoc()) {
                  
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $sliderall['title'] ?>" class="medium" />
                                </td>
                            </tr>
                             
                            <tr>
                                <td>
                                    <label>Update Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" /> <br>
                                    <img src="<?php echo $sliderall['image'] ?>" style="width:150px; margin-top:10px;" alt="">
                                </td>
                            </tr> 
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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