<?php if(!empty($carList)) { ?>
	<div class="freeEditorial freeEditorialParsys parsys">
		<div class="columns column section columns12">
			<div class="grid-row">
				<div class="col-12">
					<div class="parsys col1-par">
						<div class="vehiclelisting section">
							<div class="c_030-0">
								<div class="grid-row list-outer">
									<ul class="list-item">
										<?php 
										$target = (PATH_WEB == INFINITI_GABLINI_HU) ? "_self" : "_blank";
										foreach($carList AS $carKey => $car) { include("_list-item-newcar.php"); } 
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row" id="my-infiniti-details-top">	
		<div class="col-12" style="text-align: center; font-size: 1.3em;">Az Infinitimagyaroszág továbbra is biztosítja a modellek elérhetőségét és a hivatalos gyári támogatás által nyújtotta szakértelmet. Az Infiniti Center Budapest márkakereskedés és szerviz, a legkorszerűbb technológiákkal várja ügyfeleit, több mint 400 négyzetméteren, a Budapest XV Városkapu u.1. szám alatt.</div>
	</div>	
	<div class="my-infiniti-spacer"></div>
<?php } else { ?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_002">
				<div class="c_001">
					<p class="content-copy my-infiniti-text-center">Sajnáljuk, de jelenleg nincs elérhető modell!</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>