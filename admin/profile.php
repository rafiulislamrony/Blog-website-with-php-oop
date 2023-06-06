<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$userid = Session::get('userID');
$userrole = Session::get('userRole');  
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Post </h2>
         <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $fm->validation($_POST['name']);
                    $username = $fm->validation($_POST['username']);
                    $email = $fm->validation($_POST['email']);
                    $details = $_POST['details']; 

                    $name = $db->link->real_escape_string($name);
                    $username = $db->link->real_escape_string($username);
                    $email = $db->link->real_escape_string($email);
                    $details = $db->link->real_escape_string($details);

                    $query = "UPDATE tbl_user SET
                            name='$name',
                            username='$username',
                            email='$email',
                            details='$details'
                            WHERE id='$userid' "; 

                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                        echo "<span class='success'>Data Updated successfully.</span>";
                    } else {
                        echo "<span class='error'>Failed to Update data.</span>";
                    }
                } 
         ?>  

         <div class="block"> 
            <?php
                $query = "SELECT * FROM tbl_user WHERE id='$userid' AND role='$userrole'";
                $getuser = $db->select($query);
                if ($getuser) {
                    while ($result = $getuser->fetch_assoc()) {
                 ?>

                <form action="" method="POST">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Userame</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $result['username'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $result['email'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details"><?php echo $result['details'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Uplade" />
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