<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-sm-10 col-md-7 col-lg-5 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">Dodawanie oferty</h3>
                    
                       <?php 	if (isset($_SESSION['error_dodawanie_oferty'])){
																echo '<div class="alert alert-danger">';
																echo '<a class="close font-weight-light" data-dismiss="alert" href="#">×</a>';
																echo $_SESSION['error_dodawanie_oferty'];
																echo ' </div>';
																unset($_SESSION['error_dodawanie_oferty']);
															}?> 

                   
										<form method="post" enctype="multipart/form-data">
											<fieldset>
													<div class="form-group has-error">
															<input class="form-control input-lg" placeholder="Nazwa przedmiotu*" name="o_nazwa" type="text" value="<?php if (isset($_SESSION['rmb_nazwa'])){echo $_SESSION['rmb_nazwa'];} ?>">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Aktualna cena*" name="o_nowa_cena" type="text" value="<?php if (isset($_SESSION['rmb_nowacena'])){echo $_SESSION['rmb_nowacena'];} ?>">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Stara cena" name="o_stara_cena" type="text" value="<?php if (isset($_SESSION['rmb_staracena'])){echo $_SESSION['rmb_staracena'];} ?>">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Adres URL do strony z okazją" name="o_link" type="text" value="<?php if (isset($_SESSION['rmb_link'])){echo $_SESSION['rmb_link'];} ?>">
													</div>
													<div class="form-group">
															<textarea class="form-control" name="o_opis"id="exampleFormControlTextarea1" placeholder="Krótki opis przedmiotu, ewentualne wrażenia z użytkowania*"rows="3"><?php if (isset($_SESSION['rmb_opis'])){echo $_SESSION['rmb_opis'];} ?></textarea>
													</div>
													<div class="custom-control custom-checkbox my-1 mr-sm-2">
														<input type="checkbox" class="custom-control-input" name="o_hot" id="customControlInline" <?php if (isset($_SESSION['rmb_hot'])){echo "checked";} ?>>
														<label class="custom-control-label" for="customControlInline">Oznacz ofertę jako HOT, jeśli spełnia warunki regulaminu</label>
													</div>
													<div class="custom-file">
														<input type="file" class="custom-file-input" name="zdj" id="zdj">
														<label class="custom-file-label" for="customFile">Dodaj zdjęcie ofetry</label>
													</div>
													<input style="margin-top:10px;" name="sproboj_dodac_oferte"class="btn btn-lg btn-primary btn-block" value="Dodaj oferte" type="submit">
											</fieldset>
										</form>
                </div>
        </div>
    </div>
</div>