<p style="font-size: 1.34em; margin: .375em auto; text-align: center; font-weight: bold;">Töltse le az INFINITI modellek összes adatát tartalmazó anyagokat</p>
<?php if(!empty($carList)) { ?>
	<div class="freeEditorial freeEditorialParsys parsys">
		<div class="columns column section columns12">
			<div class="grid-row">
				<div class="col-12">
					<div class="parsys col1-par">
						<div class="vehiclelisting section">
							<div class="c_030-0">
								<div class="grid-row list-outer">
									<ul class="list-item">
										<?php 
										$target = "_self";
										foreach($carList AS $carKey => $car) { include("_list-item-pdf.php"); } 
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else { ?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_002">
				<div class="c_001">
					<p class="content-copy my-infiniti-text-center">Sajnáljuk, de jelenleg nincs elérhető árlista / prospektus!</p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>