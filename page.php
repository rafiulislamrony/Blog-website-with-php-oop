<?php include 'inc/header.php'; ?>
<?php
$pageid = $db->link->real_escape_string($_GET['pageid']);
if (!isset($pageid) || $pageid == NULL) {
	// header("Location:catlist.php");
	echo "<script>window.location = '404.php';</script>";
} else {
	$id = $pageid;
}
?>
<?php
$pagequery = "SELECT * FROM tbl_page WHERE id='$id' ";
$pagedetails = $db->select($pagequery);
if ($pagedetails) {
	while ($result = $pagedetails->fetch_assoc()) { ?>

		<div class="contentsection contemplete clear">
			<div class="maincontent clear">
				<div class="about">
					<h2>
						<?php echo $result['name']; ?>
					</h2>
					<?php echo $result['body']; ?>
				</div>
			</div>
		<?php }
} else {
	header("Location:404.php");
} ?>
	<?php include 'inc/sidebar.php'; ?>

	<?php include 'inc/footer.php'; ?>