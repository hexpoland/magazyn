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
if($_SESSION['zalogowany']==true&&$_SESSION['root']==true){
echo '<head>
    <meta charset="utf-8">
</head>
<div class="container">
    <h2>Zarejestrowani użytkownicy </h2>';
$szukana1=$_SESSION["szukana"];
#SZUKANIE
#jezeli szukana nie jest pusta to wykonaj zapytanie do SQL
if($_SESSION['szukana']!=""){

$szukana1=$szukana1.'*';


$wynik=mysql_query("SELECT * FROM czesci WHERE `Numer` REGEXP '$szukana1' OR `Nazwa` REGEXP '$szukana1'");
$_SESSION["szukana"]=0; #zerujemy szukana
}else {
  $wynik1=mysql_query("SELECT * FROM users ");
};
#SZUKANIE END

if(mysql_num_rows($wynik)>0){ #narysuj tyle rows ile rekordow ma wynik
echo "
<!-- Popoover-->
            <div id=\"tablePopover\" class=\"hide\">
                 <div class=\"row\">
                 <div class=\"col-sm-4\">.col-sm-4</div>

                <div class=\"form-group\">

                <label for=\"comment\">Właściciel</label>
                <ul class=\"list-group\">
                  <li class=\"list-group-item\">Nazwa Firmy: </li>
                  <li class=\"list-group-item\">Adres: </li>
                  <li class=\"list-group-item\">Tel: </li>
                  <li class=\"list-group-item\">Email: </li>

                </ul>
                <center>

                    <button type=\"submit\"  class=\"btn btn-success btn-sm\"><span class=\"glyphicon glyphicon-comment\"></span> Napisz</button>

                </center>
                </form>
                </div>
                </div>
            </div>
<!-- Popover  -->
<div class=\"panel panel-shadow\">
<table class=\"table small table-striped\">
<thead>
      <tr>

        <th>ID</th>
        <th>E-mail</th>
        <th>Nazwa Firmy</th>
        <th>Adres</th>
        <th>Telefon</th>
        <th>Hasło</th>
      </tr>
    </thead>


";}

while($r1 = mysql_fetch_assoc($wynik1)) {  #przypisz do $r kazdy rekord po kolei i wpisz do tabeli
        echo "<tr>";
        echo "<td>".$r1['id']."</td>";
        echo "<td>".$r1['email']."</td>";
        echo "<td>".$r1['nazwa_firmy']."</td>";
        echo "<td>".$r1['adres']."</td>";
        echo "<td>".$r1['telefon']."</td>";
        echo "<td>".$r1['haslo']."</td>";
        echo "<td>
       <a href=\"mailto:".$r1['email']."?subject=Magazyn Częsci Zbytecznych&body=\" \" class=\"btn btn-success btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Napisz</a>
       </td>";
        echo "<td>
       <a href=\"indeks.php?a=del_user&id=".$r1['id']."\"class=\"btn btn-danger btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-remove-sign\"></span> Usuń</a>
       </td>";



        echo "</tr>";
    }
    echo "</table>";
  }
?>
