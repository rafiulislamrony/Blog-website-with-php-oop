<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

	<div class="grid_10">
		<div class="box round first grid">
			<h2>Post List</h2>
			<div class="block">  
				<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Post Title</th> 
						<th>Description</th>
						<th>Category</th>
						<th>Image</th>
						<th>Author</th>
						<th>Tags</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$query = "SELECT tbl_post.*, tbl_category.name 
						FROM tbl_post
						INNER JOIN tbl_category 
						ON tbl_post.cat = tbl_category.id 
						ORDER BY tbl_post.title DESC";
 
					 $post = $db->select($query);
					 if($post){
						$i=0;
						while($result = $post->fetch_assoc()){
							$i++; 
					?>

						<tr class="odd gradeX">
							<td style="width: 5%;"> <?php echo $i++; ?> </td>
							<td style="width: 15%;"> <?php echo $result['title']; ?> </td>
							<td style="width: 20%;"> <?php echo $fm->textShorten($result['body'], 50); ?> </td>
							<td style="width: 10%;"> <?php echo $result['name']; ?> </td>
							<td style="width: 10%;"> <img src="<?php echo $result['image']; ?>" style=" width: 80px; margin-top:10px;" /> </td>
							<td style="width: 10%;"> <?php echo $result['aurthor']; ?> </td>
							<td style="width: 10%;"> <?php echo $result['tags']; ?> </td>
							<td style="width: 10%;"> <?php echo $fm->formatDate($result['date']); ?> </td>
							<td style="width: 15%;"><a href="">Edit</a> || <a href="">Delete</a></td>
						</tr>

					<?php }  } ?>


					 
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<div class="clear">
	</div>
</div>
 
<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>