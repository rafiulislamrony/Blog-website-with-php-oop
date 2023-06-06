<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
	<div class="box round first grid">
            <h2>Add New Post</h2>
            <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $fm->validation($_POST['title']);
                $cat = $fm->validation($_POST['cat']);
                $body = $_POST['body'];
                $aurthor = $fm->validation($_POST['aurthor']);
                $tags = $fm->validation($_POST['tags']);

                $title = $db->link->real_escape_string($title);
                $cat = $db->link->real_escape_string($cat);
                $body = $db->link->real_escape_string($body);
                $aurthor = $db->link->real_escape_string($aurthor);
                $tags = $db->link->real_escape_string($tags);

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
            
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/".$unique_image;

                if($title == "" || $cat == "" || $body == "" || $tags == "" || $aurthor == "" || $file_name == ""){
                    echo "<span class='error'>Field Must not be empty.</span>";
                }elseif ($file_size > 1048567) {
                    echo "<span class='error'>Image size should be less than 1MB!</span>";
                }elseif (!in_array($file_ext, $permited)) {
                    echo "<span class='error'>You can only upload files with the following extensions: " . implode(', ', $permited) . "</span>";
                }else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_post (cat, title, body, image, aurthor, tags) 
                              VALUES ('$cat', '$title', '$body', '$uploaded_image', '$aurthor', '$tags')";
                    $inserted_rows = $db->insert($query); 
                    if ($inserted_rows) {
                        echo "<span class='success'>Data inserted successfully.</span>";
                    } else {
                        echo "<span class='error'>Failed to insert data.</span>";
                    }
                }
            }
            ?>

            <div class="block">               
                <form action="addpost.php" method="post" enctype="multipart/form-data">
                <table class="form"> 
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="cat">
                                <option >Select Category</option>
                                <?php
                                $query = "SELECT * FROM tbl_category";
                                $category = $db->select($query);
                                if($category){
                                    while($result = $category->fetch_assoc()){ 
                                ?> 
                                <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>   --
                                <?php }}?> 
                            </select>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label>Aurthor</label>
                        </td>
                        <td>
                            <input type="text" name="aurthor" value="<?php echo Session::get('username')?>" class="medium" />
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

 