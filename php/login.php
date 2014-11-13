<!DOCTYPE html>
<html>
<head>
<title>URL Shortener</title>
    <link type='text/css' rel='stylesheet' href='URLShortener/css/login.css'/>
    <script type="text/javascript" src="URLShortener/js/bootstrap.js"></script>
</head>

<body>

<?php
	if (!isset($_SESSION)) {
		session_start();
	}

	if (isset($_SESSION['logged_in'])) {
		if($_SESSION['logged_in'] == true) {
		header("Location: index.php?page=dashboard");
		}
	} 

	if (!isset($_GET['page'])) {
		$_POST['page'] = "login";
	}
?>

<script type="text/javascript">

(function($){

	$("#loginSlider").carousel({
		interval : 1500;
		pause : false;
	})

	$(".left").click(function(){
		$("#loginSlider").carousel("prev");
	})

	$(".right").click(function(){
		$("#loginSlider").carousel("next");
	})

	$(".slide-one").click(function(){
		$("#loginSlider").carousel(0);
	})

	$(".slide-two").click(function(){
		$("#loginSlider").carousel(1);
	})

	$(".slide-three").click(function(){
		$("#loginSlider").carousel(2);
	})	

})(jQuery);

</script>

	<div class="jumbotron">
		<div class="container" id="welcomebox">
			<div class="row" id="background">
				<h1>ak tronic URLShortener</h1>
				<div class="col-md-8">
			    	<h2>URL-Shortening Platform</h2>
			    </div>
			    <div class="col-md-4">
			    	<?php   if (isset($_SESSION['wrongLogin'])) {
			    				if($_SESSION['wrongLogin'] == true) {
			    					echo "<h2 style='color: #d9534f !important'>Benutzername oder</br>Passwort Falsch</h2>";
			    				} else {
			    					echo "<h2>Login:</h2>";
			    				}
			    			} else {
			    				echo '<h2>Login:</h2>';
			    			}
			    	?>
			    </div>	
				<div class="col-md-8" id="TextBox">
    				<div id="loginSlider" class="carousel slide" data-interval="3000" data-ride="carousel">
        				<ol class="carousel-indicators">
            				<li id="slide-one" data-target="#loginSlider" data-slide-to="0" class="active"></li>
            				<li id="slide-two" data-target="#loginSlider" data-slide-to="1"></li>
            				<li id="slide-three" data-target="#loginSlider" data-slide-to="2"></li>
        				</ol>   
        				<div class="carousel-inner">
            				<div class="item active">
                				<h2>URLShortener</h2>            				
            					<div class ="carousel-caption">
                  					<h3>URL-Shortening Script</h3>
                  					<p>Ihre URLs kürzen war nie einfacher !</p>
                  				</div>	
            				</div>
            				<div class="item">
                				<h2>URL Plattform</h2>
                				<div class ="carousel-caption">
                  					<h3>Alles an einem Ort</h3>
                  					<p>Ihre URLs gesammelt in einer Datenbank</p>
                  				</div>	
            				</div>
            				<div class="item">
                				<h2>Statistik</h2>
                				<div class ="carousel-caption">
                  					<h3>Analyse Ihrer URLs</h3>
                  					<p>Sehen Sie, wer, wann, von wo auf Ihre URLs zugreift</p>
                  				</div>	
            				</div>
        				</div>
        				<a class="carousel-control left" href="#loginSlider" data-slide="prev">
            				<span class="fa fa-chevron-left fa-4x"></span>
        				</a>
        				<a class="carousel-control right" href="#loginSlider" data-slide="next">
            				<span class="fa fa-chevron-right fa-4x"></span>
        				</a>
    				</div>
				</div>

				<div class="col-md-4" id="input-div">
					<form id="loginform" class="form-horizontal" role="form" action="index.php?page=sys.login" method="post">
						<div class="input-group">
							<input type="text" class="form-control" name="input_name" placeholder="Vorname.Nachname" required>
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<div class="input-group">
							<input type="password" class="form-control" name="input_pw" placeholder="Passwort" required>
							<span class="input-group-addon" style="padding-left: 14px;">
								<i class="fa fa-lock"></i>
							</span>
						</div>
						<div class="form-group">
							<p>
								<button href="index.php?page=dashboard" type="submit" class="btn btn-primary btn-lg" role="button" id="btn_login" name="btn_login">
									<span class="fa fa-check"></span>
								</button>
								<a class="btn btn-primary btn-lg" role="button" id="btn_forgot">Passwort vergessen</a>
							</p>
							<p>
								<a href="index.php?page=register" class="btn btn-primary btn-lg" role="button" id="btn_register">Ich will Mitglied werden !</a>
							</p>
						<form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>


</html> 