<?php include("config.php");

$ip = $_SERVER['REMOTE_ADDR'];

$akcja = $_GET['akcja'];
$correct=0;
if ($akcja == wykonaj) {

$email = substr(addslashes(htmlspecialchars($_POST['email'])),0,60);
$haslo = substr(addslashes($_POST['haslo']),0,32);
$vhaslo = substr($_POST['vhaslo'],0,32);

if(empty($email)){
  echo '
<div class=container>
<div class="alert alert-warning">
  <strong>Uwaga!</strong> Wypełnij wszystkie pola!
</div></div>';
$correct=1;
}

//kilka sprawdzen co do nicku i maila
if($haslo!=$vhaslo){

echo '

<div class="alert alert-warning">
  <strong>Uwaga!</strong>Błędne hasło
</div>
';
$correct=1;

}
$exist=mysql_query("SELECT * FROM `users` WHERE email='$email'");
if(mysql_num_rows($exist)>=1){

echo '

<div class="alert alert-warning">
  <strong>Uwaga!</strong>Użytkownik o danym mailu juz istnieje
</div>
';
$correct=1;

}
//$spr2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$email' LIMIT 1")); // czy user o takim emailu istnieje
//$pos = strpos($email, "@");


//jesli cos jest nie tak to blokuje rejestracje i wyswietla bledy
//jesli wszystko jest ok dodaje uzytkownika i wyswietla informacje
//$email = str_replace ( ' ','', $email );

$haslo = md5($haslo); //szyfrowanie hasla
if($correct<1){
mysql_query("INSERT INTO `users` (email, haslo) VALUES('$email','$haslo')") or die("Nie mogłem Cie zarejestrować!");

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <magazynczescizbytecznych@serwisrational.pl>' . "\r\n";
$message="
<html>
<body><h1>MagazynCzesciZbytecznych</h1><p><hr></hr><br></p>
<h3>Użytkownik:  <i>".$email."</i> wpisał się do systemu.</h3><p><br></p>
<a href=\"http://www.magazyn.serwisrational.pl\">Idź!</a>
</body>
</html>
";

mail('wolaqu@poczta.onet.pl','MagazynCzesciZbytecznych',$message,$headers);
echo '<div class="alert alert-success">
  <strong>Brawo!</strong> Zostałeś zarejestrowny ! ' .$email.'
<br></div>';
include("index.php");
exit();

}}
?>

<!DOCTYPE html>
  <head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <meta charset="utf-8">

    <style>

    /* http://css-tricks.com/perfect-full-page-background-image/ */
    html {
      background: url(img/background.jpg)no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }

    body {
      padding-top: 100px;
      font-size: 16px;
      font-family: "Open Sans",serif;
      background: transparent;
    }

    .h1my {
      font-family: Quicksand;
      font-weight: 400;
      font-size: 30px;
    }

    /* Override B3 .panel adding a subtly transparent background */
    .panel {
        border-radius: 15px;
      background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 20px 10px 30px rgba(16, 16, 16, 0.65);
    }

    .margin-base-vertical {
      margin: 40px 0;
    }

  </style>

  </head>
  <html>
  <body>


  <div class="container">
  <div class="row">
  <div class="col-md-6 col-md-offset-3 panel panel-default">
    <center>
    <h1 class="h1my">MagazynCzesciZbytecznych</h1>
    <p></br></p>
    <h4>Rejestracja</h4>
      </center>
<form method="post" action="rejestracja.php?akcja=wykonaj" role="form">
<div class="form-group">
<label for="email">Email:</label>
<input maxlength="40" class="form-control" type="text" name="email" placeholder="jan@kowalski.pl">

<label for="haslo">Hasło:</label>
<input maxlength="32" class="form-control" type="password" name="haslo" placeholder="Hasło">
<label for="vhaslo">Powtórz hasło:</label>
<input maxlength="32" class="form-control" type="password" name="vhaslo" placeholder="Powtórz hasło">
<p><br>
<center>
<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-book"></span> Rejestracja</button>
<p><br></p>
<small class="text-muted">Coding by hex wolaqu@poczta.onet.pl</small>
</center>
</p>
</div>
</form>

</div>
</div>
</div>
</body>
</html>
