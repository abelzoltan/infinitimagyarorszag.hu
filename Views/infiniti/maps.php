<div id="map" style="padding-top: 40%;"></div>

<div class="grid-row">
	<div class="col-6">
		<div class="c_005">
			<div class="my-infiniti-spacer"></div>
			<div class="content-half" style="background-color: #f2f2f2; padding: 10px;">
				<img src="<?php echo $pics; ?>15.jpg" alt="" class="my-infiniti-img">
				<div class="heading-group"><h3 style="margin-top: 0; font-weight: bold; font-size: 200%;"><span>INFINITI CENTER BUDAÖRS</span></h3></div>
				<div class="content-group" style="font-size: 120%;">
					<p style="margin: 0 0 0 0;">2040 Budaörs Malomkő u. 2.</p>
					<p style="margin: 10px 0 0 0;"><a href="tel:+3623802233" style="text-decoration: none; font-weight: bold;">+36 23 802 233</a></p>
					<div class="my-infiniti-spacer"></div>
					<p style="margin: 0 0 0 0; font-size: 150%; font-weight: bold;">NYITVA TARTÁS</p>
					<p style="margin: 10px 0 0 0;">H-CS: 07:00 - 18:00</p>
					<p style="margin: 5px 0 0 0;">P: 07:00 - 17:00</p>
					<p style="margin: 5px 0 0 0;">Szo-V: zárva</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6">
		<div class="c_005">
			<div class="my-infiniti-spacer"></div>
			<div class="content-half" style="background-color: #f2f2f2; padding: 10px;">
				<img src="<?php echo $pics; ?>15.jpg" alt="" class="my-infiniti-img">
				<div class="heading-group"><h3 style="margin-top: 0; font-weight: bold; font-size: 200%;"><span>INFINITI CENTER BUDAPEST</span></h3></div>
				<div class="content-group" style="font-size: 120%;">
					<p style="margin: 0 0 0 0;">1134 Budapest Váci út 45.</p>
					<p style="margin: 10px 0 0 0;"><a href="tel:+3617992250" style="text-decoration: none; font-weight: bold;">+36 1 799 2250</a></p>
					<div class="my-infiniti-spacer"></div>
					<p style="margin: 0 0 0 0; font-size: 150%; font-weight: bold;">NYITVA TARTÁS</p>
					<p style="margin: 10px 0 0 0;">H-P: 09:00 - 18:00</p>
					<p style="margin: 5px 0 0 0;">Szo: 10:00 - 14:00</p>
					<p style="margin: 5px 0 0 0;">V: zárva</p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function map()
{
	// Map
	var mapDefaultZoom = 11;
	var mapDefaultCenter = {lat: 47.506690, lng: 19.044920};
	
	var map = new google.maps.Map(document.getElementById("map"), {
		zoom: mapDefaultZoom,
		center: mapDefaultCenter,
	});
	
	// Marker #1
	var marker1 = new google.maps.Marker({
		map: map,
		position: {lat: 47.452313, lng: 18.969987},
		icon: "<?php echo PATH_WEB; ?>pics/terkep-jelolo.png",
	});
	
	var infoWindow1 = new google.maps.InfoWindow({
		content: '<strong>INFINITI CENTER BUDAÖRS</strong><br>2040 Budaörs Malomkő u. 2.',
	});
	
	marker1.addListener("click", function() {
		currentZoom = map.getZoom();
		map.setZoom(currentZoom + 2);
		map.panTo(marker1.position);
		infoWindow1.open(map, marker1);
	});
	
	google.maps.event.addListener(infoWindow1, "closeclick", function(){
	   map.setZoom(mapDefaultZoom);
	   map.setCenter(mapDefaultCenter);
	});
	
	// Marker #2
	var marker2 = new google.maps.Marker({
		map: map,
		position: {lat: 47.566771, lng: 19.151637},
		icon: "<?php echo PATH_WEB; ?>pics/terkep-jelolo.png",
	});

	var infoWindow2 = new google.maps.InfoWindow({
		content: '<strong>INFINITI CENTER BUDAPEST</strong><br>1134 Budapest Váci út 45.',
	});
	
	marker2.addListener("click", function() {
		currentZoom = map.getZoom();
		map.setZoom(currentZoom + 2);
		map.panTo(marker2.position);
		infoWindow2.open(map, marker2);
	});
	
	google.maps.event.addListener(infoWindow2, "closeclick", function(){
	   map.setZoom(mapDefaultZoom);
	   map.setCenter(mapDefaultCenter);
	});
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvzUaeVZA1XXfIA7Udp7cFrarejQcjFDA&callback=map"></script>