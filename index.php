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
	


	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="stylesheets/skin.css">
	<link type="text/css" rel="stylesheet" href="scripts/r-lightbox/css/ui-lightness/jquery-ui-1.8.16.custom.css" />
	<link type="text/css" rel="stylesheet" href="scripts/r-lightbox/css/lightbox.min.css" />
	<link rel="stylesheet" href="scripts/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="scripts/nivo-slider/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="scripts/nivo-slider/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="scripts/nivo-slider/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="scripts/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
    <!-- <link rel="stylesheet" href="style.css" type="text/css" media="screen" /> -->

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
<body class="home-page">

<div id="fb-root"></div>
<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="outerBox">


	<!-- Primary Page Layout
	================================================== -->

	<!-- container - HEADER CONTENT -->

	<div class="header">
	<?php include ("includes/header.php"); ?>
	</div>
	
	<!-- container - CENTER CONTENT -->
	
	<div class="container sixteen columns center-content wrapper">
		
		<div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="images/slider/featured-slide-welcome.jpg" alt="featured-slide-welcome" data-thumb="images/slider/featured-slide-welcome.jpg">
                <img src="images/slider/featured-slide-adapt.jpg" alt="I Adapt" data-thumb="images/slider/featured-slide-adapt.jpg">
                <a href="art.php"><img src="images/slider/featured-slide-art.jpg" alt="Artwork" data-thumb="images/slider/featured-slide-art.jpg"></a> 
                <a href="web.php"><img src="images/slider/featured-slide-websites.jpg" alt="Premium Websites" data-thumb="images/slider/featured-slide-websites.jpg"> </a>        
            </div>
            
            <div id="htmlcaption" class="nivo-html-caption">
                Slider caption with <a href="#">a link</a>. 
            </div>
        </div>
        
        <div class="row">
        <div class="one-third column featured-block bottom-margin">
	        <!-- <img src="images/main/call-out_3dot0.png" alt="call-out_3dot0" class="scale-with-grid features-image"> -->
	        <h3>3.0 Update is Here!</h3>
	        <h5>New Design, Same Concepts.</h5>
	        <p>Welcome to Version 3.0 of BigIdeaSupply.com. Following cues from version 2, Version 3 is all about simple user experiences. Designed to make things easy. Get the info you need and move on. Hope you dig! If you notice anything out of place, please feel free to  <a href="contact.php">send us feedback!</a> </p>
        </div>
        <div class="one-third column featured-block bottom-margin">
	        <!-- <img src="images/main/call-out_-adapt.png" alt="I adapt!" class="scale-with-grid features-image"> -->
	        <h3>Now Responsive...</h3>
	        <h5>We've adapted.</h5>
	        <p>Go ahead, scale the window. Check out the site on your iPad, iPhone, Android device, TV, Game console... refrigerator... whatever. The new Big Idea Supply is optimized to provide a maximum user experience on any device. You may notice things move...that's called adaptation!</p>
        </div>
        <div class="one-third column featured-block bottom-margin">
	        <h3>Featured Work</h3>
	        <h5>Venomous2ooo: Still Connected Vol.2</h5>
	        <p class="recent-work"><a href="port-still-connected-front.php"><img src="images/hp-featured/featured-still-connected.jpg" alt="Venomous200 & Kingshon: Still Connected"  class="scale-with-grid"></a></p>
        </div>
        </div>
		
		<div class="row page-plate">
			<a href="contact.php"><img src="images/main/page-plate.png" alt="page-plate" class="scale-with-grid"></a>
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
	<script type="text/javascript" src="scripts/nivo-slider/demo/scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="scripts/nivo-slider/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
		$(window).load(function() {
	    $('#slider').nivoSlider({
	        effect: 'sliceUpDownLeft', // Specify sets like: 'fold,fade,sliceDown'
	        slices: 15, // For slice animations
	        boxCols: 8, // For box animations
	        boxRows: 4, // For box animations
	        animSpeed: 500, // Slide transition speed
	        pauseTime: 6000, // How long each slide will show
	        startSlide: 0, // Set starting Slide (0 index)
	        directionNav: true, // Next & Prev navigation
	        controlNav: true, // 1,2,3... navigation
	        controlNavThumbs: false, // Use thumbnails for Control Nav
	        pauseOnHover: true, // Stop animation while hovering
	        manualAdvance: false, // Force manual transitions
	        prevText: 'Prev', // Prev directionNav text
	        nextText: 'Next', // Next directionNav text
	        randomStart: false, // Start on a random slide
	        beforeChange: function(){}, // Triggers before a slide transition
	        afterChange: function(){}, // Triggers after a slide transition
	        slideshowEnd: function(){}, // Triggers after all slides have been shown
	        lastSlide: function(){}, // Triggers when last slide is shown
	        afterLoad: function(){} // Triggers when slider has loaded
		    });
		});
	</script>
	<!-- <script type="text/javascript" src="/scripts/r-lightbox/lib/jquery-1.6.4.min.js"></script> -->
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.core.min.js"></script>
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.widget.min.js"></script>
	<script type="text/javascript" src="/scripts/r-lightbox/lib/jquery.ui.rlightbox.min.js"></script>
	
	
	<script type="text/javascript">
	    jQuery(function($) {
		$( ".lb_overlay" ).rlightbox();
	    });
	</script>
    
</body>
</html>