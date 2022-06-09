<?php 
include(INFINITI_VIEWS."newcars-details-top.php"); 

if($carMenuActive == "ajanlatkeres") { include(INFINITI_VIEWS."newcars-details-form.php"); }
else
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>EMPOWER YOUR DRIVE WITH VERSATILITY</span></h2></div>
			</div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<?php for($i = 1; $i <= 6; $i++) { ?>
			<div class="col-4">
				<a href="<?php echo $pics.$i; ?>.jpg" target="_blank" class="fancybox"><img src="<?php echo $pics.$i; ?>.jpg" alt="" class="my-infiniti-img"></a>
				<div class="my-infiniti-spacer"></div>
			</div>
		<?php } ?>	
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>LUXURIOUSLY PRACTICAL</span></h2></div>
			</div>

			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>SEATS UP TO SEVEN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Three rows of seating let QX60 cater for non-stop lives. And with abundant legroom across all rows, a unique sliding-tilting seat gives effortless access to the third row — even with a child seat installed.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>7.jpg" alt="" class="my-infiniti-img">
			</div>		
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>SAFETY AT EVERY SIDE</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">The QX60 gives you a new perspective on what’s around you. Maneuver in even the tightest spaces with object-detection and sonar technologies, and hone your parking prowess with the help of four cameras and a virtual 360° overhead view.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>8.jpg" alt="" class="my-infiniti-img">
			</div>		
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>ENTERTAIN ON THE GO</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Give everyone freedom to experience their own movies, music and games with the Theater Package. Large dual 8-inch headrest monitors, an HDMI port, and wireless headsets expand the fun for your rear passengers, while you and your co-pilot enjoy your favorite playlists up front.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>9.jpg" alt="" class="my-infiniti-img">
			</div>	
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>UNITE POWER WITH CONTROL</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Whether you choose the impressive 3.5-liter V6 engine or the equally responsive INFINITI Direct Response Hybrid®, harness Intelligent All-Wheel Drive to keep you in total control of the drive.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>10.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>ENHANCE YOUR SENSES</span></h2></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>11.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HEIGHTENED AWARENESS</span></h3></div>
					<div class="content-group">
						<p>The Around View Monitor elevates your parking perspective, so you can see more clearly as you maneuver in even the tightest spaces. With Moving Object Detection, you’re instantly alerted if something enters your vehicle’s surrounding area.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>12.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>BACKUP WITH CONFIDENCE</span></h3></div>
					<div class="content-group">
						<p>Backup Collision Intervention can help you avoid a collision. As you reverse, the system senses what might sit beyond your line of sight, warning you if an object is detected behind your vehicle, and applying the brakes if impact is imminent.</p>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php
}
?>