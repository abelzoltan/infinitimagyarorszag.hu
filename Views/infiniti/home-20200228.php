<div class="grid-row bleed">
	<div class="col-12">
		<div id="home-slider" class="my-slider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide my-slider-item"><img src="<?php echo PATH_WEB; ?>pics/fokepek/elkoltoztunk.jpg" alt="Elköltöztünk" class="img-responsive my-slider-item-img"></div>
					<div class="swiper-slide my-slider-item"><a href="<?php echo PATH_WEB; ?>q30" class="my-slider-item-link" target="_self"><img src="<?php echo CDN_WEB; ?>uj-autok/q30/fokep.jpg?v=20190911" alt="Infiniti Q30" class="img-responsive my-slider-item-img"></a></div>
					<div class="swiper-slide my-slider-item"><a href="<?php echo PATH_WEB; ?>q50" class="my-slider-item-link" target="_self"><img src="<?php echo CDN_WEB; ?>uj-autok/q50/fokep.jpg?v=20190911" alt="Infiniti Q50" class="img-responsive my-slider-item-img"></a></div>
				</div>
				<div class="my-slider-pagination swiper-pagination"></div>
			</div>
			<div class="my-slider-button my-slider-button-prev"><i class="fa fa-angle-left"></i></div>
			<div class="my-slider-button my-slider-button-next"><i class="fa fa-angle-right"></i></div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var homeSlider = new Swiper ("#home-slider .swiper-container", {
			loop: true,
			autoplay: 5000,
			autoHeight: true,
			preventClicks: false,
			preventClicksPropagation: false,
			prevButton: "#home-slider .my-slider-button-prev",
			nextButton: "#home-slider .my-slider-button-next",
			pagination: "#home-slider .my-slider-pagination",
			paginationClickable: true,
		}); 
	});
</script>
<div class="my-infiniti-spacer"></div>
<?php 
if(date("Y-m-d") < date("2019-12-06"))
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_023">
				<div class="container-inner">
					<div class="c_023-1 default">
						<div class="heading-group"><h1><span>Tisztelt Ügyfeleink!</span></h1></div>
						<div class="content-group">
							<p style="font-size: 1.5em; line-height: 150%;">
								Városkapu utcai bemutatótermünk rendezvény miatt, december 3, 4, és 5-én zárva tart.<br>
								Az értékesítés, a munkafelvétel, és a szerviz az időszak alatt zavartalanul üzemel.<br>
								A gépkocsik a telephelyen megtekinthetők.<br>
								Infiniti Center Budapest
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="my-infiniti-spacer"></div>
	<?php
}
?>
<div class="grid-row">
	<div class="col-12">
		<div class="pageHeader">
			<div class="c_023 " data-adobe-target-id="">
				<div class="container-inner">
					<div class="c_023-1 default">
						<div class="heading-group"><h1><span>Új autók</span></h1></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$carList = $newCarList;
include(INFINITI_VIEWS."newcars-list.php"); 
?>
<div class="grid-row">
	<div class="col-12">
		<div class="pageHeader">
			<div class="c_023 " data-adobe-target-id="">
				<div class="container-inner">
					<div class="c_023-1 default">
						<div class="heading-group"><h1><span>Készleteink</span></h1></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$carList = $oldCarList;
include(INFINITI_VIEWS."oldcars-list.php"); 
?>