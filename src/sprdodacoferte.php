<?php						//Pobieranie danych z formularza
						$nazwaoferty = !empty($_POST['o_nazwa']) ? trim($_POST['o_nazwa']) : null;
						$nowacena = !empty($_POST['o_nowa_cena']) ? trim($_POST['o_nowa_cena']) : null;
						$staracena = !empty($_POST['o_stara_cena']) ? trim($_POST['o_stara_cena']) : null;
						$opis = !empty($_POST['o_opis']) ? trim($_POST['o_opis']) : null;
						$link = !empty($_POST['o_link']) ? trim($_POST['o_link']) : null;
						$hot = !empty($_POST['o_hot']) ? 1 : null;
						$dane_okej=true;
						$_SESSION['error_dodawanie_oferty']="";
						if ((strlen($nazwaoferty)<3)||(strlen($nazwaoferty)>30)){
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Wymagana nazwa od 3 do 30 znaków!"."</br>";
						}
						if(!preg_match('/^[0-9a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹ Ż\s]+$/',$nazwaoferty)){
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."W nazwie można używać tylko liter i cyfr"."</br>";
						}
						if (!is_numeric($nowacena)){
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Aktualna cena musi być liczbą"."</br>";
						}
						
						if(strlen($staracena)>0){
							if (!is_numeric($staracena)){
								$dane_okej = false;
								$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Stara cena musi być liczbą"."</br>";
							}
							if ($staracena<$nowacena){
								$dane_okej = false;
								$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Co to za okazja? - stara cena mniejsza od nowej"."</br>";
							}
						}
						
						if(!preg_match('/^[0-9a-zA-ZąęćżźńłóśĄĆĘŁŃÓŚŹŻ,. \s]+$/',$opis)){
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."W opisie można używać jedynie liter, cyfr, kropki oraz przecinka"."</br>";
						}
						
						if (!filter_var($link, FILTER_VALIDATE_URL)) {
							$dane_okej = false;
							$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Adres URL niepoprawny"."</br>";
						}
						
						
						if ($dane_okej==false){
							$_SESSION['rmb_nazwa']=$nazwaoferty;
							$_SESSION['rmb_nowacena']=$nowacena;
							$_SESSION['rmb_staracena']=$staracena;
							$_SESSION['rmb_opis']=$opis;
							$_SESSION['rmb_link']=$link;
							$_SESSION['rmb_hot']=$hot;
							$_SESSION['czy_dac_dodawanie']='tak';
						}else{
									$target_dir = "img/";
									$target_file = $target_dir . basename($_FILES["zdj"]["name"]);
									$uploadOk = 1;
									$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									// Check if image file is a actual image or fake image
									if(isset($_FILES["tmp_name"])) {
											$check = getimagesize($_FILES["zdj"]["tmp_name"]);
											if($check !== false) {
													$uploadOk = 1;

											} else {
													$uploadOk = 0;
													
											}
									
									}else{
										$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Musisz dołączyć obrazek oferty"."</br>";
									}
									
																			// Check if file already exists
																			if (file_exists($target_file)) {
																					$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Przepraszamy ale obrazek o takiej nazwie już istnieje"."</br>";
																					$uploadOk = 0;
																			}
																			// Check file size
																			if ($_FILES["zdj"]["size"] > 3000000) {
																					$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Rozmiar plikiu jest za duży max 1MB"."</br>";
																					$uploadOk = 0;
																			}
																			// Allow certain file formats
																			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
																			&& $imageFileType != "gif" ) {
																					$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Dozwolone pliki: JPG, JPEG, PNG & GIF"."</br>";
																					$uploadOk = 0;
																			}		
									// Check if $uploadOk is set to 0 by an error
									if ($uploadOk == 0) {
													$_SESSION['rmb_nazwa']=$nazwaoferty;
													$_SESSION['rmb_nowacena']=$nowacena;
													$_SESSION['rmb_staracena']=$staracena;
													$_SESSION['rmb_opis']=$opis;
													$_SESSION['rmb_link']=$link;
													$_SESSION['rmb_hot']=$hot;
											$_SESSION['czy_dac_dodawanie']='tak';
									// if everything is ok, try to upload file
									} else {
												if (move_uploaded_file($_FILES["zdj"]["tmp_name"], $target_file)) {
														//wstawienie rekordu do bazy
														//echo "The file ". basename( $_FILES["zdj"]["name"]). " has been uploaded.";
														//echo "Typ:" . $check["mime"] . ".";
																	$procent=0;
												
																	if(($nowacena*2)<$staracena){
																		$procent=1;
																	}
																					
																	$query = $db->prepare('INSERT INTO okazje VALUES (NULL, :of_nazwa, :of_opis, :of_stara, :of_nowa, :of_procent, :of_hot, NULL, :of_zdjecie, :of_link)');
																	$query->bindValue(':of_nazwa', $nazwaoferty, PDO::PARAM_STR);
																	$query->bindValue(':of_opis', $opis, PDO::PARAM_STR);
																	$query->bindValue(':of_stara', $staracena, PDO::PARAM_STR);
																	$query->bindValue(':of_nowa', $nowacena, PDO::PARAM_STR);
																	$query->bindValue(':of_procent', $procent, PDO::PARAM_STR);
																	$query->bindValue(':of_zdjecie', basename($target_file), PDO::PARAM_STR);
																	$query->bindValue(':of_link', $link, PDO::PARAM_STR);
																	$query->bindValue(':of_hot', $hot, PDO::PARAM_STR);
																	$query->execute();
														unset($_SESSION['error_dodawanie_oferty']);
														unset($_SESSION['rmb_nazwa']);
														unset($_SESSION['rmb_nowacena']);
														unset($_SESSION['rmb_staracena']);
														unset($_SESSION['rmb_opis']);
														unset($_SESSION['rmb_link']);
														unset($_SESSION['rmb_hot']);
														unset($_SESSION['error_dodawanie_oferty']);
														header('Location: index.php');
												} else {
																$_SESSION['rmb_nazwa']=$nazwaoferty;
																$_SESSION['rmb_nowacena']=$nowacena;
																$_SESSION['rmb_staracena']=$staracena;
																$_SESSION['rmb_opis']=$opis;
																$_SESSION['rmb_link']=$link;
																$_SESSION['rmb_hot']=$hot;
														$_SESSION['error_dodawanie_oferty']=$_SESSION['error_dodawanie_oferty']."Grafika nie została przesłana, prosimy spróbuj ponownie"."</br>";
														$_SESSION['czy_dac_dodawanie']='tak';
												}
										}
									
									
							
							//header('Location: index.php');
						}
				//require_once "upload.php";
?>