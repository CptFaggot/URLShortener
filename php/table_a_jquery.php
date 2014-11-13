<?php
		$a_id = $_POST['a_id'];

		$sql = mysql_query("SELECT longurl FROM urldata
							WHERE shorturl = '".$a_id."'") or die(mysql_error());
		$return = mysql_fetch_assoc($sql);
		print_r($return);
?>