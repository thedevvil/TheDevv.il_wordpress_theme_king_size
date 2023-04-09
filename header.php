<?php
/**
 * @KingSize 2011
 **/
####### Theme Setting #########
global $get_options,$data;
$get_options = get_option('wm_theme_settings');
###############################
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head> <!-- Header starts here -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_home() || is_front_page() ? bloginfo('description') : wp_title(''); ?></title> <!-- Website Title of WordPress Blog -->	
	<link rel="icon" type="image/png"  href="<?php echo $data['wm_favicon_upload'];?>">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> <!-- Style Sheet -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> <!-- Pingback Call -->

	<!--[if lte IE 8]>						
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/stylesIE.css" type="text/css" media="screen" />
	<![endif]-->		
	<!--[if lte IE 7]>				
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/stylesIE7.css" type="text/css" media="screen" />
	<![endif]-->
	
	<script type="text/javascript">		
		// Template Directory going here
		var template_directory = '<?php echo get_template_directory_uri(); ?>';
	</script>

	<!-- Do Not Remove the Below -->
	<?php if(is_singular()) wp_enqueue_script('comment-reply'); ?>
	<?php if ($tpl_body_id!="slideviewer") {  wp_enqueue_script("jquery"); } ?>
	<?php wp_head(); ?>
	<!-- Do Not Remove the Above -->
	
	<!-- Theme setting head include wp admin -->
	<?php
	$head_include = "";
	$head_include = $data['wm_head_include'];
	echo $head_include;
	?>
	<!-- End Theme setting head include -->
	
	<!-- Gallery / Portfolio control CSS and JS-->		
	<?php 
	//if gallery Shortcode is being used 
	global $tpl_body_id;
	$pattern = get_shortcode_regex(); 
	/*preg_match('/'.$pattern.'/s', $posts[0]->post_content, $matches); 
	if (is_array($matches) && $matches[2] == 'img_gallery') { 
		$arr_type = array();
		$arr_type = explode(' type="',$matches[3]);	
		list($tpl_body_id, $extra) = split('"', $arr_type[1], 2);
	}*/ 
	if( preg_match('/type="colorbox"(.*)/', $posts[0]->post_content, $matches) ) 	
	{
		$tpl_body_id = "colorbox";
	}
	elseif( preg_match('/type="fancybox"(.*)/', $posts[0]->post_content, $matches) ) 	
	{
		$tpl_body_id = "fancybox";
	}
	elseif( preg_match('/type="prettyphoto"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "prettyphoto";
	}	
	elseif( preg_match('/type="slideviewer"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "slideviewer";
	}
	elseif( preg_match('/type="galleria"(.*)/', $posts[0]->post_content, $matches) )
	{
		$tpl_body_id = "galleria";
	}
	/*elseif($tpl_body_id != "contactpage")
		$tpl_body_id = "prettyphoto";*/
	// End if gallery shortcode being used
	
	include (TEMPLATEPATH . '/lib/gallery_template_style_js.php'); ?>		
	<!-- END Portfolio control CSS and JS-->
	
	<?php if ( $data['wm_no_rightclick_enabled'] == "1" ) {?>
	<!-- Disable Right-click -->
		<script type="text/javascript" language="javascript">
			jQuery(function($) {
				$(this).bind("contextmenu", function(e) {
					e.preventDefault();
				});
			}); 
		</script>
	<!-- END of Disable Right-click -->
	<?php } ?>
	
	<?php if( $data['wm_custom_css'] ) { ?><style><?php echo $data['wm_custom_css'];?></style><?php } ?>


	<!-- scripts for background slider; if you want to use background slider/video be sure you have this v4-->
	<?php
	if( $data['wm_background_type'] != 'Video Background' && is_home()) {			
		include (TEMPLATEPATH . '/lib/background_slider.php'); 
	} 
	?>
	<!-- scripts for background slider end here v4-->
	
	<!-- New Opacity/Transparency Options added in v4 -->
	<?php 
	if( $data['wm_enable_opacity'] == "0.9 Opacity") { ?>
	<style>
	/*<!--- .9 --->*/
	#menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/90/menu_back.png) repeat left top !important; }
	#hide_menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/90/hide_menu_back.png) no-repeat left top !important; }
	#main_wrap { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/90/content_back.png) repeat left top !important; }
	#navbar ul { opacity: 0.9 !important; }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "0.8 Opacity") { ?>
	<style>
	/*<!--- .8 --->*/
	#menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/80/menu_back.png) repeat left top !important; }
	#hide_menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/80/hide_menu_back.png) no-repeat left top !important; }
	#main_wrap { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/80/content_back.png) repeat left top !important; }
	#navbar ul { opacity: 0.8 !important; }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "0.7 Opacity") { ?>
	<style>
	/*<!--- .7 --->*/
	#menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/70/menu_back.png) repeat left top !important; }
	#hide_menu { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/70/hide_menu_back.png) no-repeat left top !important; }
	#main_wrap { background:  url(<?php echo get_template_directory_uri(); ?>/images/opacity/70/content_back.png) repeat left top !important; }	
	#navbar ul { opacity: 0.7 !important; }
	</style>
	<?php } elseif( $data['wm_enable_opacity']  == "Default") { ?>
	<style>
	/*<!--- Default --->*/
	#menu { background: url(<?php echo get_template_directory_uri(); ?>/images/menu_back.png) repeat-y top left !important; }
	#hide_menu { background: url(<?php echo get_template_directory_uri(); ?>/images/hide_menu_back.png) no-repeat bottom left !important; }
	#main_wrap { background: url(<?php echo get_template_directory_uri(); ?>/images/content_back.png) repeat-y top left !important; }
	</style>
	<?php } ?>
	<!-- End of New Opacity/Tranparency Options -->
</head> 
<!-- Header ends here -->

<?php
  //getting the current page template set from the page custom options	
  $current_page_template = get_option('current_page_template');  

 //Overlay handling	
    $body_overlay = "body_home";
  if ( $data['wm_grid_hide_enabled'] == "1" ) { 	
	$body_overlay = "body_about";
  }
?>
<?php if(is_home()) {?>
<!--[if lte IE 7]>				
<style>
.body_home #menu_wrap
{margin: 0;}
</style>
<![endif]-->
	<?php
	if($data['wm_background_type'] == 'Video Background') { ?>
	<body <?php body_class('body_home video_background slider'); ?>>
	<?php } else { ?>
	<body <?php body_class('body_home slider'); ?>>
	<?php } ?>
<?php } else {?>
	
		<body <?php body_class($body_overlay." ".$current_page_template);?>>
	
<?php 		
   } ?>

<?php
include (TEMPLATEPATH . '/lib/background_video.php'); 
?>

    <!-- Wrapper starts here -->
	<div id="wrapper">
		
	     <!-- Navigation starts here -->	 
		<div id="menu_wrap">
			
			<!-- Menu starts here -->
			<div id="menu">
		    	
				<!-- Logo starts here -->
		      	<div id="logo">   
				  <?php
				  //get custom logo
				  $theme_custom_logo = $data['wm_logo_upload'];

					if(!empty($theme_custom_logo))
					{
						$url = get_template_directory_uri();
					?>
				  	  <style type="text/css" media="all" scoped="scoped">
						#logo h1 a {
							background: url("<?php echo $theme_custom_logo ?>") no-repeat scroll center top transparent;
						}
					   </style>							
					<?php
					}
				  ?>
			        <h1><a href="<?php echo home_url(); ?>" class="logo_image index"></a></h1>      
		      	</div>
		      	<!-- Logo ends here -->
		      	
		      	<!-- Navbar -->
				<?php 
					wp_nav_menu( array(
					 'sort_column' =>'menu_order',
					 'container' => 'ul',
					 'theme_location' => 'header-nav',
					 'fallback_cb' => 'null',
					 'menu_id' => 'navbar',
					 'link_before' => '',
					 'link_after' => '',
					 'depth' => 0,
					 'walker' => new description_walker())
					 );
				?>
			    <!-- Navbar ends here -->			    	       
		    </div>
		    <!-- Menu ends here -->
		    
		    <!-- Hide menu arrow -->
			<?php if ( $data['wm_menu_hide_enabled'] == "1" ) {?>
		    <div id="hide_menu">   
		    	<a href="#" class="menu_visible">Hide menu</a> 
					
					<?php if ( $data['wm_menu_tooltip_enabled'] == "1" ) {?>
		        	<div class="menu_tooltip">
						
                        <div class="tooltip_hide"><p><?php _e('Hide the navigation', 'kslang'); ?></p></div>
						<div class="tooltip_show"><p><?php _e('Show the navigation', 'kslang'); ?></p></div>
										
			        </div>  
					<?php } else { ?>
					<!-- No Tool Tip -->
					<?php } ?>					
		    </div>
				<?php } else { ?>	
				<div id="hide_menu">    
				</div>
				<?php } ?>
				<!-- Hide menu arrow ends here -->
		       
		</div>
		<!-- Navigation ends here -->
	
	
<?php 
	global $data, $cnt_slide;

	if(is_home() && $data['wm_background_type'] != 'Video Background' && $cnt_slider > 0 ) {
	?>
	
	<?php
	if($data['wm_slider_controllers']=="Enable Slider Controls"){
	?>
	 <!--Arrow Navigation-->
	 <a id="prevslide" class="load-item">prev</a>
	 <a id="nextslide" class="load-item">next</a>	 
	 
	 <div id="controls-wrapper" class="load-item">
	 	<div id="controls">
	 
	 <!-- Play button -->
	    <a id="play-button"><img id="pauseplay" src="<?php echo get_bloginfo('template_url');?>/images/slider_pause.png"/></a>
	 
	 	<!--Slide counter-->
	 	<div id="slidecounter">
	 		<span class="slidenumber"></span> / <span class="totalslides"></span>
	 	</div>
	 	
	   </div>
	 </div>	
	<?php
	}
	?>	 

	<!--Slide captions displayed here-->
	<?php
	if($data['wm_slider_contents'] == 'Display Title & Description'){
	?>	
	 <div id="slidecaption"></div>
	<?php 
	} 
	?>
	<!--END Slide captions displayed here-->

<?php 
} 
?>

	<?php if(is_home()) {?>
	</div>
	<?php } ?>