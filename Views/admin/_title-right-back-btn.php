<a href="<?php if(isset($VIEW["vars"]["backButton"]["href"]) AND !empty($VIEW["vars"]["backButton"]["href"])) { echo $VIEW["vars"]["backButton"]["href"]; } else { echo $GLOBALS["URL"]->link($GLOBALS["URL"]->routes[0]); } ?>" class="btn btn-sm btn-danger btn-title-right"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;<?php if(isset($VIEW["vars"]["backButton"]["label"]) AND !empty($VIEW["vars"]["backButton"]["label"])) { echo $VIEW["vars"]["backButton"]["label"]; } else { ?>Vissza<?php } ?></a>
<div class="clear"></div>