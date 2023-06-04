<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
    <div class="grid_10">
    
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>

            <?php 
            $query = "SELECT * FROM title_slogan WHERE id='1' ";
            $blog_title = $db->select($query);
            if($blog_title){
                while($result = $blog_title->fetch_assoc()){
                    

           
            ?>

            <div class="block sloginblock">               
                <form>
                <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
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
            <?php } }?>
        </div>
    </div>
    <div class="clear">
    </div> 
</div>
<?php include 'inc/footer.php'; ?>