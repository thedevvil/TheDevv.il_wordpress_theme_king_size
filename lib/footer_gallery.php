<?php
global $tpl_body_id,$portfolio_page;


### getting current file template name ###
global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
	<script type="text/javascript">
	//load colorbox
	jQuery('#gallery_colorbox ul li a').colorbox();	
	</script>		
<?php
}
elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
	<script type="text/javascript">
	
	function formatTitle(title, currentArray, currentIndex, currentOpts) {
	    return '<div id="tip7-title">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + '<span>' + (currentIndex + 1) + ' / ' + currentArray.length + '</span></div>';
	}
	
	
	//load fancybox and options
		jQuery("#gallery_fancybox ul li a").fancybox({
		'overlayOpacity'	: '0.8',
		'overlayColor' 		: 'black',
		'transitionIn' : 'elastic',
		'transitionOut' : 'fade',
		'titlePosition' 		: 'inside',
		 'titleFormat'		: formatTitle
	});	
</script>
<?php
}
elseif ($tpl_body_id=="prettyphoto"  || $template_name == "template-prettyphoto.php") { 	
?>
	<script type="text/javascript">
	//load prettyPhoto
	<?php
	if($portfolio_page == 'portfolio') {	
	?>	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({<?php if($data["wm_prettybox_share_option"] == 1) echo 'social_tools: false';?>});
	<?php } else { ?>
	jQuery(document).ready(function($) {
	 $("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.7, /* Value betwee 0 and 1 */
		<?php if($data["wm_prettybox_share_option"] == 1) echo 'social_tools: false,';?>
		showTitle: true /* true/false */
		});
	})
	<?php } ?>
	</script>
<?php
}
elseif ($tpl_body_id=="galleria"  || $template_name == "template-galleria.php") { 
?>
	<script type="text/javascript">
		   // Load the classic theme
		Galleria.loadTheme('<?php echo get_template_directory_uri(); ?>/js/galleria/galleria.classic.js');
		// Initialize Galleria
		jQuery('#gallery_galleria').galleria(
		{ transition: 'fade'});
	</script>
<?php
}
?> 