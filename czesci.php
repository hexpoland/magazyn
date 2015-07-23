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
if($_SESSION['zalogowany']==true){
echo '<head>
    <meta charset="utf-8">
</head>
<div class="container">
    <h2>Części </h2>
    <p>1. Wyszukaj częsci 2. Sprawdź własciciela 3. Zamów :</p>';
$szukana1=$_SESSION["szukana"];
#SZUKANIE
#jezeli szukana nie jest pusta to wykonaj zapytanie do SQL
if($_SESSION['szukana']!=""){

$szukana1=$szukana1.'*';


$wynik=mysql_query("SELECT * FROM czesci WHERE `Numer` REGEXP '$szukana1' OR `Nazwa` REGEXP '$szukana1'");
$_SESSION["szukana"]=0; #zerujemy szukana
}else {
  $wynik=mysql_query("SELECT * FROM czesci ");
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
<table class=\"table small table-striped \">
<thead>
      <tr>

        <th>ID</th>
        <th>Numer</th>
        <th>Nazwa</th>
        <th>Opis</th>
        <th>Nowy</th>
        <th>Uzytkownik</th>
      </tr>
    </thead>


";}

while($r = mysql_fetch_assoc($wynik)) {  #przypisz do $r kazdy rekord po kolei i wpisz do tabeli
        echo "<tr>";
        echo "<td>".$r['ID']."</td>";
        echo "<td>".$r['Numer']."</td>";
        echo "<td>".$r['Nazwa']."</td>";
        echo "<td>".$r['Opis']."</td>";
        if($r.['Nowy']==True){
        echo '<td><div class="checkbox">
  <label><input type="checkbox" checked="checked" disabled="true">Nowy</label>
</div></td>';
      };
$email1=$r['email'];
$company_data=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE `email`='$email1' LIMIT 1"));
        echo "<td><a  rel=\"tablepopover\" data-placement=\"top\" data-content=\"<b>Nazwa Firmy: </b>".$company_data['nazwa_firmy']."<p></p><b>Email: </b>".$r['email']."<p></p><b>Adres: </b>".$company_data['adres']." <p></p><b>Tel:   </b>".$company_data['telefon']." <p></p><center><button class='btn btn-success btn-sm'>Napisz</button></center> \">".$r['email']."</a></td>";

        echo "<td>
       <a href=\"mailto:".$r['email']."?subject=Magazyn Częsci Zbytecznych&body=Proszę o wycene części:   [NUMER]:     \n".$r['Numer']."    [NAZWA]:   ".$r['Nazwa']." \" class=\"btn btn-success btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Zamawiam!</a>
       </td>";
        echo "</tr>";
    }
    echo "</table>";
  }
?>
