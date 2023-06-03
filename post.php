<?php include 'inc/header.php'; ?> 
<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL ){
	header("Location:404.php");
	exit;   
}else{
	$id = $_GET['id'];
}

?> 
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php 
				$query = "SELECT * FROM tbl_post WHERE id = $id";
				$post = $db->select($query); 
				if($post){
				while($result = $post->fetch_assoc()) {
					?>
				<h2><?php echo $result['title'] ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <?php echo $result['aurthor'] ?></h4>
				<img src="admin/<?php echo $result['image'] ?>" alt="MyImage"/>
				<?php echo $result['body'] ?>
				  
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					$catid = $result['cat'];
					$queryrelated = "SELECT * FROM tbl_post WHERE cat ='$catid'  order by rand() limit 6";
					$relatedpost = $db->select($queryrelated); 
					if($relatedpost){
				    while($relatedresult = $relatedpost->fetch_assoc()) {
					?>
					<a href="post.php?id=<?php echo $relatedresult['id'] ?>">
					  <img src="admin/<?php echo $relatedresult['image'] ?>" alt="post image"/>
					</a> 
					<?php }}else{
							echo "No Related Post Available";
						}?>
				</div>
				<?php  
				    } }else{
					header("Location:404.php");
			        exit;} 
				?>

	        </div>

		</div>
		
	<?php include 'inc/sidebar.php'; ?>
    <?php include 'inc/footer.php'; ?>