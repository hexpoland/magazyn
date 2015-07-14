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




if($a==updateuser){
	$numertel=$_POST['numertel'];
 	$nazwa=$_POST['nazwa'];
 	$adres=$_POST['adres'];
 	$email=$user[email];

	mysql_query("UPDATE users set nazwa_firmy='$nazwa', adres='$adres', telefon='$numertel' WHERE `email` = '$email'")or die(mysql_error());


	include("indeks.php");
	echo '
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <div class="container">
    <div class="alert alert-success">
  	<strong>Success!</strong>Zaktualizowano dane firmy!
	</div>
	</div>
	';
	#include("home.php");
 exit;
}


#Dodawanie do bazy

#sprawdzamy czy jestesmy dalej zalogowani
if($_SESSION['zalogowany']==true){
$company_data=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email' LIMIT 1"));
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


	<div class="panel-heading"><h4>Dane Firmy :</h4></div>
	<div class="panel panel-body">
	<form  action="ustawienia.php?a=updateuser" method="post" role="form">
  		<div class="form-group">
    <label for="numer">Nazwa Firmy:</label>
    <input type="text" class="form-control" name="nazwa" value="'.$company_data['nazwa_firmy'].'" placeholder="Nazwa Firmy">
  </div>
  <div class="form-group">
    <label for="nazwa">Numer telefonu:</label>
    <input type="text" class="form-control" name="numertel" value="'.$company_data['telefon'].'" placeholder="tel.">
  </div>
  <div class="form-group">
    <label for="opis">Adres:</label>
    <textarea type="text" class="form-control" name="adres" placeholder="Adres:">'.$company_data['adres'].'</textarea>
  </div>
  <div class="checkbox">
    <label><input name="powiadom" type="checkbox"> Powiadamiaj mnie o nowych częściach.</label>
  </div>
  <center><button type="reset" value="true" class="btn btn-sm btn-info">Wyczyść</button>
  <button type="submit" value="true" class="btn btn-sm btn-Success">Zmień</button></center>
</form>
</div>
</div>
</div>
</div>
</div>





';

}

?>
