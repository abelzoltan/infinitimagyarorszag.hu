<?php
include("_switchery.php");
include("_ckeditor.php");
?>
<form class="form-horizontal form-label-left" action="<?php echo $GLOBALS["URL"]->currentURL; ?>" method="post" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="process" value="1">
	<input type="hidden" name="work" value="<?php echo $postWork; ?>">
	<?php if($postWork == "edit") { ?><input type="hidden" name="id" value="<?php echo $formRow->id; ?>"><?php } ?>
	<div class="x_panel">
		<div class="x_title">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="font-bold">Alapadatok</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="x_content">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Modell<span class="required">*</span>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<select class="form-control" name="model" required>
						<option value="" class="color-gray2">(Válasszon modellt!)</option>
						<?php foreach($usedCarModels AS $usedCarModelID => $usedCarModel) { ?>
							<option value="<?php echo $usedCarModelID; ?>" <?php if($formRow->model == $usedCarModelID) { ?>selected<?php } ?>><?php echo $usedCarModel; ?></option>
						<?php } ?>
					</select>	
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Megnevezés<span class="required">*</span>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12"><input class="form-control" type="text" name="name" value="<?php echo $formRow->name; ?>" required></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Értékesítő:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<select class="form-control" name="user">
						<option value="" class="color-gray2">(Válasszon értékesítőt!)</option>
						<?php foreach($usedCarUsers AS $usedCarUserID => $usedCarUser) { ?>
							<option value="<?php echo $usedCarUserID; ?>" <?php if($formRow->user == $usedCarUserID) { ?>selected<?php } ?>><?php echo $usedCarUser; ?></option>
						<?php } ?>
					</select>	
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Rövid megnevezés<span class="required">*</span>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input class="form-control" type="text" name="shortName" value="<?php echo $formRow->shortName; ?>" required>
					<p class="help-block">Az autólistában megjelenítendő név.</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Rövid ismertető:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<input class="form-control" type="text" name="shortText" value="<?php echo $formRow->shortText; ?>">
					<p class="help-block">Az autólistában megjelenítendő rövid, 1-2 mondatos szöveg.</p>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Aktív?:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="checkbox-switchery-container">
						<label><input type="checkbox" name="active" class="js-switch" value="1" <?php if($formRow->active) { ?>checked<?php } ?>></label>
					</div>
					<p class="help-block">Inaktív esetén az admin felületen látható és kezelhető az autó, de a publikus oldalon nem érhető el.</p>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Kép:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<?php
					if(isset($currentCar["pic"]) AND $currentCar["pic"] !== false)
					{
						$pic = $currentCar["pic"];
						?>
						<a class="file-link btn btn-sm btn-info font-bold fancybox" href="<?php echo $pic["path"]["web"]; ?>" data-fancybox-title="<?php echo $pic["fullName"]; ?>" data-fancybox-group="single-picture">Megtekintés</a>
						<a class="file-link btn btn-sm btn-dark font-bold" href="<?php echo $GLOBALS["URL"]->link(["file", "download", $pic["id"]], ["from" => $GLOBALS["URL"]->routes]); ?>">Letöltés</a>
						<button type="button" class="file-link btn btn-sm btn-danger font-bold" data-toggle="modal" data-target="#modal-file-del-<?php echo $pic["id"]; ?>">Törlés</button>
						<div class="modal fade" id="modal-file-del-<?php echo $pic["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-file-del-<?php echo $pic["id"]; ?>" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title" id="myModalLabel-file-del-<?php echo $pic["id"]; ?>">Feltöltött kép törlése</h4>
									</div>
									<div class="modal-body">
										Biztosan szeretné törölni a <strong>feltöltött képet</strong>?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Nem</button>
										<a href="<?php echo $GLOBALS["URL"]->link(["file", "del", $pic["id"]], ["from" => $GLOBALS["URL"]->routes]); ?>" class="inline-block"><button type="button" class="btn btn-primary">Igen</button></a>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="file-input-container">
							<div class="btn btn-primary file-button"><span class="fa fa-upload"></span></div>
							<input type="text" class="form-control file-text" name="pic-text" id="pic-text">
							<div class="clear"></div>
							<input type="file" class="form-control file-input" name="pic" onchange="document.getElementById('pic-text').value = this.value;">
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-xs-12 text-center">
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<a class="btn btn-lg btn-danger display-block-xs" href="<?php echo $GLOBALS["URL"]->link([$GLOBALS["URL"]->routes[0]]); ?>"><i class="fa fa-arrow-left"></i> &nbsp;Vissza</a>
					<div class="visible-xs height-30"></div>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<button type="submit" class="btn btn-lg btn-success display-block-xs"><i class="fa fa-floppy-o"></i> &nbsp;Mentés</button>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
				</div>
			</div>
		</div>
	</div>	
	<div class="x_panel">
		<div class="x_title">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="font-bold">Árak, További adatok</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="x_content">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $usedCarPriceTexts["list"]; ?><span class="required">*</span>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12"><input class="form-control" type="number" name="priceList" value="<?php echo $formRow->priceList; ?>" required></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $usedCarPriceTexts["sale"]; ?>:</label>
				<div class="col-md-9 col-sm-9 col-xs-12"><input class="form-control" type="number" name="priceSale" value="<?php echo $formRow->priceSale; ?>"></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Nettó?:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="checkbox-switchery-container">
						<label><input type="checkbox" name="isNet" class="js-switch" value="1" <?php if($formRow->isNet) { ?>checked<?php } ?>></label>
					</div>
					<p class="help-block">Ha a beírt árak nettóban értendőek. Az ár kiírásakor kiegésdzül a következő szöveggel: "<strong><?php echo $usedCarPriceTexts["net"]; ?></strong>".</p>
				</div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Dokumentum:</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<?php
					if(isset($currentCar["document"]) AND $currentCar["document"] !== false)
					{
						$document = $currentCar["document"];
						?>
						<a class="file-link btn btn-sm btn-info font-bold" href="<?php echo $document["path"]["web"]; ?>" target="_blank">Megtekintés</a>
						<a class="file-link btn btn-sm btn-dark font-bold" href="<?php echo $GLOBALS["URL"]->link(["file", "download", $document["id"]], ["from" => $GLOBALS["URL"]->routes]); ?>">Letöltés</a>
						<button type="button" class="file-link btn btn-sm btn-danger font-bold" data-toggle="modal" data-target="#modal-file-del-<?php echo $document["id"]; ?>">Törlés</button>
						<div class="modal fade" id="modal-file-del-<?php echo $document["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-file-del-<?php echo $document["id"]; ?>" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title" id="myModalLabel-file-del-<?php echo $document["id"]; ?>">Feltöltött dokumentum törlése</h4>
									</div>
									<div class="modal-body">
										Biztosan szeretné törölni a <strong>feltöltött dokumentumot</strong>?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Nem</button>
										<a href="<?php echo $GLOBALS["URL"]->link(["file", "del", $document["id"]], ["from" => $GLOBALS["URL"]->routes]); ?>" class="inline-block"><button type="button" class="btn btn-primary">Igen</button></a>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="file-input-container">
							<div class="btn btn-primary file-button"><span class="fa fa-upload"></span></div>
							<input type="text" class="form-control file-text" name="mydocument-text" id="mydocument-text">
							<div class="clear"></div>
							<input type="file" class="form-control file-input" name="mydocument" onchange="document.getElementById('mydocument-text').value = this.value;">
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Alvázszám:</label>
				<div class="col-md-9 col-sm-9 col-xs-12"><input class="form-control" type="text" name="carBodyNumber" value="<?php echo $formRow->carBodyNumber; ?>"></div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-xs-12 text-center">
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<a class="btn btn-lg btn-danger display-block-xs" href="<?php echo $GLOBALS["URL"]->link([$GLOBALS["URL"]->routes[0]]); ?>"><i class="fa fa-arrow-left"></i> &nbsp;Vissza</a>
					<div class="visible-xs height-30"></div>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<button type="submit" class="btn btn-lg btn-success display-block-xs"><i class="fa fa-floppy-o"></i> &nbsp;Mentés</button>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
				</div>
			</div>
		</div>
	</div>	
	<div class="x_panel">
		<div class="x_title">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="font-bold">Adatlapi tartalmak</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="x_content">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Általános információ:</label>
				<div class="height-10 clear"></div>
				<div class="col-xs-12"><textarea name="text" class="ckeditor"><?php echo $formRow->text; ?></textarea></div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Felszereltség:</label>
				<div class="height-10 clear"></div>
				<div class="col-xs-12"><textarea name="facility" class="ckeditor"><?php echo $formRow->facility; ?></textarea></div>
			</div>
			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-xs-12 text-center">
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<a class="btn btn-lg btn-danger display-block-xs" href="<?php echo $GLOBALS["URL"]->link([$GLOBALS["URL"]->routes[0]]); ?>"><i class="fa fa-arrow-left"></i> &nbsp;Vissza</a>
					<div class="visible-xs height-30"></div>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
					<button type="submit" class="btn btn-lg btn-success display-block-xs"><i class="fa fa-floppy-o"></i> &nbsp;Mentés</button>
					<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
				</div>
			</div>
		</div>
	</div>	
</form>	