<?php if(!empty($stockCars)) { ?>
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_001">
				<div class="heading-group">
					<h2><span><strong>Készleten lévő <?php echo $modelName; ?> autóink</strong></span></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-details-cars">
		<?php 
		$carList = $stockCars;
		$carListLimit = 3;
		include(INFINITI_VIEWS."oldcars-list.php");
		?>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-spacer"></div>
			<div class="my-infiniti-text-center">
				<a class="my-infiniti-btn" href="<?php echo INFINITI_STOCK; ?>keszleteink?model=<?php echo $GLOBALS["URL"]->routes[0]; ?>" target="_self">Összes készletes Q30</a>
			</div>
		</div>
	</div>
<?php } if(!empty($approvedCars)) { ?>
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_001">
				<div class="heading-group">
					<h2><span><strong>Infiniti Approved - Használt <?php echo $modelName; ?> gépjárművek</strong></span></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-details-cars">
		<?php 
		$carList = $approvedCars;
		$carListLimit = 3;
		include(INFINITI_VIEWS."oldcars-list.php");
		?>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-spacer"></div>
			<div class="my-infiniti-text-center">
				<a class="my-infiniti-btn" href="<?php echo INFINITI_APPROVED; ?>?model=<?php echo $GLOBALS["URL"]->routes[0]; ?>" target="_self">Összes használt Q30</a>
			</div>
		</div>
	</div>
<?php } ?>	
<div class="my-infiniti-spacer"></div>