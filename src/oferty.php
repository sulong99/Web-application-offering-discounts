<div class=oferty>
	<div class="container">
		<div class="row">
			<?php foreach ($okazje as $okazja) { ?>
				<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 oferta_padding">
					<div class="container oferta">
						<div class="row pasek_ocen">
							<?php
								if($okazja['PROCENT']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Wysoka obniżka" id="blah"><img class="ikonaOcena" src="./img/discount.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if($okazja['HOT']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Gorąca okazja" id="blah"><img class="ikonaOcena" src="./img/fire.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if($okazja['REKOMENDACJA']==1){
									echo	'<i class="ikonaOcena" rel="tooltip" title="Gwarancja jakości" id="blah"><img class="ikonaOcena" src="./img/recommended.svg" class="d-inline-block align-top" alt=""/></i>';
								}
								if(isset($_SESSION['logged_admin_status'])){
									echo '<form method="post">';
									echo '<input type="hidden" id="custId" name="custId" value="'.$okazja['ID'].'">';
									echo '<i class="icon-rek" rel="tooltip" title="Poleć" id="blah"><button type="submit" style="margin: 0; padding: 0; background: none; border: none;"><img height="30px" width="30px" src="./img/oki.svg"/></button></i>';
									echo '</form>';
									echo '<form method="post">';
									echo '<input type="hidden" id="delId" name="delId" value="'.$okazja['ID'].'">';
									echo '<i class="icon-del" rel="tooltip" title="Usuń" id="blah"><button type="submit" style="margin: 0; padding: 0; background: none; border: none;"><img height="30px" width="30px" src="./img/bina.svg"/></button></i>';
									echo '</form>';
								}
							?>
						</div>
						<div class="row oferta_zdjecie">
							<form method="post">
								<button class="okazButton" name="szczegoly_oferty"type="submit" value="<?php echo $okazja['ID']; ?>">
								<img class="zdjecie_oferty"src="./img/<?php echo $okazja['ZDJECIE']?>">
								</button>
							</form>
						</div>
						<div class="row">
							<b class="oferta_nazwa"><?php echo $okazja['NAZWA']; ?></b>
						</div>
						<div class="row oferta_cena">
							<b class="nowaCena"><?php echo $okazja['NOWA_CENA']?>zł</b>
							<s class="staraCena"><?php echo $okazja['STARA_CENA'] ?></s>
							<h6 class="ileRabatu"><?php if ($okazja['STARA_CENA']===NULL){}else{
																					$number=((($okazja['STARA_CENA']-$okazja['NOWA_CENA'])*100)/$okazja['STARA_CENA']);
																					$number = intval($number * ($p = pow(10, 0))) / $p;
																					echo "-".$number."%";
																					}
																		?>
							</h6>
						</div>
						<div class="row oferta_opis">
							<?php echo $okazja['OPIS']; ?>
						</div>
						<div class="row oferta_przycisk">
							<button class="btn btn-outline-success my-2 btn-block"  type="submit" onclick="location.href='<?php echo $okazja['LINK_DO_OKAZJI']?>';">
								&nbsp Idź do okazji
								<img src="./img/go.svg" width="30" height="30" class="d-inline-block align-top ikona_idz_do_oferty" alt=""> 
							</button>
						</div>
					</div>	
				</div>
			<?php	} ?>
		</div>
	</div>
</div>