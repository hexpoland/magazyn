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

	echo '
	<div class="container">



	</div>

';
}

  ?>
