<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL){
        // header("Location:catlist.php");
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $id = $_GET['msgid']; 
    }
?> 
<div class="grid_10">
	<div class="box round first grid">
            <h2>View Message</h2>
            <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $toEmail = $fm->validation($_POST['toEmail']);
				$fromEmail = $fm->validation($_POST['fromEmail']); 
				$subject = $fm->validation($_POST['subject']); 
				$message = $fm->validation($_POST['message']); 

				$toEmail = $db->link->real_escape_string($toEmail);
				$fromEmail = $db->link->real_escape_string($fromEmail); 
				$subject = $db->link->real_escape_string($subject); 
				$message = $db->link->real_escape_string($message); 

                $sendmail = mail($toEmail, $subject, $message, $fromEmail);
                if($sendmail){
                    echo "<span class='success'>Message Send successfully.</span>";
                }else{
                    echo "<span class='error'>Message Not Send.</span>";
                }

            }
            ?>

            <div class="block">               
                <form action="" method="post">
                    
                <?php 
                   $query = "SELECT * FROM tbl_contact WHERE id ='$id'";

                    $msq = $db->select($query);
                    if($msq){ 
                        $i = 0;
                    while($result = $msq->fetch_assoc()){
                        $i++
                    ?>
                <table class="form">   
                    <tr>
                        <td>
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromEmail" placeholder="Enter Your Email Address" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text" name="subject" placeholder="Enter Your Subject" class="medium" />
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>Message</label>
                        </td>
                        <td> 
                            <textarea class="tinymce" name="message"></textarea>
                        </td>
                    </tr> 
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Send"/>
                        </td>
                    </tr>
                </table>
                <?php  }  } ?>
                </form>
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

 