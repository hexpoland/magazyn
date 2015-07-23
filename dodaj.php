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
	';
    $all_users=mysql_query("SELECT * FROM `users`");
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <magazyn@serwisrational.pl>' . "\r\n";
$message="
<html>
<head>
<style>
table, th, td {
}
th, td {
    font-size: 10px;
    padding: 5px;
}
th {
    background-color: #baad07;
    color: #ffffff;
    text-align: left;
}
</style>
</head>
<body><h2>MagazynCzesciZbytecznych</h2><p><hr></hr><br></p>
<h4>Użytkownik ".$email." dodał: </h4>
<table style=\"width:100%\">
  <tr>
    <th style=\"height:11px\">Numer</th>
    <th>Nazwa</th>
    <th>Opis</th>
  </tr>
  <tr>
    <td>".$numer."</td>
    <td>".$nazwa."</td>
    <td>".$opis."</td>
  </tr>
</table>
</body>
</html>
";

while($r2 = mysql_fetch_assoc($all_users)){

        mail($r2['email'],'MagazynCzesciZbytecznych',$message,$headers);






    }

    }
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
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span></span>
    <input type="text" class="form-control" name="numer" placeholder="Numer">
    </p>
  </div>
  <div class="form-group">
    <label for="nazwa">Nazwa:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-file"></span></span>
    <input type="text" class="form-control" name="nazwa" placeholder="Nazwa">
    </p>
  </div>
  <div class="form-group">
    <label for="opis">Opis:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
    <textarea type="text" class="form-control" name="opis" placeholder="Opis"></textarea>
    </p>
  </div>
  <div class="form-group">
    <label for="nazwa">Cena:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
    <input type="text" class="form-control" name="cena" placeholder="Cena" disabled>
    </p>
  </div>
  <div class="checkbox">
    <label><input checked="checked" readonly onclick="return false" name="nowa" type="checkbox" > Nowa</label>
  </div>
  <center><button type="reset" value="true" class="btn btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> Wyczyść</button>
  <button type="submit" value="true" class="btn btn btn-Success"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</button></center>
</form>
</div>
</div>
</div>
</div>
</div>





';

}

?>
