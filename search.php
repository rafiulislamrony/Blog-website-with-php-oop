
<?php include 'inc/header.php'; ?> 
<?php 
if(!isset($_GET['search']) || $_GET['search'] == NULL ){
	header("Location:404.php");
	exit;   
}else{
	$search = $_GET['search'];
}

?> 
 
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
    <?php 

        $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";

		$post = $db->select($query); 
		if($post) {
		while($result = $post->fetch_assoc()) {
		?>
    <div class="samepost clear">
	
    <h2><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'] ?> </a></h2>
        <h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['aurthor'] ?></a></h4>
        <a href="post.php?id=<?php echo $result['id'] ?>"><img src="admin/<?php echo $result['image'] ?>" alt="post image" /></a>
        <p>
        <?php echo $fm->textShorten($result['body']); ?> 
        </p>
        <div class="readmore clear">
        <a href="post.php?id=<?php echo $result['id'] ?>">Read More</a>
        </div>
    </div>
    <?php }} else {  ?> 
        <h3>Your Search Reasult Not Found ...</h3>
		
        <?php } ?> <!--- End While Loop -->
        
	</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>