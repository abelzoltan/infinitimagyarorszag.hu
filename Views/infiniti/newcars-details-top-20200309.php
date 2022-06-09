<style scoped>#my-infiniti-page-header { display: none; }</style>
<div class="my-infiniti-spacer"></div>
<div class="grid-row" id="my-infiniti-details-top">	
	<div class="col-4">
		<div class="heading-group"><h1><strong><?php echo $VIEW["title"]; ?></strong></h1></div>
	</div>
	<div class="col-4">&nbsp;
		<?php/*<div class="pricingStrip section">
			<div class="my-infiniti-price-row">
				<div class="row prices-actions">
					<div class="c_184 my-infiniti-price-container">
						<ul class="prices">
							<li class="msrp">
								<div class="content show">
									<div class="price">
										<p class="disclaimer"><?php echo $currentModel->detailsPriceTxt; ?></p>
										<span class="full-price"><span><?php echo $currentModel->detailsPrice; ?></span></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="my-infiniti-clear"></div>
				</div>
			</div>
		</div>*/ ?>
	</div>
	<div class="col-4">
		<div class="my-infiniti-details-menu">
			<a class="my-infiniti-btn" href="<?php echo $GLOBALS["URL"]->fullURL; ?>#ajanlatkeres" target="_self">Ajánlatkérés / Tesztvezetés</a>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row bleed">
	<div class="col-12"><img src="<?php echo $pics; ?>fokep.jpg?v=20200302" alt="<?php echo $VIEW["title"]; ?>" class="my-infiniti-img"></div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row">	
	<div class="col-12">
		<div class="my-infiniti-text-center">
			<a class="my-infiniti-btn my-infiniti-btn-active" href="<?php echo INFINITI_STOCK; ?>?model=<?php echo $GLOBALS["URL"]->routes[0]; ?>">Aktuális készletünk</a>
			<a class="my-infiniti-btn" href="<?php echo INFINITI_APPROVED; ?>?model=<?php echo $GLOBALS["URL"]->routes[0]; ?>">Aktuális használt autóink</a>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<?php if($carMenu !== false) { ?>
<div class="my-infiniti-car-menu">
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-car-menu-content">
				<?php foreach($carMenu AS $carMenuKey => $carMenuItem) { ?>
				<a href="<?php echo $carMenuItem["url"]; ?>" target="_self" class="my-infiniti-car-menu-item <?php if($carMenuKey == $carMenuActive) { ?>my-infiniti-car-menu-item-active<?php } ?>"><?php echo $carMenuItem["name"]; ?></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>