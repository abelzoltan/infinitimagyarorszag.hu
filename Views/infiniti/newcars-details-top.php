<style scoped>#my-infiniti-page-header { display: none; }</style>
<div class="my-infiniti-spacer"></div>
<div class="grid-row" id="my-infiniti-details-top">	
	<div class="col-6" style="text-align: left;">
		<div class="heading-group"><h1><strong><?php echo $VIEW["title"]; ?></strong></h1></div>
	</div>
	<div class="col-6" style="text-align: right;">
		<div class="my-infiniti-details-menu">
			<a class="my-infiniti-btn" href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>" target="_self">Ajánlatkérés / Tesztvezetés</a>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row bleed">
	<div class="col-12"><img src="<?php echo $pics; ?>fokep.jpg?v=20201214" alt="<?php echo $VIEW["title"]; ?>" class="my-infiniti-img"></div>
</div>
<div id="my-infiniti-car-menubar">
	<div class="my-infiniti-car-menu">
		<div class="grid-row">
			<div class="col-12">
				<div class="my-infiniti-car-menu-content">
					<?php foreach($carMenu AS $carMenuKey => $carMenuItem) { ?>
					<span class="my-infiniti-car-menu-separator"></span>
					<a href="<?php echo $carMenuItem["url"]; ?>" target="_self" class="my-infiniti-car-menu-item<?php if($carMenuKey == "ajanlatkeres") { ?> my-infiniti-car-menu-item-offer<?php } if($carMenuKey == $carMenuActive) { ?> my-infiniti-car-menu-item-active<?php } ?>"><?php echo $carMenuItem["name"]; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
</div>
<script>
$(document).ready(function(){ 
	setTimeout(function(){
		var modelMenu = $("#my-infiniti-car-menubar");
		var modelMenuTop = modelMenu.offset().top;

		$(window).scroll(function(){  
			if($(window).scrollTop() > modelMenuTop) { modelMenu.addClass("my-infiniti-car-menubar-fixed"); }
			else { modelMenu.removeClass("my-infiniti-car-menubar-fixed"); }  
		});
	}, 1000);
});
</script>
<?php if(!isset($GLOBALS["URL"]->routes[1])) { ?>
	<a class="my-infiniti-btn" href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>" target="_self">Ajánlatkérés / Tesztvezetés</a>
	<div class="my-infiniti-spacer"></div>
<?php } ?>