<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        // header("Location:catlist.php");
        echo "<script> 
        window.location = 'catlist.php';
        </script>";
    }else{
        $id = $_GET['catid'];
    }
?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
        <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $fm->validation($_POST['name']); 
            $name = $db->link->real_escape_string($name); 

            if(empty($name)){
                echo "<span class='error'>Field must not be empty.</span>";
            }else{
                $query = "UPDATE tbl_category 
                SET name='$name'
                WHERE id='$id'";

                $updated_row = $db->update($query);
                
                if($updated_row){ 
                    echo "<span class='success'>Category Updated Successfully.</span>";
                    
                }else{
                    echo "<span class='error'>Category Not Updated.</span>"; 
                }
            }
        }
        ?>

            <?php 
            $query = "SELECT * FROM tbl_category WHERE id = '$id' ORDER BY id DESC";
            $category = $db->select($query);

            while($result = $category->fetch_assoc()){
            ?>
                <form action="" method="post">
                    <table class="form"> 	
                        <tr>
                            <td>
                                <input type="text" value=" <?php echo $result['name'] ?>" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>

                <?php  } ?>

                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div> 
<?php include 'inc/footer.php'; ?>
