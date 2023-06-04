<?php include '../lib/Session.php'; 
 Session::checkSession();
?> 

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?> 
<?php 
    $db = new Database();
?>

<?php
if (!isset($_GET['delpostid']) || $_GET['delpostid'] == null) {
    // header("Location:catlist.php");
    echo "<script>window.location = 'postlist.php';</script>";
} else {
    $postid = $_GET['delpostid'];

    $query = "SELECT * FROM tbl_post WHERE id='$postid' ";
    $getData = $db->select($query); 
    if($getData){
        while($delimg = $getData->fetch_assoc()){
            $dellink = $delimg['image'];
            echo unlink($dellink);  
        }
    }

    $delquery = "DELETE FROM tbl_post WHERE id='$postid' ";
    $delData =  $db->delete($delquery); 
    if($delData){
        echo "<script> alert('Data Deleted Successfully.');</script>";
        echo "<script>window.location = 'deletepost.php';</script>"; 
    }else{
        echo "<script> alert('Data Not  Deleted.');</script>"; 
        echo "<script>window.location = 'deletepost.php';</script>"; 
    }
}
?>


