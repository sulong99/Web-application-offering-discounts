
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-sm-10 col-md-7 col-lg-5 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">Rejestracja</h3>
                       <?php 	if (isset($_SESSION['error_rejestracja'])){
																echo '<div class="alert alert-danger">';
																echo '<a class="close font-weight-light" data-dismiss="alert" href="#">×</a>';
																echo $_SESSION['error_rejestracja'];
																echo ' </div>';
																unset($_SESSION['error_rejestracja']);
															}?> 
										<form method="post">
											<fieldset>
													<div class="form-group has-error">
															<input class="form-control input-lg" placeholder="Nazwa Uzytkownika*" name="r_nazwa" type="text"value="<?php if (isset($_SESSION['rmb_r_uzytkownik'])){echo $_SESSION['rmb_r_uzytkownik'];} ?>">
													</div>
													<div class="form-group has-error">
															<input class="form-control input-lg" placeholder="Adres E-mail*" name="r_email" type="text"value="<?php if (isset($_SESSION['rmb_r_email'])){echo $_SESSION['rmb_r_email'];} ?>">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Haslo*" name="r_haslo1" value="" type="password">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Potwierdź Hasło*" name="r_haslo2" value="" type="password">
													</div>
													<div id="r_recaptcha">
													<div class="g-recaptcha" data-sitekey="6LcWi6YUAAAAAHV2n9zglv3NNaqq7j-sAnNWOu07"></div>
													</div>
													<div class="checkbox">
															<label class="small">
																	<input style="margin-left:5px;margin-bottom:5px;"name="r_regulamin" type="checkbox"<?php if (isset($_SESSION['rmb_r_regulamin'])){echo "checked";} ?>> Akceptuję <a href="#">regulamin</a>
															</label>
													</div>
													
													<input name="r_zarejestruj" style="margin-top:10px;"class="btn btn-lg btn-primary btn-block" value="Zarejestruj" type="submit">
													<button type="submit" name="czy_dac_logowanie"class="btn btn-link my-2">Powrót do logowania</button>
											</fieldset>
										</form>
                </div>
        </div>
    </div>
</div>