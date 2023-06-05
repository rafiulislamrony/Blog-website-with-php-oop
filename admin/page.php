<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
        // header("Location:catlist.php");
        echo "<script>window.location = 'index.php';</script>";
    }else{
        $id = $_GET['pageid']; 
    }
?> 

<?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $fm->validation($_POST['name']);
                $body = $fm->validation($_POST['body']);

                $name = $db->link->real_escape_string($name);
                $body = $db->link->real_escape_string($body);


                if ($name == "" || $body == "") {
                    echo "<span class='error'>Field Must not be empty.</span>";
                } else {
                    $query = "UPDATE tbl_page
                    SET name='$name', body='$body'
                    WHERE id='$id'";
    
                    $updated_row = $db->update($query);

                    if ($updated_row) { 
                        echo "<span class='success'>Page Updated successfully.</span>";
                    } else {
                        echo "<span class='error'>Page Not Updated.</span>";
                    }
                }
            }
        ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Page</h2>
        <div class="block">
            <?php
            $pagequery = "SELECT * FROM tbl_page WHERE id='$id' ";
            $pagedetails = $db->select($pagequery);

            if ($pagedetails) {
                while ($result = $pagedetails->fetch_assoc()) { ?>

                    <form action="" method="POST"> 

                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body">
                                             <?php echo $result['body']; ?>
                                            </textarea>
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

                <?php } } ?>

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