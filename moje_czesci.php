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
#sprawdzamy czy jestesmy dalej zalogowani
if($_SESSION['zalogowany']==true){
echo '<head>
    <meta charset="utf-8">
  </head>
<div class="container">
  <h2>Moje Częsci  <a href="indeks.php?a=add" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Dodaj</a>
</h2>
  <p>1. Wyszukaj częsci 2. Sprawdź własciciela 3. Zamów :</p> ';

$mymail=$user['email'];
#tutaj glowne zapytanie mysql (wyswietla tylko czesci zalogowanego uzytkownika)
$wynik=mysql_query("SELECT * FROM czesci WHERE `email`='$mymail'") or die (mysql_error());

if(mysql_num_rows($wynik)>0){
#tabelka
echo '
<table class="table small table-striped">
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


';
while($r = mysql_fetch_assoc($wynik)) {
        echo "<tr>";
        echo "<td>".$r['ID']."</td>";
        echo "<td>".$r['Numer']."</td>";
        echo "<td>".$r['Nazwa']."</td>";
        echo "<td>".$r['Opis']."</td>";
        if($r.['Nowy']==True){
        echo '<td><div class="checkbox">
  <label><input type="checkbox" checked="checked" disabled="true"></label>
</div></td>';
      };
        echo "<td>".$user[email]."</td>";

        echo "
        <td>
       <a href=\"indeks.php?a=edit&id=".$r[ID]."\" class=\"btn btn-primary btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-edit\"></span> Edytuj</a>
       <a href=\"indeks.php?a=del&id=".$r[ID]."\" class=\"btn btn-danger btn-sm\" role=\"button\"><span class=\"glyphicon glyphicon-remove-sign\"></span> Usuń</a>

       </td>";
        echo "</tr>";
    }
    echo "</table>";

}}


?>
