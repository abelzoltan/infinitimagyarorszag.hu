<?php 
$postData = (isset($_SESSION[SESSION_PREFIX."postData"])) ? $_SESSION[SESSION_PREFIX."postData"] : [];
$formError = (isset($_SESSION[SESSION_PREFIX."formError"])) ? $_SESSION[SESSION_PREFIX."formError"] : NULL;
unset($_SESSION[SESSION_PREFIX."postData"]);
unset($_SESSION[SESSION_PREFIX."formError"]);
?>
<script src="<?php echo PATH_WEB; ?>vendors/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>
var jQuery_3_2_1 = $.noConflict(true);
function modelChange(e, model) 
{
	jQuery_3_2_1(e).siblings().css("font-weight", "normal");
	jQuery_3_2_1(e).siblings().val("");
	jQuery_3_2_1(e).css("font-weight", "bold");
	jQuery_3_2_1("#modelOut").html(jQuery_3_2_1(e).val());
	jQuery_3_2_1("#modelNameInput").val(jQuery_3_2_1(e).val());
	jQuery_3_2_1("#modelInput").val(model);
}
</script>
<style scoped>
#modelOut{
	margin: .5em 0 0 0;
	color: #ccc;
}

.my-infiniti-model-select{
	float: left;
	width: 32%;
	margin-left: 2%;
}

.my-infiniti-model-select:first-child{
	margin-left: 0;
}

@media screen and (max-width: 959px){
	.my-infiniti-model-select{
		float: none;
		width: 100%;
		margin-left: 0;
		margin-top: 1.5em;
	}
	
	.my-infiniti-model-select:first-child{
		margin-top: 0;
	}
}
</style>
<div class="grid-row">
	<div class="col-8 center">
		<div class="parsys col1-par">
			<div class="form section">
				<div class="c_019">
					<p style="font-size: 1.4em; text-align: center; margin-bottom: 1em;">*Telefonszám szükséges, hogy tudjuk értesíteni az esetleges változásokról</p>
					<?php 
					if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 0; color: #cc0000;">Kérjük igazolja, hogy nem robot!</p><?php } 
					elseif($formError == "taken") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 0; color: #cc0000;">Az időpontot sajnos már lefoglalták!</p><?php } 
					?>
					<form method="post" action="<?php echo PATH_WEB; ?>kapcsolatfelvetel-landolo" id="tesztvezetes" target="_self">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
							<input type="hidden" name="contactType" value="<?php echo $GLOBALS["URL"]->routes[0]; ?>">
							<input type="hidden" name="contactTypeName" value="<?php echo strip_tags($VIEW["title"]); ?> - Regisztráció">
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
								<div class="textfield section">
										<div class="form-group">
											<label>Modell és Időpont*</label>
											<div class="form-group-container">
												<?php
												$allModels = [
													"q30" => "Q30",
													"q50" => "Q50",
													"qx30" => "QX30", 
												];
												$i = 1;
												foreach($allModels AS $modelKey => $model)
												{
													?>
													<select name="model<?php echo $i; ?>" class="my-infiniti-select my-infiniti-model-select" onchange="modelChange(this, '<?php echo $modelKey; ?>')">
														<option value="" style="font-weight: bold;"><?php echo $model; ?></option>
														<?php
														$dates = ["2018-11-21", "2018-11-22", "2018-11-23"];
														foreach($dates AS $dateFrom)
														{
															$date = $dateFrom." 12:00:00";
															while(true)
															{
																$datas = [];
																$datas["date"] = $date;
																$datas["dateFullFormatted"] = date("Y. m d. H:i", strtotime($date));
																$datas["name"] = $model." - ".$datas["dateFullFormatted"];
																$datas["listName"] = date("F d. H:i", strtotime($date));
																if(!in_array($datas["name"], $takenDates)) 
																{ 
																	?><option value="<?php echo $datas["name"]; ?>" <?php if($datas["name"] == $postData["modelName"]) { ?>selected<?php } ?>><?php echo $datas["listName"]; ?></option><?php
																}
																
																$date = date("Y-m-d H:i:s", strtotime($date." +20 Minutes"));
																if($date >= $dateFrom." 17:00:00") { break; }
															}
														}
														?>
													</select>
													<?php
													$i++;
												}
												?>	
											</div>
											<div class="my-infiniti-clear"></div>
											<input type="hidden" name="model" id="modelInput" value="<?php echo $postData["model"]; ?>">
											<input type="hidden" name="modelName" id="modelNameInput" value="<?php echo $postData["modelName"]; ?>">
											<p id="modelOut"><?php echo $postData["modelName"]; ?></p>
										</div>
									</div>
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