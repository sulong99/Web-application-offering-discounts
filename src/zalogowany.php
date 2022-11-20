				<!-- Zarejestruj/zaloguj -->
				<form class="form-inline my-2 my-lg-0" action="logout.php">
					<button id="menu_logowanie_rejestracja_user_info"type="submit"class="btn-sm btn btn-outline-success mx-2">
						<img src="./img/user.svg" class="d-inline-block align-top menuIcon" alt="">
						Zalogowany jako <?php echo $_SESSION['logged_nazwa'];?>
					</button>
				</form>		
				
				<!-- Dodaj przedmiot -->		
				<form class="form-inline my-2 my-lg-0" method="post">
					<input type="hidden" name="czy_dac_dodawanie" value="tak">
					<button class="btn btn-outline-success" type="submit">
						<img src="./img/plus.svg" class="d-inline-block align-top menuIcon" alt="">
						Dodaj
					</button>
				</form>