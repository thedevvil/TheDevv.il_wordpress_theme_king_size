<?php
global $themename, $data;
$shortname = "wm";

function wm_wp_head() {
	global $themename, $data;

	$wm_head_include = get_option( $shortname.'_head_include' ); 
	echo $wm_head_include;

	global $data;	
	
?>
	
	<style type="text/css">
		.post a, #gallery_prettyphoto.portfolio ul li h3 a, #footer_columns div li a, #footer_copyright a, .post a.read_more, #pagination div a, #comment_form a, #sidebar ul li a, .post .metadata a, .comment a.comment_author, #sidebar a, #sidebar ul#recentcomments li a {color: <?php echo $data['wm_link_color']; ?>;}
		#gallery_prettyphoto.portfolio ul li h3 a:hover, #footer_columns div li a:hover, #footer_copyright a:hover, .post a.read_more:hover, #pagination div a:hover, #comment_form a:hover, #sidebar ul li a:hover, .post .metadata a:hover, .post a:hover, #sidebar a:hover, #sidebar ul#recentcomments li a:hover {color: <?php echo $data['wm_link_color_hover']; ?>;}
		body, #content .post p, #content p, #footer_columns p, #footer_info p, blockquote {color: <?php echo $data['wm_color_text']; ?>;}
		#navbar li a {color: <?php echo $data['wm_menu_text_color']; ?>;}
		#navbar li span {color: <?php echo $data['wm_menu_description_text_color']; ?>;}
		.post h3 a {color: <?php echo $data['wm_post_title_color']; ?>;}
		.post h3 a:hover {color: <?php echo $data['wm_post_title_color_hover']; ?>;}
		#navbar li.current-menu-item a, #navbar li.current-menu-ancestor>a, #navbar li.current-menu-parent>a {color: <?php echo $data['wm_menu_active_color']; ?>;} 
		#navbar li.current-menu-item a span, #navbar li.current-menu-ancestor a span, #navbar li.current-post-parent a span, #navbar li.current_page_item .sub-menu li.menu-item a {color: <?php echo $data['wm_menu_active_description_color']; ?>;}
		#content .post .success p {color: <?php echo $data['wm_success_color']; ?>;}
		#navbar li ul {background: <?php echo $data['wm_submenu_color']; ?>;}
		#navbar li ul {border: 1px solid <?php echo $data['wm_submenu_border_color']; ?>;}
		#gallery_prettyphoto.portfolio ul li {height: <?php echo $data['wm_portfolio_height']; ?>px;}
		#content h1 {color: <?php echo $data['wm_heading_text_color_h1']; ?>;}
		#content h2 {color: <?php echo $data['wm_heading_text_color_h2']; ?>;} 
		#content h3 {color: <?php echo $data['wm_heading_text_color_h3']; ?>;}
		#content h4 {color: <?php echo $data['wm_heading_text_color_h4']; ?>;} 
		#content h5 {color: <?php echo $data['wm_heading_text_color_h5']; ?>;} 
		#content h6 {color: <?php echo $data['wm_heading_text_color_h6']; ?>;} 
		#main h2.section_title {color: <?php echo $data['wm_section_header_titles_color']; ?>;} 
		#slidecaption p, #slidecaption h2, #pagination-full div a, #pagination div a, #main h5, #main h4, #main h3, #main h2.section_title, #main h2, #main h1, #navbar li span, h1, h2, h3, h4, h5, #navbar li a {font-family: <?php if ( $data['wm_google_fonts_name']!= "" ) {?><?php echo $data['wm_google_fonts_name']; ?><?php } else { ?><!-- Default CSS --><?php } ?> ;}
		#slidecaption h2 {color: <?php echo $data['wm_heading_text_color_h2_slider']; ?>;} 
		#slidecaption p {color: <?php echo $data['wm_text_color_slider']; ?>;}
		#wrapper #slidecaption a {color: <?php echo $data['wm_text_color_slider_link']; ?>;}
		#wrapper #slidecaption a:hover {color: <?php echo $data['wm_text_color_slider_link_hover']; ?>;}
	</style>
	
<?php }

add_action('wp_head', $shortname.'_wp_head');
?>