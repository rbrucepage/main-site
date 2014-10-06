<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Web and Mobile Solutions From The Big Idea Supply Company</title>
	<meta name="description" content="Web and Mobile creative solutions. Beautiful design that gets out of the way.">
	<meta name="author" content="The Big Idea Supply Company">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Facebook
  ================================================== -->
	<meta property="og:title" content="The Big Idea Supply Company" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.bigideasupply.com/" />
	<meta property="og:image" content="http://www.bigideasupply.com/images/logo-facebook.png" />
	<meta property="og:site_name" content="BigIdeaSupply.com" />
	<meta property="fb:app_id" content="216672625066276" />

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="stylesheets/skin.css">
	<link type="text/css" rel="stylesheet" href="scripts/r-lightbox/css/ui-lightness/jquery-ui-1.8.16.custom.css" />
	<link type="text/css" rel="stylesheet" href="scripts/r-lightbox/css/lightbox.min.css" />
	

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="apple-touch-icon-precomposed" media="screen and (resolution: 163dpi)" href="/images/ios-57.png" />
	<link rel="apple-touch-icon-precomposed" media="screen and (resolution: 132dpi)" href="/images/ios-72.png" />
	<link rel="apple-touch-icon-precomposed" media="screen and (resolution: 326dpi)" href="/images/ios-114.png" />
	<link rel="shortcut icon" href="/images/favicon.ico" />
	
	<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->

</head>
<body class="portfolio-page art">
<div class="outerBox">


	<!-- Primary Page Layout
	================================================== -->

	<!-- container - HEADER CONTENT -->

	<div class="header">
	<?php include ("includes/header.php"); ?>
	</div>
	
	<!-- container - CENTER CONTENT -->
	
	<div class="container center-content">
		
		<div class="seven columns featured-art">
			<a href="/images/portfolio/full/bisc-artwork-full-indy.jpg" title="Monoprint of Downtown Indianapolis" class="lb_overlay opacity"><img src="images/portfolio/bisc-v3-960g_portfolio-indy.png" alt="Indianapolis" class="scale-with-grid"></a>
			<h5>2000</h5>
			<h3><a href="/images/portfolio/full/bisc-artwork-full-indy.jpg" title="Monoprint of Downtown Indianapolis" class="lb_overlay">Indianapolis</a></h3>
			<h5>Monoprint</h5>
			<div class="descriptive-block">A mono-print I created of the city I call home. The print was based on a photograph taken of downtown from our photography studio. I love the mono-printing process because a single print is all that can be generated from each plate produced. In the case of this print, three plates were painted (green yellow and red) individually, and were then printed over one another, creating the final art show above. What a beautifully unpredictable process.</div>
		<br class="clear" />
		</div>
		
		
		<?php include ("includes/portfolio-art.php"); ?>
		
		
		<div class="three columns port-links porfolioRightNav">
				<?php include ("includes/portrightnav.php"); ?>
		</div>
		
		<br class="clear" />
		<div class="divPush"></div>		

	</div>


<!-- End Document
================================================== -->
</div>

<!-- container - FOOTER CONTENT -->
	
	<div class="footer">
	<?php include ("includes/footer.php"); ?>
	</div>
	
	
	<!-- Scripts
	================================================== -->
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.core.min.js"></script>
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.widget.min.js"></script>
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.rlightbox.min.js"></script>
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
	</script>
	<script type="text/javascript">
	    jQuery(function($) {
		$( ".lb_overlay" ).rlightbox();
	    });
	</script>
    
</body>
</html>