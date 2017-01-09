<?php
	//destroy the session on adminPage.php
	session_destroy();
	//go to first page
	header("Location: index.php");
	//kill current page.
	die();
?>