<div class="grid-row bleed">
	<div class="col-12"><img src="<?php echo $pics; ?>q50.jpg" alt="<?php echo strip_tags($VIEW["title"]); ?>" class="my-infiniti-img"></div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0; text-align: left;">
			<div class="heading-group"><h3 style="margin-bottom: 0;"><strong>Includes all Q50 features, plus</strong></h3></div>
			<div class="content-group" style="font-family: 'Infiniti Light','Infiniti Extended Light',Verdana,Arial,sans-serif">
				<ul style="margin: 5px 0 15px 15px;">
					<li>Direct Adaptive Steering</li>
					<li>Active Lane Control</li>
					<li>Regenerative brakes system</li>
					<li>Sports suspension (only with 3.5-litre V6 Hybrid engine)</li>
					<li>Approaching Vehicle Sound for Pedestrians</li>
					<li>Chrome fog lamp finisher</li>
					<li>Kacchu Aluminium interior trim</li>
					<li>Leather seat facings</li>
					<li>Heated front seats</li>
				</ul>
				<p>&nbsp;</p>
				<p style="font-size: 0.9em;">CO2 emissions: 139 g/km Official Fuel Consumption: 5,9 - 8,2 l/km</p>
				<p style="font-size: 0.85em;">Vehicles shown for illustration purposes only. Information subject to change at any time.</p>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<a class="my-infiniti-btn" href="<?php echo $GLOBALS["URL"]->fullURL; ?>#contact" target="_self">FIND OUT MORE</a>
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