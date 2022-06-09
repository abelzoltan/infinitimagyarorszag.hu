<?php 
include(INFINITI_VIEWS."newcars-details-top.php"); 

if($carMenuActive == "ajanlatkeres") { include(INFINITI_VIEWS."newcars-details-form.php"); }
elseif($carMenuActive == "tartozekok") 
{ 
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>TARTOZÉKOK</span></h2></div>
			</div>
		</div>
	</div>	
	<div class="my-infiniti-spacer"></div>
	<?php
	include(INFINITI_VIEWS."newcars-details-accessories.php"); 
}
elseif($carMenuActive == "teljesitmeny")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Q50 TELJESÍTMÉNY ÉS ERŐ</span></h2></div>
				<p class="content-copy">A Q50-et úgy terveztük, hogy motivációt nyújtson a vezetéshez, és magabiztossá tegye az utakon. Élje át a szenvedélyt, és tudja meg, meddig képes elmenni.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>7.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>MOTOR</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>A VEZETÉSI STÍLUSÁHOZ ILLŐ TELJESÍTMÉNY</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Az INFINITI Q50 egész koncepciója a vérpezsdítő innovációra épül: a 364 lóerős INFINITI Direct Response Hybrid® rendszer lényegéből fakad a lenyűgöző teljesítmény. A hibrid technológia kihasználja az alapesetben elvesző teljesítményt azáltal, hogy elektromossággá alakítja a mozgási energiát, majd lítium-ion alapú akkumulátorrendszerben tárolja, és gyorsítás közben felhasználja azt – így azonnali elektronikus nyomatékot biztosít a hátsó kerekeknek.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>8.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>ALVÁZ</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>TÖKÉLETESEN EGYENSÚLYBAN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Az intelligens összkerékmeghajtású rendszer¹ lehetővé teszi a megszakítás nélküli haladást. Ideális útviszonyok esetén a hátsó kerekekhez irányítja a nyomatékot, így lehetővé teszi az agilis, sportos vezetést. Amikor jobb tapadásra van szükség, a nyomaték 50 százalékát áthelyezi az első kerekekre, így gondoskodik a jobb irányíthatóságról.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>9.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>KORMÁNYMŰ</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>			
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6"><img src="<?php echo $pics; ?>10.jpg" alt="" class="my-infiniti-img"></div>
		<div class="col-6">
			<div class="c_005">
				<div class="heading-group"><h2><span>KÖNNYED ÉS PONTOS</span></h2></div>
				<div class="content-group" style="font-size: 15px; margin-top: 15px;">Tartsa még inkább az irányítása alatt az autót a világ első digitális kormányművével. A közvetlen adaptív kormányzás (Direct Adaptive Steering – DAS) érzékeli az útviszonyokat, és folyamatosan, másodpercenként kiigazításokat végez, hogy a kanyarodás még pontosabb lehessen.</div>
			</div>
		</div>
	</div>	
	
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>11.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ALKALMAZKODIK A SEBESSÉGHEZ</span></h3></div>
					<div class="content-group">
						<p>A standard hidraulikus kormányműnek köszönhetően könnyedén manőverezhet. Ez az erős fogasléces rendszer alkalmazkodik a jármű tempójához. Parkolás közben lazább, míg nagyobb sebességnél feszesebb a reakció.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>12.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SZABJA MEG A VEZETÉSI STÍLUST</span></h3></div>
					<div class="content-group">
						<p>Szabja személyre a kormányzást. A Rack elektronikus szervókormány¹ erre is lehetőséget ad. Válassza a Standard módot a kényelmes vezetésért. Váltson Sport módra a gyorsabb reakcióért. Az elektronikus rásegítés minden pillanatot élvezhetőbbé tesz.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>13.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>A VÁLASZTÁS SZABADSÁGA</span></h3></div>
					<div class="content-group">
						<p>Finomhangolja a Q50 reakcióit az üzemmódválasztóval. Válasszon hat különböző üzemmód közül, vagy szabja személyre saját, egyedi üzemmódját. Q50-e hozzáigazítja a motor, a felfüggesztés, a sebességváltó és a kormánymű beállításait, így passzolni fog a választásához és a hangulatához.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
elseif($carMenuActive == "formavilag")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>A Q50 FORMATERVE ÉS STÍLUSVILÁGA</span></h2></div>
				<p class="content-copy">Az INFINITI formatervének lelke az erőteljes elegancia. A merész és agresszív, mégis aprólékosan kifinomult Q50 a megállíthatatlan teljesítmény és a modern emberi művészet találkozópontja. Mikor belép, úgy érzi majd, semmi sem állhatja útját az utakon.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>14.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>STÍLUS</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>NE MARADJON ÉSZREVÉTLEN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Adjon új értelmet annak, hogy "mély benyomást tenni". A Q50 sajátságos, megkülönböztető INFINITI megjelenésével sehol nem marad észrevétlen. A kettős ívű motorháztetőtől a holdsarlóra emlékeztető hátsó ablakig figyelemfelkeltésre tervezték ezt a prémium sportszedánt.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>?tesztvezetes=1" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Jelentkezzen tesztvezetésre</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>15.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>16.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>MUTASSA MEG MAGÁT</span></h3></div>
					<div class="content-group">
						<p>Alacsony, széles, dinamikus kialakítású padlójának köszönhetően a Q50 kiválóan tud teljesíteni az utakon. A csomag három alumínium keréktárcsával lesz teljes, melyek világgá kiáltják a nagy teljesítményt, bármerre jár is az autó.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>17.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ELEGÁNSAN FELFORGATÓ</span></h3></div>
					<div class="content-group">
						<p>Sportos első lökhárítója vizuális megszakítás nélkül olvad egybe az autó fényűző, hullámzó vonalaival. Az agresszíven áramvonalas és minden porcikájában kifinomult Q50 méltóságteljesen gördül az utakon.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-12">
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>KÉZZEL KÉSZÜLT EGYEDISÉG</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q50 az egyedi stílus megtestesítője. Elöl, középen helyezkedik el a kettős ívű hűtőrács. Ízléses krómbetétei és kifinomult textúrái egyedi módon sugározzák az Ön egyéniségét.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>18.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>19.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>MINDEN FÉNYBE BORUL</span></h3></div>
					<div class="content-group">
						<p>A jellegzetes INFINITI fényszórók fénybe borítanak mindent, így Ön éjjel-nappal jól látható lesz. Jellegzetes félhold alakjukkal elegánsan belesimulnak a Q50 erős vállvonalába.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>20.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>NYÚJTSON INSPIRÁCIÓT AZ ÖN MÖGÖTT HALADÓKNAK</span></h3></div>
					<div class="content-group">
						<p>A csillogó csomagtartódíszléctől a megújult hátsó lökhárítóig a teljes vonalvezetés a Q50 sportos kinézetét emeli ki. Az egészet a továbbfejlesztett, a jellegzetes első fényszóró formáját tükröző hátsó fényszóró fogja egységbe. Így mindenhol merész benyomást hagy maga után, miközben következő úti célja felé tart.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-12">
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>LUXUS, MELYTŐL FELNYÍLIK A SZEM</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Fényűző anyagok, jól megtervezett ergonómia, aprólékos kézi munka: a Q50-nel belefeledkezhet a vezetésbe.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>21.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>22.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>TARTSA MÉG BIZTOSABBAN A KORMÁNYT</span></h3></div>
					<div class="content-group">
						<p>A sportautók ihlette kormánykerékkel Ön még szenvedélyesebben vezethet. A természetes, a kéz alakjára tervezett markolattal a manőverezés könnyű és ösztönös. Ragadja meg a hozzá passzoló, ugrásra kész érzetet keltő, bőrborítású váltógombot. Aztán gyorsítson, és törje át a korlátokat.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>23.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>KÉNYELEM MEGALKUVÁS NÉLKÜL</span></h3></div>
					<div class="content-group">
						<p>Vezetés közben fontos, hogy ellazult állapotban legyen. A Q50 üléseit úgy terveztük, hogy az elősegítse a természetes testtartást. Hogy az utasai is kényelmesen utazhassanak, még jobban kipárnáztuk a középkonzol oldalát térdmagasságban.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>24.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>AZ ÖRDÖG A RÉSZLETEKBEN REJLIK</span></h3></div>
					<div class="content-group">
						<p>Rendkívüli dupla varrás díszíti a műszerfal tetejét, az alsó konzolt és a váltógombot. Prémium anyagok és díszítőbetétek teszik még elegánsabbá a belsőt. Finomhangolja szabadon autója küllemét.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>GALÉRIA</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>			
			<img src="<?php echo $pics; ?>25.jpg" alt="" class="my-infiniti-img">
		</div>
	</div>
	<div class="grid-row">
		<?php for($i = 26; $i <= 34; $i++) { ?>
		<div class="col-4">
			<div class="my-infiniti-spacer"></div>			
			<a href="<?php echo $pics.$i; ?>.jpg" target="_self" class="fancybox" data-fancybox="gallery"><img src="<?php echo $pics.$i; ?>.jpg" alt="" class="my-infiniti-img"></a>
		</div>
		<?php } ?>
	</div>
	<?php
}
elseif($carMenuActive == "biztonsag")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Q50 BIZTONSÁG ÉS IRÁNYÍTÁS</span></h2></div>
				<p class="content-copy">A Q50-et úgy terveztük, hogy segítse a környezete érzékelését, így Ön magabiztosabban vezethet. Modern vezetéstámogató technológiákat¹ építettünk ebbe a sportszedánba, hogy az autó legalább annyira biztonságos legyen, mint amennyire vérpezsdítő.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>35.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-6"><img src="<?php echo $pics; ?>36.jpg" alt="" class="my-infiniti-img"></div>
		<div class="col-6">
			<div class="c_005">
				<div class="heading-group"><h2><span>ÉRZÉKELJEN TÖBBET A VILÁGBÓL</span></h2></div>
				<div class="content-group" style="font-size: 15px; margin-top: 15px;">A Q50-ben vezetéstámogató technológiáink¹ csak az Ön parancsára várnak; segítik, hogy távolabb láthasson, és gyorsabban reagálhasson.</div>
			</div>
		</div>
	</div>	
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>TUDJON MEG TÖBBET A VEZETÉSTÁMOGATÓ TECHNOLÓGIÁKRÓL</span></h2></div>
			</div>	
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>37.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>KÖZVETLEN ADAPTÍV KORMÁNYZÁS</span></h3></div>
					<div class="content-group">
						<p>Szabja testre a kormányzást a világ első digitális kormányművével. Élvezze a jobb kormányozhatóságot és a kormányrázás csökkenését.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>38.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>INTELLIGENS TÁVOLSÁG- ÉS SEBESSÉGTARTÓ AUTOMATIKA</span></h3></div>
					<div class="content-group">
						<p>Állítsa be a tempót, és induljon. A Q50 megtartja a kívánt távolságot. Automatikusan lassít, mikor a forgalom lassul. Majd visszagyorsít, ha újra szabaddá válik az út.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-row">	
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>39.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ÜTKÖZÉST MEGAKADÁLYOZÓ TOLATÓRENDSZER</span></h3></div>
					<div class="content-group">
						<p>Tolasson magabiztosabban. Q50-e érzékeli a jármű mögött levő tárgyakat tolatás közben, és leállítja az autót, ha egy jármű vagy egy nagy tárgy közeledik.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>40.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>PREDIKTÍV RÁFUTÁSOS ÜTKÖZÉSEKRE FIGYELMEZTETŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Számítson arra, ami az útjában lesz. A Q50 figyelemmel kíséri az előtte haladó két autót, és figyelmezteti a lehetséges frontális ütközésre, hogy Ön megfelelően reagálhasson.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>41.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HOLTTÉRFIGYELŐ ÉS A HOLTTÉRBEN HALADÓ JÁRMŰVEL VALÓ ÜTKÖZÉST MEGAKADÁLYOZÓ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Lásson többet a periférián. A szenzorok érzékelik, ha valami belép a holtterébe. Ha sávváltásba kezd, a Q50 figyelmeztető hangjelzést ad, és egy apró kormánymozdulattal segít visszatéríteni az autót a sávba.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>42.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SÁVELHAGYÁSRA FIGYELMEZTETŐ RENDSZER ÉS SÁVELHAGYÁST MEGELŐZŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Tartsa az irányt. A Q50 figyeli az útburkolati jeleket, figyelmezteti a Önt, ha kezd kisodródni a sávjából, és segít visszatérni a sáv közepére.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>43.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ÜTKÖZÉS ELŐTTI VÉSZFÉKEZŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Reagáljon egy szempillantás alatt. Ha fennáll a veszély, hogy beleütközik az előtte haladó járműbe, a Q50 elveszi a gázt, és fékez. Így segít elkerülni az ütközést, vagy legalább csökkenti az erősségét.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>44.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>AKTÍV SÁVTARTÓ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Erős oldalszélben és egyenetlen úttesten is maradjon a sávjában. Q50-e kiértékeli a körülményeket, és szükség esetén kis mértékben korrigálja a kormány állását.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>TOVÁBBI BIZTONSÁGI FUNKCIÓK</span></h2></div>
			</div>	
		</div>
	</div>
	
	<div class="grid-row">
		<div class="col-6"><img src="<?php echo $pics; ?>45.jpg" alt="" class="my-infiniti-img"></div>
		<div class="col-6">
			<div class="c_005">
				<div class="heading-group"><h2><span>KAPJON TELJES KÉPET</span></h2></div>
				<div class="content-group" style="font-size: 15px; margin-top: 15px;">Szűk helyen is manőverezzen könnyedén. A panoráma monitor (AVM)¹ 360°-os madártávlati virtuális kompozitképet ad a környezetéről valós időben. Többet lát, és így könnyebben kikerülhet a szoros helyzetekből.</div>
			</div>
		</div>
	</div>	
	
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>46.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>FÉNYBE BORUL AZ ÚTJA</span></h3></div>
					<div class="content-group">
						<p>Ön nem láthatja, mi várja a kanyar után, a Q50 azonban bizonyos értelemben igen. Az adaptív első fényszórórendszer úgy javítja a látásviszonyokat, hogy út közben arra irányítja a fényszórókat, amerre Ön a kormányt tekeri. Lásson többet maga előtt - és a sarkon túl is.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>47.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>A FILIGRÁNABB ERŐSEBB</span></h3></div>
					<div class="content-group">
						<p>A Q50-et ultra erős acél felhasználásával építettük, hogy ütközés esetén jobb védelmet biztosítson. Ez kétszer olyan erős, mint a hagyományos acél - és könnyebb is. Így növeli a biztonságot, mégsem lassítja le az autót.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>BIZTONSÁG EGYENLŐ ELŐRELÁTÁS</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Legyen több mint felkészült. Legyen proaktív. Az INFINITI 1989 óta egy sor világelső, az autó irányíthatóságát elősegítő technológiát fejlesztett ki. A Q50-ben megjelenik a legtöbb modern innovációnk. Így az Ön kezébe kerül az irányítás.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>48.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<?php
}
elseif($carMenuActive == "csatlakoztathatosag")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Q50 CSATLAKOZTATHATÓSÁG</span></h2></div>
				<p class="content-copy">A Q50-ben nem szakad el a külvilágtól vezetés közben sem. Az utastér modern technológiáival kapcsolatban marad a levelezésével, tartalmaival és navigációval, bármilyen messze is utazna.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>49.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>KOPPINTSON, HOGY BELÉPHESSEN AZ INFINITI INTOUCH VILÁGÁBA</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6"><img src="<?php echo $pics; ?>50.jpg" alt="" class="my-infiniti-img"></div>
		<div class="col-6">
			<div class="c_005">
				<div class="heading-group"><h2><span>RUGALMAS CSATLAKOZTATHATÓSÁG</span></h2></div>
				<div class="content-group" style="font-size: 15px; margin-top: 15px;">A hangja nem veszhet a semmibe. Az INFINITI InTouch-ot úgy terveztük, hogy figyeljen. Lépjen vele kapcsolatba hangparancs, a Contoller vagy a kettős érintőképernyő útján. Az INFINITI InTouch-csal több mindent elintézhet, miközben a dolgai után jár.</div>
			</div>
		</div>
	</div>	
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>51.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>TÖKÉLETES EGYSZERŰSÉG</span></h3></div>
					<div class="content-group">
						<p>Az intuitív INFINITI InTouch¹ rendszer sokféle alkalmazáshoz és szolgáltatáshoz biztosít hozzáférést, hogy még kellemesebben teljen az út. Mielőtt útnak indulna, egyszerűen koppintson, húzza oldalra, csippentse össze vagy csúsztassa szét az ujjait. Az érintőképernyőt a telefonoknál megszokott módon kell kezelni.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>52.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>TÜKRÖZI AZ EGYÉNISÉGÉT</span></h3></div>
					<div class="content-group">
						<p>Finomhangolja Q50-e belterét, hogy a lehető legpraktikusabb és kényelmesebb legyen. Az INFINITI InTouch-csal könnyedén beállíthatja a hőmérsékletet, audiovizuális kívánságait, a navigációt, stb. Akár 200 beállítást is eltárolhat, így a vezetés valóban élmény lesz.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>53.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>AUTOMATIKUSAN FELISMERI ÖNT</span></h3></div>
					<div class="content-group">
						<p>A Q50 Önre van szabva, illetve bárkire, akinek átengedi a kormányt. Az intelligens kulcs megjegyzi a beállításokat. Mikor kinyitja az ajtókat, minden beállítás automatikusan Önhöz igazodik. Mindezt az intelligens kulcs hozza működésbe.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>SZEMÉLYRE SZÓLÓ ÜDVÖZLÉS</span></h2></div>
				<p class="content-copy">A praktikusan a váltógomb felett elhelyezett kettős érintőképernyőn számos eszközt és sok tartalmat átnézhet.</p>
			</div>	
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>54.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SZEMÉLYRE SZÓLÓ ÜDVÖZLÉS</span></h3></div>
					<div class="content-group">
						<p>Induljon az utazás egy személyre szabott üdvözlőkéernyővel, melyen az Ön neve látható.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>55.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ALKALMAZÁSAI EGY HELYEN</span></h3></div>
					<div class="content-group">
						<p>Férjen hozzá alkalmazásaihoz a kezdőképernyőn. Rendezze őket a használat gyakorisága alapján.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>56.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ÁLLÍTSA BE ÚTVONALÁT</span></h3></div>
					<div class="content-group">
						<p>Hívja be navigációs térképét egy pillanat alatt. Lássa át a környék képét.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>57.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SZABJA SZEMÉLYRE A NAVIGÁCIÓT</span></h3></div>
					<div class="content-group">
						<p>Koppintson a navigációs menüre, miközben nyitva van a térkép, és módosítsa a beállításokat.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>58.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ÖSSZHANGBAN AZ ESZKÖZÉVEL</span></h3></div>
					<div class="content-group">
						<p>Válassza meg Bluetooth® beállításait, és játssza le zenéit a telefonjáról.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>59.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HANG ÁLTALI KAPCSOLAT</span></h3></div>
					<div class="content-group">
						<p>A rendszer hangparancsokkal irányítható, így az Ön keze szabad marad vezetés közben.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>NEM KELL ELSZAKADNIA A VILÁGÁTÓL</span></h2></div>
			</div>	
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>60.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>MERÜLJÖN EL A KRISTÁLYTISZTA HANGOKBAN</span></h3></div>
					<div class="content-group">
						<p>Teremtse meg az utazás hangulatát. A Bose® Performance Series-szel 16 hangszóró burkolja be a tökéletes surround hangzású zenével. Akár a telefonjáról játssza le a zenét Bluetooth®-szal, akár kábeles kapcsolaton át, a zene minden üteme kristálytisztán hallatszik.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>61.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>IGAZODJON EL</span></h3></div>
					<div class="content-group">
						<p>Ne térjen le az útvonaláról. Előzze meg a többieket. A Q50 INFINITI InTouch navigációs rendszere, amely a teljes modellcsaládnál alapfelszereltség, ablakot nyit a világra. Igazodjon ki ismeretlen terepen is, fedezze fel a váratlant. Aztán találjon haza.</p>
					</div>
				</div>
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
				<div class="heading-group"><h2><span>PRÉMIUM SZEDÁN</span></h2></div>
				<p class="content-copy">Az INFINITI Q50 olyan teljesítményt nyújt, amilyenre minden vezető vágyik. Hibrid motorja ötvözi a csendes erőt az intelligens összkerékmeghajtással, hogy a vezetés sima, kifinomult és fényűző lehessen. Most Ön következik, élje meg a nagy teljesítményt olyan támogatással és szervizzel, amilyet elvár.</p>
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div><img src="<?php echo $pics; ?>1.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="video-container">
				<video class="video" autoplay controls looped muted>
					<source src="<?php echo $pics; ?>video1_1080p.mp4" type="video/mp4" media="(min-width: 60em)">
					<source src="<?php echo $pics; ?>video1_720p.mp4" type="video/mp4" media="(min-width: 36.3125em) and (max-width:59.9375em)">
					<source src="<?php echo $pics; ?>video1_480p.mp4" type="video/mp4" media="(max-width: 36.2425em)">
					<img src="<?php echo $pics; ?>video1.jpg" alt="" class="my-infiniti-img">
				</video>
			</div>		
			<div class="my-infiniti-spacer"></div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>MERJEN TÖBB LENNI</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q50-et úgy építettük meg, hogy inspirációt nyújtson, lenyűgözzön, és megváltoztassa mindannyiunk elképzelését arról, mi lehetséges. Válasszon többféle motorunk közül, például a vérpezsdítő teljesítményt nyújtó 3,5 literes V6-os motort INFINITI Direct Response Hybrid® technológiával¹. Az akár 364 lóerős teljesítményre is képes motorban minden megvan ahhoz, hogy életre szóló vezetési élményt nyújtson. Minden egyes alkalommal.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["teljesitmeny"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a teljesítményhez</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>2.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>VEZESSEN MAGABIZTOSAN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Egy jármű ne csak védjen, legyen proaktív is. Az INFINITI a közlekedési helyzetet és a környezetet érzékelő vezetéstámogató technológiáival¹ Ön tökéletesen ura lehet a helyzetnek az utakon. E technológiák segítségével még inkább tisztában lehet a helyzettel, így jobban élvezheti a vezetést.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["biztonsag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a biztonsághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>3.jpg" alt="" class="my-infiniti-img">
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>4.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>

			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>KIVÁLÓSÁGRA TERVEZVE</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Az Ön részletek iránti igényessége nyújtott inspirációt ahhoz, hogy valami szépet alkossunk. A sportos első lökhárító és a gazdag textúrájú, kettős ívű hűtőrács sportos, kifinomult külsőt kölcsönöz a Q50-nek. Lépjen be, és gyönyörködjön a teljesítmény ihlette emberi művészet alkotásaiban.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["formavilag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a formavilághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>5.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>ZÖKKENŐMENTES KAPCSOLAT</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q50-ben a technológiát kézközelbe hozzuk. Így végigpörögheti az egész napot, miközben azonnali hozzáféréssel rendelkezik a digitális világhoz. Többféleképpen gondoskodunk róla, hogy Ön folyamatosan online lehessen, és kezében tarthassa az irányítást.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["csatlakoztathatosag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a csatlakoztathatósághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>6.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>	
		</div>
	</div>
	<?php
}
?>
<div class="my-infiniti-spacer"></div>	
<div class="my-infiniti-spacer"></div>	
<div class="grid-row" id="my-infiniti-details-top">	
	<div class="col-12" style="text-align: center; font-size: 1.3em;">Az Infinitimagyaroszág továbbra is biztosítja a modellek elérhetőségét és a hivatalos gyári támogatás által nyújtotta szakértelmet. Az Infiniti Center Budapest márkakereskedés és szerviz, a legkorszerűbb technológiákkal várja ügyfeleit, több mint 400 négyzetméteren, a Budapest XV Városkapu u.1. szám alatt.</div>
</div>	
<div class="my-infiniti-spacer"></div>