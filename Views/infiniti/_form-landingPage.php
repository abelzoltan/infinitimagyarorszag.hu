<?php 
$postData = (isset($_SESSION[SESSION_PREFIX."postData"])) ? $_SESSION[SESSION_PREFIX."postData"] : [];
$formError = (isset($_SESSION[SESSION_PREFIX."formError"])) ? $_SESSION[SESSION_PREFIX."formError"] : NULL;
unset($_SESSION[SESSION_PREFIX."postData"]);
unset($_SESSION[SESSION_PREFIX."formError"]);

if($GLOBALS["URL"]->routes[0] == "kapcsolatfelvetel") { ?>
<script>
function modelChange(e)
{
	$("[name=modelName]").val($(e).find("option:selected").text());
}
</script>
<?php } ?>
<div class="grid-row">
	<div class="col-8 center">
		<div class="parsys col1-par">
			<div class="form section">
				<div class="c_019">
					<?php if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 0; color: #cc0000;">Kérjük igazolja, hogy nem robot!</p><?php } ?>
					<form method="post" action="<?php echo PATH_WEB; ?>kapcsolatfelvetel-landolo" id="tesztvezetes" target="_self">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
							<input type="hidden" name="contactType" value="<?php echo $GLOBALS["URL"]->routes[0]; ?>">
							<input type="hidden" name="contactTypeName" value="<?php echo strip_tags($VIEW["title"]); ?>">
						<fieldset>
							<div class="parsys formBuilder">
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_3be">Vezetéknév*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_3be" class="my-infiniti-input" name="lastName" required value="<?php echo $postData["lastName"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_273d">Keresztnév*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_273d" class="my-infiniti-input" name="firstName" required value="<?php echo $postData["firstName"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_76e2">E-mail cím*</label>
										<div class="form-group-container">
											<input type="email" id="textfield_76e2" class="my-infiniti-input" name="email" required value="<?php echo $postData["email"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_5616">Telefonszám*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_5616" class="my-infiniti-input" name="phone" placeholder="+36 XX XXX XXXX" required value="<?php echo $postData["phone"]; ?>">
										</div>
									</div>
								</div>
								<?php if(isset($FORM_ADDRESS) AND $FORM_ADDRESS) { ?>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_3be">Lakcím*</label>
										<div class="form-group-container">
											<input type="text" class="my-infiniti-input" name="address" required value="<?php echo $postData["address"]; ?>">
										</div>
									</div>
								</div>
								<?php } if(isset($FORM_PERSONS) AND $FORM_PERSONS) { ?>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_3be">Létszám*</label>
										<div class="form-group-container">
											<select class="my-infiniti-select" name="persons" required>
												<option value="">(Kérem válasszon!)</option>
												<option value="1" <?php if($postData["persons"] == 1) { ?>selected<?php } ?>>1 fő</option>
												<option value="2" <?php if($postData["persons"] == 2) { ?>selected<?php } ?>>2 fő</option>
											</select>
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_5616t">Üzenet, megjegyzés</label>
										<div class="form-group-container">
											<textarea id="textfield_5616t" name="message" class="my-infiniti-textarea"><?php echo $postData["message"]; ?></textarea>
										</div>
									</div>
								</div>
								<div class="textfield section g-recaptcha-container">
									<script src="https://www.google.com/recaptcha/api.js"></script>
									<div class="form-group">
										<label>Igazolja, hogy nem robot!</label>
										<div class="form-group-container">	
											<div class="g-recaptcha display-inline-block" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
										</div>
									</div>
								</div>
								<div class="checkbox section">
									<div class="form-group checkbox">
										<span class="help-block">
											<p>
												Elérhetőségei megadásával hozzájárul, hogy az INFINITI a tesztvezetéssel kapcsolatban keresse Önt, és a jövőben értesítse az INFINITI vel kapcsolatos hírekről.<br>
												Az egyes módok bejelölésével Ön hozzájárul, hogy az INFINITI a megadott módon vegye fel Önnel a kapcsolatot.<br>
											</p>
										</span>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="submit-form"><button class="submit-form-button" type="submit">Elküldés</button></div>
						<p class="legend">* Kötelezően kitöltendő mező</p>
					</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>