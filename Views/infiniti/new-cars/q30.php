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
				<p class="content-copy">Minden INFINITI Q30 az egyediséget hangsúlyozza és az önkifejezést támogatja. A vezető saját ízlésének megfelelően alakíthatja a Q30-at a rendelkezésre álló tartozékok kiválasztásával a stílusához leginkább megfelelően. Minden tartozék elsődleges célja, hogy általa a vezető kifejezésre juttathassa saját személyiségét.</p>
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
				<div class="heading-group"><h2><span>Q30 ERŐ ÉS TELJESÍTMÉNY</span></h2></div>
				<p class="content-copy">A város él és lélegzik. Alkalmazkodjon a folytonosan változó környezetéhez a finomra hangolt kezelhetőséggel, mely egyszerre agilis és sima.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>6.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>ALVÁZ</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>INTELLIGENS TÁVOLSÁG- ÉS SEBESSÉGTARTÓ AUTOMATIKA</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Állítsa be a sebességet és a biztonságos követési távolságot, aztán csak hagyja, hogy az intelligens távolság- és sebességtartó automatika (ICC – Intelligent Cruise Control) megtartsa, sőt automatikusan szabályozza a sebességet a közúti forgalomnak megfelelően.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>7.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>8.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SPORT FELFÜGGESZTÉS</span></h3></div>
					<div class="content-group">
						<p>Ha a sportfelfüggesztést választja, alacsonyabb alváz mellett jobb úttartást kap. A jobb fékhatás érdekében ezek a modellek nagyobb méretű és elöl szellőztetett féktárcsákkal rendelkeznek, miközben a kanyarokban is jobban reagálnak.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>9.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SPORTOS ÉS KÉNYELMES</span></h3></div>
					<div class="content-group">
						<p>A Q30 sportos és kényelmes lengéscsillapítói jól megtartják az autót a kanyarokban, ugyanakkor csökkentik a rázkódást az egyenetlen utakon. Tökéletesen egyensúlyba hozzák a sportos irányíthatóságot és a kényelmes utazást.</p>
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
				<div class="heading-group"><h2><span>MOTOR</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>LEHENGERLŐ GYORSULÁSI ÉLMÉNY</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A motorok hangolásánál fontos szempont, hogy a nyomatékot széles fordulatszám-tartományban adják le, így a gyorsító erőt a sebesség növekedésével egyre nagyobbnak érezzük – és biztosan számíthatunk arra, hogy a Q30 szükség esetére komoly erőtartalékkal rendelkezik.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>?tesztvezetes=1" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Jelentkezzen tesztvezetésre</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>10.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>11.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HÉTSEBESSÉGES DUPLAKUPLUNGOS SEBESSÉGVÁLTÓ</span></h3></div>
					<div class="content-group">
						<p>A váltási késedelem a múlté a hétsebességes duplakuplungos sebességváltóval. A váltó hatékonyan osztja be a Q30 teljesítményét: intelligensen előre kiválasztja az alacsonyabb vagy magasabb fokozatot, még mielőtt váltani kéne, így a váltás mindössze annyi időbe kerül, míg Ön megnyomja a váltófület.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>12.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SEBESSÉGVÁLTÓ FÜL</span></h3></div>
					<div class="content-group">
						<p>A hétfokozatú, duplakuplungos sebességváltós Q30-ban mindig kézre esnek a kormány mögötti váltófülek, így a sebességváltás a másodperc törtrésze alatt történik. Váltson egy gyors ujjmozdulattal fel vagy le, és élvezze a tökéletes, precíz irányíthatóságot.</p>
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
				<div class="heading-group"><h2><span>A Q30 FORMATERVE ÉS STÍLUSVILÁGA</span></h2></div>
				<p class="content-copy">A város az Ön színpada. A Q30 Önt állítja reflektorfénybe – drámai vonalvezetésével, amely legalább annyira kifejező, mint Ön.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>13.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>KÜLSŐ</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>ELŐREMUTATÓ DESIGN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q30 emelt hasmagasságának, sportosan széles kerékíveinek és a provokatívan alacsonyan futó tetővonalának köszönhetően Ön sehol sem maradhat észrevétlen. A meghökkentő arányok célja egy semmi másra nem hasonlító autó megalkotása — ugyanakkor mind praktikus célt is szolgál.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>?tesztvezetes=1" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Jelentkezzen tesztvezetésre</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>14.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>15.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>LED FÉNYSZÓRÓK</span></h3></div>
					<div class="content-group">
						<p>A szemből és oldalról is felismerhető, emberi szem alakja által ihletett LED fényszórók formája minden irányból az ikonikus INFINITI stílust tükrözik.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>16.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>VÁLASSZA KI KÖNNYŰFÉM KERÉKTÁRCSÁIT</span></h3></div>
					<div class="content-group">
						<p>A szép formatervezésű könnyűfém keréktárcsák még elegánsabbá és stílusosabbá teszik Q30-át. Válasszon a 17, a 18 és a 19 colos méretek, valamint a hatféle felületkidolgozás közül.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>17.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>KETTŐS KIPUFOGÓCSŐ</span></h3></div>
					<div class="content-group">
						<p>A kettős kipufogó sötét króm csővégei* még merészebb megjelenést kölcsönöznek a Q30-nak —és utalnak a benne szunnyadó hatalmas teljesítményre is.</p>
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
				<div class="heading-group"><h2><span>BELTÉR</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>MUTASSA MEG EGYEDISÉGÉT</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q30 belterébe választható speciális színszettek újfajta gondolkodásmódról árulkodnak. Válasszon a prémium megjelenésű és tapintású grafitszürke bőr és a természetes megjelenésű bézsszínű bőr közül, vagy döntsön a Gallery White még inspirálóbb modern színkombinációi mellett.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>?tesztvezetes=1" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Jelentkezzen tesztvezetésre</a>
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
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ALKALMAZKODJON A VÁLTOZÁSOKHOZ</span></h3></div>
					<div class="content-group">
						<p>Történjék bármi, Önt nem éri felkészületlenül. A Q30 nyílása széles és szögletes, így hihetetlenül könnyű a be- és kipakolás, a 60/40 arányban lehajtható hátsó üléseknek köszönhetően pedig még tágasabb és praktikusabban alakítható a csomagtér.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>20.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>NAPPABŐR</span></h3></div>
					<div class="content-group">
						<p>Kivételesen rugalmas bőrkárpit, amelyet kellemes tapintása és strapabírása miatt választottunk. Páratlan kényelmet nyújt, és az utastér egyéb felületeit is kiemeli. Csak bizonyos modellváltozatokban.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
elseif($carMenuActive == "biztonsag")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>Q30 BIZTONSÁG ÉS IRÁNYÍTÁS</span></h2></div>
				<p class="content-copy">A városban az akadályok gyorsan bukkannak fel. A biztonságot szolgáló korszerű, innovatív berendezésekkel felszerelt Q30 segítségével előre számíthat a veszélyre — így higgadtabban reagálhat.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>21.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>MANŐVEREZZEN KÖNNYEDÉN</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>AUTOMATA PARKOLÁSSEGÍTŐ RENDSZER</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A Q30 12 szenzora segítségével meg tudja állapítani, hol van neki megfelelő parkolóhely. Aztán egyszerűen használja a sebességváltót, nyomja meg a gombot a megerősítéshez, majd használja a gázpedált és a fékpedált. Q30-a biztonságosan bekormányozza magát a helyre.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["ajanlatkeres"]["url"]; ?>?tesztvezetes=1" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Jelentkezzen tesztvezetésre</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>22.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>23.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>TOLATÓKAMERA</span></h3></div>
					<div class="content-group">
						<p>Nézze meg közelebbről az autó mögötti területet a tolatókamerával. A kamera képe megjelenik a Q30 beltéri kijelzőjén, így Ön magabiztosan tolathat —még ha hátrafele nem is látna pontosan.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>24.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>PARKOLÓÉRZÉKELŐ</span></h3></div>
					<div class="content-group">
						<p>Az első és hátsó lökhárítóba épített szenzorok érzékelik a közelebb kerülő objektumokat*, és ha túl közel kerülnek, a rendszer hangjelzéssel figyelmeztet —így Ön azt is érzékelheti, amit nem lát.</p>
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
				<div class="heading-group"><h2><span>TUDJON MEG TÖBBET A VEZETÉSTÁMOGATÓ TECHNOLÓGIÁKRÓL</span></h2></div>
			</div>	
		</div>
	</div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<div class="video-container">
						<video class="video" autoplay controls looped muted>
							<source src="<?php echo $pics; ?>video2.mp4" type="video/mp4">
							<img src="<?php echo $pics; ?>video2.jpg" alt="" class="my-infiniti-img">
						</video>
					</div>
					<div class="heading-group"><h3 style="margin-top: 0;"><span>PANORÁMA MONITOR (AROUND VIEW® MONITOR) MOZGÁSÉRZÉKELŐVEL</span></h3></div>
					<div class="content-group">
						<p>A panoráma monitor madártávlati virtuális képet ad a Q30-ról, így Ön még a legszűkebb helyeken való manőverezés közben is tisztábban láthat mindent. A mozgásérzékelő azonnal figyelmezteti, amint valami a jármű közelébe kerül.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<div class="video-container">
						<video class="video" autoplay controls looped muted>
							<source src="<?php echo $pics; ?>video3.mp4" type="video/mp4">
							<img src="<?php echo $pics; ?>video3.jpg" alt="" class="my-infiniti-img">
						</video>
					</div>
					<div class="heading-group"><h3 style="margin-top: 0;"><span>INTELLIGENS TÁVOLSÁG- ÉS SEBESSÉGTARTÓ AUTOMATIKA</span></h3></div>
					<div class="content-group">
						<p>Állítsa be a sebességet és a biztonságos követési távolságot, aztán csak hagyja, hogy az intelligens távolság- és sebességtartó automatika megtartsa, sőt automatikusan szabályozza a sebességet a közúti forgalomnak megfelelően.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>25.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>INTELLIGENS FÉNYSZÓRÓ</span></h3></div>
					<div class="content-group">
						<p>Az intelligens fényszóró úgy csökkenti a szembejövők elvakításának a kockázatát, hogy közeledő járművet érzékelve időlegesen tompított fényre kapcsol. Ha pedig a szembejövő járművek elhaladtak mellette, automatikusan visszakapcsolja a távolsági fényszórót.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-row">	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>26.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ADAPTÍV ELSŐ FÉNYSZÓRÓRENDSZER</span></h3></div>
					<div class="content-group">
						<p>Ön nem láthatja, mi várja a kanyar után, a Q30 viszont igen. Az adaptív első fényszórórendszer úgy növeli a látótávolságot, hogy arra fordítja a fényszórókat, amerre a kormány fordul — így Ön messzebbre elláthat a kanyarokban.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="video-container">
						<video class="video" autoplay controls looped muted>
							<source src="<?php echo $pics; ?>video4.mp4" type="video/mp4">
							<img src="<?php echo $pics; ?>video4.jpg" alt="" class="my-infiniti-img">
						</video>
					</div>
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HOLTTÉRFIGYELŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Növelje meg perifériás látószögét a szenzorokkal, melyek érzékelik, ha valaki belép a holtterébe. Ha sávváltásba kezd, a rendszer látható és hallható jelzéssel figyelmezteti.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="video-container">
						<video class="video" autoplay controls looped muted>
							<source src="<?php echo $pics; ?>video5.mp4" type="video/mp4">
							<img src="<?php echo $pics; ?>video5.jpg" alt="" class="my-infiniti-img">
						</video>
					</div>
					<div class="heading-group"><h3 style="margin-top: 0;"><span>SÁVELHAGYÁSRA FIGYELMEZTETŐ ÉS SÁVELHAGYÁST MEGELŐZŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>A sávelhagyásra figyelmeztető rendszer és a sávelhagyást megelőző rendszer figyeli az útburkolati jeleket, és figyelmezteti a vezetőt, ha elkezd kisodródni a sávból. Ha a jármű továbbra is távolodik a saját sávjától, a rendszer finoman visszairányítja az eredeti sáv közepe felé.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="video-container">
						<video class="video" autoplay controls looped muted>
							<source src="<?php echo $pics; ?>video6.mp4" type="video/mp4">
							<img src="<?php echo $pics; ?>video6.jpg" alt="" class="my-infiniti-img">
						</video>
					</div>
					<div class="heading-group"><h3 style="margin-top: 0;"><span>ÜTKÖZÉS ELŐTTI VÉSZFÉKEZŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>Ha a rendszer úgy érzékeli, valószínűleg frontális ütközés fog bekövetkezni, fény- és hangjelzéssel figyelmezteti a vezetőt, valamint szükség esetén részben vagy teljesen aktiválja a fékeket, hogy segítsen a vezetőnek lelassítani a járművet.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<p style="margin: 0;">Vezetéstámogató technológiáink csak bizonyos Q30-as modellekhez rendelhetők.</p>
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
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>27.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>VEGYE ÉSZRE A KÖZLEKEDÉSI TÁBLÁKAT</span></h3></div>
					<div class="content-group">
						<p>A táblafelismerő rendszer egy kamera segítségével figyeli a megengedett maximális sebességre figyelmeztető táblákat, majd kijelzi azokat a műszerfalon. Akinél az információ, annál az irányítás.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>28.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>NE TÉRJEN LE AZ ÚTRÓL</span></h3></div>
					<div class="content-group">
						<p>A dinamikus menetstabilizáló rendszer korrigálja az alul- vagy felülkormányozottságot, azáltal, hogy csökkenti a motor sebességét és aktiválja a féket az egyes kerekeken, így segít a jármű kívánt íven tartásában.</p>
					</div>
				</div>
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
				<div class="heading-group"><h2><span>Q30 CSATLAKOZTATHATÓSÁG</span></h2></div>
				<p class="content-copy">Maradjon összeköttetésben a világgal: zene, navigáció, szabadkezes telefonálás út közben is.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>29.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>SZÓRAKOZTATÓ FUNKCIÓK</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>30.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>INFINITI INTOUCH™</span></h3></div>
					<div class="content-group">
						<p>INFINITI InTouch™ – érezze, ahogy a világ Önnel mozog. A csak bizonyos modellekhez rendelhető INFINITI InTouch egyetlen, műszerfalra szerelt, 7 colos érintőképernyőn integrálja a navigációt, a biztonságot és a szórakoztatást.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>31.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>BOSE® AUDIÓRENDSZER 10 HANGSZÓRÓVAL</span></h3></div>
					<div class="content-group">
						<p>Tíz hangszórójával a Bose® hangrendszer* lenyűgöző részletgazdagsággal kényezteti a zenekedvelőket. Akár CD-n, akár kompatibilis Bluetooth® eszközön, az USB portok segítségével, vagy a kedvenc digitális rádiócsatornáján hallgatja, kristálytiszta digitális hangzásban lesz része.</p>
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
				<div class="heading-group"><h2><span>CSATLAKOZTATHATÓSÁG</span></h2></div>
			</div>	
			<div class="my-infiniti-spacer"></div>
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>SZEMÉLYRE SZABOTT BESZÁLLÁS</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">A csak bizonyos modellekhez kapható INFINITI intelligens kulcs érzékeli, ha Ön közeledik. Kinyitja az ajtót vagy a hátsó csomagtérajtót, anélkül, hogy elő kéne vennie a zsebéből. Miután beszállt, a rendszer beállítja az ülést, automatikusan a pozíciójához igazítja a kormánykereket és a külső tükröket – az Ön igényeinek megfelelően.</div>
					</div>
				</div>
				<img src="<?php echo $pics; ?>32.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>33.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>BLUETOOTH® SZABADKEZES TELEFONRENDSZER ÉS AUDIO STREAMELÉS</span></h3></div>
					<div class="content-group">
						<p>Változtassa át Bluetooth®-kompatibilis okostelefonját zenetárrá, és hallgassa a legjobb lejátszási listáit a Q30 hangrendszerén.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>34.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>HANGFELISMERŐ RENDSZER</span></h3></div>
					<div class="content-group">
						<p>A hangfelismerő technológia mellett soha nem kell levennie szemét az útról. Kezelje egyszerű hangparancsokkal telefonját, a navigációs rendszert, valamint a szórakoztató és járműinformációs rendszereket.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="c_005">
				<div class="content-half">
					<img src="<?php echo $pics; ?>35.jpg" alt="" class="my-infiniti-img">
					<div class="heading-group"><h3 style="margin-top: 0;"><span>NAVIGÁCIÓ</span></h3></div>
					<div class="content-group">
						<p>Ne térjen le az útvonaláról. Előzze meg a többieket. A Q30 INFINITI InTouch™ navigációs rendszere ablakot nyit a világra. Igazodjon ki ismeretlen terepen is, fedezze fel a váratlant. Aztán találjon haza.</p>
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
				<div class="heading-group"><h2><span>PRÉMIUM AKTÍV KOMPAKT</span></h2></div>
				<p class="content-copy">Az INFINITI Q30-cal Öné a város. Kiemelkedő teljesítmény és kezelhetőség, kifinomultság és egyedi, sportos megjelenés várja. Most Ön következik, érezze otthon magát a városban olyan támogatással és szervizzel, amilyet elvár.</p>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>1.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>ÁLLÍTSA BE A TEMPÓT</span></h2></div>
				<p class="content-copy">Mozogjon a nagyvárosi élet ütemére.</p>
			</div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>FEJEZZE KI ÖNMAGÁT</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Az emberi szem alakja által ihletett első fényszóróktól az agresszív íveken át a Q30 teljes vonalvezetése a beépített króm kipufogócsővel ellátott összetéveszthetetlen hátsó lökhárító felé mutat.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["formavilag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a formavilághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>2.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>TALÁLJA MEG AZ ÖNNEK MEGFELELŐ MOTORTÍPUST</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Mindegy, melyik benzin- vagy dízelmotorunkat választja, a Q30 duplakuplungus váltója* így is, úgy is egyetlen szempillantás alatt vált sebességet. Közben pedig speciális sportfelfüggesztése* gondoskodik a jobb kezelhetőségről és az út rázkódásainak kiszűréséről.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["teljesitmeny"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a teljesítményhez</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>3.jpg" alt="" class="my-infiniti-img">
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div class="my-infiniti-spacer"></div>
	<div><img src="<?php echo $pics; ?>4.jpg" alt="" class="my-infiniti-img"></div>
	<div class="my-infiniti-spacer"></div>
	<div class="my-infiniti-spacer"></div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>ÖSSZEKAPCSOLVA</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Az INFINITI InTouch™ rendszerrel* használhatja a navigációt, miközben a Bluetooth® csatlakozás és a hangrendszer segítségével tökéletes hangminőségben hallgathatja telefonja lejátszólistáját.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["csatlakoztathatosag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a csatlakoztathatósághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>5.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="lp-img-text-container">
				<div class="lp-img-text">
					<div class="wrapper">
						<div class="heading-group"><h2><span>VEZESSEN KÖNNYEDÉN</span></h2></div>
						<div class="my-infiniti-spacer"></div>
						<div class="content" style="font-size: 15px;">Mozogjon otthonosan a nagyvárosi dzsungelben innovatív rendszereinkkel, például az automata parkolássegítő rendszerrel és a panorámamonitorral. Ezek segítségével az olyan veszélyforrásokkal is megbirkózhat, amiket nem is lát.</div>
						<div class="my-infiniti-spacer"></div>
						<a href="<?php echo $carMenu["biztonsag"]["url"]; ?>" target="_self" class="my-infiniti-btn my-infiniti-btn3" style="text-align: center;">Lépjen tovább a biztonsághoz</a>
					</div>
				</div>
				<img src="<?php echo $pics; ?>5_2.jpg" alt="" class="my-infiniti-img">
			</div>
			<div class="my-infiniti-spacer"></div>	
			
			<div class="video-container">
				<video class="video" autoplay controls looped muted>
					<source src="<?php echo $pics; ?>video1_1080p.mp4" type="video/mp4" media="(min-width: 60em)">
					<source src="<?php echo $pics; ?>video1_720p.mp4" type="video/mp4" media="(min-width: 36.3125em) and (max-width:59.9375em)">
					<source src="<?php echo $pics; ?>video1_480p.mp4" type="video/mp4" media="(max-width: 36.2425em)">
					<img src="<?php echo $pics; ?>video1.jpg" alt="" class="my-infiniti-img">
				</video>
			</div>
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