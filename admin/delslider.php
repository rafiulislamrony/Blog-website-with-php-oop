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
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == null) {
    // header("Location:catlist.php");
    echo "<script>window.location = 'sliderlist.php';</script>";
} else {
    $sliderid = $_GET['sliderid'];

    $query = "SELECT * FROM tbl_slider WHERE id='$sliderid' ";
    $getData = $db->select($query); 
    if($getData){
        while($delimg = $getData->fetch_assoc()){
            $dellink = $delimg['image'];
            echo unlink($dellink);  
        }
    }

    $delquery = "DELETE FROM tbl_slider WHERE id='$sliderid' ";
    $delData =  $db->delete($delquery); 
    if($delData){
        echo "<script> alert('Data Deleted Successfully.');</script>";
        echo "<script>window.location = 'delslider.php';</script>"; 
    }else{
        echo "<script> alert('Data Not  Deleted.');</script>"; 
        echo "<script>window.location = 'delslider.php';</script>"; 
    }
}
?>


