<div class="my-infiniti-user" id="my-infiniti-user-<?php echo $user["id"]; ?>">
	<div class="my-infiniti-user-img"><img src="<?php echo $user["pic"]; ?>?v=20181017" alt="<?php echo $user["name"]; ?>"></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-name"><?php echo $user["name"]; ?></div>
	<div class="my-infiniti-user-position"><?php echo $user["position"]; ?></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-data my-infiniti-user-premise"><?php echo $user["premise"]; ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-address"><?php echo $user["address"]; ?></div>
	<div class="my-infiniti-user-separator"></div>
	<div class="my-infiniti-user-data my-infiniti-user-phone"><?php if(!empty($user["phone"])) { ?>T: <a href="tel:<?php echo str_replace(" ", "", $user["phone"]); ?>"><?php echo $user["phone"]; ?></a><?php } else { echo "&nbsp;"; } ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-mobile"><?php if(!empty($user["mobile"])) { ?>M: <a href="tel:<?php echo str_replace(" ", "", $user["mobile"]); ?>"><?php echo $user["mobile"]; ?></a><?php } else { echo "&nbsp;"; } ?></div>
	<div class="my-infiniti-user-data my-infiniti-user-email"><a onclick="showPremiseUserEmails()"><?php echo $user["emailX"]; ?></a></div>
</div>