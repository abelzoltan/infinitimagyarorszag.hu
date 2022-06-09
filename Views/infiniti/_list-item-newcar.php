<li class="my-infiniti-newcars-col">
	<div class="c_130">
		<div class="vehicle-link">
			<div class="header-group">
				<h3 class="car-title"><a href="<?php echo PATH_WEB.$car->url; ?>" target="<?php echo $target; ?>"><?php echo $car->name; ?></a></h3>
				<p class="row vehicle-strapline" style="margin-top: 10px;"><?php echo $car->description; ?></p>
			</div>
			<a href="<?php echo PATH_WEB.$car->url; ?>" target="<?php echo $target; ?>" class="media-view">
				<span class="picture-element">
					<span data-src="<?php echo CDN_WEB; ?>uj-autok/listakepek/<?php echo $car->url; ?>.jpg" class="analytics-target"></span>
				   <noscript><img alt="" src="<?php echo CDN_WEB; ?>uj-autok/listakepek/<?php echo $car->url; ?>.jpg"/></noscript>
				</span>
			</a>
		</div>
		<a class="primary-cta cta-explore" href="<?php echo PATH_WEB.$car->url; ?>" target="<?php echo $target; ?>">Felfedezés</a>
	</div>
</li>