<?php 
if(!empty($carAccessories) AND count($carAccessories) > 0)
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="my-infiniti-car-menu2">
				<div class="my-infiniti-car-menu-content">
					<?php foreach($carAccessories AS $cat1URL => $cat1) { ?>
					<span class="my-infiniti-car-menu-separator"></span>
					<a onclick="accessorySlider('<?php echo $cat1["data"]["data"]["name"]; ?>')" target="_self" class="my-infiniti-car-menu-item"><?php echo $cat1["data"]["data"]["nameOut"]; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="my-infiniti-spacer"></div>
	<?php
	$j = 0;
	foreach($carAccessories AS $cat1URL => $cat1)
	{
		if($j > 0)
		{
			?>
			<div class="my-infiniti-spacer"></div>
			<div class="grid-row">
				<div class="content-zone container c_002 content-divider"><hr></div>
			</div>
			<?php
		}
		?>
		<div id="kategoria-<?php echo $cat1["data"]["data"]["name"]; ?>"></div>
		<div class="grid-row">
			<div class="col-12">
				<div class="c_004">
					<div class="heading-group"><h2><span><?php echo $cat1["data"]["data"]["nameOut"]; ?></span></h2></div>
					<p class="content-copy"><?php echo $cat1["data"]["data"]["shortText"]; ?></p>
				</div>
			</div>
		</div>
		<div class="my-infiniti-spacer"></div>
		<div class="grid-row">
			<?php
			$i = 0;			
			if(count($cat1["accessories"]) > 0)
			{
				foreach($cat1["accessories"] AS $accessory) { include(INFINITI_VIEWS."_newcars-accessories-item.php");  }
			}
			if(count($cat1["categories"]) > 0)
			{
				foreach($cat1["categories"] AS $cat2URL => $cat2)
				{
					if(count($cat2["accessories"]) > 0)
					{
						foreach($cat2["accessories"] AS $accessoryKey => $accessory) { include(INFINITI_VIEWS."_newcars-accessories-item.php"); }
					}
				}
			}
			?>
		</div>
		<?php
		$j++;
	}
}
else
{
	?>
	<div class="grid-row">
		<div class="col-12">
			<div class="c_004" style="width: 100%; color: #cc0000;">
				<div class="heading-group"><h2><span>Jelenleg még nincs tartozék feltöltve a modellhez!</span></h2></div>
			</div>	
		</div>	
	</div>	
	<?php
}
?>
<script>
function accessorySlider(catName)
{
	$("html,body").animate({scrollTop:$("#kategoria-" + catName).offset().top - 50 }, 1000);
}
</script>