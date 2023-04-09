<?php
/**
 Template Name: Colorbox Page
 **/
$tpl_body_id = 'colorbox';
get_header(); 
update_option('current_page_template','body_portfolio body_colorbox body_gallery_2col_cb');

global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$no_of_page_columns = get_post_meta( $wp_query->post->ID, 'kingsize_page_columns', true );
if(empty($no_of_page_columns))
	$no_of_page_columns = "2columns";

?>		<!-- Main wrap -->
		<div id="main_wrap">			
	  		<!-- Main -->
   			 <div id="main">   			 	
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      			<h2 class="section_title"><?php the_title();?></h2><!-- This is your section title -->      			
					
				 <div id="content" class="content_full_width">

					<?php if($content = $post->post_content) {  the_content();  } else { the_content(); } ?>
				
				   <?php	
						$checkPasswd = false;
					if (!empty($post->post_password)) { // if there's a password
					if(!post_password_required($post->ID)) {
						$checkPasswd = true;
					 }
					 else
						 $checkPasswd = false;
					}
					else{
						$checkPasswd = true;
					}


					if($checkPasswd == true) :
					?>
      					<!-- Gallery with ColorBox plugin -->
      					<div id="gallery_colorbox" class="gallery">
    					   <ul class="gallery_<?php echo $no_of_page_columns;?>">							
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => menu_order, 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";								

								if ($attachments) { 
									foreach ($attachments as $attachment) { 
										if($no_of_page_columns=="2columns")
											$url_post_img = wm_image_resize('330','220', wp_get_attachment_url($attachment->ID));
										elseif($no_of_page_columns=="3columns")
											$url_post_img = wm_image_resize('220','140', wp_get_attachment_url($attachment->ID));
										elseif($no_of_page_columns=="4columns")
											$url_post_img = wm_image_resize('160','110', wp_get_attachment_url($attachment->ID));
										elseif($no_of_page_columns=="grid")
											$url_post_img = wm_image_resize('112','112', wp_get_attachment_url($attachment->ID));

										$post_title = $attachment->post_title;
								?>
									<li><a href="<?php echo wp_get_attachment_url($attachment->ID);?>" class="image" title="<?php echo $post_title;?>" rel="gallery"><img src="<?php echo $url_post_img;?>" alt="<?php echo $attachment->post_title;?>" title="<?php echo $attachment->post_title;?>"/></a></li>									
							<?php
								   }
								}
							?>								
							</ul>		
						</div>	
						<?php endif; //password protected check?> 
							<?php endwhile; ?>
						<?php endif;?>
						<!-- Gallery ends here -->	

					</div><!-- 	Content full width class -->
						
						<?php if ( $data['wm_show_comments'] == "1" ) {?>
						<div id="content_gallery_bottom">
						<?php comments_template( '/comments.php' ); ?>
						</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>
						
<?php get_footer(); ?>