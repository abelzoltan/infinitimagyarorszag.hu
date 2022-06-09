<?php 
include(INFINITI_VIEWS."newcars-details-top.php"); 

if($carMenuActive == "ajanlatkeres") { include(INFINITI_VIEWS."newcars-details-form.php"); }
elseif($carMenuActive == "teljesitmeny")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>TELJESÍTMÉNY</span></h2></div>
			</div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>KÉT VILÁG LEGJOBBJA: VÁLTOZTATHATÓ KOMPRESSZIÓJÚ TURBÓMOTOR</span></h2></div>
				<p class="content-copy">Mintha két motor lenne egyben, a 2020-as QX50 kétliteres, világelső VC-Turbo négyhengeres motorja automatikusan alakul át, hogy az aktuális vezetési körülményhez szükséges optimális teljesítményt és hatékonyságot nyújtsa. A nagysorozatban elsőként elérhető különleges megoldásként a QX50 VC-Turbo erőforrásának kivételes kialakítása az INFINITI 20 éves fejlesztési munkájának és innovációinak eredménye. Egy sportmotor reakciójára és erejére van szüksége? A VC-Turbo azonnal teljesíti a parancsát. Maximális üzemanyag-hatékonyságot szeretne? A motor ahhoz is alkalmazkodik. A két világ legjobbja, amely minden útján elkíséri.</p>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div class="video-container">
				<iframe class="video" src="https://www.youtube.com/embed/ZjxbGHg-8Y4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>CSENDES ERŐ - AKTÍV NYOMATÉKRÚD</span></h2></div>
				<p class="content-copy">A QX50 aktív nyomatékrúdja a gyorsítások során fellépő motorzajok és vibrációk minimalizálását szolgálja. Az aktív nyomatékrúd a felső motortartó bakon kapott helyet és ellensúlyozó rezgésekkel csillapítja a motor járását. Az eredmény egy páratlanul lágy, finom járású motor, a gyorsítások alkalmával is.</p>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>3.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0;"><span>MINŐSÉGI ANYAGOK - KIEGYENSÚLYOZOTT IRÁNYÍTHATÓSÁG</span></h3></div>
					<div class="content-group">
						<p>Az INFINITI platformja a speciális igénybevételek figyelembevételével készült válogatott alapanyagokból az erő, a súly és a biztonsági potenciál legjobb kombinációjaként. Az exkluzív, 980 Mpa-s nyújtószilárdságú acél használatával a QX50 platformja tökéletes alapot nyújt a kimagasló kényelem, a csendes futás, a kiegyensúlyozott irányíthatóság és az utasvédelem tekintetében.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>4.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>5.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0;"><span>DIRECT ADAPTIVE STEERING™ KORMÁNYZÁS - A PRECIZITÁS MAGASFOKA</span></h3></div>
					<div class="content-group">
						<p>Képzelj el, hogy rossz minőségű úton halad, de a kormánykerék mozdulatlanul marad a kezében. A kerekek és a kormánykerék közötti elektronikus kapcsolat révén ez valósággá válik az INFINITI exkluzív Direct Adaptive Steering™ kormányzási technológiájával, amely a hagyományos mechanikus kialakítások folyamatos mozgását kiszűri. A rendszer másodpercenként ezerszeres észlelésével automatikusan alkalmazkodik a vezetői igényekhez, csökkentve a pilóta fáradékonyságát és kivételes precizitást, valamint irányíthatóságot biztosítva, miközben egyedi, személyre szabható kormányzási érzetet nyújt.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0;"><span>INTELLIGENS ÖSSZKERÉKHAJTÁS - TELJESÍTMÉNY, AMIKOR CSAK KELL</span></h3></div>
					<div class="content-group">
						<p>Az intelligens összkerékhajtás azonnal alkalmazkodik a megváltozott útviszonyokhoz. A kerékpörgés, a gázállás és a sebesség figyelembevételével a rendszer akár a teljesítmény 50 százalékát is a hátsó kerekekhez küldi a jobb tapadás érdekében. Ha pedig nincs szükség négykerékhajtásra, az első kerekeket hajtva maximalizálja a hatékonyságot.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>6.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<?php
}
elseif($carMenuActive == "innovacio")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>INNOVÁCIÓ</span></h2></div>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>7.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>A NAGYOBB KÉP</span></h2></div>
				<p class="content-copy">A magabiztos irányíthatóság nem csupán egyetlen technológia eredménye, hanem az INFINITI innovációinak közös érdeme, amelyek azért születtek, hogy Ön még több élményt gyűjthessen a volán mögött.</p>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A gyalogos-felismeréssel is rendelkező Forward Emergency Braking rendszer nem csak kiszámítja az autója és az Ön előtt haladó közötti távolságot, felismerve a járművek sebességét, de még a sávja felé közeledő gyalogos mozgását is észleli, elősegítve a frontális ütközés lehetőségének időben történő felismerését. A rendszer először hallható és látható figyelmeztetést ad ki. Ha nem fékeznek időben, a rendszer először részben, majd szükség esetén akár teljesen is megteszi azt.</p>
						<p>A sávtartó rendszer segíti az autója irányítását és feleslegessé teszi a kis kormányzási korrekciókat azzal, hogy automatikusan észleli a sávfelfestést és segít a QX50 sáv közepén történő megtartásában.</p>
						<p>Az intelligens tempomat folyamatosan figyeli a sebességet és a távolság Ön helyett és automatikusan állítja azt a teljes sebesség-tartományban a forgalom figyelembevételével – még teljes megállásra is képes szükség esetén.</p>
						<p>A sávelhagyásra figyelmeztető és sávelhagyást megakadályozó rendszer még inkább fokozza a koncentrációt azzal, hogy figyelmeztet, sőt, beavatkozik, ha autója akaratlanul készül elhagyni a sávját.</p>
						<p>A Distance Control Assist figyeli a gépjármű előtti teret és segíti betartani a vezető által beállított követési távolságot azzal, hogy fokozott ellenállással visszanyomja a gázpedált, ha az előttünk lévő jármű közelebb van, mint a beépített távolság.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>8.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004" style="width: 80%;">
				<div class="heading-group"><h2><span>HEAD-UP DISPLAY - MINDEN INFORMÁCIÓ SZEM ELŐTT</span></h2></div>
				<p class="content-copy">Eredetileg a vadászpilóták számára kifejlesztett technológiájával a QX50 Head-Up Display rendszere a legfontosabb információkat közvetlenül a szélvédő aljára vetíti ki. Az olyan fontos adatok, mint a sebesség, a navigáció információi vagy a figyelmeztetések így jobban szem előtt vannak, melynek köszönhetően még inkább figyelhet az útra, miközben zavartalanul megkapja például az új táblafelismerő információit.</p>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>9.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>10.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>		
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>ELŐRELÁTÁS</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Előre néző radarjával és kamerájával a QX50 gyalogos-felismeréssel is rendelkező Forward Emergency Braking rendszere és a Predictive Forward Collision Warning ráfutásra figyelmeztető rendszere időben figyelmezteti a vezetőt a ráfutásos ütközés kockázatáról és szükség esetén segít megállítani vagy lelassítani autóját, megakadályozva a balesetet vagy csökkentve a sérülés kockázatát.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>LÁTJA, AMINT ÖN NEM</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A QX50 sávelhagyásra figyelmeztető és sávelhagyást megakadályozó rendszere figyelmezteti a vezetőt, sőt, indokolatlan sávelhagyás esetén be is avatkozik. Emellett a holttérfigyelő és a Blind Spot Intervention® rendszer figyelmeztet a visszapillantó tükrök holtterében tartózkodó közlekedőkre sávváltások előtt és során.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>11.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>12.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>AROUND VIEW® KAMERARENDSZER MOZGÁSÉRZÉKELÉSSEL - ODAFIGYELÉS SZÉLES PANORÁMÁN</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Az INFINITI világelső technológiája, az opcionális Around View® Monitor rendszer fejlett, mégis intuitív technológiát kínál a parkolás megkönnyítésére. A jármű négy oldalán elhelyzett négy kamera virtuális 360 fokos madártávlati képet nyújt a központi kijelzőn. De ez csak a kezdet. Az INFINITI továbbfejlesztette a rendszert mozgásérzékelés funkcióval, amely figyelmezteti a vezetőt a képernyőn észlelt mozgásra. Új perspektívát kínálva az Önt körülvevő világról, INFINITI modellje megkönnyíti a manőverezést a legszűkebb helyeken is.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>TÁVOLSÁGI FÉNYSZÓRÓ ASSZISZTENS - TÖKÉLETES MEGVILÁGÍTÁSBAN</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A távolsági fényszóró asszisztens segítségével elkerülheti mások vakítását. A rendszer automatikusan lekapcsolja a távolsági fényszórót, ha közeledő vagy Ön előtt közlekedő járművet észlel, így Önnek csak a vezetésre kell figyelnie.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>13.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>14.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>TOLATÓRADAR - PARKOLÁS MAGABIZTOSAN</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A tolatóradar lehetővé teszi, hogy a legszűkebb helyeken is magabiztosan manőverezzen. A rendszer hallható figyelmeztetéssel ad információt arról, hogy a jármű hátsó része milyen távolságra van a mögötte lévő tárgyaktól.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?php
}
elseif($carMenuActive == "formaterv")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>FORMATERV</span></h2></div>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>15.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>VÁRJA A KALAND - VEZETŐKÖZPONTÚ, TEKINTETTEL AZ UTASOKRA</span></h2></div>
				<p class="content-copy">Elegáns felületek és vezetőközponti kialakítás egyesül a QX50 aprólékosan kidolgozott belső terében. A gondosan kiválasztott anyagok kényeztető választékának köszönhetően a QX50 utastere kivételesen nyugodt környezetet teremt a legizgalmasabb kalandok megéléséhez is.</p>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>MŰVÉSZI KÉNYELEM - A KÖZÉPPONTBAN: ÖN</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A QX50 belterében az átgondolt ergonómia kényeztető felületekkel egyesül, különösen megnyugtató hangulatot árasztva. Az egyedi, vezetőközpontú geometriával felépülő műszerfal harmóniáját finom bőrkárpitozás, fabetétek és aprólékos varrások emeli a művészi kényelem legmagasabb fokára, amely garantáltan pihentető hangulatba hozza a leghosszabb úton is. A forradalmi, erőteljes VC-Turbo motor kompakt kialakítása lehetővé tette az utastér előretolását, még nagyobb belső méreteket létrehozva. Mindez a prémium dönthető és csúsztatható üléssorral együtt kivételes praktikumot kölcsönöz a QX50 különösen szellős és tágas utas-, valamint csomagterének.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>16.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>17.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>CSOMAGTARTÓ: MINDEN IGÉNYT KIELÉGÍT</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A QX50 nagy csomagtérnyílása, hatalmas csomagtartója és rejtett, padló alatti tárolói minden igényt kielégítenek. Még egy teljes méretű babakocsi is befér hosszában a hátsó ülések ledöntése nélkül úgy, hogy még rengeteg dolognak marad hely.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>16-HANGSZÓRÓS BOSE® PERFORMANCE SERIES AUDIORENDSZER - A KIVÉTELES HANGZÁS DALLAMA</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Az Advanced Staging technológiával rendelkező, opcionális Bose® Performance Series audiorendszer valódi alumínium hangszóróborításokkal fokozza a QX50 belső terének megjelenését. 16-hangszórós elrendezésének köszönhetően valódi koncertszerű audioélményt nyújt gyönyörűen széles, professzionálisan hangolt színpadképpel.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>18.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-spacer"></div>
			<div class="c_004">
				<div class="heading-group"><h2><span>A MEGJELENÉSBEN REJLŐ ERŐ</span></h2></div>
				<p class="content-copy">Domborodó vonalak határolják a letisztult felületet, olyan karosszériát alkotva, amely erőteljes, mégis stílusos. Széles kiállásával és sportosan előretolt utasterével a QX50 ígéretes arányai erősítik a modell izgalmas vizuális karakterét.</p>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>19.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>MOZGÁSSAL MŰKÖDTETHETŐ CSOMAGTÉRAJTÓ - FEDEZZE FEL A KÉZ NÉLKÜLI HOZZÁFÉRÉS VARÁZSÁT</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A QX50 szériában elektromos működtetési csomagtérajtaját opcionálisan mozgásérzékelőkkel lehet felszerelni, így sosem kell többé a kulcsot keresni a nyitáshoz. Sőt, a kezére sincs szüksége. Csak húzza el a lábát a hátsó lökhárító alatt és a jármű automatikusan kinyitja a csomagtérajtót. Varázslatos tudomány, amelynek megtapasztalása után nem érti majd, hogyan tudott eddig enélkül élni.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>20.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>21.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>CSÚSZTATHATÓ ÉS DÖNTHETŐ ÜLÉSSOR - ELSŐOSZTÁLYÚ UTAZÁS</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Élje át az első sor kényelmét hátul is! A QX50 csúsztatható és dönthető második üléssora minden utas számára kivételes személyre szabhatóságot biztosít, ülőhelytől függetlenül. A prémium anyagok, a gondosan megtervezett konstrukció és a kényelemközpontú megtámasztás gondoskodik arról, hogy a QX50-ben mindenki a legjobb helyen üljön.</p>
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
				<div class="heading-group"><h2><span>BIZTONSÁG</span></h2></div>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>22.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>5-CSILLAGOS BIZTONSÁGI ÉRTÉKELÉS - KIVÁLÓ PASSZÍV BIZTONSÁG</span></h2></div>
				<p class="content-copy">A vadonatúj INFINITI QX50 első- és összkerékhajtású verziója is ötcsillagos értékelést kapott a National Highway Traffic Safety Administration (NHTSA) New Car Assessment Program (NCAP) töréstesztjén.</p>
			</div>
			
			<div class="my-infiniti-spacer"></div>
			<div><img src="<?php echo $pics; ?>23.jpg" alt="" class="my-infiniti-img"></div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="c_004">
				<div class="heading-group"><h2><span>HOLTTÉRFIGYELŐ BLIND SPOT INTERVENTION®: HOLTTEREK NÉLKÜL</span></h2></div>
				<p class="content-copy">A széria holttérfigyelő figyelmezteti a vezetőt, ha vezetés közben jármű tartózkodik a visszapillantó tükrök holtterében, miközben az opcionális Blind Spot Intervention® aktívan segít visszakormányozni Önt a sávja közepére, ha ilyenkor megkezdi a sávváltási manővert.</p>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>HÁTSÓ AUTOMATIKUS FÉKRENDSZER - FIGYELEM MINDEN IRÁNYBÓL</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Az opcionális hátsó automatikus fékrendszer ellenőrizi az INFINITI modellje mögötti térben található tárgyakat. Ha Ön nem áll meg, a rendszer automatikusan használja a féket, hogy elkerülje az ütközést vagy csökkentse az ütközés súlyosságát. A hátsó automatikus fékrendszer nem képes mindenféle ütközés megelőzésére és nem minden körülmények között figyelmeztet vagy fékez. A vezetőnek mindig saját magának kell ellenőriznie a jármű környezetét vezetés előtt. További biztonsági információkat a használati útmutatóban talál.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>24.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>25.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>PREDICTIVE FORWARD COLLISION WARNING - AZ ELŐRELÁTÁS CSÚCSA</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Az INFINITI úttörő technológiája nem csak az Ön és az Ön előtt haladó, de még az előtte haladó jármű távolságát is érzékeli. A rendszer így segít a megfelelő, biztonságos követési távolság megtartásában autópályán és városi forgalomban egyaránt.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>AUTOMATIKUS VÉSZFÉKEZÉS GYALOGOS-FELISMERÉSSEL - MINDIG EGY LÉPÉSSEL ELŐBBRE</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>Az INFINITI gyalogos-felismeréssel is rendelkező Forward Emergency Braking rendszere nem csak kiszámítja az autója és az Ön előtt haladó közötti távolságot, felismerve a járművek sebességét, de még a sávja felé közeledő gyalogos mozgását is észleli, elősegítve a frontális ütközés lehetőségének időben történő felismerését. A rendszer először hallható és látható figyelmeztetést ad ki. Ha nem fékeznek időben, a rendszer először részben, majd szükség esetén akár teljesen is megteszi azt.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>26.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>27.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>SÁVELHAGYÁSRA FIGYELMEZTETŐ RENDSZER - MINDIG JÓ HELYEN</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A sávelhagyásra figyelmeztető rendszer egy kamera használatával figyeli meg a távolságot a jármű és a sávfelfestés között. Ha a jármű akaratlanul elkezd a sáv széles felé mozdulni, a rendszer hallható figyelmeztetést ad.</p>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="grid-row">
		<div class="col-6">
			<div class="c_005">
				<div class="content-half">
					<div class="my-infiniti-spacer"></div>	
					<div class="heading-group"><h3 style="margin-top: 0; font-size: 1.6em;"><span>HÁTSÓ KERESZTIRÁNYÚ FORGALOM FIGYELMEZTETŐ</span></h3></div>
					<div class="content-group" style="font-size: 1.2em; text-align: justify;">
						<p>A hátsó keresztirányú forgalom figyelmeztető rendszer segít Önnek, amikor egy parkolóhelyről tolat ki. Ha a jármű hátramenetben van, a rendszer észleli az oldalról érkező járműveket a bal és a jobb oldalon. Keresztirányú forgalom esetén a rendszer figyelmezteti Önt.</p>
					</div>
				</div>
			</div>
		</div>	
		<div class="col-6">
			<div class="c_005">
				<div class="content-half"><img src="<?php echo $pics; ?>28.jpg" alt="" class="my-infiniti-img"></div>
			</div>
		</div>
	</div>
	<?php
}
elseif($carMenuActive == "galeria")
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>GALÉRIA</span></h2></div>
			</div>	
		</div>
	</div>
	<div class="grid-row">
		<?php for($i = 1; $i <= 12; $i++) { ?>
		<div class="col-4">
			<div class="my-infiniti-spacer"></div>			
			<a href="<?php echo $pics."galeria/".$i; ?>.jpg" target="_self" class="fancybox" data-fancybox="gallery"><img src="<?php echo $pics."galeria/".$i; ?>.jpg" alt="" class="my-infiniti-img"></a>
		</div>
		<?php } ?>
	</div>
	<?php
}
else
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>LÉPJEN MAGASABB SZINTRE A 2020-AS INFINITI QX50-NEL</span></h2></div>
				<p class="content-copy">A 2020-as INFINITI QX50 megalkotásakor egyetlen dolog járt a tervezők fejében: Ön. Minden centiméter, minden megoldás és minden innováció úgy készült, hogy inspirálja és felemelje Önt, hogy kihasználhassa a magában rejlő potenciált. Az INFINITI világelső változtatható kompressziójú turbómotorjától kezdve a ProPILOT Assist technológián át a vezetőközpontú kialakításig minden azért dolgozik, hogy Ön legyen a QX50 univerzumának közepében.</p>
			</div>
			<div class="my-infiniti-spacer"></div>
			
			<div class="grid-row">
				<div class="col-4">
					<div class="c_005">
						<div class="content-half">
							<div class="my-infiniti-spacer"></div>	
							<div class="heading-group"><h3 style="margin-top: 0;"><span>VÁLTOZTATHATÓ KOMPRESSZIÓJÚ TURBÓMOTORJA</span></h3></div>
							<div class="content-group">
								<p>Képzelje el, hogy igény szerint csúcsteljesítmény és környezetbarát hatékonyság is rendelkezésére áll, együtt munkálkodva azon, hogy szárnyakat adjanak képzeletének, minden álmát megvalósítva. Az INFINITI QX50 úttörő, világelső VC-Turbo motorja ezt a víziót valósítja meg a világ legelső sorozatgyártásban elérhető változtatható kompressziójú motorjaként.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-4"><div class="c_005"><img src="<?php echo $pics; ?>1.jpg" alt="" class="my-infiniti-img"></div></div>
				<div class="col-4">
					<div class="c_005">
						<div class="content-half">	
							<div class="heading-group"><h3 style="margin-top: 0;"><span>KIFINOMULT TELJESÍTMÉNY</span></h3></div>
							<div class="content-group">
								<p>Az erő és a hatékonyság közötti hagyományos kompromisszum véget ér az INFINITI QX50 esetében. A modern mérnöki tudáson is túlmutatva vérbeli prémium teljesítményt nyújt, határok nélkül.</p>
							</div>
							<div class="heading-group"><h3 style="margin-top: 0;"><span>EXKLUZÍV INNOVÁCIÓ</span></h3></div>
							<div class="content-group">
								<p>Több mint 20 év kutatás és innováció eredményeképp az INFINITI világelső VC-Turbo erőforrása a valaha készült egyik legfejlettebb és legsokoldalúbb motorkoncepció.</p>
							</div>
							<div class="heading-group"><h3 style="margin-top: 0;"><span>FORRADALMI KIALAKÍTÁS</span></h3></div>
							<div class="content-group">
								<p>A VC-Turbo motor fizikailag képes 8:1 (teljesítmény) és 14:1 (hatékonyság) között bármilyen kompressziós arányt kialakítani, amivel a 272 lóerős kétliteres egység tökéletesen alkalmazkodik igény szerint az aktuális vezetési helyzethez.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="my-infiniti-spacer"></div>
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-spacer"></div>
			<div class="c_004" style="width: 80%;">
				<div class="heading-group"><h2><span>"... A motor, amely annyi erőt szorít ki magából, mint a nagyobb V6-os erőforrások, miközben olyan hatékonyságra képes, mint némelyik hibrid"</span></h2></div>
				<p class="content-copy">- BRYAN LOGAN, BUSINESS INSIDER</p>
			</div>
			<div class="my-infiniti-spacer"></div>
		</div>
	</div>		
	<div class="grid-row">
		<div class="content-zone container c_002 content-divider"><hr></div>
	</div>
	<div class="my-infiniti-spacer"></div>		
			
			
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004">
				<div class="heading-group"><h2><span>A MEGJELENÉSBEN REJLŐ ERŐ</span></h2></div>
				<p class="content-copy">Domborodó vonalak határolják a letisztult felületet, olyan karosszériát alkotva, amely erőteljes, mégis stílusos. Széles kiállásával és sportosan előretolt utasterével a QX50 ígéretes arányai erősítik a modell izgalmas vizuális karakterét.</p>
			</div>
			<div class="my-infiniti-spacer"></div>		
			<div><img src="<?php echo $pics; ?>2.jpg" alt="" class="my-infiniti-img"></div>
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