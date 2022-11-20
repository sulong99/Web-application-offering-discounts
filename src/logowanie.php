
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-sm-10 col-md-7 col-lg-5 mx-auto">
                <div class="card card-body">
                    <h3 class="text-center mb-4">Logowanie</h3>
                       <?php 	if (isset($_SESSION['error_logowanie'])){
																echo '<div class="alert alert-danger">';
																echo '<a class="close font-weight-light" data-dismiss="alert" href="#">×</a>';
																echo $_SESSION['error_logowanie'];
																echo ' </div>';
																unset($_SESSION['error_logowanie']);
															}?> 
										<form method="post">
											<fieldset>
													<div class="form-group has-error">
															<input class="form-control input-lg" placeholder="Nazwa uzytkownika" name="l_nazwa" type="text" value="<?php if (isset($_SESSION['rmb_uzytkownik'])){echo $_SESSION['rmb_uzytkownik'];} ?>">
													</div>
													<div class="form-group has-success">
															<input class="form-control input-lg" placeholder="Haslo" name="l_haslo" type="password" value="">
													</div>
													
													
													<input style="margin-top:10px;" name="l_zaloguj"class="btn btn-lg btn-primary btn-block" value="Zaloguj" type="submit">
													<button type="submit" name="czy_dac_rejestracje"class="btn btn-link my-2">Rejestracja</button>
											</fieldset>
										</form>
                </div>
        </div>
    </div>
</div>