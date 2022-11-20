<?php
header('Cache-Control: no cache'); //WSTECZ
session_cache_limiter('private_no_expire'); //WSTECZ
require_once './dbUtils/database.php';
		if(isset($_POST['l_zaloguj'])){//walidacja i obsluga logowania
						//Pobieranie danych z formularza
						$uzytkownik = !empty($_POST['l_nazwa']) ? trim($_POST['l_nazwa']) : null;
						$haslo = !empty($_POST['l_haslo']) ? trim($_POST['l_haslo']) : null;
						$_SESSION['error_logowanie']="";
						$dane_okej = true;
						
						if ((strlen($uzytkownik)<3)||(strlen($uzytkownik)>15)){
							$dane_okej = false;
							$_SESSION['error_logowanie']=$_SESSION['error_logowanie']."Login ma od 3 do 15 znaków!"."</br>";
						}
						if ((strlen($haslo)<8)||(strlen($haslo)>20)){
							$dane_okej = false;
							$_SESSION['error_logowanie']=$_SESSION['error_logowanie']."Hasło ma od 8 do 20 znaków"."</br>";
						}else if(!preg_match('/[0-9a-zA-Z]/',$haslo)){
							$dane_okej = false;
							$_SESSION['error_logowanie']=$_SESSION['error_dodawanie_oferty']."Hasło składa się tylko z liter różnej wielkości i cyfr"."</br>";
						}
						
						if ($dane_okej){
							$sql = "SELECT ID,NAZWA,HASLO,STATUS FROM UZYTKOWNICY WHERE NAZWA = :username";
							$zapytanie = $db->prepare($sql);
							$zapytanie->bindValue(':username', $uzytkownik);
							$zapytanie->execute();
							$uzytkownik_w_bazie = $zapytanie->fetch(PDO::FETCH_ASSOC);
							if($uzytkownik_w_bazie === false){
									$_SESSION['error_logowanie']=$_SESSION['error_logowanie']."Nie ma takiego użytkownika!"."</br>";
									$_SESSION['czy_dac_logowanie']='tak';
							} else{
									$weryfikacja_hasla = password_verify($haslo, $uzytkownik_w_bazie['HASLO']);
									if($weryfikacja_hasla){
											$_SESSION['logged_id'] = $uzytkownik_w_bazie['ID'];
											$_SESSION['logged_nazwa'] = $uzytkownik_w_bazie['NAZWA'];
											if($uzytkownik_w_bazie['STATUS']==1){
											$_SESSION['logged_admin_status'] = 1;
											echo $_SESSION['logged_admin_status'];
											}
											header('Location: index.php');
											
							
									} else{
										$_SESSION['rmb_uzytkownik']=$uzytkownik;
										$_SESSION['error_logowanie']=$_SESSION['error_logowanie']."Błędny login i/lub hasło!"."</br>";
										$_SESSION['czy_dac_logowanie']='tak';
									}
							}
							$_SESSION['rmb_uzytkownik']=$uzytkownik;
							$_SESSION['czy_dac_logowanie']='tak';
						}else{
							$_SESSION['rmb_uzytkownik']=$uzytkownik;
							$_SESSION['czy_dac_logowanie']='tak';
						}
		}else if(isset($_POST['r_zarejestruj'])){//walidacja i obsluga rejestracji
						//Pobieranie danych z formularza
						$uzytkownik = !empty($_POST['r_nazwa']) ? trim($_POST['r_nazwa']) : null;
						$email = !empty($_POST['r_email']) ? trim($_POST['r_email']) : null;
						$haslo1 = !empty($_POST['r_haslo1']) ? trim($_POST['r_haslo1']) : null;
						$haslo2 = !empty($_POST['r_haslo2']) ? trim($_POST['r_haslo2']) : null;
						$regulamin = !empty($_POST['r_regulamin']) ? 1 : null;
						$_SESSION['error_rejestracja']="";
						$dane_okej = true;
						
						if ((strlen($uzytkownik)<3)||(strlen($uzytkownik)>15)){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Nazwa użytkownika musi mieć 3 do 15 znaków!"."</br>";
						}else if(!preg_match('/[0-9a-zA-Z]/',$uzytkownik)){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."W nazwie użytkownika dopuszczlne są tylko litery i cyfry"."</br>";
						}
						if ((strlen($haslo1)<8)||(strlen($haslo1)>20)){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Hasło musi mieć od 8 do 20 znaków"."</br>";
						}else if(!preg_match('/[0-9a-zA-Z]/',$haslo1)){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."W haśle dopuszczlne są tylko litery i cyfry"."</br>";
						}
						if ($haslo1 != $haslo2){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Hasła muszą być identyczne"."</br>";	
						}
						
						if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Niepoprawny adres e-mail"."</br>";							
						}
						if(empty($_POST['r_regulamin'])){
							$dane_okej = false;
							$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Przeczytaj i zaakceptuj regulamin"."</br>";							
						}
							
						$secret_key="6LcWi6YUAAAAAKeuJfTnKEh33ngrp8zAV9or_Arb";
						$spr = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
						$odp = json_decode($spr);
						
						if($odp->success==false){
							$ok = false;
							$_SESSION['error_rejestracja'] =$_SESSION['error_rejestracja']."Potwierdź że nie jesteś robotem";
						}
						
						if($dane_okej){
							//Sprawdzenie czy nie istnieje taki user
							$sql = "SELECT COUNT(NAZWA) AS num FROM UZYTKOWNICY WHERE NAZWA = :username";
							$zapytanie = $db->prepare($sql);
							$zapytanie->bindValue(':username', $uzytkownik);
							$zapytanie->execute();
							$czy_nie_istnieje_taki_sam= $zapytanie->fetch(PDO::FETCH_ASSOC);
						
							if($czy_nie_istnieje_taki_sam['num'] > 0){
									$_SESSION['error_rejestracja']=$_SESSION['error_rejestracja']."Istnieje już taki użytkownik"."</br>";		
									$_SESSION['rmb_r_uzytkownik']=$uzytkownik;
									$_SESSION['rmb_r_email']=$email;
									$_SESSION['rmb_r_regulamin']=$regulamin;
									$_SESSION['czy_dac_rejestracje']='tak';
							}
							
							//wstawianie rekordu
							$haslo_zaszyfrowane = password_hash($haslo1,PASSWORD_DEFAULT);
							
							$sql = "INSERT INTO UZYTKOWNICY (NAZWA, HASLO, EMAIL) VALUES (:username, :password, :email)";
							$zapytanie = $db->prepare($sql);

							$zapytanie->bindValue(':username', $uzytkownik);
							$zapytanie->bindValue(':password', $haslo_zaszyfrowane);
							$zapytanie->bindValue(':email', $email);
					 
							//Execute the statement and insert the new account.
							$czy_zarejestrowano = $zapytanie->execute();

							if($czy_zarejestrowano){
									$sql = "SELECT ID,NAZWA,HASLO,STATUS FROM UZYTKOWNICY WHERE NAZWA = :username";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':username', $uzytkownik);
									$zapytanie->execute();
									$uzytkownik_w_bazie = $zapytanie->fetch(PDO::FETCH_ASSOC);
									$_SESSION['logged_id'] = $uzytkownik_w_bazie['ID'];
									$_SESSION['logged_nazwa'] = $uzytkownik_w_bazie['NAZWA'];
									if($uzytkownik_w_bazie['STATUS']==1){
									$_SESSION['logged_admin_status'] = 1;
									echo $_SESSION['logged_admin_status'];
									}
								header('Location: index.php');
							}
						}else{
							$_SESSION['rmb_r_uzytkownik']=$uzytkownik;
							$_SESSION['rmb_r_email']=$email;
							$_SESSION['rmb_r_regulamin']=$regulamin;
							$_SESSION['czy_dac_rejestracje']='tak';
						}
		}else{
			if(isset($_POST['czy_dac_logowanie'])){
				$_SESSION['czy_dac_logowanie']='tak';
			}else if(isset($_POST['czy_dac_rejestracje'])){
				$_SESSION['czy_dac_rejestracje']='tak';
			}else if(isset($_POST['czy_dac_dodawanie'])){
				$_SESSION['czy_dac_dodawanie']='tak';
			}else if(isset($_POST['sproboj_dodac_oferte'])){
				require_once 'sprdodacoferte.php';
			}else if(isset($_POST['custId'])){
				$sql = "SELECT rekomendacja FROM okazje WHERE ID = :idd";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':idd', $_POST['custId']);
									$zapytanie->execute();
									$ofka = $zapytanie->fetch(PDO::FETCH_ASSOC);

				if($ofka['rekomendacja']==0){					
				$sql = "UPDATE okazje SET rekomendacja=1 WHERE ID = :jakiesid";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':jakiesid', $_POST['custId']);
									$zapytanie->execute();
				}else{
				$sql = "UPDATE okazje SET rekomendacja=0 WHERE ID = :jakiesid";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':jakiesid', $_POST['custId']);
									$zapytanie->execute();
				}
					header('Location: index.php');	
								
			}else if(isset($_POST['delId'])){

				$sql = "DELETE FROM okazje WHERE ID = :jakiesid";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':jakiesid', $_POST['delId']);
									$zapytanie->execute();
				
					header('Location: index.php');	
								
			}else if(isset($_POST['komentIdDoSkasowania'])){

				$sql = "DELETE FROM komentarze WHERE ID = :jakiesid";
									$zapytanie = $db->prepare($sql);
									$zapytanie->bindValue(':jakiesid', $_POST['komentIdDoSkasowania']);
									$zapytanie->execute();
									$_SESSION['id_do_pokazania']=$_POST['szczegoly_oferty'];

								
			}else if(isset($_POST['szczegoly_oferty'])){
					$_SESSION['id_do_pokazania']=$_POST['szczegoly_oferty'];

					
								
			}else if(isset($_POST['dodajemyKomentarz'])){
					$_SESSION['id_do_pokazania']=$_POST['dodajemyKomentarzId'];
					$koment = !empty($_POST['textKomenta']) ? trim($_POST['textKomenta']) : null;
					$dane_okej = true;
					
					if(!preg_match('/^[0-9a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ?,. \s]+$/',$koment)){
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']="W komentarzu można używać jedynie liter, cyfr, kropki oraz przecinka"."</br>";
					}
					
					if($dane_okej){
							$sql = "INSERT INTO KOMENTARZE (ID_OFERTY, TRESC,ID_USERA) VALUES (:id_ofki, :tresc_ofki, :idUsera)";
							$zapytanie = $db->prepare($sql);

							$zapytanie->bindValue(':id_ofki', $_SESSION['id_do_pokazania']);
							$zapytanie->bindValue(':tresc_ofki', $koment);
							$zapytanie->bindValue(':idUsera', $_SESSION['logged_id']);
							$zapytanie->execute();
					}else{
							//todo wyswietlic gdzies błąd
					}
					
								
			}else{
				if(isset($_GET['wyszukiwany_przedmiot'])){
				$okazjeQuery = $db->query('select * from okazje where nazwa like "%'.$_GET['wyszukiwany_przedmiot'].'%"');
				}else{
				$okazjeQuery = $db->query('SELECT * FROM okazje order by id desc');
				}
				$okazje = $okazjeQuery->fetchAll();
			}
		}
//print_r($users);

?>
<!doctype html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap-4.3.1-dist/css/bootstrap.css">
		<link rel="stylesheet" href="./css/styles.css">

    <title>Discount Master</title>
  </head>
	
  <body>
	
		<!---------------------------------------- MENU START ---------------------------------------->		
		<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
			<!-- Logo i nazwa -->		
			<a class="navbar-brand" href="index.php">
				<img src="./img/fire.svg" id="logo_strony" class="d-inline-block align-top" alt=""> Discount Master
			</a>
			<!-- Przycisk dla małych urządzeń -->		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
			<!-- # FORMULARZE # -->		
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Separacja do prawej -->		
				<ul class="navbar-nav mr-auto">
				</ul>
				<!-- Szukaj -->				
				<form class="form-inline my-2 my-lg-0" action="index.php"method="GET">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Szukaj ..." name="wyszukiwany_przedmiot">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="submit" >
								<img id="searchicon" src="./img/search.svg" width="30" height="30" class="d-inline-block align-top" alt="">
							</button>
						</div>
					</div>
				</form>
				<!-- Panel usera -->
				<?php
					if(isset($_SESSION['logged_nazwa'])){
						require_once "zalogowany.php";
					}else{
						require_once "zarejestruj_zaloguj.php";
					}
				?>

			</div>
		</nav>
		<!---------------------------------------- MENU KONIEC ---------------------------------------->			
		<div id="info_pod_menu">	
			<?php //info o wyszukiwanym
				if(isset($_GET['wyszukiwany_przedmiot'])&&(strlen($_GET['wyszukiwany_przedmiot'])>0)){
					echo 'Wyniki wyszukiwania dla:<b id="odstep_wyszukiwanego_wynik">'.$_GET['wyszukiwany_przedmiot'].'</b>';
					echo '<a id="wyczysc_filtr" href="index.php">wyczyść filtr wyszukiwania</a>';
				}
			?>
		</div>
		<div id="kreska_pod_info">	</div>
		<?php 
			if(isset($_SESSION['czy_dac_logowanie'])){
				require_once "logowanie.php";
				unset($_SESSION['czy_dac_logowanie']);
			}else if(isset($_SESSION['czy_dac_rejestracje'])){
				require_once "rejestracja.php";
				unset($_SESSION['czy_dac_rejestracje']);
			}else if(isset($_SESSION['czy_dac_dodawanie'])){
				require_once "dodawanie.php";
				unset($_SESSION['czy_dac_dodawanie']);
			}else if(isset($_SESSION['id_do_pokazania'])){
				require_once "szczegoly_przedmiotu.php";
				unset($_SESSION['id_do_pokazania']);
			}else{
				require_once "oferty.php";}
							
		?>

		
		
		
		
    <!-- Optional JavaScript -->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./jQuery/jquery-3.4.1.min.js"></script>
		<script src="./popper/popper.min.js"></script>
		<script src="./bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
		
		<!-- Other js -->
		<script>
		// Add the following code if you want the name of the file appear on select
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
		</script>  

  </body>
	<footer class="page-footer font-small">
		<div class="footer-copyright text-center py-3">Code by: Piotr Sulich<br/>
		</div>
	</footer>
</html>




