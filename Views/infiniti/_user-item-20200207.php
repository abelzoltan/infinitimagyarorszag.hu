<div class="my-infiniti-user" id="my-infiniti-user-<?php echo $user["id"]; ?>">
	<div class="my-infiniti-user-img"><img src="<?php echo $user["pic"]; ?>?v=20181017" alt="<?php echo $user["name"]; ?>"></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-name"><?php echo $user["name"]; ?></div>
	<div class="my-infiniti-user-position"><?php echo $user["position"]; ?></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-data my-infiniti-user-premise"><?php echo $user["premise"]; ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-address"><?php echo $user["address"]; ?></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-data my-infiniti-user-phone">T: <?php echo $user["phone"]; ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-mobile">M: <?php echo $user["mobile"]; ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-email"><a href="mailto:<?php echo $user["email"]; ?>" target="_blank"><?php echo $user["email"]; ?></a></div>
</div>