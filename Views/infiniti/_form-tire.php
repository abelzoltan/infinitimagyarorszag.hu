<?php 
$postData = (isset($_SESSION[SESSION_PREFIX."postData"])) ? $_SESSION[SESSION_PREFIX."postData"] : [];
$formError = (isset($_SESSION[SESSION_PREFIX."formError"])) ? $_SESSION[SESSION_PREFIX."formError"] : NULL;
unset($_SESSION[SESSION_PREFIX."postData"]);
unset($_SESSION[SESSION_PREFIX."formError"]);

if(empty($postData) AND isset($_GET["kerek"]) AND !empty($_GET["kerek"])) { $postData["tire"] = $_GET["kerek"]; }
?>
<script src="<?php echo DIR_PUBLIC_WEB; ?>vendors/jquery-3.2.1.min.js"></script>
<link rel="stylesheet" href="<?php echo PATH_WEB; ?>vendors/fancybox-2.1.5/jquery.fancybox.css">
<script src="<?php echo PATH_WEB; ?>vendors/fancybox-2.1.5/jquery.fancybox.pack.js"></script>
<script src="<?php echo PATH_WEB; ?>vendors/fancybox-2.1.5/jquery.mousewheel-3.0.6.pack.js"></script>
<script>
var jQuery_3_2_1 = $.noConflict(true);
jQuery_3_2_1(document).ready(function(){
	jQuery_3_2_1(".fancybox").fancybox();	
});
</script>
<style scoped>
.my-infiniti-tire-container input{
	display: none !important;
}

.my-infiniti-tire-label{
	float: left;
	display: block !important;
	width: 48% !important;
	margin: 10px 1% !important;
	padding: 10px 10px 10px 0!important;
	border: 1px solid transparent !important;
	cursor: pointer !important;
}

.my-infiniti-tire-label:hover{
	border-color: #e5e5e5 !important;
}

.my-infiniti-tire-container input:checked + .my-infiniti-tire-label{
	background-color: #e5e5e5 !important;
}

.my-infiniti-tire{
	position: relative;
}

.my-infiniti-tire-img{
	position: absolute;
	top: 0;
	left: 0;
	width: 20%;
	height: 100%;
}

.my-infiniti-tire-img2{
	left: auto;
	right: 0;
}

.my-infiniti-tire-img a{
	display: block;
	width: 100%;
	height: 100%;
}

.my-infiniti-tire-img img{
	position: relative;
	top: 50%;
	margin: 0 auto;
	max-width: 100% !important;
	max-height: 100% !important;
	transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-moz-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-o-transform: translateY(-50%);
}

.my-infiniti-tire-texts{
	width: 60%;
	margin: 0 auto;
	padding: 5px 15px;
}

.my-infiniti-tire-name{
	font-size: 2em;	
	font-weight: bold;
}

.my-infiniti-tire-brand{
	font-size: 1.3em;
	padding: 5px 0;
	font-weight: bold;
}

.my-infiniti-tire-size{
	font-size: 1.2em;
}

.my-infiniti-tire-price{
	padding-top: 5px;
	vertical-align: middle;
}

.my-infiniti-tire-price span{
	display: inline-block;
	vertical-align: middle;
}

.my-infiniti-tire-price span + span{
	padding-left: 5px;
}

.my-infiniti-tire-price-list, .my-infiniti-tire-price-txt{
	font-size: 1.1em;
	color: #ccc;
}

.my-infiniti-tire-price-sale{
	font-size: 1.5em;
	font-weight: bold;
	color: #8b1d28;
}

@media screen and (max-width: 1024px){
	.my-infiniti-tire-label{
		float: none !important;
		width: 80% !important;
		margin-left: auto !important;
		margin-right: auto !important;
	}
}

@media screen and (max-width: 768px){
	.my-infiniti-tire-label{
		width: 100% !important;
	}
}

@media screen and (max-width: 580px){	
	.my-infiniti-tire-label{
		padding-left: 10px !important;
		border-color: #e5e5e5 !important;
	}
	
	.my-infiniti-tire-img{
		position: relative;
		width: 100%;
		height: auto;
	}

	.my-infiniti-tire-img a{
		max-width: 200px;
		margin: 0 auto;
		height: auto;
	}

	.my-infiniti-tire-img img{
		top: 0;
		transform: none;
			-webkit-transform: none;
			-moz-transform: none;
			-ms-transform: none;
			-o-transform: none;
	}
	
	.my-infiniti-tire-img2{
		padding: 15px 0;
	}
	
	.my-infiniti-tire-texts{
		width: 100%;
		text-align: center;
	}
}
</style>
<div class="grid-row">
	<div class="col-12 center">
		<div class="parsys col1-par">
			<div class="form section">
				<div class="c_019">
					<?php if($formError == "recaptcha") { ?><p style="font-size: 1.4em; font-weight: bold; text-align: center; margin-bottom: 0; color: #cc0000;">Kérjük igazolja, hogy nem robot!</p><?php } ?>
					<form method="post" action="<?php echo PATH_WEB; ?>kapcsolatfelvetel-kerek" target="_self" id="ajanlatkeres">
						<input type="hidden" name="process" value="1">
						<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
						<fieldset>
							<div class="parsys formBuilder">
								<div class="textfield section">
									<div class="form-group">
										<div class="form-group-container my-infiniti-tire-container">
											<?php 
											$i = 0;
											foreach($tires AS $tireKey => $tire)
											{
												?>
												<input type="radio" name="tire" id="tire-<?php echo $tire["id"]; ?>" value="<?php echo $tire["id"]; ?>" <?php if(isset($postData["tire"]) AND $postData["tire"] == $tire["id"]) { ?>checked<?php } ?>>
												<label for="tire-<?php echo $tire["id"]; ?>" class="my-infiniti-tire-label">
													<div class="my-infiniti-tire">
														<div class="my-infiniti-tire-img">
															<a href="<?php echo $tire["picCar"]; ?>" class="fancybox" data-fancybox-title="<?php echo $tire["fullName"]; ?> / 1." data-fancybox-group="tires"><img src="<?php echo $tire["picCar"]; ?>" alt="<?php echo $tire["fullName"]; ?>" class="my-infiniti-img"></a>
														</div>
														<div class="my-infiniti-tire-img my-infiniti-tire-img2">
															<a href="<?php echo $tire["picTire"]; ?>" class="fancybox" data-fancybox-title="<?php echo $tire["fullName"]; ?> / 1." data-fancybox-group="tires"><img src="<?php echo $tire["picTire"]; ?>" alt="<?php echo $tire["fullName"]; ?>" class="my-infiniti-img"></a>
														</div>
														<div class="my-infiniti-tire-texts">
															<div class="my-infiniti-tire-name"><?php echo $tire["name"]; ?></div>
															<div class="my-infiniti-tire-brand"><?php echo $tire["fullBrand"]; ?></div>
															<div class="my-infiniti-tire-size"><?php echo $tire["size"]; ?></div>
															<div class="my-infiniti-tire-price">
																<?php 
																if(!empty($tire["priceList"])) { ?><span class="my-infiniti-tire-price-list"><?php echo $tire["priceListOut"]; ?></span><?php }
																if(!empty($tire["priceList"]) AND !empty($tire["priceSale"])) { ?><span class="my-infiniti-tire-price-txt"> helyett</span><?php }
																if(!empty($tire["priceSale"])) { ?><span class="my-infiniti-tire-price-sale"> <?php echo $tire["priceSaleOut"]; ?></span><?php }
																?>
															</div>
														</div>
														<div class="my-infiniti-clear"></div>
													</div>
												</label>
												<?php
												$i++;
												if($i % 2 == 0) { ?><div class="my-infiniti-clear"></div><?php }
											}
											?>
											<div class="my-infiniti-clear"></div>
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