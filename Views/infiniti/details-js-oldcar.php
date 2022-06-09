<script>
function myFormOpen(hash)
{
	var fullHash = "#" + hash;
	if(window.location.hash != fullHash) { window.location.hash = fullHash; }
	if(hash == "ajanlatkeres") 
	{
		myInfinitiMenu("form", $("#my-infiniti-btn-form")); 
		
		$("html, body").animate({
			scrollTop: $("#my-infiniti-details-bottom").offset().top
		}, 1000);	
	}
	else if(hash == "tesztvezetes") 
	{ 
		myInfinitiMenu("form", $("#my-infiniti-btn-form"));
		$("#my-infiniti-radio-t").prop("checked", true);
		
		$("html, body").animate({
			scrollTop: $("#my-infiniti-details-bottom").offset().top
		}, 1000);
	}
}

function myInfinitiMenu(id, e)
{
	var preText = "#my-infiniti-details-";
	var openedMenu = $(preText + "bottom").attr("data-opened");
	if(openedMenu != id)
	{
		$(preText + openedMenu).slideUp(400, function (){
			$(preText + id).slideDown();
		});
		$(preText + "menu a").removeClass("my-infiniti-btn-active");
		$(e).addClass("my-infiniti-btn-active");
		$(preText + "bottom").attr("data-opened", id);
	}
}

$(document).ready(function(){
	myFormOpen(window.location.hash.substring(1)); 
});
</script>