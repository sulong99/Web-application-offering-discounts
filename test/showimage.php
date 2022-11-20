<? header("Content-type: image/jpg;");
$uzytkownik = "user"; // 
$haslo = "pass"; // 
$db_name = "base"; // 
$adres = "localhost"; // 
$link = mysql_connect( $adres, $uzytkownik, $haslo); 
mysql_select_db($db); $result = mysql_query("SELECT * FROM okazje WHERE id=".$_GET['id']);
if (mysql_num_rows($result) != 0) { $row = mysql_fetch_assoc($result); echo base64_decode($row['ZDJECIE']); }