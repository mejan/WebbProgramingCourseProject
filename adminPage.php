<?php
	//starts a session
	session_start();
	include 'post.php';
	/*
	Check so that password is not empty
	*/
	if(!(!isset($_REQUEST["password"]) || (strlen(trim($_REQUEST["password"])) == 0)) && !(!isset($_REQUEST["user"]) || (strlen(trim($_REQUEST["user"])) == 0))){
		//Check that it was the correct password.
		if(checkPassword($con)){
			//set the session variable to the correct for admin.
			$_SESSION["pw"] = "hhafpofojasfojfdafdsfpafadfnapdfiafae";
		}else{
			//just set the session variable so something wrong.
			$_SESSION["pw"]="nope";
		}
	}
	//Check so the titel of the post is not empty.
	if( !( !isset($_REQUEST["newPostTitelInput"]) || (strlen(trim($_REQUEST["newPostTitelInput"])) == 0) ) ){
		//insert post to database.
		insertToDB($con);
	}
	//check if admin wants to delete a post if true call delete function.
	if(!(!isset($_REQUEST["toDelete"]) || (strlen(trim($_REQUEST["toDelete"])) == 0))){
		deletePost($con, $_REQUEST['toDelete'], $_SESSION['array']);
	}
	//if it is the first time loading it will by default set current month to watch.
	if((!isset($_REQUEST["clientMonthCHoice"]) || (strlen(trim($_REQUEST["clientMonthCHoice"])) == 0))){
		$_REQUEST["clientMonthCHoice"] = 0;
	}
?>
<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin on blogg project</title>
		<link rel="stylesheet" type="text/css" href="Stylesheet.css">
		<!-- Latest compiled and minified CSS -->
		<script type="text/javascript" src="jQuery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="fancyBox/source/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="fancyBox/source/jquery.fancybox.pack.js"></script>

		<script type="text/javascript" src="bloggJS.js"></script>
	</head>
	<body>
		<?php
			//check if the session is set to the right value
			if($_SESSION["pw"] == "hhafpofojasfojfdafdsfpafadfnapdfiafae"){
				/*
					print some html to make it look like in index.php Check
					EASYTOREAD.html "explain First!"
				*/
				echo "<div class='row'><div class='col-xs-0 col-sm-0 col-md-2 col-lg-3'></div><div><img src='images/banner.png' id='bannerPic'  class='col-xs-12 col-sm-12 col-md-7 col-lg-7' alt='BannerPictu'></div></div><div class='row'><div class='col-md-3 col-lg-3'></div><div class='col-xs-9 col-sm-9 col-md-5 col-lg-5'>";
				/*
					Echo the add post GUI.(For admin).
					Check "EASYTOREAD SECOND!"
				*/
				echo "<div id='newPost'><form action='adminPage.php' method='post' enctype='multipart/form-data'><div class='row-fluid'><div class='postText col-xs-8 col-sm-8 col-md-8 col-lg-8'><h1 id='newPostEditBar'>Titel:<input id='newPostTitelInput' name='newPostTitelInput'><button id='textRandomHeader' name='textRandomHeader' type='button'>header</button><button id='textBig' name='textBig' type='button'>B</button><button id='textItalic' name='textItalic' type='button'>I</button></h1><textarea id='newPostInputText' name='newPostInputText'></textarea></div><div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'><input type='file' name='fileToUpload' id='fileToUpload'><button type='submit' name='newPostPost' id='newPostPost'>Post</button></div></div></form></div>";


				echo "<form action='adminPage.php' method='post'>";
					//To keep track of id for postst to delete.
					$_SESSION['array'] = linkAdminChoice($con, $_REQUEST["clientMonthCHoice"]);
					
				echo "</form>";
				/*
					continue of html to make it look like index.php
					Check EASYTOREAD "Explain MENU"
				*/
				echo "</div><div class='col-xs-3 col-sm-3 col-md-2 col-lg-2'><div id='menu'><form action='adminPage.php' method='post'><h3 class='menuLink'><button name='clientMonthCHoice' class='menyButton' value='0'>This month</button></h3><h3 class='menuLink'><button name='clientMonthCHoice' class='menyButton' value='1'>Last month</button></h3><h3 class='menuLink'><button name='clientMonthCHoice' class='menyButton' value='2'>Two Month before</button></h3><h3 class='menuLink'><a href='logout.php'>Log out</a></h3></form></div></div></div>";
			//if the session wasn't set to the right value send client to index.php again.
			} else{
				//Destroy session if user put wrong password in.
				session_destroy();
				//go to firstPage
				header("Location: index.php");
				//kill this page.
				die();
			}
		?>
	</body>
</html>