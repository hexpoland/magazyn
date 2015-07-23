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
    $haslo_form=$_POST['haslo_form'];
    $haslo_form_repete=$_POST['haslo_form_repete'];
    if($haslo_form!=""){
        if($haslo_form==$haslo_form_repete){
        $haslo_form=md5($haslo_form);

        mysql_query("UPDATE users set haslo='$haslo_form' WHERE `email` = '$email'")or die(mysql_error());
        $_SESSION['haslo']=$haslo_form;
        }else{
            include('indeks.php');

	echo '

    <div class="container">
    <div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Uwaga!</strong> Źle powtórzyłeś hasło!
	</div>
	</div>
	';
        exit();


        }

    }



	mysql_query("UPDATE users set nazwa_firmy='$nazwa', adres='$adres', telefon='$numertel' WHERE `email` = '$email'")or die(mysql_error());



	include("indeks.php");
	echo '

    <div class="container">
    <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  	<strong>Success!</strong> Zaktualizowano dane firmy!
	</div>
	</div>
	';


}


#Dodawanie do bazy

#sprawdzamy czy jestesmy dalej zalogowani
if($_SESSION['zalogowany']==true){
$company_data=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email' LIMIT 1"));
echo '
<link rel="stylesheet" href="css/bootstrap.css">
<html>

<body>
<div class="container">
<div class="row">

			<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-shadow">


	<div class="panel-heading"><h4>Dane Firmy :</h4></div>
	<div class="panel panel-body">
    <div class="row">

            <div class="col-md-3 col-sm-3 hidden-s">
              <figure style="float:left" class="thumbnail">
                <img class="img-responsive img-circle" src="img/avatar.jpg" style="max-height:180px;height:100px;">
                <figcaption class="text-center"></figcaption>
              </figure>
            </div>
            </div>
	<form  action="ustawienia.php?a=updateuser" method="post" role="form">
  		<div class="form-group">
    <label for="numer">Nazwa Firmy:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
    <input type="text" class="form-control" name="nazwa" value="'.$company_data['nazwa_firmy'].'" placeholder="Nazwa Firmy">
  </div></p>

  <div class="form-group">
    <label for="nazwa">Numer telefonu:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
    <input type="text" class="form-control" name="numertel" value="'.$company_data['telefon'].'" placeholder="tel.">
  </div></p>
  <div class="form-group">

    <label for="opis">Adres:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
    <textarea type="text" class="form-control" name="adres" placeholder="Adres:">'.$company_data['adres'].'</textarea>
  </div></p>
  <hr>
  <div class="form-group">
    <label for="nazwa">Nowe hasło:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
    <input type="text" class="form-control" name="haslo_form" value="" placeholder="haslo">
  </div></p>
  <div class="form-group">
    <label for="nazwa">Powtórz hasło:</label>
    <p class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
    <input type="text" class="form-control" name="haslo_form_repete" value="" placeholder="haslo">
  </div></p>
  <hr>



  <div class="checkbox">
    <label><input name="powiadom" type="checkbox"> Powiadamiaj mnie o nowych częściach.</label>
  </div>

  <center><button type="reset" value="true" class="btn btn btn-info"><span class="glyphicon glyphicon-remove-sign"></span> Anuluj</button>
  <button type="submit" value="true" class="btn btn btn-Success"><span class="glyphicon glyphicon-ok-sign"></span> Zmień</button></center>
</form>
</p>
</div>
</div>
</div>
</div>
</div>





';

}

?>
