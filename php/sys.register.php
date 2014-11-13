
<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_POST)) {

        $_SESSION["loginError"] = "";
        
        $login = trim($_POST["login"]);
        $email = trim($_POST["email"]);
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $pass1 = trim($_POST["passwd"]);
        $pass2 = trim($_POST["passwd2"]);
        $department = trim($_POST["department"]);

        if ($pass1 != $pass2) {
            $_SESSION["loginError"] = "Passwörter stimmen nicht überein.";
        } elseif ($email == "" || $firstname == "" || $lastname == "" || $pass1 == "" || $pass2 == "") {
            $_SESSION["loginError"] = "Bitte alle Felder ausfüllen";
        } else {
            $pass1 = md5(md5($pass1));

            $con = mysql_connect('localhost', 'sec_user', 'pyramide') or die(mysql_error());
            $db = mysql_select_db('urls', $con) or die(mysql_error());
            $sql = mysql_query("SELECT * FROM user WHERE login = '".$login."'") or die(mysql_error());
            $rows = mysql_num_rows($sql);
            if ($rows >= 1) {
                $_SESSION["loginError"] = 'Der Login "'.$login.'" ist schon vergeben';
            } else {
                $sql = mysql_query("INSERT INTO user(login, email, firstname, lastname, department, password) VALUES ('".$login."', '".$email."', '".$firstname."', '".$lastname."', '".$department."', '".$pass1."')") or die(mysql_error());
                $_SESSION['userid'] = $row['id'];
                $_SESSION['email']  = $row['email'];        
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['department'] = $row['department'];
                $_SESSION['logged_in'] = true;

                header("Location: index.php?page=dashboard"); 
            }
        }
            if ($_SESSION['loginError'] != "") {
                header("Location: index.php?page=register");
            }
    }

?>