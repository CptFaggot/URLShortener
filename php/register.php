<!DOCTYPE html>
<html>
<head>
<title>URL Shortener</title>

    <link type='text/css' rel='stylesheet' href='URLShortener/css/register.css'/>
</head>

<body>
<?php
    if(!isset($_SESSION)) {
        session_start();
    }
?>
<div class="jumbotron">
    <div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="container">
        <div class="panel panel-info <?php if(isset($_SESSION['loginError'])) echo "panel-danger"?>">
            <div class="panel-heading">
                <div class="panel-title">Mitglied werden
                    <a id="signinlink" href="index.php?page=login" style="float: right;">Schon Mitglied ?</a>
                    <?php if(isset($_SESSION['loginError'])) echo "<h3 style='color: #d9534f;'>".$_SESSION['loginError']."</h3>" ;?>                    
                </div>
            </div>  
            <div class="panel-body">
                <form id="signupform" class="form-horizontal" role="form" action="index.php?page=sys.register" method="post">             
                    <div id="signupalert" style="display:none" class="alert alert-danger">
                        <p>Error:</p>
                        <span></span>
                    </div>                             
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">E-Mail</label>
                        <div class="col-md-9">
                            <input class="form-control" name="email" placeholder="Email" type="text" required>
                        </div>
                    </div>             
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Vorname</label>
                        <div class="col-md-9">
                            <input id="registerInputFirstname" class="form-control" name="firstname" placeholder="Vorname" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Nachname</label>
                        <div class="col-md-9">
                            <input id="registerInputLastname" class="form-control" name="lastname" placeholder="Nachname" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-md-3 control-label">Abteilung</label>
                        <div class="col-md-9">
                            <input class="form-control" name="department" placeholder="Abteilung" type="text" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login" class="col-md-3 control-label">Ihr Login:</label>
                        <div class="col-md-9">
                            <input class="form-control" id="registerLogin" type="text" placeholder="." disabled>
                            <input type ="hidden" id ="login_double" name ="login">
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Passwort</label>
                        <div class="col-md-9">
                            <input class="form-control" name="passwd" placeholder="Passwort" type="password" required>
                        </div>
                    </div>        
                    <div class="form-group">
                        <label for="passrepeat" class="col-md-3 control-label">Passwort wiederholen</label>
                        <div class="col-md-9">
                            <input class="form-control" name="passwd2" placeholder="Passwort wiederholen" type="password" required>
                        </div>
                    </div>
                    <div class="form-group">                                        
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info">
                                <i class="fa fa-check"></i> Mitglied werden
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>            
    </div>
</div>
</div>

<script type ="text/javascript">

(function($){
    var name = "";
    var nachname = "";

    $('#registerInputFirstname').on('input', function(){
        name = this.value;
        name = name.toLowerCase();
        $('#registerLogin').val(name +'.'+ nachname);
        $('#login_double').val(name +'.'+ nachname);
    })

    $('#registerInputLastname').on('input', function(){
        nachname = this.value;
        nachname = nachname.toLowerCase();
        $('#registerLogin').val(name +'.'+ nachname);
        $('#login_double').val(name +'.'+ nachname);
    })
    
})(jQuery);

</script>

</body>
</html>