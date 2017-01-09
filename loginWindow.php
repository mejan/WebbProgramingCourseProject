<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Blogg Project</title>
		<script type="text/javascript" src="jQuery.js"></script>
		<link rel="stylesheet" type="text/css" href="Stylesheet.css">
		<?php
			include 'post.php'
		?>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
				<div id="window">
					<form action="adminPage.php" method="post">
						<table>
							<tr>
								<td>
									<h3>Username:</h3>
								</td><td>
									<input name="user" id="user" type="text">
								</td>
							</tr><tr>
								<td>
									<h3>Password:</h3>
								</td><td>
									<input name="password" id="password" type="password">
								</td>
							</tr><tr>
								<td></td><td>
									<button type="submit" name="submitText">Log in</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>