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
					<?php if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 0; color: #cc0000;">Please proove you're not a robot!</p><?php } ?>
					<form method="post" action="<?php echo PATH_WEB; ?>contact" id="tesztvezetes" target="_self">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
							<input type="hidden" name="model" value="<?php echo $model; ?>">
							<input type="hidden" name="modelName" value="<?php echo $modelName; ?>">
						<fieldset>
							<div class="parsys formBuilder">
								<div class="textfield section">
									<div class="form-group">
										<label>Contact type*</label>
										<div class="form-group-container my-infiniti-radio">
											<label><input type="radio" name="contactType" value="contact" <?php if(!isset($postData["contactType"]) OR empty($postData["contactType"]) OR $postData["contactType"] == "contact") { ?>checked<?php } ?>><span>Contact</span></label>
											<?php if($GLOBALS["URL"]->routes[0] != "q50-en") { ?><label><input type="radio" name="contactType" value="testdrive" id="my-infiniti-radio-t" <?php if($postData["contactType"] == "testdrive") { ?>checked<?php } ?>><span>Test Drive</span></label><?php } ?>
										</div>
									</div>
								</div>								
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_273d">Firstname*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_273d" class="my-infiniti-input" name="firstName" required value="<?php echo $postData["firstName"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_3be">Lastname*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_3be" class="my-infiniti-input" name="lastName" required value="<?php echo $postData["lastName"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_76e2">E-mail address*</label>
										<div class="form-group-container">
											<input type="email" id="textfield_76e2" class="my-infiniti-input" name="email" required value="<?php echo $postData["email"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_5616">Phone number*</label>
										<div class="form-group-container">
											<input type="text" id="textfield_5616" class="my-infiniti-input" name="phone" placeholder="+36 XX XXX XXXX" required value="<?php echo $postData["phone"]; ?>">
										</div>
									</div>
								</div>
								<div class="textfield section">
									<div class="form-group">
										<label for="textfield_5616t">Message, comment</label>
										<div class="form-group-container">
											<textarea id="textfield_5616t" name="message" class="my-infiniti-textarea"><?php echo $postData["message"]; ?></textarea>
										</div>
									</div>
								</div>
								<div class="textfield section g-recaptcha-container">
									<script src="https://www.google.com/recaptcha/api.js?hl=en"></script>
									<div class="form-group">
										<label>Proove you're not a robot!</label>
										<div class="form-group-container">	
											<div class="g-recaptcha display-inline-block" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
										</div>
									</div>
								</div>
								<div class="checkbox section">
									<div class="form-group checkbox">
										<p>
											Protecting your personal data is a key priority for us.<br>
											We are happy to count you amongst our visitors. You’ve been invited to share some personal data. The protection of your personal data is a key priority for us.<br>
											<br>
											I consent to have my data processed for receiving personalised communications by:<br>
											Please tick the relevant boxes:<br>
										</p>	
										<div class="form-group">
											<ul class="group-checkboxes">
												<li class="checkbox">
													<input type="checkbox" value="1" name="legalsContactEmail" id="legalsContactEmail" class="group-checkbox">
													<label for="legalsContactEmail">contacted by email</label>
												</li>
												<li class="checkbox">
													<input type="checkbox" value="1" name="legalsContactPhone" id="legalsContactPhone" class="group-checkbox">
													<label for="legalsContactPhone">contacted by phone</label>
												</li>
											</ul>
										</div>
										<p>At any time you can change your mind by using the unsubscribe link in communications. You can find more info related to Data Privacy at INFINITI by clicking here. (https://www.infiniti.hu/gdpr.html)</p>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="submit-form"><button class="submit-form-button" type="submit">Send</button></div>
						<p class="legend">* Required</p>
					</form>
				</div>	
			</div>	
		</div>	
	</div>	
</div>