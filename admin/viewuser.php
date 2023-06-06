<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$userid = Session::get('userID');
$userrole = Session::get('userRole');  
?> 

<?php
    if(!isset($_GET['userid']) || $_GET['userid'] == NULL){
        // header("Location:catlist.php");
        echo "<script>window.location = 'userlist.php';</script>";
    }else{
        $id = $_GET['userid']; 
    }
?> 


<div class="grid_10">
    <div class="box round first grid">
        <h2> User Details </h2>
         <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'userlist.php';</script>";
            } 
         ?>  

         <div class="block"> 
            <?php
                $query = "SELECT * FROM tbl_user WHERE id='$id'"; 
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
                                <input type="text" readonly name="name" value="<?php echo $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Userame</label>
                            </td>
                            <td>
                                <input type="text" readonly name="username" value="<?php echo $result['username'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" readonly name="email" value="<?php echo $result['email'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly name="details"><?php echo $result['details'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="View Ok" />
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