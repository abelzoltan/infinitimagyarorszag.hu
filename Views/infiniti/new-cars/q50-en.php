<div class="grid-row">
	<div class="col-12">
		<div class="c_004">
			<div class="heading-group"><h2><span>POTENTIAL STANDS FAST</span></h2></div>
		</div>
	</div>
	<div class="my-infiniti-clear"></div>
</div>
<div class="grid-row bleed">
	<div class="col-12"><img src="<?php echo $pics; ?>1.jpg" alt="<?php echo strip_tags($VIEW["title"]); ?>" class="my-infiniti-img"></div>
</div>

<div class="grid-row">
	<div class="col-12 center">
		<div class="parsys col1-par">
			<div class="section heliostext">
				<div class="c_001">
					<div class="heading-group"><h2><span>EMPOWERING TECHNOLOGY</span></h2></div>
					<div>
						<div><p>Aggressive yet refined, the Q50 is ready to bring out your daring side. Unleash enthralling horsepower, harness world-first technologies, and feel empowered through every turn. The Q50 will push you further.</p></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
<div class="contentZone section">
	<div class="content-zone container c_002 content-divider">
		<hr>
		<div class="link-zone">
			<div class="title">
				<div class="grid-row">
					<div class="col-12">
						<div class="c_004">
							<div class="heading-group"><h2><span>EXPLORE THE Q50</span></h2></div> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="link-zone">
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>2.jpg" alt="" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>3.jpg" alt="" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>4.jpg" alt="" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>5.jpg" alt="" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>6.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="my-infiniti-spacer"></div>
		<hr>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div>
	<a class="my-infiniti-btn" href="<?php echo $GLOBALS["URL"]->fullURL; ?>#contact" target="_self">FIND OUT MORE</a>
	<?php /*<a class="my-infiniti-btn my-infiniti-btn2" href="<?php echo $pics; ?>Q50_UK.pdf" target="_blank">Download a brochure</a>
	<a class="my-infiniti-btn" href="<?php echo $pics; ?>Q50_UK.pdf" target="_blank">Price List</a>*/ ?>
</div>
<div class="my-infiniti-spacer"></div>
<div id="my-infiniti-users">
	<?php	
	foreach($VIEW["vars"]["userList"] AS $userKey => $user)
	{
		?><div class="my-infiniti-users-item"><?php include(INFINITI_VIEWS."_user-item.php"); ?></div><?php
	}
	?>
</div>
<div id="contact">
	<?php 
	$model = "q50";
	$modelName = "Q50";
	include(INFINITI_VIEWS."_form-en.php"); 
	?>
</div>