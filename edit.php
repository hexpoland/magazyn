<?php include("config.php");
$email = $_SESSION['email'];
$haslo = $_SESSION['haslo'];
    if ((empty($email)) AND (empty($haslo))) {
echo '<br>Nie byłeś zalogowany albo zostałeś wylogowany<br><a href="index.php">Strona Główna</a><br>';
exit;
}
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email' AND `haslo`='$haslo' LIMIT 1"));
    if (empty($user[id]) OR !isset($user[id])) {
echo '<br>Nieprawidłowe logowanie.<br>';
exit;
}


#Dodawanie do bazy
$a=$_GET['a'];




if($a==edit){

  $edit=mysql_query("SELECT * FROM `czesci` WHERE ID='$_GET[id]'");
  echo mysql_error();
 	$wyniki = mysql_fetch_row($edit);
  $ida=$wyniki[0];
  $numer=$wyniki[1];
  $nazwa=$wyniki[2];
 	$opis=$wyniki[3];

}

if($_GET['id']=="submit"){

  $id_post=$_POST[ID];
  $numer=$_POST[numer];
  $nazwa=$_POST[nazwa];
  $opis=$_POST[opis];


mysql_query("UPDATE `czesci` SET numer='$numer',nazwa='$nazwa',opis='$opis',nowy=true WHERE ID='$id_post' ")or die("Nie udalo sie zmienic rekordu!");

include("indeks.php");
echo $wyniki[0];
echo '
<div class="container">
    <div class="alert alert-success">
    <strong>Sukces!</strong>Zaktualizowano pozycje w bazie!
  </div>
  </div>


';
include("moje_czesci.php");

exit;

}


#Dodawanie do bazy

#sprawdzamy czy jestesmy dalej zalogowani
if($_SESSION['zalogowany']==true){
echo '
<link rel="stylesheet" href="css/bootstrap.min.css">
<html>
<head>
    <meta charset="utf-8">
  </head>
<body>
<div class="container">
<div class="row">

			<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-shadow">


	<div class="panel-heading"><h4>Edytuj:</h4></div>
	<div class="panel panel-body">
	<form  action="edit.php?id=submit" method="post" role="form">
  <div class="form-group">
    <label for="numer">ID:</label>
    <input type="text" class="form-control" name="ID" placeholder="Numer" value="'.$ida.'" readonly>
  </div>
  		<div class="form-group">
    <label for="numer">Numer:</label>
    <input type="text" class="form-control" name="numer" placeholder="Numer" value="'.$numer.'">
  </div>
  <div class="form-group">
    <label for="nazwa">Nazwa:</label>
    <input type="text" class="form-control" name="nazwa" placeholder="Nazwa" value="'.$nazwa.'">
  </div>
  <div class="form-group">
    <label for="opis">Opis:</label>
    <textarea type="text" class="form-control" name="opis" placeholder="Opis">'.$opis.'</textarea>
  </div>
  <div class="checkbox">
    <label><input name="nowa" type="checkbox"> Nowa</label>
  </div>
  <center><button type="reset" value="true" class="btn btn-sm btn-info">Wyczyść</button>
  <button type="submit" value="true" class="btn btn-sm btn-Success" id="submit">Zapisz</button></center>
</form>
</div>
</div>
</div>
</div>
</div>





';

}

?>
