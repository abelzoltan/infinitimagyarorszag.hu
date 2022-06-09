<li class="my-infiniti-newcars-col">
	<div class="c_130">
		<div class="vehicle-link">
			<div class="header-group">
				<h3 class="car-title"><a href="<?php echo PATH_WEB.$car->url; ?>" target="<?php echo $target; ?>"><?php echo $car->name; ?></a></h3>
				<p class="row vehicle-strapline"><?php echo $car->description; ?></p>
				<div class="row starting-price">
					<div class="c_184">
						<ul class="prices">
							<li class="msrp">
								<div class="content">
									<div class="price" style="display: block;">
										<p class="disclaimer"><?php echo $car->priceTxt; ?></p>
										<span class="full-price"><span><?php echo number_format($car->price, 0, ",", " "); ?> Ft</span></span>
									</div>
									<div class="subtext"></div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<a href="<?php echo PATH_WEB.$car->url; ?>" target="<?php echo $target; ?>" class="media-view">
				<span class="picture-element">
					<span data-src="<?php echo CDN_WEB; ?>uj-autok/<?php echo $car->url; ?>.png" class="analytics-target"></span>
				   <noscript><img alt="" src="<?php echo CDN_WEB; ?>uj-autok/<?php echo $car->url; ?>.png"/></noscript>
				</span>
			</a>
		</div>
		<a class="primary-cta cta-explore" href="<?php echo CDN_WEB.$car->pdfBrochure; ?>" target="_blank">Prospektus</a>
		<div class="accordion">
			<div class="accordion-group">
				<a class="primary-cta cta-explore" href="<?php echo CDN_WEB.$car->pdfPriceList; ?>" target="_blank">Árlista</a>
			</div>
		</div>
	</div>
</li>