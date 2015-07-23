<?php
session_start();
$conn=mysql_connect("localhost","root","") or die(mysql_error()."Nie mozna polaczyc sie z baza danych. Prosze chwile odczekac i sprobowac ponownie.");
mysql_set_charset('latin1');
mysql_select_db("logowanie") or die(mysql_error()."Nie mozna wybrac bazy danych.");

?>
