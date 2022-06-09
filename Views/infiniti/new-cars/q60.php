<?php 
include(INFINITI_VIEWS."newcars-details-top.php"); 

if($carMenuActive == "ajanlatkeres") { include(INFINITI_VIEWS."newcars-details-form.php"); }
else
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>THE HUMAN-RESPONSIVE PERFORMANCE COUPE</span></h2></div>
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="video-container">
				<iframe class="video" src="https://www.youtube.com/embed/huWNqVNqfMU?autoplay=1&mute=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>		
			<div class="my-infiniti-spacer"></div>	
			
			<div class="c_004">
				<div class="heading-group"><h2><span>EMPOWER YOUR PERFORMANCE</span></h2></div>
				<p class="content-copy">We gave it confident curves and a powerful stance. The exhilarating performance of a twin-turbocharged V6 engine and the thrilling responsiveness of the first digitally adaptive handling system.</p>
			</div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<?php for($i = 1; $i <= 6; $i++) { ?>
			<div class="col-4">
				<a href="<?php echo $pics.$i; ?>.jpg" target="_blank" class="fancybox" data-fancybox="gallery"><img src="<?php echo $pics.$i; ?>.jpg" alt="" class="my-infiniti-img"></a>
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
				<div class="heading-group"><h2><span>TURN HEADS</span></h2></div>
			</div>

			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>UNINHIBITED PERFORMANCE</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">This is power through innovation, where advanced technology opens new horizons. Propel every journey with the breathtaking performance that comes with your choice of three engines, including the award-winning 3.0-liter twin-turbo V6 — available with 300 hp or an electrifying 400 hp.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>7.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>DARING DESIGN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Discover a new kind of sports coupe — one with sleek form, aggressive character, and a luxuriously intuitive interior. From the signature headlights to the double-arch grille, every line shapes an emotion. Explore the future of INFINITI design when you experience the 2020 Q60.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>8.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>DRIVE ASSIST TECHNOLOGIES</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Master a new level of ease and confidence with technologies designed for an enhanced drive. Synchronizing driver input, steering response, and chassis control, the first fully digital handling system amplifies your sightline and enhances your reaction times to help you see and avoid danger.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>9.jpg" alt="" class="my-infiniti-img">
			</div>	
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>INTUITIVE CONNECTIVITY</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Escape while staying connected. Q60 offers personalization and connectivity with a class-exclusive dual-screen interactive display. Access your most important mobile apps from the comfort of your seat.</div>
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
				<div class="heading-group"><h2><span>BEHIND THE WHEEL, REDEFINED</span></h2></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>11.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>A NEW STAGE FOR A NEW SOUND WITH BOSE®</span></h3></div>
					<div class="content-group">
						<p>The new Bose® Performance Series debuts on the all-new Q60. Enjoy concert-like sound that envelops you with thirteen speakers, including multiple new woofers and a lightweight silk dome tweeter.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>12.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HANDLE WITH INSTANT ADAPTABILITY</span></h3></div>
					<div class="content-group">
						<p>The all-new Dynamic Digital Suspension adapts to you. With adaptive dampers that can switch instantaneously, enjoy a smooth ride when you want it or agile response when you demand it.</p>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php
}
?>
<div class="my-infiniti-spacer"></div>	
<div class="grid-row" id="my-infiniti-details-top">	
	<div class="col-12" style="text-align: center; font-size: 1.3em;">Az Infinitimagyaroszág továbbra is biztosítja a modellek elérhetőségét és a hivatalos gyári támogatás által nyújtotta szakértelmet. Az Infiniti Center Budapest márkakereskedés és szerviz, a legkorszerűbb technológiákkal várja ügyfeleit, több mint 400 négyzetméteren, a Budapest XV Városkapu u.1. szám alatt.</div>
</div>	
<div class="my-infiniti-spacer"></div>