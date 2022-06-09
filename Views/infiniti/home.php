<div class="grid-row bleed">
	<div class="col-12">
		<div id="home-slider" class="my-slider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php /*<div class="swiper-slide my-slider-item"><a href="<?php echo PATH_WEB; ?>black-friday" class="my-slider-item-link" target="_self"><img src="<?php echo PATH_WEB; ?>/pics/fokepek/black-friday-2021.jpg" alt="Black Friday" class="img-responsive my-slider-item-img"></a></div>*/ ?>
					<div class="swiper-slide my-slider-item"><a href="<?php echo PATH_WEB; ?>szerviz#ajanlatkeres" class="my-slider-item-link" target="_self"><img src="<?php echo PATH_WEB; ?>/pics/fokepek/premium-program.jpg" alt="Infiniti Prémium Program" class="img-responsive my-slider-item-img"></a></div>
					<div class="swiper-slide my-slider-item"><a href="<?php echo PATH_WEB; ?>eien" class="my-slider-item-link" target="_self"><img src="<?php echo PATH_WEB; ?>/pics/fokepek/eien.jpg?v=20210825" alt="Infiniti Eien" class="img-responsive my-slider-item-img"></a></div>
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
<div class="grid-row">
	<div class="col-12">
		<div class="my-infiniti-spacer"></div>
		<div class="pageHeader">
			<div class="c_023 " style="padding: 0;">
				<div class="container-inner">
					<div class="c_023-1 default">
						<div class="heading-group"><h1><span>Információk</span></h1></div>
					</div>
				</div>
			</div>
		</div>
		<div class="my-infiniti-spacer"></div>
		<img src="<?php echo PATH_WEB; ?>pics/maszk2.png" alt="" class="img-responsive center" style="cursor: pointer;" onclick="window.open('https://gablini.hu/mobilitas', '_blank')">
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row bleed">
	<div class="col-3" style="padding: 0;">
		<div class="c_027 grid-row">
			<div><img src="<?php echo $pics; ?>1.jpg" alt="Ügyfélinformációk"></div>
			<div>
				<div class="heading-group"><h3><span>Ügyfélinformációk<br>&nbsp;</span></h3></div>
				<div class="content-group"><a href="<?php echo PATH_WEB; ?>ugyfelinformaciok" target="_self">Részletek</a></div>
			</div>
		</div>
	</div>
	<div class="col-3" style="padding: 0;">
		<div class="c_027 grid-row">
			<div><img src="<?php echo $pics; ?>2.jpg" alt="Erőteljes elegancia"></div>
			<div>
				<div class="heading-group"><h3><span>Erőteljes elegancia<br>&nbsp;</span></h3></div>
				<div class="content-group"><a href="<?php echo PATH_WEB; ?>eroteljes-elegancia" target="_self">Részletek</a></div>
			</div>
		</div>
	</div>
	<div class="col-3" style="padding: 0;">
		<div class="c_027 grid-row">
			<div><img src="<?php echo $pics; ?>3.jpg" alt="Erő és teljesítmény"></div>
			<div>
				<div class="heading-group"><h3><span>Erő és teljesítmény<br>&nbsp;</span></h3></div>
				<div class="content-group"><a href="<?php echo PATH_WEB; ?>ero-es-teljesitmeny" target="_self">Részletek</a></div>
			</div>
		</div>
	</div>
	<div class="col-3" style="padding: 0;">
		<div class="c_027 grid-row">
			<div><img src="<?php echo $pics; ?>4.jpg" alt="Világelső technológiák"></div>
			<div>
				<div class="heading-group"><h3><span>Világelső technológiák</span></h3></div>
				<div class="content-group"><a href="<?php echo PATH_WEB; ?>vilagelso-technologiak" target="_self">Részletek</a></div>
			</div>
		</div>
	</div>
</div>