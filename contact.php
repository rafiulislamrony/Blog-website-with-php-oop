<?php include 'inc/header.php'; ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $fm->validation($_POST['firstname']);
    $lastname = $fm->validation($_POST['lastname']);
    $email = $fm->validation($_POST['email']);
    $body = $fm->validation($_POST['body']);

    $firstname = $db->link->real_escape_string($firstname);
    $lastname = $db->link->real_escape_string($lastname);
    $email = $db->link->real_escape_string($email);
    $body = $db->link->real_escape_string($body); 

	$error = "";

	if(empty($firstname)){
		$error = "First Name Must Not be Empty";
	}elseif(empty($lastname)){
		$error = "Last Name Must Not be Empty";
	}elseif(empty($email)){
		$error = "Email Must Not be Empty";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = "Invalide Email Address";
	}elseif(empty($body)){
		$error = "Message Must Not be Empty";
	}else{
		$masg = "ok";
	}

	

}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<?php 
			if(isset($error)){
				echo "<span style='color:red;' >$error </span>";
			}
			if(isset($msg)){
				echo "<span style='color:red;' >$msg </span>";
			}
			?>
			
			<form action="" method="post">
				<table>
					<tr>
						<td>Your First Name:</td>
						<td>
							<input type="text" name="firstname" placeholder="Enter first name"/>
						</td>
					</tr>
					<tr>
						<td>Your Last Name:</td>
						<td>
							<input type="text" name="lastname" placeholder="Enter Last name" />
						</td>
					</tr>

					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"> </textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send" />
						</td>
					</tr>
				</table>
				<form>
		</div>

	</div>

	<?php include 'inc/sidebar.php'; ?>

	<?php include 'inc/footer.php'; ?>