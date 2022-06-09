<div class="grid-row">
	<div class="col-12">
		<div id="my-infiniti-users">
			<?php	
			foreach($VIEW["vars"]["userList"] AS $userKey => $user)
			{
				?><div class="my-infiniti-users-item"><?php include("_user-item.php"); ?></div><?php
			}
			?>
		</div>
		<br>
		<div id="mymodal-emailshow" class="mymodal">
			<div class="mymodal-content">
				<div class="mymodal-header">
					<span>Szükséges van személyes tanácsadásra a választáshoz?<br>Kérjen visszahívást!</span>
					<span class="close" onclick="modalClose('mymodal-emailshow')">&times;</span>
				</div>
				<div class="mymodal-body">
					<form id="form-emailshow" onsubmit="return false;" class="my-infiniti-text-center">
						<script src="https://www.google.com/recaptcha/api.js"></script>
						<div class="g-recaptcha" style="display: inline-block;" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>" data-callback="showPremiseUserEmailsRecaptchaCallback"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function showPremiseUserEmails()
{
	modalOpen("mymodal-emailshow");
}

function showPremiseUserEmailsRecaptchaCallback()
{
	modalClose("mymodal-emailshow");
	$.ajax({
		type: "POST",
		url: "<?php echo PATH_WEB; ?>munkatars-emailek",
		dataType: "json",
		success: function(data){
			$.each(data, function(index, value) {
				$("#my-infiniti-user-" + index + " .my-infiniti-user-email a").removeAttr("onclick").attr("href", "mailto:" + value).attr("target", "_blank").html(value);
			});
		},
	});
}
</script>