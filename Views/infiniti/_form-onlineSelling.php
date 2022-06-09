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
<div class="parsys col1-par">
	<div class="form section">
		<div class="c_019" style="padding-top: 0;">
			<?php if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 25px; color: #cc0000;">Kérjük igazolja, hogy nem robot!</p><?php } ?>
			<form method="post" action="<?php echo PATH_WEB; ?>kapcsolatfelvetel-landolo" id="ajanlatkeres" target="_self">
				<input type="hidden" name="process" value="1">
				<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
				<input type="hidden" name="contactType" value="online-ertekesites">
				<input type="hidden" name="contactTypeName" value="Online értékesítés">
				<input type="hidden" name="onlinePlatform" value="Skype">
				<fieldset>
					<div class="parsys formBuilder">
						<div class="textfield section">
							<div class="form-group">
								<label style="margin-top: 10px;">Modell*</label>
								<div class="form-group-container">
									<select name="model" class="my-infiniti-select" required onchange="modelChange(this)">
										<option value="">(Válasszon modellt!)</option>
										<?php foreach($models AS $modelURL => $modelName) { ?>
											<option value="<?php echo $modelURL; ?>" <?php if($postData["model"] == $modelURL) { ?>selected<?php } ?>><?php echo $modelName; ?></option>
										<?php } ?>
									</select>
									<input type="hidden" name="modelName" value="">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_3be" style="margin-top: 20px;">Vezetéknév*</label>
								<div class="form-group-container">
									<input type="text" id="textfield_3be" class="my-infiniti-input" name="lastName" required value="<?php echo $postData["lastName"]; ?>">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_273d" style="margin-top: 20px;">Keresztnév*</label>
								<div class="form-group-container">
									<input type="text" id="textfield_273d" class="my-infiniti-input" name="firstName" required value="<?php echo $postData["firstName"]; ?>">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_76e2" style="margin-top: 20px;">E-mail cím*</label>
								<div class="form-group-container">
									<input type="email" id="textfield_76e2" class="my-infiniti-input" name="email" required value="<?php echo $postData["email"]; ?>">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_5616" style="margin-top: 20px;">Telefonszám*</label>
								<div class="form-group-container">
									<input type="text" id="textfield_5616" class="my-infiniti-input" name="phone" placeholder="+36 XX XXX XXXX" required value="<?php echo $postData["phone"]; ?>">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_56161" style="margin-top: 20px;">Skype azonosító*</label>
								<div class="form-group-container">
									<input type="text" id="textfield_56161" class="my-infiniti-input" name="onlinePlatformName" placeholder="" required value="<?php echo $postData["onlinePlatformName"]; ?>">
								</div>
							</div>
						</div>
						<div class="textfield section">
							<div class="form-group">
								<label for="textfield_5616t" style="margin-top: 20px;">Üzenet, megjegyzés</label>
								<div class="form-group-container">
									<textarea id="textfield_5616t" name="message" class="my-infiniti-textarea" style="min-height: 0;" rows="4"><?php echo $postData["message"]; ?></textarea>
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
<script> function modelChange(e) { $("[name=modelName]").val($(e).find("option:selected").text()); } </script>