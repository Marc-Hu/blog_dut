<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="shortcut icon" href="/Static/images/favicon.png">
    <link rel="stylesheet" type="text/css" href="/Static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/Static/css/main.css">
</head>
<body class="bg">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Blog DUT</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">Accueil</a></li>
        <?php
          echo $menu;
        ?>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        
        <?php
          if(!$connected){
            echo "
              <li><a href='/index.php?page=signin'>Se connecter</a></li>
              <li><a href='/index.php?page=signup'>S'enregistrer</a></li>
              ";
          }else{
            echo "<li><a href='#'>".$_SESSION['username']."</a></li>
              <li><a href='/index.php?page=logout'><div class='lienNavDeco'>Déconnecter</div></a></li>
            ";
          }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

  <div class="body-wrapper">