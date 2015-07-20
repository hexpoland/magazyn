<?php
	  echo '<head>
    <meta charset="utf-8">
  </head>
<div class="container">';
	  include("config.php");
      if($_SESSION['zalogowany']==true&&$_SESSION['root']==true){
      $select_user=mysql_query("SELECT * FROM `users` WHERE id=$_GET[id]");
      $sql = "DELETE FROM `users` WHERE id=$_GET[id]";
        $sql1="DELETE * FROM `czesci` WHERE email=$select_user[email] ";
        mysql_query($sql);
        mysql_query($sql1);
        mysql_query("ALTER TABLE `users` AUTO_INCREMENT = 1");

      echo '
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Sukces!</strong> Pomyślnie usunięto pozycje: '.$_GET[id].'</div>';
    include("admin_users.php");
  }else{ #jezeli nie wyswiwetl info !!!!!
     echo '
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Uwaga!</strong> Nie masz uprawnień do usunięcia tego rekordu!!!
    </div>';
    include("czesci.php");

  };


?>
