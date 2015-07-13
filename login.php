<?php include("config.php"); ?>
<?php
$email = $_POST['email'];
$haslo = $_POST['haslo'];
$haslo = addslashes($haslo);
$email = addslashes($email);
$email = htmlspecialchars($email);
$zalogowany=false;
if ($_GET['email'] != '') { //jezeli ktos przez adres probuje kombinowac
exit;
}
if ($_GET['haslo'] != '') { //jezeli ktos przez adres probuje kombinowac
exit;
}

$haslo = md5($haslo); //szyfrowanie hasla


if (!$email OR empty($email)) {

include("index.php");
echo '
<meta charset="utf-8">
<div class=container>
<div class="alert alert-info">
Wypełnij pole z loginem!
</div>
</div>



';
exit;

}

if (!$haslo OR empty($haslo)) {

echo '<div class="alert alert-danger">Wypełnij pole z hasłem!</div>';
exit;
}
$istnick = mysql_fetch_array(mysql_query("SELECT * FROM `users` WHERE `email` = '$email' AND `haslo` = '$haslo'")); // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle
    if ($istnick[0] == 0) {

include("index.php");
echo '
<div class=container>
<div class="alert alert-info">
Logowanie nieudane. Sprawdź pisownię nicku oraz hasła.
</div>
</dvi>';
exit;
    }else {

$_SESSION['email'] = $email;
$_SESSION['haslo'] = $haslo;
$_SESSION['zalogowany']=true;
ob_start();
header("Location: indeks.php");
exit();
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</html>
