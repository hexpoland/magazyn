<?php
	  echo '<head>
    <meta charset="utf-8">
  </head>
<div class="container">';
	  include("config.php");
      if($_SESSION['zalogowany']==true){
        #sprawdzanie czy ktos nie kombinuje z adresem
        $check=mysql_fetch_array(mysql_query("SELECT email FROM czesci WHERE ID=$_GET[id]"));
        #jeżeli sie zgadza email zalogowanego z emailem usuwanej czesci to usuwaj!
        if($email==$check[email]){
      $sql = "DELETE FROM `czesci` WHERE ID=$_GET[id]";
      mysql_query($sql);
        mysql_query("ALTER TABLE `czesci` AUTO_INCREMENT = 1");

      echo '
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Sukces!</strong> Pomyślnie usunięto pozycje: '.$_GET[id].'
		</div>';
    include("moje_czesci.php");
  }else{ #jezeli nie wyswiwetl info !!!!!
     echo '
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Uwaga!</strong> Nie masz uprawnień do usunięcia tego rekordu!!!
    </div>';
    include("czesci.php");

  };

}

?>
