<?php include 'inc/header.php'; ?>

	<?php
					
		$firstname = $lastname = $email = $body = '';
		$error = array('firstname' => '', 'lastname' => '', 'email' => '', 'body' => '');
		$errorFlag = false;

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			$firstname = $fm->sanitaization($_POST['firstname']);
			$lastname = $fm->sanitaization($_POST['lastname']);
			$email = $fm->sanitaization($_POST['email']);
			$body = $fm->sanitaization($_POST['body']);

			$firstname = mysqli_real_escape_string($db->link, $firstname);
			$lastname = mysqli_real_escape_string($db->link, $lastname);
			$email = mysqli_real_escape_string($db->link, $email);
			$body = mysqli_real_escape_string($db->link, $body);

			
			if (empty($firstname)) {
				$error['firstname'] = 'First name must not be empty.';
				$errorFlag = true;
			}
			
			if (empty($lastname)) {
				$error['lastname'] = 'Last name must not be empty.';
				$errorFlag = true;
			}
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error['email'] = 'Enter a valid email address.';
				$errorFlag = true;
			}
			
			if (empty($body)) {
				$error['body'] = 'Message feild must not be empty.';
				$errorFlag = true;
			}
			
			if (!$errorFlag) {
				$query = "INSERT INTO tbl_contact(firstname, lastname, email, body) VALUES('$firstname', '$lastname', '$email', '$body')";
				
				if ($db->insert($query)) {
					$msg = "<span style='color: green; font-size: 18px;'>Message sent successful</span>";
					$firstname = $lastname = $email = $body = '';
				} else {
					$msg = "<span style='color: green; font-size: 18px;'>Message sent failed</span>";
				}
			}

		}
	?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?= isset($msg) ? $msg : ''; ?>
				<form action="" method="post">
					<table>
						<tr>
							<td>Your First Name:</td>
							<td>
							<input type="text" name="firstname" <?= $firstname ? 'value="' . $firstname . '"' : 'placeholder="Enter first name"'; ?> />
							</td>
						</tr>
						<tr>
							<td></td>
							<td><span style="color: red; font-size: normal;"><?= $error['firstname'] ? $error['firstname'] : ''; ?></span></td>
						</tr>
						<tr>
							<td>Your Last Name:</td>
							<td>
							<input type="text" name="lastname" <?= $lastname ? 'value="' . $lastname . '"' : 'placeholder="Enter first name"'; ?>/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><span style="color: red; font-size: normal;"><?= $error['lastname'] ? $error['lastname'] : ''; ?></span></td>
						</tr>
						
						<tr>
							<td>Your Email Address:</td>
							<td>
							<input type="email" name="email" <?= $email ? 'value="' . $email . '"' : 'placeholder="Enter first name"'; ?>/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><span style="color: red; font-size: normal;"><?= $error['email'] ? $error['email'] : ''; ?></span></td>
						</tr>
						<tr>
							<td>Your Message:</td>
							<td>
							<textarea name="body"><?= $body ? $body : ''; ?></textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><span style="color: red; font-size: normal;"><?= $error['body'] ? $error['body'] : ''; ?></span></td>
						</tr>
						<tr>
							<td></td>
							<td>
							<input type="submit" name="submit" value="Send"/>
							</td>
						</tr>
					</table>
				<form>				
 			</div>

	</div>

	<?php include 'inc/sidebar.php'; ?>
	</div>
	<?php include 'inc/footer.php'; ?>