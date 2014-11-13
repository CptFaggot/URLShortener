<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}

	$con = mysql_connect('localhost', 'sec_user','pyramide');
	$db = mysql_select_db('urls', $con);

	if(isset($_POST)) {
		$title = trim($_POST['title']);
		$comment = trim($_POST['comment']);
		$longURL = trim($_POST['longurl']);


		$row = 1;
		while($row == 1) {
			$rand = rand(100000, 999999);
			$shortURL = base_convert($rand, 32, 36);
			$sql = mysql_query("SELECT * FROM urldata WHERE shorturl = '".$shortURL."'");
			$row = mysql_num_rows($sql);	
		}

		$userid = $_SESSION['userid'];

		$sql = mysql_query("INSERT INTO urldata(user_id, title, comment, shorturl, longurl, created_day, created_time) VALUES (
			'".$userid."',
		 	'".$title."', 
		 	'".$comment."', 
		 	'".$shortURL."', 
		    '".$longURL."',
		    '".date("Y-m-d")."',
		    '".date("H:i:s")."'
		    )");
	}

header("Location: index.php?page=URLs");
?>