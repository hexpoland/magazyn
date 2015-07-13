<?php
	  echo '<head>
    <meta charset="utf-8">
  </head>
<div class="container">';
	  include("config.php");
      if($_SESSION['zalogowany']==true){
      if($root=true){
      $sql = "DELETE FROM comment WHERE id=$_GET[cid]";
      mysql_query($sql);

      echo '
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		<strong>Sukces!</strong> Pomyślnie usunięto komentarz nr: '.$_GET[cid].'
		</div>';
    include("home.php");
}
}

?>
