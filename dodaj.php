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




if($a==addtobase){
	$numer=$_POST['numer'];
 	$nazwa=$_POST['nazwa'];
 	$opis=$_POST['opis'];

 	$nowa=$_POST['nowa'];
 	if($nowa==on){
 		$nowa=true;
 	}else $nowa=false;
 	$email=$user[email];
	if($numer!=NULL&&$nazwa!=NULL){

    mysql_query("INSERT INTO `czesci` (ID, Numer, Nazwa, Opis, Nowy, email) VALUES (NULL,'$numer','$nazwa','$opis','$nowa','$email')");
    $all_users=mysql_query("SELECT * FROM `users`");
    while($r2 = mysql_fetch_assoc($all_users)){
        echo 'test';
        echo 'wyslano maila do: '.$r2['email'].'z informacja ze uzytkownik: '.$email.'dodał czesc do magazynu: #NUMER:'.$numer.' #NAZWA: '.$nazwa.' ';


    }
	echo mysql_error();


	include("indeks.php");
	echo '
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <div class="container">
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Success!</strong>Dodano do bazy!
	</div>
	</div>
	';}
    else{
        include("indeks.php");
      echo '
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <div class="container">
    <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Uwaga!</strong>Wypelnij puste pola!
	</div>
	</div>

    ';}
    include("moje_czesci.php");
    exit();

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


	<div class="panel-heading"><h4>Dodaj część do bazy:</h4></div>
	<div class="panel panel-body">
	<form  action="dodaj.php?a=addtobase" method="post" role="form">
  		<div class="form-group">
    <label for="numer">Numer:</label>
    <input type="text" class="form-control" name="numer" placeholder="Numer">
  </div>
  <div class="form-group">
    <label for="nazwa">Nazwa:</label>
    <input type="text" class="form-control" name="nazwa" placeholder="Nazwa">
  </div>
  <div class="form-group">
    <label for="opis">Opis:</label>
    <textarea type="text" class="form-control" name="opis" placeholder="Opis"></textarea>
  </div>
  <div class="checkbox">
    <label><input checked="checked" readonly onclick="return false" name="nowa" type="checkbox" > Nowa</label>
  </div>
  <center><button type="reset" value="true" class="btn btn-sm btn-info">Wyczyść</button>
  <button type="submit" value="true" class="btn btn-sm btn-Success">Dodaj</button></center>
</form>
</div>
</div>
</div>
</div>
</div>





';

}

?>
