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
    <h2>Częsci </h2>
    <p>1. Wyszukaj częsci 2. Sprawdź własciciela 3. Zamów :</p>';
$szukana1=$_SESSION["szukana"];
#SZUKANIE
#jezeli szukana nie jest pusta to wykonaj zapytanie do SQL
if($_SESSION['szukana']!=""){
$wynik=mysql_query("SELECT * FROM czesci WHERE `Numer`='$szukana1' OR `Nazwa`='$szukana1'");
$_SESSION["szukana"]=0; #zerujemy szukana
}else {
  $wynik=mysql_query("SELECT * FROM czesci ");
};
#SZUKANIE END

if(mysql_num_rows($wynik)>0){ #narysuj tyle rows ile rekordow ma wynik
echo "
<!-- Popoover-->
            <div id=\"tablePopover\" class=\"hide\">


                <div class=\"form-group\">

                <label for=\"comment\">Właściciel</label>
                <ul class=\"list-group\">
                  <li class=\"list-group-item\">Nazwa Firmy: </li>
                  <li class=\"list-group-item\">Adres: </li>
                  <li class=\"list-group-item\">Tel: </li>
                  <li class=\"list-group-item\">Email:".$r['email']."</li>

                </ul>
                <center>

                    <button type=\"submit\"  class=\"btn btn-success btn-sm\"><span class=\"glyphicon glyphicon-comment\"></span> Napisz</button>
                </center>
                </form>
                </div>
            </div>
<!-- Popover  -->

<table class=\"table small table-striped\">
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
        echo "<td><a href=\"func.php\" rel=\"tablepopover\" data-placement=\"top\" data-content=\"<b>Nazwa Firmy: </b>Combi-Service Jerzy Wolakowski<p></p><b>Email: </b>".$r['email']."<p></p><b>Adres: </b><p></p><b>Tel: </b><p></p><center><button class='btn btn-success btn-sm' >Napisz</button></center> \">".$r['email']."</a></td>";

        echo "<td>
       <a href=\"mailto:".$r['email']."?subject=Magazyn Częsci Zbytecznych&body=Proszę o wycene części:   [NUMER]:     \n".$r['Numer']."    [NAZWA]:   ".$r['Nazwa']." \" class=\"btn btn-success btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-shopping-cart\"></span> Zamawiam!</a>
       </td>";
        echo "</tr>";
    }
    echo "</table>";
  }
?>
