<?php
	include 'post.php';
	
	if((!isset($_REQUEST["clientMonthCHoice"]) || (strlen(trim($_REQUEST["clientMonthCHoice"])) == 0))){
		$_REQUEST["clientMonthCHoice"] = 0;
	}
?>
<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Blogg Project</title>
		<link rel="stylesheet" type="text/css" href="Stylesheet.css">
		<script type="text/javascript" src="jQuery.js"></script>
		<script type="text/javascript" src="fancyBox/source/jquery.fancybox.pack.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="fancyBox/source/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="fancyBox/source/jquery.fancybox.pack.js"></script>

		<script type="text/javascript" src="bloggJS.js"></script>
	</head>
	<body>
		<div class="row">
			
			<div class="col-xs-0 col-sm-0 col-md-2 col-lg-3"></div>

			<div>
				<img src="images/banner.png" id="bannerPic"  class="col-xs-12 col-sm-12 col-md-7 col-lg-7" alt="BannerPicture">
			</div>
			
		</div>

		<div class="row">

			<div class="col-md-3 col-lg-3"></div>

			<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
				<?php
					linkChoice($con, $_REQUEST["clientMonthCHoice"]);
				?>
			</div>

			<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2">
				<div id='menu'>
					<form action='index.php' method='post'>
						<h3 class='menuLink'>
							<button name='clientMonthCHoice' class='menyButton' value='0'>This month</button>
						</h3>
						<h3 class='menuLink'>
							<button name='clientMonthCHoice' class='menyButton' value='1'>Last month</button>
						</h3>
						<h3 class='menuLink'>
							<button name='clientMonthCHoice' class='menyButton' value='2'>Two Month before</button>
						</h3>
						<h3 class='menuLink'>
							<a href='loginWindow.php'>Log in</a>
						</h3>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>