<div class="grid-row">
	<div class="col-12">
		<div class="c_004">
			<div class="heading-group"><h2><span>THE PREMIUM ACTIVE COMPACT</span></h2></div>
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
					<div class="heading-group"><h2><span>The city's your playground</span></h2></div>
					<div>
						<div><p>Harness nimble, sports performance that makes each straight and every corner your own.</p></div>
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
							<div class="heading-group"><h2><span>EXPLORE THE Q30</span></h2></div> 
						</div>
					</div>
				</div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>2.jpg" alt="EXPLORE THE Q30" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="my-infiniti-spacer"></div>
		<hr>
		<div class="link-zone">
			<div class="title">
				<div class="grid-row">
					<div class="col-12">
						<div class="c_004">
							<div class="heading-group"><h2><span>SEE FROM A DIFFERENT PERSPECTIVE</span></h2></div> 
						</div>
					</div>
				</div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>3.jpg" alt="SEE FROM A DIFFERENT PERSPECTIVE - PILOT THE STREETS" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>4.jpg" alt="SEE FROM A DIFFERENT PERSPECTIVE - EXPRESS YOURSELF" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>5.jpg" alt="SEE FROM A DIFFERENT PERSPECTIVE - FIND YOUR POWER" class="my-infiniti-img"></div>
			</div>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pics; ?>6.jpg" alt="SEE FROM A DIFFERENT PERSPECTIVE - CLOSELY CONNECTED" class="my-infiniti-img"></div>
			</div>
		</div>
		<hr>
		<div class="link-zone">
			<div class="title">
				<div class="grid-row">
					<div class="col-12">
						<div class="c_004">
							<div class="heading-group"><h2><span>ANTICIPATE DANGER. REACT WITH POISE.</span></h2></div> 
						</div>
					</div>
				</div>
			</div>
			<div class="grid-row">
				<div class="col-6">
					<div class="c_005">
						<div class="content-half">
							<img src="<?php echo $pics; ?>7.jpg" alt="HEIGHTENED AWARENESS" class="my-infiniti-img">
							<div class="heading-group"><h3><span>HEIGHTENED AWARENESS</span></h3></div>
							<div class="content-group">
								<p>The Around View Monitor elevates your parking perspective, so you can see more clearly as you maneuver in even the tightest spaces. With Moving Object Detection, you're instantly alerted if something enters your vehicle's surrounding area.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="c_005">
						<div class="content-half">
							<img src="<?php echo $pics; ?>8.jpg" alt="STAY ON TRACK" class="my-infiniti-img">
							<div class="heading-group"><h3><span>STAY ON TRACK</span></h3></div>
							<div class="content-group">
								<p>Vehicle Dynamic Control intuitively corrects oversteer or understeer by reducing engine speed and applying the brakes to individual wheels, helping you stay on the steered path.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer"></div>
<div>
	<a class="my-infiniti-btn" href="<?php echo $GLOBALS["URL"]->fullURL; ?>#contact" target="_self">FIND OUT MORE</a>
	<a class="my-infiniti-btn my-infiniti-btn2" href="<?php echo $pics; ?>Q30_UK.pdf" target="_blank">Download a brochure</a>
	<a class="my-infiniti-btn" href="<?php echo $pics; ?>Q30_UK.pdf" target="_blank">Price List</a>
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
	$model = "q30";
	$modelName = "Q30";
	include(INFINITI_VIEWS."_form-en.php"); 
	?>
</div>