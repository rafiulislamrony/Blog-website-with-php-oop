<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $fm->validation($_POST['title']);
    $slogan = $fm->validation($_POST['slogan']);

    $title = $db->link->real_escape_string($title);
    $slogan = $db->link->real_escape_string($slogan);

    $permited  = array('png');
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $logo_name = 'logo'.'.'.$file_ext;
    $uploaded_image = "upload/".$logo_name;

    if($title == "" || $slogan == "") {
        echo "<span class='error'>Field Must not be empty.</span>";
    } 
    else{
        if (!empty($file_name)){
            if ($file_size > 1048567){
                echo "<span class='error'>Image size should be less than 1MB!</span>";
            } elseif (!in_array($file_ext, $permited)) {
                echo "<span class='error'>You can only upload files with the following extensions: " . implode(', ', $permited) . "</span>";
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE title_slogan 
                    SET title='$title', 
                    slogan='$slogan',
                    logo='$uploaded_image' 
                    WHERE id='1'";
                 $updated_rows = $db->update($query);
                if ($updated_rows) {
                    echo "<span class='success'>Data Updated successfully.</span>";
                } else {
                    echo "<span class='error'>Failed to Update data.</span>";
                }
            }  
        }else{
            $query = "UPDATE title_slogan 
            SET title='$title',
            slogan='$slogan' WHERE id='1'";
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

    <div class="grid_10">
    
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>

            <?php
            $query = "SELECT * FROM title_slogan WHERE id='1' ";
            $blog_title = $db->select($query);
            if($blog_title) {
                while($result = $blog_title->fetch_assoc()) {    
 
          ?>

            <div class="block sloginblock">               
                <form method="POST"  enctype="multipart/form-data"> 
                  <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text"  value="<?php echo $result['title'] ?>"  name="title" class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <label>Upload Logo</label>
                        </td>
                        <td>
                            <input type="file" name="logo"/><br>
                            <img src="<?php echo $result['logo']; ?>" style="width:100px; margin-top:10px;" alt="logo">
                        </td>
                        </tr>
                    
                        <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php }
    }?>
        </div>
    </div>
    <div class="clear">
    </div> 
</div>
<?php include 'inc/footer.php'; ?>