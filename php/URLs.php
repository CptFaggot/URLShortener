
<!DOCTYPE HTML>
<html>

<head>
<title>Meine URLs</title>
  <link type="text/css" rel="stylesheet" href="URLShortener/css/jquery.dataTables.css"/>
	<link type="text/css" rel="stylesheet" href="URLShortener/css/bootstrap-table.css"/>
  <link type="text/css" rel="stylesheet" href="URLShortener/css/tables.css"/>
  <script type="text/javascript" src="URLShortener/js/jquery.dataTables.js"></script>

</head>

<?php
if(!isset($_SESSION)) {
  session_start();
} 
?>

<body>

<div id="wrapper">
    <div id="page-wrapper">
    	<div class="container-fluid">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h2 class="panel-title">
              <i class="fa fa-sort-amount-desc"></i> URL kürzen
            </h2>
          </div>
          <div class="panel-body">
            <div class="col-md-2">
              <div class="legend">
                <p>Hier können Sie Ihre URLs kürzen</p>
                <ol>
                  <li>
                    <p class="info">Lange URL: Kopieren Sie hier Ihre lange Url rein</p>
                  </li>
                  <li>
                    <p class="info">Überschrift: Geben Sie Ihrer URL zur Wiedererkennung oder Suche einen Namen</p>
                  </li>
                  <li>
                    <p class="info">Kommentar: Kommentare dienen zur weiteren Erkennung der URLs, können aber auch gesucht werden</p>
                  </li>
                </ol>
              </div>
            </div>
            <div id="URLFormInput" class="col-md-10 col-xs-12">
              <form id="URLForm" class="form-horizontal" role="form" action="index.php?page=sys.urls" method="post">             
                <div id="URLalert" style="display:none" class="alert alert-danger">
                  <p>Error:</p>
                  <span></span>
                </div>                             
                <div class="form-group">
                  <label for="longurl" class="col-md-2 control-label">Lange URL</label>
                  <div class="col-md-9">
                    <input class="form-control" name="longurl" placeholder="http://" type="text" required>
                  </div>
                </div>             
                <div class="form-group">
                  <label for="title" class="col-md-2 control-label">Überschrift</label>
                  <div class="col-md-9">
                    <input id="urlInputTitle" maxlength="18" class="form-control" name="title" placeholder="Überschrift" type="text" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="comment" class="col-md-2 control-label">Kommentar</label>
                  <div class="col-md-9">
                    <input id="urlInputComment" class="form-control" name="comment" placeholder="Kommentar" type="text">
                  </div>
                </div>
                  <div class="form-group">
                    <div class="col-md-offset-9 col-md-2">          
                      <button id="btn-url" style="width: 100%;"type="submit" class="btn btn-info">
                        <i class="fa fa-check"></i> URL kürzen
                      </button>
                    </div>
                  </div>  
                </form>                             
              </div> 
            </div>            
          </div>    
    		<div class="panel panel-primary">
    			<div class="panel-heading">
    				<h2 class="panel-title">
    					<i class="fa fa-table"></i> Meine URLs
    				</h2>
    			</div>
    			<div class="panel-body">		
      			<table id="table" data-toggle="table" class="table table-striped table-hover">
      				<thead>
          			<tr>
          	  		<th id="NR" data-field="id">
          	  			<div class="th-inner ">#NR</div>
          	  		</th>
          	  		<th data-field="comment">
          	  			<div class="th-inner ">Name</div>
          	  		</th>
          	  		<th data-field="title">
          	  			<div class="th-inner">Kommentar</div>
          	  		</th>
          	  		<th data-field="url">
          	  			<div class="th-inner">ShortURL</div>
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
            			<?php getTableData(); ?>
            	  </tbody> 	
            	</table>
            </div>
          </div>
        </div>  			  
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
    $('#table').DataTable();

    $('.row').hover(function() {
      $(this).addClass('hovered');
      var id = $(this).children(":first").text();
        console.log(id);
    }, function() {
      $(this).removeClass('hovered');
    });
});
</script>
</body>

</html>