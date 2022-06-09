<?php
$hasCars = false; 
if(!empty($carList)) 
{
	foreach($carList AS $carKey => $car) 
	{
		if($car["car"]->model == "Q30" OR $car["car"]->model == "QX30") {  }
		else { unset($carList[$carKey]); }
	}
	
	if(!empty($carList)) 
	{
		$hasCars = true;
		?>
		<style scoped>.pageHeader{display: none;}</style>
		<img src="<?php echo PATH_WEB; ?>pics/fokepek/q30-keszletakcio.jpg?v=20200918" alt="<?php echo $VIEW["title"]; ?>" class="my-infiniti-img">
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
												?>
												<li>
													<div class="c_130">
														<div class="vehicle-link">
															<div class="header-group">
																<h3 class="car-title"><a href="<?php echo INFINITI_STOCK.$car["url"]; ?>" target="<?php echo $target; ?>"><?php echo $car["name"]; ?></a></h3>
																<p class="row vehicle-strapline">
																	<span style="padding-top: 10px;">
																		<?php 
																		$out = [];
																		foreach($car["listDatas"] AS $key => $data) { $out[] = $data["value"]; }
																		echo implode("&nbsp;&nbsp;&nbsp;", $out);
																		?>
																	</span>
																</p>
																<div class="row starting-price">
																	<div class="c_184">
																		<ul class="prices">
																			<li class="msrp">
																				<div class="content">
																					<?php if($car["priceOriginalInList"]) { ?>
																						<div class="price" style="display: block;">
																							<p class="disclaimer"><del><?php echo $car["priceOriginal"]; ?></del> helyett</p>
																							<span class="full-price"><span style="color: #800000;"><?php echo $car["price"]; ?></span></span>
																						</div>
																					<?php } else { ?>
																						<div class="price" style="display: block;">
																							<p class="disclaimer">&nbsp;</p>
																							<span class="full-price"><span><?php echo $car["price"]; ?></span></span>
																						</div>
																					<?php } ?>
																					<div class="subtext"></div>
																				</div>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
															<a href="<?php echo INFINITI_STOCK.$car["url"]; ?>" target="<?php echo $target; ?>" class="media-view">
																<span class="picture-element">
																	<span data-src="<?php echo $car["pic"]; ?>" class="analytics-target"></span>
																   <noscript><img alt="" src="<?php echo $car["pic"]; ?>"/></noscript>
																</span>
															</a>
														</div>
														<a class="primary-cta cta-explore" href="<?php echo INFINITI_STOCK.$car["url"]; ?>" target="<?php echo $target; ?>">Adatlap</a>
														<div class="accordion">
															<div class="accordion-group">
																<a class="primary-cta cta-explore" href="<?php echo INFINITI_STOCK.$car["url"]; ?>#ajanlatkeres" target="<?php echo $target; ?>">Ajánlatkérés</a>
															</div>
														</div>
													</div>
												</li>
												<?php
												$i++;
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
		<?php 
	}
} 

if(!$hasCars) 
{ 
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_002">
				<div class="c_001">
					<p class="content-copy my-infiniti-text-center">Sajnáljuk, de jelenleg nincs elérhető <?php if(isset($_GET["model"])) { ?><strong class="my-infiniti-text-uppercase"><?php echo $_GET["model"]; ?></strong> <?php } ?>modell!</p>
				</div>
			</div>
		</div>
	</div>
	<?php 
} 
?>