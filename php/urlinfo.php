<?php

	if(!isset($_SESSION)) {
		session_start();
	}
	function printURLInfo() {
		if(isset($_GET['id'])) {
			$con = mysql_connect('localhost', 'sec_user', 'pyramide');
			$db = mysql_select_db('urls', $con);

			$id = $_GET['id'];

			$sql = mysql_query("SELECT * FROM urldata
								WHERE id = '".$id."'
								");
			$row = mysql_num_rows($sql);

			if($row !== 1) {
				echo "URL existiert nicht";
			} else {
				$sql = mysql_query("SELECT * FROM urldata
									WHERE id = '".$id."'
									AND user_id = '".$_SESSION['userid']."'
									");
				$row = mysql_num_rows($sql);

				if ($_SESSION['isManager'] == 1) {
					$row = 1;
				}

				if ($row !== 1) {
					echo "Sie haben keinen Zugriff auf diese URL";
				} else {
					$sql = mysql_query("SELECT * FROM urldata LEFT JOIN browserhits
										ON urldata.id = '".$id."'
										WHERE urldata.user_id = '".$_SESSION['userid']."'
										AND browserhits.url_id = urldata.id
										OR '".$_SESSION['isManager']."' = 1										
										");

					$val = mysql_fetch_assoc($sql);
					$return = $val;

					$sql = mysql_query("SELECT max(day) AS last_visit_day FROM browserhits
							WHERE url_id = '".$id."'
							");

					$val = mysql_fetch_assoc($sql);
					$return['last_visit_day'] = $val['last_visit_day'];

					$sql = mysql_query("SELECT max(time) AS last_visit_time FROM browserhits
							WHERE url_id = '".$id."'
							AND day = '".$val['last_visit_day']."'
							");

					$val = mysql_fetch_assoc($sql);
					$return['last_visit_time'] = $val['last_visit_time'];
					if ($return['comment'] == '') {
						$return['comment'] = '-Kein Eintrag-';
					}
					print(" <ul id='list-group-values' class='list-group'>
								<li class ='list-group-item'>".$return['title']."</li>
								<li class ='list-group-item'>".$return['comment']."</li>
								<li class ='list-group-item'>".$return['shorturl']."</li>
								<li class ='list-group-item'><a target='_blank' href='".$return['longurl']."'>".$return['longurl']."</a></li>
								<li class ='list-group-item'>".$return['created_day']."</li>
								<li class ='list-group-item'>".$return['last_visit_day']." ".$return['last_visit_time']."		
						    </ul>");
				}
			}

		} else {
			echo "Fehler: Keine URL gesetzt";
		}
	}

	function printURLInfoReturn($input) {
		$id = $_GET['id'];

		$sql = mysql_query("SELECT * FROM urldata
				 WHERE id = '".$id."'
				 AND user_id = '".$_SESSION['userid']."'
				 OR '".$_SESSION['isManager']."' = 1
				 ");

		$val = mysql_fetch_assoc($sql);

		return $val[$input];
	}	


?>
<head>
	<link rel="stylesheet" type="text/css" href="URLShortener/css/urlinfo.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="URLShortener/morris/morris.min.js"></script>
    <script src="URLShortener/morris/morris.css"></script>	
</head>
<body>
	<div id="wrapper">
  		<div id="page-wrapper">
    		<div class="container-fluid">
      			<div class="panel panel-primary">
        			<div class="panel-heading">
			            <h2 class="panel-title">
            				<i class="fa fa-angle-double-right"></i> <?php print(printURLInfoReturn('title')) ?>
            				<i class="fa fa-angle-right"></i> <?php print(printURLInfoReturn('shorturl')) ?>
          				</h2>  
        			</div>
        			<div class="panel-body">
        				<div id="list-group-container" class="col-md-2">
        					<div class="legend">
        						<ul id ="list-group" class='list-group'>
        							<li class='list-group-item'>Name</li>
        							<li class='list-group-item'>Kommentar</li>
        							<li class='list-group-item'>ShortURL</li>
        							<li class='list-group-item'>Lange URL</li>        							
        							<li class='list-group-item'>Erstellt</li>
        							<li class='list-group-item'>Zuletzt Besucht</li>        							
        						</ul>
        					</div>
        				</div>
        				<div id="list-group-container-values" class="col-md-4">
        					<div class="legend">
        						<?php printURLInfo() ?>
        					</div>	
        				</div>
        				<div id="urlInfoMorris" class="col-md-6">
			              <div class="flot-areachart">
			                <div id="areaChart">
			                  <script type="text/javascript">
			                    Morris.Line({
			                    element: 'areaChart',
			                    data: [
			                      <?php printURLInfoMorris($_GET['id']) ?>
			                    ],
			                    xkey: 'date',
			                    ykeys: ['a'],
			                    xLabelFormat: function(date) {
			                    if (date.getDate() < 10) {
			                      return '0' + date.getDate() + '-' + (date.getMonth() + 1);
			                    } else {
			                      return date.getDate() + '-' + (date.getMonth() + 1);
			                      }
			                    },
			                    xLabels:'day',
			                    behaveLikeLine: true,
			                    xLabelAngle: 45,
			                    labels: ['URL 1'],
			                    lineColors: ["#E66000"],
			                    dateFormat: function (date) {
			                      var f = new Date(date);
			                      return f.getDate() + '-' + (f.getMonth() + 1);
			                    },  
			                    hideHover: true,
			                    hoverCallback: function (index, options) {
			                    var row = options.data[index];  

			                    return '<div class="hover-title">' + row.date + '</div><b style="color: ' + options.lineColors[0] + '">' + row.a + ' </b><span>Hits</span></br>'

			                    }
			                  });
			                  </script>
			                </div>
			              </div>        					
        				</div>
        			</div>	
        		</div>
        	</div>
        </div>		
    </div>
</div>    
    <script>

    </script>
</body>