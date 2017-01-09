<?php
/*
*Auther Mikael Falck
*php script for blogg project
*Course DT100G
*/
	/*
	*Varible's for server settings. This is how I access the MySQL.
	*For creating the right database and table's use the .sql script.
	*Rember to change the username, passsword and serverIp variable's
	*/
	$serverIp = "127.0.0.1"; //Change if needed.
	$DBname="bloggProject"; //this is the name in the sql script
	$username="xxx"; //MySQL username.
	$passsword="xxx"; //MySQL password..
	//make con a global variable.
	$con = null;
	//try to connect to database.
	try{
		$con = new PDO("mysql:host=$serverIp;dbname=$DBname;", $username, $passsword);
	}catch(PDOException $e){
		echo $e->getMessage();
	}

	//Check so admin filled both inputs
	if(!(!isset($_REQUEST["titel"]) || (strlen(trim($_REQUEST["titel"])) == 0) && !isset($_REQUEST["msg"]) || (strlen(trim($_REQUEST["msg"])) == 0))){
		insertToDB($con);
		if(!empty($_FILES['imgUpload']['name'])){
			uploadImg($con);
		}
	}

	function insertToDB($con){
		//Take input from admin page
		$firstTagGroup = '<div class="post row-fluid"><div class="postText col-xs-9 col-sm-9 col-md-9 col-lg-9"><h1 class="postTitel">';
		$secondTagGroup = '</h1><div class="postBody">';
		$thirdTagGroup = '</div></div><div class="postImg col-xs-3 col-sm-3 col-md-3 col-lg-3">';
		$forthTagGroup = '</div></div>';
		$currentDate = date("Y-m-d");
		$tarDir = "images/";

		$toPostText = $_REQUEST["newPostInputText"];
		$titel = $_REQUEST["newPostTitelInput"];

		if(!empty($_FILES['fileToUpload']['name'])){
			$tarFile = $tarDir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = pathinfo($tarFile,PATHINFO_EXTENSION);
			//Check so the file that is uploaded is of the right type (jpg,jpeg,png,git)
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
				echo "The picture need's to be: jpg, jpeg, png or gif";
			}else{
				//Try to upload the file to server folder
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $tarFile)){
					//sett file path.
					$tmp = (String)$tarFile;
					//picture variable for fancybox possibuíltys.
					$fancyBoxstufffOne = "<a class='FancyPhotos' href='{$tmp}' rel='biggerPhoto'><img src='{$tmp}' alt='PostPicture'></a>";
					//put the post in one variable.
					$tmp2 = $firstTagGroup . $titel . $secondTagGroup . $toPostText . $thirdTagGroup . $fancyBoxstufffOne . $forthTagGroup;
					//insert post and image to DB.
					$sql = "INSERT INTO textForPost (postDate, postText) VALUES (:dateItWas, :thePostText)";
					$stm = $con->prepare($sql);
					$res = $stm->execute(array(
						":dateItWas" => $currentDate,
						":thePostText" => $tmp2
					));
				}else{
					echo 'A error occerd while uploading the image';
				}
			}
		} else{
			//post set in one variable.
			$tmp2 = $firstTagGroup . $titel . $secondTagGroup . $toPostText . $thirdTagGroup . $forthTagGroup;
			//Insert the post in DB.
			$sql = "INSERT INTO textForPost (postDate, postText) VALUES (:dateItWas, :thePostText)";
			$stm = $con->prepare($sql);
			$res = $stm->execute(array(
				":dateItWas" => $currentDate,
				":thePostText" => $tmp2
			));
		}
	}

	//Meny choice will make diffrent sql kode.
	function linkChoice($con, $num){
		if($num == 0){
			//SQL code for this month query.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE()) ORDER BY id DESC";
			getPosts($con, $sql);
		} elseif ($num == 1) {
			//SQL code for privouse month.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) ORDER BY id DESC";
			getPosts($con, $sql);
		} elseif ($num == 2){
			//SQL code for post 2 month ago.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 2 MONTH) ORDER BY id DESC";
			getPosts($con, $sql);
		}
	}
	//geting the posts for special month.
	function getPosts($con, $sql){
		//Make Query.
		$stm = $con->prepare($sql);
		$stm->execute();
		$res = $stm->fetchAll();
		//This is a worse solution then it would be with a left join! (sql).
		if($res != false){
			foreach ($res as $row) {
				echo $row['postText'];

			}
		}
	}

	//make choice for with month will be get.
	function linkAdminChoice($con, $num){
		if($num == 0){
			//SQL code for this month query.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE()) ORDER BY id DESC";
			return getAdminPosts($con, $sql);
		} elseif ($num == 1) {
			//SQL code for privouse month.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 1 MONTH) ORDER BY id DESC";
			return getAdminPosts($con, $sql);
		} elseif ($num == 2){
			//SQL code for post 2 month ago.
			$sql = "SELECT * FROM textForPost WHERE EXTRACT(YEAR_MONTH FROM postDate) = EXTRACT(YEAR_MONTH FROM CURDATE() - INTERVAL 2 MONTH) ORDER BY id DESC";
			return getAdminPosts($con, $sql);
		}
	}

	//Gets the postss from database, for admin(current month).
	function getAdminPosts($con, $sql){
		//Make Query.
		$stm = $con->prepare($sql);
		$stm->execute();
		$res = $stm->fetchAll();
		//keep track of deletepost.
		$tmpCount = 0;
		//This is a worse solution then it would be with a left join! (sql).
		if($res != false){
			foreach ($res as $row) {
				echo $row['postText'].'<br>';
				$tmpId[] = $row['id'];
				echo "<button type='submit' name='toDelete' value='". $tmpCount ."'>Delete</button>";
				$tmpCount = $tmpCount + 1;
			}
			return $tmpId;
		}
	}

	//check the login was ok!
	function checkPassword($con){
		//check so that the client put in a password and user name.
		if(!(!isset($_REQUEST["password"]) || (strlen(trim($_REQUEST["password"])) == 0)) && !(!isset($_REQUEST["user"]) || (strlen(trim($_REQUEST["user"])) == 0))){
			$tr = $_REQUEST["password"];
			$ur = $_REQUEST["user"];
			//defins the sql question.
			$sql = "SELECT * FROM COMMON WHERE (trust = :tmp1) AND (name = :tmp2)";
			//Make Query.
			$stm = $con->prepare($sql);
			$stm->execute(array(
				":tmp1" => $tr,
				":tmp2" => $ur
			));
			$test = $stm->rowCount();
			if($stm->rowCount() == 1){
				return true;
			}
			return false;
		}
		return false;
	}

	//funktion to delete data from database.
	function deletePost($con, $index, $tmpId){
		$PostId = $tmpId[$index];
		//Deffine sql query
		$sql = 'DELETE FROM textForPost WHERE id = :pid';
		//Make Query
		$stm = $con->prepare($sql);
		$stm->execute(array(
			":pid" => $PostId
		));
	}
?>
