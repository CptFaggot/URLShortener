<!DOCTYPE html>
<html>
<head>
<title>URL Shortener</title>
  <link type="text/css" rel="stylesheet" href="URLShortener/css/jquery.dataTables.css"/>
  <link type="text/css" rel="stylesheet" href="URLShortener/css/bootstrap-table.css"/>
  <link type="text/css" rel="stylesheet" href="URLShortener/css/tables.css"/>
  <script type="text/javascript" src="URLShortener/js/jquery.dataTables.js"></script>
</head>
<body>
<?php

    if(!isset($_SESSION)) {
      session_start();
    }
?>
    <div id="wrapper">
    	<div id="page-wrapper">
    		<div class="container-fluid">
        		<div class="panel panel-danger">
          			<div class="panel-heading">
           		 		<h2 class="panel-title">
              				<i class="fa fa-sort-amount-desc"></i> Abteilungs-URLs
            			</h2>
          			</div>
          			<div class="panel-body">
          			    <table id="table_dpt" data-toggle="table" class="table table-striped table-hover">
	      					<thead>
	          					<tr>
	          	  					<th id="NR" data-field="id">
	          	  						<div class="th-inner ">#NR</div>
	          	  					</th>
	          	  					<th data-field="firstname">
	          	  						<div class="th inner ">Besitzer</div>
	          	  					</th>
	          	  					<th data-field="comment">
	          	  						<div class="th-inner ">Name</div>
	          	  					</th>
	          	  					<th data-field="title">
	          	  						<div class="th-inner">Kommentar</div>
	          	  					</th>
	          	  					<th data-field="url">
	          	  						<div class="th-inner">URL</div>
	          	  					</th>
	                        		<th data-field="longurl">
	                          			<div class="th-inner">Link</div>
	                        		</th>
	          	  					<th data-field="hits">
	          	  						<div class="th-inner ">Hits</div>
	          	  					</th>
	          					</tr>
	          				</thead>
	          				<tbody>
	          					<?php getTableDataDpt(); ?>
	          				</tbody>
	          			</table>
          			</div>
          		</div>
          	</div>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {
	$("#table_dpt").DataTable();
});
</script>
</head>
</html>