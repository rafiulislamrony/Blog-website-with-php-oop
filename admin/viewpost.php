<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == null) {
    // header("Location:catlist.php");
    echo "<script>window.location = 'postlist.php';</script>";
} else {
    $postid = $_GET['viewpostid'];
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
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
                                    <input type="text" readonly value="<?php echo $postresult['title'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select readonly id="select">
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
                                    <label>  Image</label>
                                </td>
                                <td> 
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
                                    <input type="text" readonly value="<?php echo $postresult['tags'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Aurthor</label>
                                </td>
                                <td>
                                    <input type="text" readonly value="<?php echo $postresult['aurthor'] ?>" class="medium" /> 
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="View OK" />
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