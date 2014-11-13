<!DOCTYPE html>
<html>
<head>
<title>URL Shortener</title>

    <link type='text/css' rel='stylesheet' href='URLShortener/css/header.css'/> 
    <script type="text/javascript" src="URLShortener/js/bootstrap.js"></script>
</head>

<?php
  if(!isset($_SESSION)) {
  session_start();
  }
  $_SESSION["loginError"] = "";
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="index.php?page=dashboard">ak tronic URLShortener</a>
  </div>
  <ul class="nav navbar-right top-nav">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user"></i><?php print(" ".$_SESSION['firstname']." ".$_SESSION['lastname'])?>
        <b class="caret"></b>
      </a>
      <ul class="dropdown-menu" role="menu">
        <li role="presentation">
          <a role="menuitem" tabindex="-1" href="#">
            <i class="fa fa-user"></i> Profil
          </a>
        </li>
        <li role="presentation">
          <a role="menuitem" tabindex="-1" href"#">
            <i class="fa fa-cog"></i> Einstellungen
          </a>
        </li>
        <li role="presentation" class="divider"></li>
        <li role="presentation">
          <a role="menuitem" tabindex="-1" href="index.php?page=logout" style="padding-left: 17px;">
            <i class="fa fa-fw fa-power-off"></i> Logout
          </a>
        </li>
      </ul>
    </li>    
  </ul>
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav hidden-xs" id="sidenav">
      <li>
        <a href="index.php?page=dashboard"><i class="fa fa-fw fa-dashboard"></i> Übersicht</a>
      </li>
      <li>
        <a href="index.php?page=statistik"><i class="fa fa-fw fa-bar-chart-o"></i> Statistik</a>
      </li>
      <li>
        <a href="index.php?page=URLs"><i class="fa fa-fw fa-table"></i> Meine URLs</a>
      </li>
      <?php departmentMenu() ?>
      <li>
        <a href="index.php?page=logout"><i class="fa fa-fw fa-edit"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

<script>
  $(function() {    
    $('ul.nav > li.dropdown').hover(function() {
      $('ul.dropdown-menu', this).stop(true, false).slideDown('slow');
      $(this).addClass('open')
    });
    }, function() {
      $('ul.dropdown-menu', this).stop(true, false).slideUp('fast');
      $(this).removeClass('open');
    });

  $(function() {
    $('#sidenav > li').hover(function() {
      $(this).toggle('slide', {direction: 'left'}, 1000);
      });
    });
</script>