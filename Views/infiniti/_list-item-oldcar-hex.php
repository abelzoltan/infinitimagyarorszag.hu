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
									<div class="price" style="display: block;">
										<p class="disclaimer"><?php echo $car["priceLabel"]; ?></p>
										<span class="full-price"><span><?php echo $car["price"]; ?></span></span>
									</div>
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