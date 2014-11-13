<?php
session_start();
	if (isset($_POST)) {


		$username = trim($_POST['input_name']);
		$password = trim($_POST['input_pw']);

		$con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
		$db = mysql_select_db('urls', $con) or die(mysql_error());
		$sql = mysql_query("SELECT * FROM user WHERE login = '".$username."' AND password = '".md5(md5($password))."'") or die(mysql_error());
		$row = mysql_fetch_array($sql);

		if(!$row) {
			$_SESSION['wrongLogin'] = true;
			header('Location: index.php?page=login');
		} else {
			$_SESSION['userid'] = $row['id'];
			$_SESSION['email']	= $row['email'];		
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			$_SESSION['department'] = $row['department'];
			$_SESSION['isManager'] = $row['manager'];
			$_SESSION['logged_in'] = true;

			header("Location: index.php?page=dashboard");
		}
	}
?>