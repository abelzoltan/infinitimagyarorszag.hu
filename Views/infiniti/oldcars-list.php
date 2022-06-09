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
										$target = (PATH_WEB == INFINITI_STOCK) ? "_self" : "_blank";
										$i = 0;
										foreach($carList AS $carKey => $car) 
										{ 
											include("_list-item-oldcar-hex.php"); 
											$i++;
											if(isset($carListLimit) AND $i >= $carListLimit) { break; }
										} 
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
<?php } else { ?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_002">
				<div class="c_001">
					<p class="content-copy my-infiniti-text-center">Sajnáljuk, de jelenleg nincs elérhető <?php if(isset($_GET["model"])) { ?><strong class="my-infiniti-text-uppercase"><?php echo $_GET["model"]; ?></strong> <?php } ?>modell!</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
