<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0; text-align: left;">
			<div class="content-group" style="font-family: 'Infiniti Light','Infiniti Extended Light',Verdana,Arial,sans-serif">
				<p style="text-align: justify;">A Gablini Kft. 1988 óta foglalkozik a gépjármű kereskedelemmel, így jelentős tapasztalattal rendelkezünk a szerviz és az alkatrészellátás területén is. 2009-ben kezdtük meg az Infiniti forgalmazását és szervizelését hazánkban, az eltelt években pedig bizonyítottuk ügyfeleink számára, hogy több a évtizedes tapasztaltunk garancia a gyors, pontos és szakszerű munkavégzésre.</p>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row bleed">
	<div class="col-12">
		<div id="service-slider" class="my-slider">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php for($i = 2; $i <= 5; $i++) { ?><div class="swiper-slide my-slider-item"><img src="<?php echo $pics; ?>galeria/<?php echo $i; ?>.jpg" alt="" class="img-responsive my-slider-item-img"></div><?php } ?>
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
		var homeSlider = new Swiper ("#service-slider .swiper-container", {
			loop: true,
			autoplay: 5000,
			autoHeight: true,
			preventClicks: false,
			preventClicksPropagation: false,
			prevButton: "#service-slider .my-slider-button-prev",
			nextButton: "#service-slider .my-slider-button-next",
			pagination: "#service-slider .my-slider-pagination",
			paginationClickable: true,
		}); 
	});
</script>
<div class="my-infiniti-spacer"></div>
<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0; text-align: left;">
			<div class="content-group" style="font-family: 'Infiniti Light','Infiniti Extended Light',Verdana,Arial,sans-serif">
				<p style="text-align: justify;">Márkaszervizünk a legmodernebb technikával vannak felszerelve és rendelkezünk Infiniti gépkocsijának javításához szükséges összes célszerszámmal, és diagnosztikai műszerrel. Szerelőink mind minősített Infiniti szerelők, folyamatosan vesznek részt a szakirányú oktatásokon, hogy a legújabb technikákat elsajátíthassák. Képzett szerelőink szakértő szemekkel nézik át gépkocsiját, és a szükséges javításokról még a munka megkezdése előtt árajánlatot készítenek Önnek.</p>
			</div>
		</div>
	</div>
</div>

<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-text-center"><a class="my-infiniti-btn my-infiniti-btn-big" href="<?php echo PATH_WEB; ?>szerviz#ajanlatkeres" target="_self">Szerviz bejelentkezés</a></div>
<div class="my-infiniti-spacer"></div>

<div class="grid-row">
	<div class="col-12">
		<div class="pageHeader">
			<div class="c_023">
				<div class="container-inner">
					<div class="c_023-1 default">
						<div class="heading-group"><h1><span>Aktuális szerviz akciók</span></h1></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0; text-align: center;">
			<div class="content-group" style="font-family: 'Infiniti Light','Infiniti Extended Light',Verdana,Arial,sans-serif">
				<a href="<?php echo PATH_WEB; ?>eien" target="_self"><img src="<?php echo PATH_WEB; ?>pics/fokepek/eien.jpg?v=20210825" alt="" class="my-infiniti-img"></a>
				<div class="my-infiniti-spacer"></div>
				<div class="my-infiniti-text-center"><a class="my-infiniti-btn my-infiniti-btn-big" href="<?php echo PATH_WEB; ?>eien" target="_self">Bejelentkezem</a></div>
			</div>
		</div>
	</div>
</div>

<?php /*
<div class="grid-row">
	<div class="content-zone container c_002 content-divider"><hr></div>
</div>

<div class="my-infiniti-spacer"></div>
<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0; text-align: center;">
			<div class="content-group" style="font-family: 'Infiniti Light','Infiniti Extended Light',Verdana,Arial,sans-serif">
				<a href="<?php echo PATH_WEB; ?>eien" target="_self"><img src="<?php echo PATH_WEB; ?>pics/fokepek/atvizsgalas.jpg?v=20200925" alt="" class="my-infiniti-img"></a>
				<div class="my-infiniti-spacer"></div>
				<div class="my-infiniti-text-center"><a class="my-infiniti-btn my-infiniti-btn-big" href="<?php echo PATH_WEB; ?>oszi-atvizsgalas" target="_self">Bejelentkezem</a></div>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
*/ ?>
<div class="grid-row">
	<div class="content-zone container c_002 content-divider"><hr></div>
</div>
<div id="ajanlatkeres"><?php include(INFINITI_VIEWS."_form-service.php"); ?></div>