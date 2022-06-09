<div class="grid-row">
	<div class="col-12">
		<div class="c_001" style="padding: 0;">
			<p class="content-copy" style="margin: 0;">Maradjon kapcsolatban az INFINITI világával. Nézze meg, mit teszünk Európában és világszerte azért, hogy segítsük kibontakozni az elkötelezett embereket.</p>
		</div>	
	</div>	
</div>	
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer"></div>
<?php 
$newsItemKey = array_keys($news)[0];
$newsItem = array_shift($news); 
?>
<div class="grid-row bleed">
	<div class="col-12">
		<div class="c_014">
			<span class="c_029-1"><img src="<?php echo $pics.$newsItem["img"]; ?>" alt="<?php echo $newsItem["name"]; ?>"></span>
			<div class="wrapper">
				<div class="heading-group">
					<h2><span><?php echo $newsItem["name"]; ?></span></h2>
					<p><span><?php echo $newsItem["text"]; ?></span></p>
				</div>
				<div class="content"><a href="<?php echo PATH_WEB."hirek/".$newsItemKey; ?>" class="button" target="_self">TOVÁBBI INFORMÁCIÓK</a></div>
			</div>
		</div>
	</div>
</div>
<div class="my-infiniti-spacer"></div>
<div class="my-infiniti-spacer my-infiniti-visible-0em"></div>
<div class="grid-row">
	<?php 
	$i = 0;
	foreach($news AS $newsItemKey => $newsItem)
	{
		?>
		<div class="col-4">
			<div class="col1-par parsys"><div class="imageTextLink image contentPromo section">
				<div class="c_005  media-right vertical-center" data-clickable="true">
					<div class="content-half"><img src="<?php echo $pics.$newsItem["img"]; ?>" alt="<?php echo $newsItem["name"]; ?>"></div>
					<div class="content-half">
						<div class="content-wrapper">
							<div class="heading-group"><h3><span><?php echo $newsItem["name"]; ?></span></h3></div>
							<div class="content-group">
								<p><?php echo $newsItem["text"]; ?></p>
								<div class="no-bullet">
									<ul>
										<li><a href="<?php echo PATH_WEB."hirek/".$newsItemKey; ?>" target="_self">TOVÁBBI INFORMÁCIÓK</a></li>
									</ul>
								</div>
							</div>
							<div class="disclaimer default"></div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php
		$i++;
		
		?><div class="my-infiniti-clear my-infiniti-spacer my-infiniti-visible-0em"></div><?php
		if($i % 3 == 0) { ?><div class="my-infiniti-clear my-infiniti-spacer my-infiniti-visible-60em"></div><?php }
		if($i % 2 == 0) { ?><div class="my-infiniti-clear my-infiniti-spacer my-infiniti-visible-36em"></div><?php }
	}
	?>
</div>
<div class="my-infiniti-spacer"></div>