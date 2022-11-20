<? $uzytkownik = "root"; // 
$haslo = ""; // Rzecz jasna wszystkie te dane zależą od naszej konkretnej bazy! 
$db_name = "pepper"; // 
$adres = "localhost"; // 
$link = mysql_connect( $adres, $uzytkownik, $haslo); 
mysql_select_db($db_name);
$fhandle = fopen($_FILES['zdjecie']['tmp_name'], "r"); $content = base64_encode(fread($fhandle, $_FILES['zdjecie']['size']));
 fclose($fhandle);
$zapytanie = mysql_query("INSERT INTO okazje (ZDJECIE) VALUES (\"".$content."\")";
$adres = "ADRES_STRONY/showimage.php?id=".mysql_insert_id(); 
echo $adres;
?>