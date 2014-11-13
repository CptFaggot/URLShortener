<?php

	function getTableData() {	
		if(!isset($_SESSION)) {
  			session_start();
		} 
			
		$con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
		$db = mysql_select_db('urls', $con) or die(mysql_error());
		$sql = mysql_query("SELECT * FROM urldata WHERE user_id = '".$_SESSION['userid']."'");
		$rows = mysql_num_rows($sql);

		if($rows != 0) {
			while ($row = mysql_fetch_assoc($sql)) {

				$original = $row['longurl'];	
				$parts = parse_url($original);
				if (isset($parts['host'])) {
					$longurl = $parts['host'];
				} else {
					$longurl = $original;
				}
				$longurl = str_replace("www.", '', $longurl);



			  echo "<tr>
			  			<td><div class='td-inner'>".$row['id']."</div></td>
						<td><div class='td-inner'>".$row['title']."</div></td>			  			
						<td><div class='td-inner'>".$row['comment']."</div></td>
						<td><div class='td-inner'><a href=index.php?page=urlinfo&id=".$row['id'].">".$row['shorturl']."</a></div></td>
						<td><div class='td-inner'><a target='_blank' href=".$row['longurl'].">".$longurl."</a></div></td>
						<td><div class='td-inner'>".$row['hits']."</div></td>
					</tr>";
			}
		} else {
			echo "<tr><td><div class='td-inner'>Keine Daten gefunden.</div></td></tr>";
		}	
	}

	function getTableDataDpt() {	
		if(!isset($_SESSION)) {
  			session_start();
		} 
			
		$con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
		$db = mysql_select_db('urls', $con) or die(mysql_error());
		$sql = mysql_query("SELECT * FROM urldata WHERE user_id = '".$_SESSION['userid']."'");
		$rows = mysql_num_rows($sql);

		if($rows != 0) {
			$sql = mysql_query("SELECT urldata.id, user.firstname, user.lastname, title, comment, shorturl, longurl, hits FROM urldata LEFT JOIN user
								ON urldata.user_id = user.id
								WHERE user.department = '".$_SESSION['department']."'");
			while ($row = mysql_fetch_assoc($sql)) {

				$original = $row['longurl'];	
				$parts = parse_url($original);
				if (isset($parts['host'])) {
					$longurl = $parts['host'];
				} else {
					$longurl = $original;
				}
				$longurl = str_replace("www.", '', $longurl);

			  echo "<tr>
			  			<td><div class='td-inner'>".$row['id']."</div></td>
			  			<td><div class='td-inner'>".$row['firstname']." ".$row['lastname']."</div></td>
						<td><div class='td-inner'>".$row['title']."</div></td>			  			
						<td><div class='td-inner'>".$row['comment']."</div></td>
						<td><div class='td-inner'><a href=index.php?page=urlinfo&id=".$row['id'].">".$row['shorturl']."</a></div></td>
						<td><div class='td-inner'><a href=".$row['longurl'].">".$longurl."</a></div></td>
						<td><div class='td-inner'>".$row['hits']."</div></td>
					</tr>";
			}
		} else {
			echo "<tr><td class='dataTables_empty' valign='top' colspan='7'>Keine Daten vorhanden bisher</td></tr>";
		}	
	}

?>