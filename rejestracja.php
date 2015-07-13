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

//$spr2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$email' LIMIT 1")); // czy user o takim emailu istnieje
//$pos = strpos($email, "@");


//jesli cos jest nie tak to blokuje rejestracje i wyswietla bledy
//jesli wszystko jest ok dodaje uzytkownika i wyswietla informacje
//$email = str_replace ( ' ','', $email );

$haslo = md5($haslo); //szyfrowanie hasla
if($correct<1){
mysql_query("INSERT INTO `users` (email, haslo) VALUES('$email','$haslo')") or die("Nie mogłem Cie zarejestrować!");

echo '<div class="alert alert-success">
  <strong>Success!</strong> Zostałeś zarejestrowny ! ' .$email.'
<br><button type="button" class="btn btn-info btn-xs"><a href="index.php">Logowanie</a></button></div>
';
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
      background: url(img/background.jpg) no-repeat center center fixed;
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

    h1 {
      font-family: Quicksand;
      font-weight: 400;
      font-size: 30px;
    }

    /* Override B3 .panel adding a subtly transparent background */
    .panel {
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

    <h1>MagazynCzesciZbytecznych</h1>
    <p></br></p>
    <h4>Rejestracja</h4>

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
<button type="submit" class="btn btn-info">Rejestracja</button>
</center>
</p>
</div>
</form>

</div>
</div>
</div>
</body>
</html>
