<?php

/**

 Template Name: Galleria Page

 **/

$tpl_body_id = 'galleria';

get_header(); 

update_option('current_page_template','body_portfolio body_galleria');



global $wp_query;

$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

?>	

	<!-- Main wrap -->

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

      				<!-- Galleria - place you images here -->

      					<div id="gallery_galleria">    					   					
							<?php 
								//getting the page Gallery attachments images
								$args = array('post_type' => 'attachment', 'post_parent' => $post->ID,  'orderby' => menu_order, 'order' => ASC); 
								$attachments = get_children($args); 
								$url_post_img = "";					
								if ($attachments) { 
									foreach ($attachments as $attachment) { 										
										$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID));
										$post_title = $attachment->post_title;
								?>								
									<img src="<?php echo $url_post_img;?>" alt="<?php echo $attachment->post_content;?>" title="<?php echo $attachment->post_title;?>"/>
							<?php
								   }
								}
							?>	
						</div>	
						<?php endif; //password protected check?> 
							<?php endwhile; ?>
						<?php endif;?>
					 <!-- Galleria ends here -->

					 </div><!-- 	Content full width class -->
					 
						<?php if ( $data['wm_show_comments'] == "1" ) {?>
						<div id="content_gallery_bottom">
						<?php comments_template( '/comments.php' ); ?>
						</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>
					 
<?php get_footer(); ?>