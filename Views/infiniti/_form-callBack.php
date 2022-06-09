<?php 
$postData = (isset($_SESSION[SESSION_PREFIX."postData"])) ? $_SESSION[SESSION_PREFIX."postData"] : [];
$formError = (isset($_SESSION[SESSION_PREFIX."formError"])) ? $_SESSION[SESSION_PREFIX."formError"] : NULL;
unset($_SESSION[SESSION_PREFIX."postData"]);
unset($_SESSION[SESSION_PREFIX."formError"]);
?>
<div class="grid-row">
	<div class="col-8 center">
		<div class="parsys col1-par">
			<div class="form section">
				<div class="c_019">
					<?php if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-top: 0; margin-bottom: 0; color: #cc0000;">Kérjük igazolja, hogy nem robot!</p><?php } ?>
					<form method="post" action="<?php echo PATH_WEB.$GLOBALS["URL"]->routes[0]; ?>" target="_self" id="contactForm">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
						<fieldset>
							<div class="parsys formBuilder">
								<div class="textfield section">
									<div class="form-group">
										<label style="margin-top: 0;">Érdeklődés tárgya*</label>
										<div class="form-group-container">
											<select name="subject" class="my-infiniti-select" required>
												<option value="">(Kérjük válasszon!)</option>
												<option value="M3, Új autó" <?php if($postData["subject"] == "M3, Új autó") { ?>selected<?php } ?>>Új autó</option>
												<option value="M3, Szerviz" <?php if($postData["subject"] == "M3, Szerviz") { ?>selected<?php } ?>>Szerviz (M3)</option>
												<option value="Budaörs, Szerviz" <?php if($postData["subject"] == "Budaörs, Szerviz") { ?>selected<?php } ?>>Szerviz (Budaörs)</option>
												<option value="M3, Alkatrész" <?php if($postData["subject"] == "M3, Alkatrész") { ?>selected<?php } ?>>Alkatrész (M3)</option>
												<option value="Budaörs, Alkatrész" <?php if($postData["subject"] == "Budaörs, Alkatrész") { ?>selected<?php } ?>>Alkatrész (Budaörs)</option>
											</select>
										</div>
									</div>
								</div>
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
										<label>Telefonszám*</label>
										<div class="form-group-container">
											<div class="row" style="margin-left: -2px; margin-right: -2px;">
												<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phonePart1" placeholder="Országkód*" required value="<?php if(!empty($postData["phonePart1"])) { echo $postData["phonePart1"]; } else { ?>+36<?php } ?>"></div>
												<div class="col-3" style="padding-left: 2px; padding-right: 2px;">
													<select class="my-infiniti-select" name="phonePart2Select" id="callBack-phonePart2Select" onchange="callBackPhoneParts(this, 'phonePart2')" required>
														<option value="">Előhívó</option>
														<option value="20" <?php if($postData["phonePart2Select"] == "20") { ?>selected<?php } ?>>20</option>
														<option value="30" <?php if($postData["phonePart2Select"] == "30") { ?>selected<?php } ?>>30</option>
														<option value="70" <?php if($postData["phonePart2Select"] == "70") { ?>selected<?php } ?>>70</option>
														<option value="-" <?php if($postData["phonePart2Select"] == "-") { ?>selected<?php } ?>>EGYÉB</option>
													</select>
													<input type="text" class="my-infiniti-input" name="phonePart2" id="callBack-phonePart2" placeholder="Előhívó*" required value="<?php if(!empty($postData["phonePart2"])) { echo $postData["phonePart2"]; } ?>" style="display: none;">
												</div>
												<div class="col-6" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phonePart3" placeholder="Telefonszám*" required value="<?php if(!empty($postData["phonePart3"])) { echo $postData["phonePart3"]; } ?>"></div>
												<div class="my-infiniti-clear"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label>Vezetékes telefonszám</label>
										<div class="form-group-container">
											<div class="row" style="margin-left: -2px; margin-right: -2px;">
												<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart1" placeholder="Országkód*" required value="<?php if(!empty($postData["phoneWiredPart1"])) { echo $postData["phoneWiredPart1"]; } else { ?>+36<?php } ?>"></div>
												<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart2" placeholder="Körzetszám" value="<?php if(!empty($postData["phoneWiredPart2"])) { echo $postData["phoneWiredPart2"]; } ?>">
												</div>
												<div class="col-6" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart3" placeholder="Vezetékes telefonszám" value="<?php if(!empty($postData["phoneWiredPart3"])) { echo $postData["phoneWiredPart3"]; } ?>"></div>
												<div class="my-infiniti-clear"></div>
											</div>
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
<script>
function callBackPhoneParts(e, inputName)
{
	if($(e).val() == "-")
	{
		$(e).hide();
		$("#callBack-" + inputName).show();
	}
	else
	{
		$("#callBack-" + inputName).val($(e).val());
		$("#callBack-" + inputName).hide();
	}
}
callBackPhoneParts($("#callBack-phonePart2Select"), "phonePart2");
</script>