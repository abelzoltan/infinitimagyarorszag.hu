<?php $picBig = (count($accessory["gallery"]) > 0) ? $accessory["gallery"][array_keys($accessory["gallery"])[0]]["path"]["web"] : $accessory["picLink"]; ?>
<div class="col-6">
	<div class="c_005">
		<div class="content-half">
			<a href="<?php echo $picBig; ?>" class="fancybox" data-fancybox="gallery" data-caption="<?php echo $accessory["data"]["nameOut"]; ?>"><img src="<?php echo $accessory["picLink"]; ?>" alt="" class="my-infiniti-img"></a>
			<div class="heading-group"><h3 style="margin-top: 0;"><span><?php echo $accessory["data"]["nameOut"]; ?></span></h3></div>
			<div class="content-group"><?php echo $accessory["data"]["text"]; ?></div>
		</div>
	</div>
</div>
<?php
$i++;
if($i % 2 == 0) { ?><div class="my-infiniti-clear"></div><?php }