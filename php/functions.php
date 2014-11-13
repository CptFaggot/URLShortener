<?php

	$con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
	$db = mysql_select_db('urls', $con) or die(mysql_error());

	if(!isset($_SESSION)) {
		session_start();
	}

	function isManager() {

		$sql = mysql_query("SELECT manager FROM user WHERE id = '".$_SESSION['userid']."'");
		$manager = mysql_fetch_assoc($sql);

		if ($manager['manager'] == 1) {
			return true;
		} else {
			return false;
		}
	}

	function departmentMenu() {
		if(isManager() == true) {
			echo "<li>
       				<a href='index.php?page=department'>
       				<i class='fa fa-fw fa-suitcase'></i> 
       				Abteilungs-URLs</a>
      			  </li>";
		}
	}

	function getTop5URLs() {
		$date = date("Y-m-d");
		$date_str = str_replace($date, '-', '/');
		$date1 = date("Y-m-d", strtotime("- 6 days"));

 		$sql = mysql_query("SELECT *, SUM(count) AS total FROM hits_by_time LEFT JOIN urldata 
 							ON hits_by_time.url_id = urldata.id 
 							WHERE urldata.user_id = '".$_SESSION['userid']."'
 							AND hits_by_time.day > '".$date1."'
 							GROUP BY hits_by_time.url_id
 							ORDER BY total DESC LIMIT 5");
 			$i = 0;
 			$return = array();

 			if (!$sql) {
 				$Error = "Keine Werte vorhanden";
 				die($Error);
 			} else {
 				while ($val = mysql_fetch_assoc($sql)) {
 					$return[$i] = $val;
 					$i ++;
 				}
 				return $return;
 			}
	}

	function printTop5URLs() {
		$Top5 = getTop5URLs();

		$i = 0;
		while (isset($Top5[$i])) {
			$a = $i + 1;
			print("<li>
				    <span class='label label-default' id='URL".$a."'>".$Top5[$i]['title']."</span>
				    <span class='label label-default small hits' id='URL".$a."'>".$Top5[$i]['total']."</span>
				    <span class='label label-default small chevron' id='URL".$a."'><a href='".$Top5[$i]['shorturl']."'><i class='fa fa-chevron-circle-right'></i></a></span>
				   </li>");
			$i ++;
		}
	}

	function getTop5URLsMorris() {
		$sql = mysql_query("SELECT * , SUM(count) AS total FROM hits_by_time LEFT JOIN urldata
 							ON hits_by_time.url_id = urldata.id 
 							WHERE urldata.user_id = '".$_SESSION['userid']."'
 							GROUP BY hits_by_time.url_id
 							ORDER BY total DESC LIMIT 5");

 		while ($val = mysql_fetch_array($sql)) {
 				$Top5[$val['url_id']] = $val['url_id'];
 		}

 		return $Top5;
	}

	function getTop5URLsMorrisByDate() {
		$results = getTop5URLsMorris();
		foreach ($results as $result) {
			$sql = mysql_query("SELECT * FROM hits_by_time LEFT JOIN urldata
								ON hits_by_time.url_id = '".$result."'
								WHERE urldata.user_id = '".$_SESSION['userid']."'
								ORDER BY hits_by_time.day DESC
								");
			while ($val = mysql_fetch_assoc($sql)) {
				$return[$result][$val['day']] = $val['count'];	
			}

		}
		return $return;
	}

	function printTop5URLsMorris() {
		$Top5 = getTop5URLsMorrisByDate();
		$date = date("Y-m-d");
		$date_str = str_replace($date, '-', '/');
		$date = date("Y-m-d", strtotime("- 6 days"));

		$i = 0;

		while ($key = current($Top5)){
			$key = key($Top5);
			$index[$i] = $key;
			next($Top5);
			$i++;
		}
		error_reporting(0);
		for ($x = 0; $x < 7; $x ++) {

			$date_str = str_replace($date, '-', '/');
			$date1 = date("Y-m-d", strtotime("+ ".$x." days", strtotime($date)));	

			if (isset($Top5[$index[0]])) {
				if (array_key_exists($date1, $Top5[$index[0]])) {
					print("{date: '".$date1."', a:".$Top5[$index[0]][$date1]);
				} else {
					print("{date: '".$date1."', a: 0");
				}
			}

			if (isset($Top5[$index[1]])) {
				if (array_key_exists($date1, $Top5[$index[1]])) {
					print(", b:".$Top5[$index[1]][$date1]);
			
				} else {
					print(", b: 0");
				}
			}

			if (isset($Top5[$index[2]])) {
				if (array_key_exists($date1, $Top5[$index[2]])) {
					print(", c:".$Top5[$index[2]][$date1]);
			
				} else {
					print(", c: 0");
				}
			}
			
			if (isset($Top5[$index[3]])) {
				if (array_key_exists($date1, $Top5[$index[3]])) {
					print(", d:".$Top5[$index[3]][$date1]);
			
				} else {
					print(", d: 0");
				}
			}

			if (isset($Top5[$index[4]])) {
				if (array_key_exists($date1, $Top5[$index[4]])) {
					print(", e:".$Top5[$index[4]][$date1]);
			
				} else {
					print(", e: 0");
				}
			}

				print("},");		
		}
	}

	function printURLInfoMorris($id) {

		$sql = mysql_query("SELECT * FROM hits_by_time
							WHERE url_id = '".$id."'
							GROUP BY day
							ORDER BY day ASC
							");
		$return = array();

		while ($val = mysql_fetch_assoc($sql)) {
			$return[$val['day']] = $val['count'];
		}

		$date = date("Y-m-d");
		$date_str = str_replace($date, '-', '/');
		$date = date("Y-m-d", strtotime("- 6 days"));

		for ($x = 0; $x < 7; $x ++) {
			$date_str = str_replace($date, '-', '/');
			$date1 = date("Y-m-d", strtotime("+ ".$x." days", strtotime($date)));

			if ($x < 6) {
				if(!isset($return[$date1])) {
					print("{date: '".$date1."', a: 0},");
				} else {
					print("{date: '".$date1."', a: ".$return[$date1]."},");
				}
			} else {
				if(!isset($return[$date1])) {
					print("{date: '".$date1."', a: 0}");
				} else {
					print("{date: '".$date1."', a: ".$return[$date1]."}");
				}			
			}
		}
	}
		
?>