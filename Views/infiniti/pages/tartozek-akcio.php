<?php 
$tableRows = [
	["Infiniti", "Tetőcsomagtartó / Q30 / QX30 /", "KE7325D510I", " 130 372 Ft ", " 82 176 Ft ", "Gablini Budaörs"],
	["Infiniti", "Tetőcsomagtartó / QX70 /", "KE7321C010I", " 99 607 Ft ", " 65 900 Ft ", "Gablini Budaörs"],
	["Infiniti", "Csomagtér tálca / QX70 /", "KE9651C5S0", " 61 562 Ft ", " 44 324 Ft ", "Gablini Budaörs"],
	["Infiniti", "Textilszőnyeg fekete / JX35 /", "999E2RZ000I", " 66 722 Ft ", " 43 395 Ft ", "Gablini Budaörs"],
	["Infiniti", "Csomagtér tálca / Q50 Hybrid /", "999C3J2001i", " 49 101 Ft ", " 37 491 Ft ", "Gablini Budaörs"],
	["Infiniti", "Textilszőnyeg fekete / Q60 /", "KE7455C001I", " 36 636 Ft ", " 28 045 Ft ", "Gablini Budaörs"],
	["Infiniti", "Textilszőnyeg fekete / QX30 /", "KE7455D084I", " 28 326 Ft ", " 21 549 Ft ", "Gablini Budaörs"],
	["Infiniti", "Textilszőnyeg fekete / Q30 /", "KE7455D081I", " 29 475 Ft ", " 22 787 Ft ", "Gablini M3"],
	["Infiniti", "Nyakpánt", "INF821", " 999 Ft ", " 362 Ft ", "Gablini Budaörs"],
]; 
?>

<div><img src="<?php echo $pics; ?>fokep.jpg?v=2" alt="" class="my-infiniti-img"></div>
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer"></div>

<div class="grid-row">
	<div class="col-12">
		<div class="c_004" style="width: 100%; padding: 0; text-align: center;">
			<div class="heading-group"><h2><span>HAMAROSAN ITT A KARÁCSONY! ÖLTÖZTESSE FEL<br>AUTÓJÁT IGAZÁN HOZZÁ ILLŐ TARTOZÉKOKKAL!</span></h2></div>
			<div class="content-group">
				<p style="font-size: 16px; margin: 15px 0 0 0;"><strong>MOST 20% kedvezményt adunk az akciónkban részt vevő tartozékokból!*</strong></p>
				<p style="font-size: 16px; margin: 15px 0 0 0;">Látogasson el az akcióban résztvevő szalonjaink egyikébe és válasszon autójához megfelelő kiegészítők és shop termékek közül!</p>
			</div>
		</div>
	</div>
</div>	
<div class="my-infiniti-spacer"></div>

<div class="grid-row">
	<div class="col-12">
		<table style="width: 100%; border: 0; border-collapse: collapse; font-size: 15px; line-height: 25px; text-align: left;">
			<thead>
				<tr>
					<th style="padding: 3px 10px;">Márka</th>
					<th style="padding: 3px 10px;">Megnevezés</th>
					<th style="padding: 3px 10px;">Cikkszám</th>
					<th style="width: 120px; padding: 3px 10px; text-align: right;">Listaár</th>
					<th style="width: 120px; padding: 3px 10px; text-align: right;">Akciós ár</th>
					<th style="width: 160px; padding: 3px 10px;">Telephely</th>
				</tr>
			</thead>
			<tbody style="text-align: left;">
				<?php
				foreach($tableRows AS $i => $tableRow)
				{
					?>
					<tr style="<?php if($i % 2 == 0) { ?>background-color: #ebebeb;<?php } ?>">
						<td style="padding: 3px 10px;"><?php echo trim($tableRow[0]); ?></td>
						<td style="padding: 3px 10px;"><?php echo trim($tableRow[1]); ?></td>
						<td style="padding: 3px 10px;"><?php echo trim($tableRow[2]); ?></td>
						<td style="padding: 3px 10px; text-align: right;" ><del style="color: #ccc;"><?php echo trim($tableRow[3]); ?></del></td>
						<td style="padding: 3px 10px; text-align: right; font-weight: bold;"><?php echo trim($tableRow[4]); ?></td>
						<td style="padding: 3px 10px;"><?php echo trim($tableRow[5]); ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer"></div>

<div class="grid-row">
	<div class="col-12">
		<div class="c_004" style="width: 100%; padding: 0; text-align: center;">
			<div class="content-group">
				<p style="font-size: 16px; margin: 0 0 0 0;">A termékek elérhetősége az egyes szalonjainkban nem egységes, így vásárlás előtt legyen kedves érdeklődni a kívánt termék elérhetőségéről.</p>
			</div>
		</div>
	</div>
</div>	

<div class="grid-row">	
	<div class="col-6">
		<div class="my-infiniti-spacer"></div>
		<h3 style="margin: 0; font-weight: bold;">GABLINI M3</h3>
		<p style="font-size: 14px; margin: 7px 0 0 0;">1152 Budapest Városkapu u. 1.</p>
		<p style="font-size: 14px; margin: 7px 0 0 0;"><a href="tel:+3614150206">+36 1 415 02 06</a></p>
		<div class="my-infiniti-spacer"></div>
	</div>
	<div class="col-6">
		<div class="my-infiniti-spacer"></div>
		<h3 style="margin: 0; font-weight: bold;">GABLINI BUDAÖRS</h3>
		<p style="font-size: 14px; margin: 7px 0 0 0;">2040 Budaörs Malomkő u. 2.</p>
		<p style="font-size: 14px; margin: 7px 0 0 0;"><a href="tel:+3623802200">+36 23 802 200</a></p>
		<div class="my-infiniti-spacer"></div>
	</div>
</div>

<div class="grid-row">
	<div class="col-12">
		<div class="c_004" style="width: 100%; padding: 0; text-align: justify;">
			<div class="content-group">
				<p style="font-size: 13px; margin: 0 0 0 0; color: #999;">
					*Az akció érvényes 2021. dec. 13. – dec. 23. között, az alábbi oldalon található tartozékok vásárlása esetén: www.gablini.hu/tartozek-akcio.<br>
					A jelen hirdetés tájékoztató jellegű nem teljes körű és nem minősül ajánlattételnek. A részletes tájékoztatásért forduljon bizalommal a Gablini Csoport márkaszervizeihez!<br>
					Az akció kizárólag a megjelölt termékekre érvényes. A kedvezmény nem vonatkozik, az egyéb akcióban résztvevő termékekre.<br>
					A Gablini Kft. fenntartja magának a jogot, hogy egyes Termékek esetében korlátozza, hogy egy vásárló hány darabot vehet meg azokból a Kampány során.<br>
					A Gablini Kft. fenntartja a jogot, hogy a Kampány időtartama alatt a kedvezménnyel kínált Termékek körét megváltoztassa.<br>
					A kampányban résztvevő termékeket kizárólag személyesen lehet megvásárolni.
				</p>
			</div>
		</div>
	</div>
</div>	