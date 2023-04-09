<?php
/**
* @KingSize 2011
* The PHP code for setup Theme Gallery Page support header file.
* Begin creating Gallery Page support header file
* Gallery Page support header file
*/
global $tpl_body_id;

###### getting current template name ######
global $wp_query,$data;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorbox.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox-min.js"> </script>
<?php
}
elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>
	 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4.pack.js"></script> 
<?php
}
elseif ($tpl_body_id=="prettyphoto"   || $template_name == "template-prettyphoto.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
}
elseif ($tpl_body_id=="blog_overview" ) { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 

	<script type="text/javascript">  
	 jQuery(document).ready(function($) {
	   $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.7, /* Value betwee 0 and 1 */
		<?php if($data["wm_prettybox_share_option"] == 1) echo 'social_tools: false,';?>
		showTitle: true /* true/false */
		});
	})
	</script>
<?php
}
elseif ($tpl_body_id=="galleria"   || $template_name == "template-galleria.php") { 
?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.js"></script> 
<?php
}
elseif ($tpl_body_id=="slideviewer"   || $template_name == "template-slideviewer.php") { 
?>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.slideviewer.1.2.js"></script> 
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>	
 <script type="text/javascript">		
	$(window).bind("load", function(){ 
		$("#gallery_slideviewer").css('display', 'none');
		$("#gallery_slideviewer").fadeIn('fast');
		$("#gallery_slideviewer").slideView();
	});
	</script>
<?php
}	
elseif ($tpl_body_id == "contactpage") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

	<script type="text/javascript">
	jQuery(document).ready(function($) {  
		var geocoder;
		var map;
		
		function codeAddress(address) {
			console.log('address: '+address);
			geocoder = new google.maps.Geocoder();
			  
			geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var myOptions = {
						zoom: 8,
						center: results[0].geometry.location,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);				
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
				} else {
					alert('Geocode was not successful for the following reason: ' + status);
				}	
			});
		}

		$("a[rel^='prettyPhoto']").each(function(index, elm){
			var $elm = $(elm);
			$elm.prettyPhoto({    
			custom_markup: '<div id="map_canvas" style="width:400px; height:300px"></div>',
				changepicturecallback: function(){ 				
					codeAddress($elm.attr("title"));
				}
			})
		});
	});
	</script>
<?php
}
?>