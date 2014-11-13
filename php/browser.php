<?php

			//mysql constants
	$con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
    $db = mysql_select_db('urls', $con) or die(mysql_error());

			// Return browser information
function getBrowser()
{
    $u_agent = isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'';
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= $ub ="";

    	//First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    	// Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/trident/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    	// finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

   	    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= isset($matches['version'][1])?$matches['version'][1]:'';
        }
    }
    else {
        $version= $matches['version'][0];
    }

    	// check if we have a number
    if ($version==null || $version=="") {
        $version="?";
    }

    return array(
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
    );
}

		// any 'hits' data available ?
	function check_for_browser_data() {
		if    (browser_hits('Mozilla Firefox') == 0
            && browser_hits('Google Chrome') == 0
            && browser_hits('Internet Explorer') == 0
            && browser_hits('Opera') == 0
            && browser_hits('Apple Safari') == 0
            && browser_hits('Netscape') == 0
            && browser_hits('Unknown') == 0) {
            return false;
    	} else {
    		return true;
    	}
	}


  		//how often hit by $browser ?
 	function browser_hits($browser) {
 		$sql = mysql_query("SELECT * FROM urldata LEFT JOIN browserhits 
 							ON browserhits.url_id = urldata.id WHERE urldata.user_id = 
 							'".$_SESSION['userid']."' AND browserhits.browser = '".$browser."'");
 		$row = mysql_num_rows($sql);

 		return $row;
 	}
 		// how often hit by $platform ?
 	function platform_hits($platform) {
 		$sql = mysql_query("SELECT * FROM urldata LEFT JOIN browserhits 
 							ON browserhits.url_id = urldata.id WHERE urldata.user_id = 
 							'".$_SESSION['userid']."' AND browserhits.platform = '".$platform."'");
 		$row = mysql_num_rows($sql);

 		return $row;
 	}   
 		// percentage Value for spans on statistik.php
 	function percentage($type, $input) {
 		$all_hits = mysql_query("SELECT * FROM browserhits") or die(mysql_error());
 		$int_all_hits = mysql_num_rows($all_hits);

 		if($type == "browser") {
 			$sql = mysql_query("SELECT * FROM browserhits WHERE browser = '".$input."'");
 			$row = mysql_num_rows($sql);
 		} else if($type == "platform") {
 			$sql = mysql_query("SELECT * FROM browserhits WHERE platform = '".$input."'");
 			$row = mysql_num_rows($sql);			
 		} else {
 			echo "Type in percentage() is illegal";
 		}

 		if($row && $int_all_hits > 0) {
 			$return = round($row / $int_all_hits, 4) * 100;
 		 	echo $return." %"; 			
		} else {
			echo "0 %";
		}

 	}

?>