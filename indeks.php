
<?php include("config.php");
$email = $_SESSION['email'];
$haslo = $_SESSION['haslo'];
if($email=="wolaqu@poczta.onet.pl"){
$root=true;
$_SESSION['root']=$root;
}

    if ((empty($email)) AND (empty($haslo))) {
include("index.php");
echo '
<meta charset="utf-8">
<div class=container>
<div class="alert alert-info">Nie byłeś zalogowany albo zostałeś wylogowany
</div>
</div>
';


exit;
}

$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email' AND `haslo`='$haslo' LIMIT 1"));
    if (empty($user[id]) OR !isset($user[id])) {
echo '<br>Nieprawidłowe logowanie.<br>';
exit;
}
if($_SESSION['zalogowany']==true){
    mysql_query("SET NAMES latin1_swedish_ci");
$aktywna_strona=basename($_SERVER['REQUEST_URI'],".php");
$exist_user_info=mysql_query("SELECT `nazwa_firmy` FROM `users`");

if(!$exist_user_info){

mysql_query("ALTER TABLE users ADD COLUMN `nazwa_firmy` TEXT after `email`") or die (mysql_error());
mysql_query("ALTER TABLE users ADD COLUMN `adres` TEXT after `nazwa_firmy`") or die (mysql_error());
mysql_query("ALTER TABLE users ADD COLUMN `telefon` TEXT after `adres`") or die (mysql_error());
}

function navbaractive($strona) #funkcja do przerzucania aktywnego navbara
{
  $aktywna_strona=basename($_SERVER['REQUEST_URI'],".php");
  if($strona==$aktywna_strona){
     return "class=\"active\"";
  }

}
$wynik=mysql_query("SELECT * FROM users");
$parts=mysql_query("SELECT * FROM czesci");
$parts_counter=mysql_num_rows($parts);
echo '

<html>
<head>
    <meta charset="utf-8">
  </head>
<body style="background: #d6d6d6;">

<nav class="navbar navbar-default transparent navbar-fixed-top hr">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="indeks.php?id=0"><span class="text-info"><span class="label label-warning"><span class="glyphicon glyphicon-cog"></span> MagazynCzesciZbytecznych</span></span></a>
    </div>
    <div>
      <ul class="nav navbar-nav">

        <li '.navbaractive("indeks.php?id=1").'><a href="indeks.php?id=1"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li '.navbaractive("indeks.php?id=2").'><a href="indeks.php?id=2"><span class="glyphicon glyphicon-list"></span> Części <span class="badge">'.$parts_counter.'</span></a></li>
        <li '.navbaractive("indeks.php?id=3").'><a href="indeks.php?id=3"><span class="glyphicon glyphicon-user"></span> Moje Częsci</a></li>
        <li '.navbaractive("indeks.php?id=4").'><a href="indeks.php?id=4"><span class="glyphicon glyphicon-wrench"></span> Ustawienia</a></li>



        ';
        if($root){
          echo "<li ".navbaractive("indeks.php?id=5")."><a href=\"indeks.php?id=5\"><span class=\"glyphicon glyphicon-lock\"></span> Admin</a></li>";

        }

        echo '
        <li><td></td></li>
        <li><td></td></li>
        </div>
        <ul class="nav navbar-nav navbar-right">
        <form action="indeks.php" class="navbar-form navbar-left" role="search">
          <div class="form-group">
          <input type="text" class="form-control input-sm" name="szukaj" placeholder="Szukaj...">
          </div>
          <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
Szukaj</button>
        </form>


        <li><a href="wyloguj.php"><span class="glyphicon glyphicon-log-out"></span> Wyloguj</a></li>
        </ul>



      </ul>
    </div>
  </div>
</nav>
<br></br>
<br></br>

 <div class="container">
<div class="jumbotron">
    <div class="row">
    <h1><span class="glyphicon glyphicon-cog" style:"background-color:#FFFFF"></span>MagazynCzęściZbytecznych</h1>
    <p><div class="col-md-8"><h3><small>Witaj <kbd>'.$user[email].'</kbd>  w systemie wymiany częsci do urządzeń gastronomicznych.</small></h3>
    <form class="form-inline" role="form" action="indeks.php" method="get">
            <input type="text" class="form-control input-sm" name="szukaj" placeholder="Szukaj..." height="100">
            <button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Szukaj</button>

            </form></div>

        <div class="col-md-4">

                  <img src="img/imac.png" weidth="100" height="100" algin="left" class="pull-right" class="img-responsive"></div>


        </div>

    </div>

</div>
</div>
</body>
</html>
';



    if(isset($_POST["comment"])){
  date_default_timezone_set('UTC');
  $comment=$_POST['comment'];

  $date = date('Y-m-d H:i:s');

  if(!empty($comment)){
    mysql_query("INSERT INTO `comment` (user,message,Data) VALUES ('$user[email]','$comment','$date')") or die (mysql_error());
    $comment="";
  }


  ;


}


#sprawdzamy jaką strone zainkludowac
if(isset($_GET["a"])!="del"){
#szukanie
if(isset($_GET["szukaj"])!=0){
  $_SESSION['szukana']=$_GET["szukaj"];
  include("czesci.php");

}
#usuwanie komentarza przez roota
if(isset($_GET["c"])=="del"){
  if($root==true){
  include("usun_com.php");
 }else{
  echo '
      <div class=container>
      <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Uwaga!</strong>Nie jestes administratorem !
    </div></div>';
 }
}



#linki do stron
if (isset($_GET["id"])) {
    if($_GET["id"]=="0"){
      include("regulamin.php");

    }elseif ($_GET["id"] == "1") {
      include("home.php");

    } elseif ($_GET["id"] == "2")
    {
    	include("czesci.php");

    } elseif ($_GET["id"] == "3")
    {
      include("moje_czesci.php");

    }elseif ($_GET["id"] == "4")
    {
      include("ustawienia.php");


    }elseif ($_GET["id"] == "5")
    {
      include("admin_users.php");


    }
}#linki do stron
} elseif($_GET["a"]=="del"){ #usuwanie czesci
  include("usun.php");

} elseif ($_GET["a"]=="add") { #dodawanie czesci
  include("dodaj.php");

} elseif ($_GET["a"]=="edit") { #edytowanie czesci
  include("edit.php");

} elseif ($_GET["a"]=="del_user") { #edytowanie czesci
  include("usun_user.php");
}





}
?>

<!--#laduj style i skrypty java-->

<link rel="stylesheet" href="css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>

  $(function(){
    $('[rel="popover"]').popover({
        container: 'body',
        html: true,
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
            return clone;
        }
    }).click(function(e) {
        e.preventDefault();
    });

});

$(function(){
    $('[rel="tablepopover"]').popover({

        container: 'body',
        html: true,
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
            return clone;
        }
    }).click(function(e) {
        e.preventDefault();
    });
});



</script>



