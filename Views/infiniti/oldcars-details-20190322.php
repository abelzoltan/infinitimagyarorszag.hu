<div id="my-infiniti-details">
	<div class="grid-row">
		<div class="col-12">
			<div id="my-infiniti-details-top">
				<div id="my-infiniti-details-top-right">
					<div id="my-infiniti-details-datas">
						<div class="my-infiniti-details-data">Modell: <strong><?php echo $car["model"]->name; ?></strong></div>
						<?php if(!empty($car["carBodyNumber"])) { ?>
							<div class="my-infiniti-details-data">Azonosító: <strong><?php echo $car["carBodyNumber"]; ?></strong></div>
						<?php } if($car["document"] !== false) { ?>
							<div class="my-infiniti-details-data">Dokumentum letöltése: <strong><a href="<?php echo PATH_WEB."letoltes/".$car["document"]["urlName"]; ?>"><?php echo $car["document"]["fullName"]; ?></a></strong></div>
						<?php } if(!empty($car["text"])) { 
							$txt = strip_tags($car["text"], "<strong>,<b>");
							$txtArray = explode(PHP_EOL, $txt);
							foreach($txtArray AS $txtRow)
							{
								$txtRowCheck = str_replace(["\r", "\n", "\r\n", "\t", " ", "&nbsp;"], "", $txtRow);
								if(empty($txtRowCheck)) { continue; }
								else { ?><div class="my-infiniti-details-data"><?php echo $txtRow; ?></div><?php }
							}
						} ?>
					</div>
					<div id="my-infiniti-details-prices">
						<div id="my-infiniti-details-prices-list">
							<div class="my-infiniti-details-data <?php if($car["priceInUse"] == "sale") { ?>my-infiniti-details-data-del<?php } ?>"><?php echo $car["priceListTxt"] ?>:<br><strong><?php echo $car["priceListOut"]; ?></strong></div>
						</div>
						<?php if($car["priceInUse"] == "sale") { ?>
							<div id="my-infiniti-details-prices-sale">
								<div class="my-infiniti-details-data"><?php echo $car["priceSaleTxt"]; ?>:<br><strong><?php echo $car["priceSaleOut"]; ?></strong></div>
							</div>
						<?php } ?>
					</div>
					<div id="my-infiniti-details-btn">
						<a class="my-infiniti-btn" onclick="myFormOpen('ajanlatkeres')">Érdekel, ajánlatot kérek!</a>
					</div>
					<?php 
					if($car["user"] !== false) 
					{ 
						$user = $car["user"];
						?><div id="my-infiniti-details-user"><?php include("_user-item.php"); ?></div><?php
					}
					?>
				</div>
				<div id="my-infiniti-details-top-left">
					<?php 
					$count = count($car["gallery"]); 
					$countOut = $count + 1;
					?>
					<a href="<?php echo $car["picSrc"]; ?>" class="fancybox" id="my-infiniti-details-img" data-fancybox-group="gallery" data-fancybox-title="1/<?php echo $countOut.". - ".$car["name"]; ?>"><img src="<?php echo $car["picSrc"]; ?>" alt="<?php echo $car["name"]; ?>"></a>
					<?php if($count > 0) { ?>
						<div id="my-infiniti-details-gallery">
							<?php
							$i = 1;
							foreach($car["gallery"] AS $pic)
							{						
								$iOut = $i + 1;
								?>
								<div class="my-infiniti-details-gallery-col <?php if($i > 5) { ?>my-infiniti-details-gallery-col-hidden<?php } ?>">
									<div class="my-infiniti-details-gallery-img">
										<div class="my-infiniti-details-gallery-img-outer">
											<a href="<?php echo $pic["path"]["web"]; ?>" class="fancybox my-infiniti-details-gallery-img-inner" data-fancybox-group="gallery" data-fancybox-title="<?php echo $iOut."/".$countOut.". - ".$pic["name"]; ?>"><img src="<?php echo $pic["path"]["web"]; ?>" alt="<?php echo $pic["name"]; ?>" class="img-responsive center vertical-middle"></a>
										</div>
									</div>
								</div>
								<?php
								$i++;
							}
							?>
							<div class="my-infiniti-clear"></div>
						</div>
					<?php } ?>
				</div>
				<div class="my-infiniti-clear"></div>
			</div>
			<div id="my-infiniti-details-menu">
				<a class="my-infiniti-btn my-infiniti-btn-active" onclick="myInfinitiMenu('text', this)">Általános információ</a>
				<a class="my-infiniti-btn" onclick="myInfinitiMenu('facility', this)">Felszereltség</a>
				<a class="my-infiniti-btn" id="my-infiniti-btn-form" onclick="myInfinitiMenu('form', this)">Ajánlatkérés / Tesztvezetés</a>
			</div>
			<div id="my-infiniti-details-menu-border"></div>
		</div>
	</div>
	<div id="my-infiniti-details-bottom" data-opened="text">
		<div id="my-infiniti-details-text">		
			<div class="grid-row">
				<?php if($car["tipus"] == "1") { ?>
				<div class="col-12 my-infiniti-details-description">
					<div style="height: 30px;"></div>
					<h3><strong>Pénzügyi lízing</strong></h3>
					<p style="text-align: justify;">Ismerje meg ajánlatainkat magánszemély és céges ügyfeleknek, zárt-és nyíltvégű lízingben történő finanszírozásra egyaránt.</p>
					<h4><strong>Nyílt végű lízing előnyei</strong></h4>
					<p style="text-align: justify;">
						<strong>VISSZAIGÉNYELHETŐ ÁFA</strong><br>
						Lízingdíjak áfa tartalma az üzleti használat arányában levonható
					</p>
					<p style="text-align: justify;">
						<strong>ADÓKEDVEZMÉNY</strong><br>
						Kis-és Középvállalkozások a fizetett kamat 100%-át levonhatják a társasági adójukból
					</p> 
					<p style="text-align: justify;">
						<strong>LIKVIDITÁSI TÖBBLET</strong><br>
						Készpénzes vásárlással szemben, a beszerzésre ki nem fizetett összeg leköthető, befektethető vagy a cég más beruházására fordítható<br>
						<br>
						Kérje személyre szabott lízing ajánlatainkat a kollégáinktól, szívesen állnak Ön illetve az Ön cége rendelkezésére.
					</p>
					<br>
					<h3><strong>Operatív lízing (tartós bérlet)</strong></h3>
					<p style="text-align: justify;">A teljes körű operatív lízing olyan lízingtípus, amely a finanszírozás mellett a gépjárművek teljes menedzselését is magában foglalja. A lízingszerződés tartalmazza a kamatokat és az amortizációt, a teljesítményadót és cégautó adót, az ügyintézés költségeit, a javítással, karbantartással és gumikkal kapcsolatos költségeket, valamint a biztosítást.</p>
					<h4><strong>A szolgáltatás előnyei:</strong></h4>
					<p style="text-align: justify;">Az operatív lízing konstrukciónak részben pénzügyi indokai vannak, ugyanakkor a tartós bérleti szolgáltatás (operatív lízing) nem pusztán erről, hanem azokról a minőségi kiegészítő szolgáltatásokról is szól, melyek nem csak költséghatékonnyá, de igazán kényelmessé is teszik ezt a megoldást.</p>
					<h4><strong>Pénzügyi előnyei:</strong></h4>
					<p style="text-align: justify;">A tartós bérleti szolgáltatás számos általános pénzügyi előnnyel bír, melyeknek köszönhetően a tartós bérlet a cégautó vásárláshoz képest jobb alternatívát kínál.</p>
					<p style="text-align: justify;">
						<strong>ELSZÁMOLHATÓ BÉRLETI DÍJ</strong><br>
						Tartós bérlet esetén a teljes bérleti díj elszámolható költségként. Ha operatív lízing konstrukcióban bérli céges gépjárműveit, akkor a személygépjárművek bérleti díjának ÁFÁ-ja visszaigényelhető az üzleti használat arányában, a jogszabályi előírások betartása mellett.
					</p>
					<p style="text-align: justify;">
						<strong>ELSZÁMOLHATÓ FENNTARTÁSI KÖLTSÉGEK</strong><br>
						A fenntartási költségek – például a szervizdíj, a biztosítás, az évszaknak megfelelő karbantartás – ugyancsak elszámolhatóak, ezeket ugyanis a bérleti díj tartalmazza.
					</p>
					<p style="text-align: justify;">
						<strong>FELSZABADULÓ TŐKE</strong><br>
						Az is a vállalatok gazdálkodását segíti, hogy a tartós bérletet választva felszabadul az a tőke, amit a társaságok egyébként cégautók vásárlására fordítottak volna.
					</p>
					<p style="text-align: justify;">
						<strong>KÖLTSÉGHATÉKONY FLOTTA MENEDZSMENT</strong><br>
						Nem kell plusz erőforrást szánni a flotta karbantartására, üzemeltetésére sem - a szolgáltatásához kötődő flottakezelés ezt a terhet is leveszi az Ön válláról. Vállalatunk és partnereink a flottakezelés kapcsán minden részletre kiterjedő ajánlatot nyújtanak az Ön cégének.
					</p>
					<br>
					<h3><strong>Kiterjesztett garancia</strong></h3>
					<p style="text-align: justify;">Kérje kollégáinktól a Prémium Exclusive kiterjesztett garancia széleskörű szolgáltatását, a választott autóra vontakozó ajánlatunkat.</p>

					<p style="text-align: justify;"><small>Az áraink az áfát és a regisztrációs adót tartalmazzák. A meghirdetett modellek részletes felszereltségéről kérjük tájékozódjon értékesítő munkatársainknál. A tájékoztatás nem teljes körű. Gépelési hibákért felelősséget nem vállalunk. A fenti tájékoztatás nem minősül a Polgári Törvénykönyvről szóló 2013. évi V. törvény szerinti ajánlatnak, így nem fűződik hozzá ajánlati kötöttség sem.</small></p>

				</div>
				<?php } else { ?>
				<div class="col-12 my-infiniti-details-description">
					<div style="height: 30px;"></div>
					
					<p style="text-align: justify;"><strong>INFINITI APPROVED</strong> program keretein belül, szervizünk átfogó vizsgálatokat végez annak érdekében, hogy minden autó megfeleljen a kivételesen magas színvonalú követelményeinknek. Bizalmunk tükröződik a programon keresztül megvásárolt autók további előnyeivel, beleértve a kiterjesztett garanciát. Nincs jobb módja annak, hogy megvásároljon egy INFINITI APPROVED gépjárművet tőlünk.</p>
					<h4><strong>ELŐZMÉNYEK ELLENŐRZÉSE ÉS MEGERŐSÍTÉSE</strong></h4>
					<p style="text-align: justify;">Minden INFINITI-t alaposan ellenőriz az INFINITI márkakereskedő, hogy megerősítse származását, megállapítsa, hogy nincs-e fennálló finanszírozási megállapodás, és megerősíti, hogy nem lopott, vagy nem történt-e vele súlyos baleset.</p>
					<h4><strong>ÁTFOGÓ MŰSZAKI ELLENŐRZÉS</strong></h4>
					<p style="text-align: justify;">Mielőtt bármelyik beérkezett INFINITI modellt INFINITI APPROVED használtautónak nyilvánítanánk, meg kell felelnie egy 110 pontos INFINITI APPROVED műszaki ellenőrzésnek.</p>
					<h4><strong>30 NAPOS / 1000 KM BIZALMI CSEREPROGRAM</strong></h4>
					<p style="text-align: justify;">Ha nem elégedett ÖN az INFINITI APPROVED használtautójával bármilyen okból, szabadon kicserélheti azt 30 napon vagy 1000 km-en belül az átadást követően - egy másik, legalább azonos értékű INFINITI használtautóra. A kiegészítők nem része az alábbi ajánlatnak. A részletes feltételekért keresse meg az INFINITI Márkakereskedését.</p>
					<h4><strong>Kiterjesztett garancia</strong></h4>
					<p style="text-align: justify;">Kérje kollégáinktól a Prémium Exclusive kiterjesztett garancia széleskörű szolgáltatását, a választott autóra vontakozó ajánlatunkat.</p>
				</div>
				<?php } ?>
			</div>		
		</div>
		<div id="my-infiniti-details-facility" class="my-infiniti-details-item-hidden">
			<div class="grid-row"><div class="col-12 my-infiniti-details-description"><?php echo $car["facility"]; ?></div></div>
		</div>
		<div id="my-infiniti-details-form" class="my-infiniti-details-item-hidden">
			<?php include("_form.php"); ?>
		</div>
	</div>
</div>