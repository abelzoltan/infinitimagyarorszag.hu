<?php 
if(file_exists(DIR_ROUTES."_inc-view-set-variables.php")) { include(DIR_ROUTES."_inc-view-set-variables.php"); }
$infinitiDir = DIR_PUBLIC_WEB."infiniti/";

if($mainLang == "en")
{
	$texts = [
		"menuNewCar" => "New Cars",
		"menuStockCar" => "New Cars in Stock",
		"menuUsedCar" => "Pre owned cars / Infiniti Approved",
		"menuService" => "Service",
		"menuNews" => "News & Events",
	];
}
else
{
	$texts = [
		"menuNewCar" => "Új autók",
		"menuStockCar" => "Készleten lévő autóink",
		"menuUsedCar" => "Ellenőrzött használt autók / Infiniti Approved",
		"menuService" => "Szerviz",
		"menuNews" => "Hírek és események",
	];
}
?>
<!DOCTYPE html>
<html lang="hu-HU" dir="ltr" class="" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="MQMqy9Au0k6P6xOnYiTa5qcmMrLn_oBHiZYzBDzlFPY">
	<meta name="geo.country" content="HU">
	<base href="<?php echo INFINITI_HU; ?>" target="_blank">
	
	<title><?php echo strip_tags($VIEW["title"])." - ".INFINITI_GABLINI; ?></title>	
	<?php
	include(DIR_VIEWS."_inc-head-meta.php");	

	$INCLUDE_NAME = "headTop";
	include(DIR_ROUTES."_inc-view-section.php");
	?>	
	<meta name="robots" content="index,follow">
	<!--link rel="stylesheet" media="print, screen" href="<?php echo DIR_PUBLIC_WEB; ?>css/owl.carousel.min.css"-->
	<link rel="stylesheet" media="print, screen" href="<?php echo DIR_PUBLIC_WEB; ?>css/font-awesome.min.css">
	<link rel="stylesheet" media="print, screen" href="<?php echo $infinitiDir; ?>css/fonts-latin-extended.min.css">
	<link rel="stylesheet" media="print, screen" href="<?php echo $infinitiDir; ?>css/small.min.css">
	<link rel="stylesheet" media="print, screen and (min-width: 36.3125em)" href="<?php echo $infinitiDir; ?>css/medium.min.css">
	<link rel="stylesheet" media="print, screen and (min-width: 60em)" href="<?php echo $infinitiDir; ?>css/large.min.css">
	<link rel="stylesheet" media="print" href="<?php echo $infinitiDir; ?>css/print.min.css">

	<!-- Android and Others -->
	<link rel="icon" type="image/png" href="<?php echo $infinitiDir; ?>favicon/favicon.png">
	<link rel="icon" type="image/png" sizes="24x24" href="<?php echo $infinitiDir; ?>favicon/favicon_24x24.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $infinitiDir; ?>favicon/favicon_32x32.png">
	<link rel="icon" type="image/png" sizes="48x48" href="<?php echo $infinitiDir; ?>favicon/favicon_48x48.png">
	<link rel="icon" type="image/png" sizes="64x64" href="<?php echo $infinitiDir; ?>favicon/favicon_64x64.png">
	<link rel="icon" type="image/png" sizes="72x72" href="<?php echo $infinitiDir; ?>favicon/favicon_72x72.png">
	<link rel="icon" type="image/png" sizes="120x120" href="<?php echo $infinitiDir; ?>favicon/favicon_120x120.png">
	<link rel="icon" type="image/png" sizes="152x152" href="<?php echo $infinitiDir; ?>favicon/favicon_152x152.png">
	<!-- Apple -->
	<link rel="apple-touch-icon" href="<?php echo $infinitiDir; ?>favicon/favicon_64x64.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $infinitiDir; ?>favicon/favicon_72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $infinitiDir; ?>favicon/favicon_120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $infinitiDir; ?>favicon_152x152.png">
	<!-- Windows Phone -->
	<meta name="msapplication-square70x70logo" content="<?php echo $infinitiDir; ?>favicon/favicon_72x72.png" />
	<meta name="msapplication-square150x150logo" content="<?php echo $infinitiDir; ?>favicon/favicon_152x152.png" />
	<meta name="msapplication-square310x310logo" content="<?php echo $infinitiDir; ?>favicon/favicon_152x152.png" />
	
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1688416021398964');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1688416021398964&ev=PageView&noscript=1" /></noscript>
	<!-- End Facebook Pixel Code -->
	
	<link rel="stylesheet" media="print, screen" href="<?php echo DIR_PUBLIC_WEB; ?>css/infiniti.css?v=20200207">
	<style>
		<?php
		$INCLUDE_NAME = "headStyle";
		include(DIR_ROUTES."_inc-view-section.php");
		?>
	</style>
	<?php if(isset($_GET["ujchat"]) AND $_GET["ujchat"]) { ?>
		<!--Start of Tawk.to Script-->
		<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5d78a52577aa790be3337b5b/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
		</script>
	<!--End of Tawk.to Script-->
	<?php } else { ?>	
		<!-- Smartsupp Live Chat script -->
		<script type="text/javascript">
		var _smartsupp = _smartsupp || {};
		_smartsupp.key = '3a182638dc7db75713f8387416cd03b9c3ca4cae';
		window.smartsupp||(function(d) {
		  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
		  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
		  c.type='text/javascript';c.charset='utf-8';c.async=true;
		  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
		})(document);
		</script>
	<?php } ?>	
	
	<!-- Hotjar Tracking Code for -->
	<script>
	(function(h,o,t,j,a,r){
		h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		h._hjSettings={hjid:806054,hjsv:6};
		a=o.getElementsByTagName('head')[0];
		r=o.createElement('script');r.async=1;
		r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	
	<!-- Adform Tracking Code BEGIN -->
	<script type="text/javascript">
		window._adftrack = Array.isArray(window._adftrack) ? window._adftrack : (window._adftrack ? [window._adftrack] : []);
		window._adftrack.push({
			pm: 1460314
		});
		(function () { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'https://track.adform.net/serving/scripts/trackpoint/async/'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();

	</script>
	<noscript>
		<p style="margin:0;padding:0;border:0;">
			<img src="https://track.adform.net/Serving/TrackPoint/?pm=1460314" width="1" height="1" alt="" />
		</p>
	</noscript>
	<!-- Adform Tracking Code END -->
	
	<!-- Taboola Pixel Code -->
	<script type='text/javascript'>
		window._tfa = window._tfa || [];
		window._tfa.push({notify: 'event', name: 'page_view', id: 1154547});
		!function (t, f, a, x) {
			if (!document.getElementById(x)) {
				t.async = 1;t.src = a;t.id=x;f.parentNode.insertBefore(t, f);
			}
		}(document.createElement('script'),
		document.getElementsByTagName('script')[0],
		'//cdn.taboola.com/libtrc/unip/1154547/tfa.js',
		'tb_tfa_script');
	</script>
	<noscript><img src="//trc.taboola.com/1154547/log/3/unip?en=page_view" width="0" height="0" style="display:none"></noscript>
	<!-- End of Taboola Pixel Code -->
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M9D7B9D');</script>
	<!-- End Google Tag Manager -->
	
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M64GG3H');</script>
	<!-- End Google Tag Manager -->
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	
	<?php
	$INCLUDE_NAME = "headBottom";
	include(DIR_ROUTES."_inc-view-section.php");
	?>
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9D7B9D"	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M64GG3H"; height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	
	<?php 
	$INCLUDE_NAME = "bodyTop";
	include(DIR_ROUTES."_inc-view-section.php");

	if(!isset($_COOKIE["cookiesAccepted"]) OR empty($_COOKIE["cookiesAccepted"]) OR $_COOKIE["cookiesAccepted"] == false)
	{ 
		?>
		<div class="c_128" id="cookies">
			<div class="cookies-row">
				<div class="cookies-content">
					<p class="heading">Cookie használat</p>
					<p>A weboldal cookie-kat használ. Ha továbblép, azzal beleegyezik a cookie-k használatába. További részletekért lásd a <a href="https://www.infiniti.hu/cookie.html">Cookie szabályzatunkat</a>.</p>
					<button>ELFOGAD ÉS BEZÁR</button>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	<div class="header">
		<div class="noindex">
			<ul id="skiplinks" class="skiplinks">
				<li><a href="#container">Ugrás a fő tartalomhoz</a></li>
			</ul>
		</div>
		<div itemscope="itemscope" itemtype="http://schema.org/WPHeader">
			<div class="noindex">
				<header class="c_010 grid-row bleed">
					<div class="col-12">
						<?php if($mainHeaderMenusShow) { ?>
							<div class="global-nav-container" role="navigation" aria-label="global navigation">
								<ul class="nav-global grid-row">
									<li class="login"></li>
									<li><a href="<?php echo PATH_WEB; ?>munkatarsak" target="_self"><b>Munkatársak</b></a></li>
									<li><a href="<?php echo PATH_WEB; ?>prospektusok" target="_self"><b>Prospektusok</b></a></li>
									<li class="nav-global-batd"><a href="<?php echo PATH_WEB; ?>tesztvezetes" target="_self"><b>Tesztvezetés</b></a></li>
									<li class="nav-global-batd"><a href="<?php echo PATH_WEB; ?>kapcsolatfelvetel" target="_self"><b>Kapcsolatfelvétel</b></a></li>
								</ul>
							</div>
						<?php } ?>
						<div class="grid-row">
							<div class="nav-root upgraded">
								<div class="title-logo-container grid-row">
									<a class="show-menu" href="#" title="" aria-label=""></a>
									<span class="logo">
										<a href="<?php echo PATH_WEB; ?>" target="_self" data-adobe-tagging="Homepage">
											<img class="logo-large" src="<?php echo $infinitiDir; ?>Infiniti-logo-black_Desktop.png" alt=""/>
											<img class="logo-small" src="<?php echo $infinitiDir; ?>Infiniti-logo-black_mobile.png" alt=""/>
											<img class="logo-print" src="<?php echo $infinitiDir; ?>Infiniti-logo-black_Tablet.png" alt=""/>
										</a>
									</span>
									<p class="page-title"><?php echo $VIEW["title"]; ?></p>
									<ul class="print-info">
										<li class="print-info-date"><span></span></li>
										<li class="print-info-url"></li>
									</ul>
								</div>
								<div class="nav-container grid-row">
									<div class="nav-inner">
										<button class="close-menu" aria-label=""></button>
										<div class="main-nav-wrapper">
											<nav aria-label="main navigation" class="grid-row">
												<div class="primaryNav pageNavigation">
													<ul class="nav-primary itemscope" itemtype="http://schema.org/SiteNavigationElement">
														<li><a itemprop="url" href="<?php echo PATH_WEB; ?>uj-autok" target="_self" title="<?php echo $texts["menuNewCar"]; ?>"><?php echo $texts["menuNewCar"]; ?></a></li>
														<li><a itemprop="url" href="<?php echo PATH_WEB; ?>keszleteink" target="_self" title="<?php echo $texts["menuStockCar"]; ?>"><?php echo $texts["menuStockCar"]; ?></a></li>
														<li><a itemprop="url" href="<?php echo INFINITI_APPROVED; ?>" target="_self" title="<?php echo $texts["menuUsedCar"]; ?>"><?php echo $texts["menuUsedCar"]; ?></a></li>
														<li><a itemprop="url" href="<?php echo PATH_WEB; ?>hirek" target="_self" title="<?php echo $texts["menuNews"]; ?>"><?php echo $texts["menuNews"]; ?></a></li>
														<li><a itemprop="url" href="<?php echo PATH_WEB; ?>szerviz" target="_self" title="<?php echo $texts["menuService"]; ?>"><?php echo $texts["menuService"]; ?></a></li>
													</ul>
												</div>
											</nav>
											<ul class="nav-global-small">
												<li><a href="<?php echo PATH_WEB; ?>munkatarsak" target="_self"><b>Munkatársak</b></a></li>
												<li><a href="<?php echo PATH_WEB; ?>prospektusok" target="_self"><b>Prospektusok</b></a></li>
												<li class="nav-global-small-batd"><a href="<?php echo PATH_WEB; ?>tesztvezetes" target="_self"><b>Tesztvezetés</b></a></li>
												<li class="nav-global-small-batd"><a href="<?php echo PATH_WEB; ?>kapcsolatfelvetel" target="_self"><b>Kapcsolatfelvétel</b></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="nav-mask"></div>
						</div>
					</div>
					<div class="title liveChatScript"></div>
				</header>
			</div>
		</div>
	</div>
	<main id="container" role="main">
		<div class="grid-row bleed">
			<div class="col-12"><div class="editorialInPageNavigation"></div></div>
		</div>
		<?php 
		if($mainHeaderShow)
		{
			?>
			<div class="grid-row" id="my-infiniti-page-header">
				<div class="col-12">
					<div class="pageHeader">
						<div class="c_023 " data-adobe-target-id="">
							<div class="container-inner">
								<div class="c_023-1 default">
									<div class="heading-group"><h1><span><?php echo $VIEW["title"]; ?></span></h1></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
		}
		$INCLUDE_NAME = "content";
		include(DIR_ROUTES."_inc-view-section.php");
		?>
	</main>
	<div class="grid-row bleed">
		<div class="noindex">
			<div class="c_054-2">
				<div class="grid-row">
					<div class="col-12">
						<ol>
							<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo PATH_WEB; ?>" target="_self" itemprop="url"><span itemprop="title"><?php echo INFINITI_GABLINI; ?></span></a></li>
							<li><span><?php echo strip_tags($VIEW["title"]); ?></span></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="noindex">
		<footer itemscope itemtype="http://schema.org/WPFooter" class="grid-row bleed">
			<nav class="c_054-3">
				<div class="grid-row">
					<div class="col-12">
						<dl class="col-4" style="border-bottom: 0;">
							<dt>
								<a href="#" class="accordionToggle"><span>Toggle KAPCSOLAT menu</span></a>
								<span>KAPCSOLAT</span>
							</dt>
							<dd><a href="/newsletter.html" data-adobe-tagging="newsletter"><span>Hírlevél</span></a></dd>
							<dd><a href="<?php echo PATH_WEB; ?>kapcsolatfelvetel" target="_self" data-adobe-tagging="contact-us"><span>Kapcsolatfelvétel</span></a></dd>
							<dd><a href="<?php echo PATH_WEB; ?>tesztvezetes" target="_self" data-adobe-tagging="batd"><span>Jelentkezzen tesztvezetésre</span></a></dd>
						</dl>
						<dl class="col-4" style="border-bottom: 0;">
							<dt>
								<a href="#" class="accordionToggle"><span>Toggle Segítség a vásárláshoz menu</span></a>
								<span>Segítség a vásárláshoz</span>
							</dt>
							<dd><a href="<?php echo PATH_WEB; ?>prospektusok" target="_self"><span>Prospektusok</span></a></dd>
							<dd><a href="<?php echo PATH_WEB; ?>prospektusok" target="_self"><span>Árlisták</span></a></dd>
						</dl>
						<dl class="col-4 last" style="border-bottom: 0;">
							<dt>
								<a href="#" class="accordionToggle"><span>Toggle Infiniti társadalmi felelősségvállalás menu</span></a>
								<span>Infiniti társadalmi felelősségvállalás</span>
							</dt>
							<dd><a class="social-icon icon-facebook" href="https://www.facebook.com/infinitibudapest/" target="_blank" rel=""><span>facebook</span></a></dd>
							<dd><a class="social-icon icon-twitter" href="https://twitter.com/InfinitiEurope" target="_blank" rel=""><span>twitter</span></a></dd>
						</dl>
					</div>
				</div>
			</nav>
		</footer>
	</div>
	<div class="noindex">
		<footer class="grid-row bleed">
			<nav class="c_025">
				<p class="strapline">Mi a lehetőségekre fókuszálunk, és nem a korlátokra</p>
				<div class="grid-row">
					<div class="col-12">
						<ul class="footer-options">
							<li><a href="/" title="">Infiniti.hu</a></li>
							<li><a href="/cookie.html" title="">Cookie információk</a></li>
							<li><a href="/privacy.html" title="">Adatkezelés</a></li>
							<li><a href="/legal.html" title="">Jogi nyilatkozat</a></li>
						</ul>
						<div class="footer-legal">
							<ul></ul>
							<p class="footer-copyright">&copy; Infiniti 2018</p>
						</div>
					</div>
				</div>
			</nav>
		</footer>
	</div>
	
	<script>
	function modalOpen(modal)
	{
		$("#" + modal).fadeIn();
		$("body").addClass("mymodal-open");
		$("#" + modal).click(function(e){
			if($(e.target).hasClass("mymodal-content") || $(e.target).parents().hasClass("mymodal-content")) {  }
			else { modalClose(modal); }
		});
	}
	
	function modalClose(modal)
	{
		$("#" + modal).fadeOut();
		$("body").removeClass("mymodal-open");
	}
	</script>
	
	<?php
	if($GLOBALS["URL"]->routes[0] != "visszahivas" AND $GLOBALS["URL"]->routes[0] != "visszahivas-befejezes" AND (!isset($_SESSION[SESSION_PREFIX."callBackPopUpDate"]) OR $_SESSION[SESSION_PREFIX."callBackPopUpDate"] < date("Y-m-d H:i:s", strtotime("-4 hours"))))
	{
		?>
		<div id="mymodal-callback" class="mymodal">
			<form class="mymodal-content" action="<?php echo PATH_WEB; ?>visszahivas" method="post" target="_self">
				<div class="mymodal-header">
					<span>Szükséges van személyes tanácsadásra a választáshoz?<br>Kérjen visszahívást!</span>
					<span class="close" onclick="modalClose('mymodal-callback')">&times;</span>
				</div>
				<div class="mymodal-body">
					<input type="hidden" name="process" value="1">
					<input type="hidden" name="url" value="<?php echo $GLOBALS["URL"]->currentURL; ?>">
					<div>
						<div class="textfield section">
							<div class="form-group">
								<label>Érdeklődés tárgya*</label>
								<div class="form-group-container">
									<select name="subject" class="my-infiniti-select" required>
										<option value="">(Kérjük válasszon!)</option>
										<option value="M3, Új autó" <?php if($postData["subject"] == "M3, Új autó") { ?>selected<?php } ?>>Új autó</option>
										<option value="M3, Szerviz" <?php if($postData["subject"] == "M3, Szerviz") { ?>selected<?php } ?>>Szerviz (M3)</option>
										<option value="Budaörs, Szerviz" <?php if($postData["subject"] == "Budaörs, Szerviz") { ?>selected<?php } ?>>Szerviz (Budaörs)</option>
										<option value="M3, Alkatrész" <?php if($postData["subject"] == "M3, Alkatrész") { ?>selected<?php } ?>>Alkatrész (M3)</option>
										<option value="Budaörs, Alkatrész" <?php if($postData["subject"] == "Budaörs, Alkatrész") { ?>selected<?php } ?>>Alkatrész (Budaörs)</option>
									</select>
								</div>
							</div>
						</div>
						<div class="my-infiniti-spacer"></div>
						<div style="float: left; width: 49%;">
							<div class="textfield section">
								<div class="form-group">
									<label for="textfield_3be">Vezetéknév*</label>
									<div class="form-group-container">
										<input type="text" id="textfield_3be" class="my-infiniti-input" name="lastName" required value="<?php echo $postData["lastName"]; ?>">
									</div>
								</div>
							</div>
							<div class="my-infiniti-spacer"></div>
						</div>
						<div style="float: right; width: 49%;">
							<div class="textfield section">
								<div class="form-group">
									<label for="textfield_273d">Keresztnév*</label>
									<div class="form-group-container">
										<input type="text" id="textfield_273d" class="my-infiniti-input" name="firstName" required value="<?php echo $postData["firstName"]; ?>">
									</div>
								</div>
							</div>
							<div class="my-infiniti-spacer"></div>
						</div>
						<div class="my-infiniti-clear"></div>
					</div>					
					<div class="textfield section">
						<div class="form-group">
							<label>Telefonszám*</label>
							<div class="form-group-container">
								<div class="row" style="margin-left: -2px; margin-right: -2px;">
									<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phonePart1" placeholder="Országkód*" required value="<?php if(!empty($postData["phonePart1"])) { echo $postData["phonePart1"]; } else { ?>+36<?php } ?>"></div>
									<div class="col-3" style="padding-left: 2px; padding-right: 2px;">
										<select class="my-infiniti-select" name="phonePart2Select" id="callBack-phonePart2Select" onchange="callBackPhoneParts(this, 'phonePart2')" required>
											<option value="">Előhívó</option>
											<option value="20" <?php if($postData["phonePart2Select"] == "20") { ?>selected<?php } ?>>20</option>
											<option value="30" <?php if($postData["phonePart2Select"] == "30") { ?>selected<?php } ?>>30</option>
											<option value="70" <?php if($postData["phonePart2Select"] == "70") { ?>selected<?php } ?>>70</option>
											<option value="-" <?php if($postData["phonePart2Select"] == "-") { ?>selected<?php } ?>>EGYÉB</option>
										</select>
										<input type="text" class="my-infiniti-input" name="phonePart2" id="callBack-phonePart2" placeholder="Előhívó*" required value="<?php if(!empty($postData["phonePart2"])) { echo $postData["phonePart2"]; } ?>" style="display: none;">
									</div>
									<div class="col-6" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phonePart3" placeholder="Telefonszám*" required value="<?php if(!empty($postData["phonePart3"])) { echo $postData["phonePart3"]; } ?>"></div>
									<div class="my-infiniti-clear"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="my-infiniti-spacer"></div>
					<div class="textfield section">
						<div class="form-group">
							<label>Vezetékes telefonszám</label>
							<div class="form-group-container">
								<div class="row" style="margin-left: -2px; margin-right: -2px;">
									<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart1" placeholder="Országkód*" required value="<?php if(!empty($postData["phoneWiredPart1"])) { echo $postData["phoneWiredPart1"]; } else { ?>+36<?php } ?>"></div>
									<div class="col-3" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart2" placeholder="Körzetszám" value="<?php if(!empty($postData["phoneWiredPart2"])) { echo $postData["phoneWiredPart2"]; } ?>">
									</div>
									<div class="col-6" style="padding-left: 2px; padding-right: 2px;"><input type="text" class="my-infiniti-input" name="phoneWiredPart3" placeholder="Vezetékes telefonszám" value="<?php if(!empty($postData["phoneWiredPart3"])) { echo $postData["phoneWiredPart3"]; } ?>"></div>
									<div class="my-infiniti-clear"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="my-infiniti-spacer"></div>
					<div class="textfield section g-recaptcha-container">
						<script src="https://www.google.com/recaptcha/api.js"></script>
						<div class="form-group">
							<label>Igazolja, hogy nem robot!</label>
							<div class="form-group-container">	
								<div class="g-recaptcha display-inline-block" data-sitekey="6LfcUBAUAAAAADgteIhCPJXEnSorp0ygBQ-oPnlT"></div>
							</div>
						</div>
					</div>
					<div class="checkbox section">
						<div class="form-group checkbox">
							<span class="help-block">
								<p>
									Elérhetőségei megadásával hozzájárul, hogy az INFINITI a tesztvezetéssel kapcsolatban keresse Önt, és a jövőben értesítse az INFINITI vel kapcsolatos hírekről.<br>
									Az egyes módok bejelölésével Ön hozzájárul, hogy az INFINITI a megadott módon vegye fel Önnel a kapcsolatot.<br>
								</p>
							</span>
						</div>
					</div>
				</div>
				<div class="mymodal-footer my-infiniti-text-center">
					<button type="submit" class="my-infiniti-btn">Küldés</button>
				</div>
			</form>
		</div>
		<script>
		function callBackPhoneParts(e, inputName)
		{
			if($(e).val() == "-")
			{
				$(e).hide();
				$("#callBack-" + inputName).show();
			}
			else
			{
				$("#callBack-" + inputName).val($(e).val());
				$("#callBack-" + inputName).hide();
			}
		}
		callBackPhoneParts($("#callBack-phonePart2Select"), "phonePart2");

		var callBackModal = 0;
		function callBackModalShow()
		{
			if(callBackModal <= 0) 
			{ 
				modalOpen("mymodal-callback");
				callBackModal++;
				$.ajax({
					type: "POST",
					url: "<?php echo PATH_WEB; ?>visszahivas-ablak",
					data: "name=" + name,
					dataType: "html",
					success: function(msg){
					},
				});
			}
		}
		
		$(document).ready(function(){
			$(document).on("mouseleave", function(){
				setTimeout(function(){
					callBackModalShow();
				}, 30000);	
			});
			
			setTimeout(function(){
				callBackModalShow();
			}, 60000);
		});
		</script>
		<?php
	}
	?>
	

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-6896841-9"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-6896841-9');
	</script>
	<!-- Google remarketingcímke-kód -->
	<!--------------------------------------------------
	A remarketingcímkék nem társíthatók személyazonosításra alkalmas adatokkal, és nem helyezhetők el érzékeny kategóriához kapcsolódó oldalakon. A címke beállításával kapcsolatban további információt és útmutatást a következő címen olvashat: http://google.com/ads/remarketingsetup
	--------------------------------------------------->
	<script type="text/javascript">
	/* <![CDATA[ */
	var google_conversion_id = 1061811836;
	var google_custom_params = window.google_tag_params;
	var google_remarketing_only = true;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
		<div style="display:inline;"><img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1061811836/?guid=ON&amp;script=0"/></div>
	</noscript>
	
	<script>
	(function ($, root, undefined) {
		$(function () {
			'use strict';
			$('.show-menu').click(function (e) {
				e.preventDefault();
				$('.nav-root').toggleClass('nav-is-open');
				$('body').toggleClass('nav-is-activated');
			});

			$('.close-menu').click(function (e) {
				e.preventDefault();
				$('.nav-root').toggleClass('nav-is-open');
				$('body').toggleClass('nav-is-activated');
			});

			<?php 
			if(!isset($_COOKIE["cookiesAccepted"]) OR empty($_COOKIE["cookiesAccepted"]) OR $_COOKIE["cookiesAccepted"] == false)
			{ 
				?>
				$('.cookies-content button').click(function (e) {
					e.preventDefault();
					$.ajax({
						type: "GET",
						url: "<?php echo PATH_WEB; ?>sutik-elfogadasa",
						dataType: "html",
						success: function(msg) {
							$('#cookies').hide();
						}
					});
				});
				<?php 
			} 
			?>

			/*$(".main-slider.owl-carousel").owlCarousel({
				items: 1,
				loop: true,
				dots: false,
				autoplayHoverPause: true,
				autoplay: true,
				autoplayTimeout: 10000,
				smartSpeed: 900,
				nav: true,
				navText: [
					"<i class='fa fa-angle-left'></i>",
					"<i class='fa fa-angle-right'></i>"
				]
			});*/

			$('.analytics-target').each(function() {
				var imgURL = $(this).attr('data-src');
				$(this).html('<img src="'+ imgURL +'">');
			});

			$('.dropdown-toggle').click(function(){
				$('.dropdown-toggle').not(this).each(function(){
					$(this).next('.dropdown-menu').removeClass('expanded');
					$(this).find('.fa').removeClass('fa-angle-up');
					$(this).find('.fa').addClass('fa-angle-down');
				});
				$(this).next('.dropdown-menu').toggleClass('expanded');
				$(this).find('.fa').toggleClass('fa-angle-down fa-angle-up');
			});

			$(document).click(function(e) {
				var target = e.target;
				if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
					$('.dropdown-menu').removeClass('expanded');
					$('.dropdown-toggle').find('.fa').removeClass('fa-angle-up');
					$('.dropdown-toggle').find('.fa').addClass('fa-angle-down');
				}
			});

		});
	})(jQuery, this);
	</script>

	<?php
	$INCLUDE_NAME = "bodyBottom";
	include(DIR_ROUTES."_inc-view-section.php");
	?>
</body>
</html>