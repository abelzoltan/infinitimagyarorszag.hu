<?php 
if($GLOBALS["URL"]->routes[0] == "contact-thank-you")
{
	?>
	<div class="grid-row">	
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Thank you for your contact!</span></h2></div>
				<p class="content-copy">We are going to get in touch as soon as possible!</p>
			</div>
		</div>
	</div>
	<?php
}
elseif($GLOBALS["URL"]->routes[0] == "visszahivas-koszonjuk")
{
	?>
	<div class="grid-row">	
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Köszönjük, hogy megtisztel minket bizalmával!</span></h2></div>
				<p class="content-copy">Munkatársunk hamarosan keresni fogja Önt a megadott telefonszámon!</p>
			</div>
		</div>
	</div>
	<?php
}
else
{
	if($VIEW["vars"]["contact"]["data"]->contactType == "online-ertekesites")
	{
		?>
		<div class="grid-row">	
			<div class="col-12">
				<div class="c_004">
					<div class="heading-group"><h2><span>Köszönjük, hogy Infiniti <?php if(!empty($VIEW["vars"]["contact"]["data"]->modelName)) { echo $VIEW["vars"]["contact"]["data"]->modelName." modellünk"; } else { ?>modelljeink<?php } ?> iránt érdeklődik!</span></h2></div>
					<p class="content-copy">
						Kollegáink 30 percen belül keresni fogják a megadott Skype elérhetőségén.<br><br>
						Üdvözlettel,<br>
						Infiniti Magyarország
					</p>
				</div>
			</div>
		</div>
		<?php
	}
	else
	{
		?>
		<div class="grid-row">	
			<div class="col-12">
				<div class="c_004">
					<div class="heading-group"><h2><span>Az űrlap kitöltése sikeresen megtörtént!</span></h2></div>
					<p class="content-copy">Amennyiben szükséges, munkatársunk hamarosan felveszi Önnel a kapcsolatot!</p>
				</div>
			</div>
		</div>
		<?php if(isset($pic)) { ?>
			<div class="grid-row bleed">
				<div class="col-12"><img src="<?php echo $pic; ?>" alt="<?php echo $VIEW["title"]; ?>" class="my-infiniti-img"></div>
			</div>
		<?php } elseif(isset($car)) { ?>
			<div class="grid-row bleed">
				<div class="col-12">
					<a href="<?php echo setLink($car["url"]); ?>" id="my-infiniti-details-img"><img src="<?php echo $car["picSrc"]; ?>" alt="<?php echo $car["name"]; ?>"></a>
				</div>
			</div>	
		<?php } 
	}
}
?>
