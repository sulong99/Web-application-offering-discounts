<?php 
$sql = "SELECT * FROM OKAZJE WHERE ID = :jakiesdziwneid";
							$zapytanie = $db->prepare($sql);
							$zapytanie->bindValue(':jakiesdziwneid', $_SESSION['id_do_pokazania']);
							$zapytanie->execute();
							$pojedynczaoferta = $zapytanie->fetch(PDO::FETCH_ASSOC);



$sql = "SELECT KOMENTARZE.ID,KOMENTARZE.TRESC,UZYTKOWNICY.NAZWA FROM KOMENTARZE JOIN UZYTKOWNICY on KOMENTARZE.ID_USERA=UZYTKOWNICY.ID WHERE KOMENTARZE.ID_OFERTY = ".$_SESSION['id_do_pokazania'];
							$zapytanie2 = $db->query($sql);
							$pojedynczykoment = $zapytanie2->fetchAll();
							
?>
<div class=oferty>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 oferta_padding">
					<div class="container oferta">
						<div class="row pasek_ocen">
							<?php
								if($pojedynczaoferta['PROCENT']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Wysoka obniżka" id="blah"><img class="ikonaOcena" src="./img/discount.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if($pojedynczaoferta['HOT']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Gorąca okazja" id="blah"><img class="ikonaOcena" src="./img/fire.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if($pojedynczaoferta['REKOMENDACJA']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Gwarancja jakości" id="blah"><img class="ikonaOcena" src="./img/recommended.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if(isset($_SESSION['logged_admin_status'])){
									echo '<form method="post">';
									echo '<input type="hidden" id="custId" name="custId" value="'.$pojedynczaoferta['ID'].'">';
									echo '<i class="icon-rek" rel="tooltip" title="Poleć" id="blah"><button type="submit" style="margin: 0; padding: 0; background: none; border: none;"><img height="30px" width="30px" src="./img/oki.svg"/></button></i>';
									echo '</form>';
									echo '<form method="post">';
									echo '<input type="hidden" id="delId" name="delId" value="'.$pojedynczaoferta['ID'].'">';
									echo '<i class="icon-del" rel="tooltip" title="Usuń" id="blah"><button type="submit" style="margin: 0; padding: 0; background: none; border: none;"><img height="30px" width="30px" src="./img/bina.svg"/></button></i>';
									echo '</form>';
								}
							?>
						</div>
						<div class="row oferta_zdjecie">
							<form method="post">
								<button class="okazButton" name="szczegoly_oferty"type="submit" value="<?php echo $pojedynczaoferta['ID']; ?>">
								<img class="zdjecie_oferty"src="./img/<?php echo $pojedynczaoferta['ZDJECIE']?>">
								</button>
							</form>
						</div>
						<div class="row">
							<b class="oferta_nazwa"><?php echo $pojedynczaoferta['NAZWA']; ?></b>
						</div>
						<div class="row oferta_cena">
							<b class="nowaCena"><?php echo $pojedynczaoferta['NOWA_CENA']?>zł</b>
							<s class="staraCena"><?php echo $pojedynczaoferta['STARA_CENA'] ?></s>
							<h6 class="ileRabatu"><?php if ($pojedynczaoferta['STARA_CENA']===NULL){}else{
																					$number=((($pojedynczaoferta['STARA_CENA']-$pojedynczaoferta['NOWA_CENA'])*100)/$pojedynczaoferta['STARA_CENA']);
																					$number = intval($number * ($p = pow(10, 0))) / $p;
																					echo "-".$number."%";
																					}
																		?>
							</h6>
						</div>
						<div class="row oferta_opis">
							<?php echo $pojedynczaoferta['OPIS']; ?>
						</div>
						<div class="row oferta_przycisk">
							<button class="btn btn-outline-success my-2 btn-block"  type="submit" onclick="location.href='<?php echo $pojedynczaoferta['LINK_DO_OKAZJI']?>';">
								&nbsp Idź do okazji
								<img src="./img/go.svg" width="30" height="30" class="d-inline-block align-top ikona_idz_do_oferty" alt=""> 
							</button>
				</div>
		</div>	
	</div>
				

				<?php if (empty($pojedynczykoment)) {require_once "slidebar.php"; }?>
				<div class="col-sm-12 col-md-6 col-lg-7 col-xl-7 oferta_padding" >
				<?php foreach ($pojedynczykoment as $jk) { ?>	
					<div style="margin-bottom:10px;"class="container oferta">
							<div class="row px-2 pt-1">
								<?php echo '<b>'.$jk['NAZWA'].'</b>';
								if(isset($_SESSION['logged_admin_status'])){
									echo '<form method="post">';
									echo '<input type="hidden" id="komentIdDoSkasowania" name="komentIdDoSkasowania" value="'.$jk['ID'].'">';
									echo '<button class="btn admin btn-sm ml-2"name="szczegoly_oferty" type="submit" value="'.$pojedynczaoferta['ID'].'" style="margin: 0; padding: 0; background: none; border: none;"><img height="30px" width="30px" src="./img/bina.svg"/></button>';
									echo '</form>';
								}
								?>
							</div>
							<div class="row px-2">
								<div id="kreska_pod_info">	</div>
							</div>
							<div class="row pl-2 py-2">
								<?php echo $jk['TRESC'];?>
							</div>
					</div>	
				<?php }?>
				</div>
				
				
				<?php 	if (isset($_SESSION['error_dodawanie_oferty'])){
																echo '<div class="alert alert-danger">';
																echo '<a class="close font-weight-light" data-dismiss="alert" href="#">×</a>';
																echo $_SESSION['error_dodawanie_oferty'];
																echo ' </div>';
																unset($_SESSION['error_dodawanie_oferty']);
															}?>
				
				

				<?php if(isset($_SESSION['logged_id'])){?>
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 oferta_padding my-2" >
					<form method="post">
					<div class="input-group">
						 <input type="hidden" id="dodajemyKomentarzId" name="dodajemyKomentarzId" value="<?php echo $pojedynczaoferta['ID'];?>">
						<textarea class="form-control" name="textKomenta"aria-label="With textarea"></textarea>
						<button type="submit" name="dodajemyKomentarz"class="btn btn-primary btn-sm">Wyslij Komentarz</button>
					</div>
					</form>
				</div>		
				<?php }?>
				
				
				
		</div>
	</div>	
</div>				