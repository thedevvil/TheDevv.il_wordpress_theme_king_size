<?php
/**
 Template Name: Blog Page
 **/
 $tpl_body_id = 'blog_overview';
get_header(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
					
    		<!-- Main -->
   			 <div id="main">
   			 	
     			<h2 class="section_title"><?php the_title(); ?></h2><!-- This is your section title -->
     				
					<?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
      				<div id="content" class="content_two_thirds">
					<?php } else { ?>
					<div id="content" class="content_full_width">
					<?php } ?>
    					
						<?php
						if (get_query_var('paged')) {
							$paged = get_query_var('paged');
						} elseif (get_query_var('page')) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}


						global $more; $more = false; # some wordpress wtf logic
						$query_string ="post_type=post&paged=$paged";
						$cat_id = get_cat_ID(single_cat_title('', false));
						if(!empty($cat_id))
						{
							$query_string.= '&cat='.$cat_id;
						}

						query_posts($query_string);
						if (have_posts()) : while (have_posts()) : the_post();
						?>
      					<!-- Post -->
         				 <div class="post">
    						  <h3 class="post_title">
							  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
         							
						  		<!-- Post details -->
					           <div class="metadata">
					                 <p class="post_date"><?php the_time(get_option('date_format')); ?></p><?php //edit_post_link('edit post', ', ', ''); ?>
					                 <a class="post_comments" href="<?php the_permalink(); ?>#comments"><?php comments_number('No comment', '1 Comment', '% Comments'); ?></a>
					            </div>
					            
								<!-- Post thubmnail -->	
								<?php
									//show the image in lightbox									
										$show_image_lightbox = get_post_meta($post->ID, 'kingsize_featured_img_lightbox', true );

									//POST featured image height
										if(get_post_meta($post->ID, 'kingsize_post_featured_img_height', true ))
											$post_featured_img_height = get_post_meta($post->ID, 'kingsize_post_featured_img_height', true );
										else
											$post_featured_img_height = 180;

									 //Sidebar enabled	
										if ( $data['wm_sidebar_enabled'] == "1" ) 
											$post_featured_img_width = 460;
										else
											$post_featured_img_width = 680;//showing full width
												
										if(has_post_thumbnail()): // POST has thumbnail

											$org_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
											$attachment_id =  get_post_thumbnail_id($post->ID);

											$url_post_img = wm_image_resize($post_featured_img_width,$post_featured_img_height, wp_get_attachment_url($attachment_id));
											
											if($show_image_lightbox=='enable')
												echo '<a href="'.$org_img_url.'" class="image" title="'.$post_title.'" rel="gallery"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
											else 
												echo '<a href="'.get_permalink( $post->ID ).'" class="image" title="'.$post_title.'"><img src="'.$url_post_img.'" alt="" class="blog_thumbnail"/></a>';
											
										endif;
								?>
								<!-- END Post thubmnail -->

								<!-- POST Content -->
								<?php 
									///Enable the gallery with next previous of images
									if( $data['wm_enable_rtf_excerpts'] == '0' ) {
										echo get_the_content_with_formatting(get_option('wm_read_more_text'));
									}		
									elseif ( $data['wm_blog_img_gallery_nxt_prev'] == "1" ) {								
										$post_content = get_content();
										$post_content = apply_filters('the_content', $post_content);
										$post_content = str_replace(']]>', ']]&gt;', $post_content);
										echo $post_content = str_replace("<a ","<a rel='prettyPhoto[gallery]' ",$post_content);
									}
									else {
										echo get_content(); 
									}
									?>
								<!-- POST Content END -->
								
						</div>
						<!-- Post ends here -->    
						<?php endwhile; ?>		

						<div id="pagination-container">

							<!-- Pagination -->
							<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>
								<?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
								<div id="pagination">										
									<div class="older"><?php next_posts_link( __( '&larr; Older entries', 0 ) ); ?></div>
					
									<?php if($paged > 1) :?>
										<div class="newer"><?php previous_posts_link( __( 'Newer entries &rarr; ', 0 ) ); ?></div>
									<?php endif; ?>
								</div><!-- #nav-below -->
								<?php } else { ?>
								
									<div id="pagination-full">										
									<div class="older"><?php next_posts_link( __( '&larr; Older entries', 0 ) ); ?></div>
					
									<?php if($paged > 1) :?>
										<div class="newer"><?php previous_posts_link( __( '&Newer entries &rarr; ', 0 ) ); ?></div>
									<?php endif; ?>
								</div><!-- #nav-below -->
								<?php } ?>
							<?php endif; ?>
							<!-- End Pagination -->						
						
						</div>
						
						<?php endif; ?>
					
    			 </div>
     			<!-- Content ends here -->
      
     			
  			   <!-- Sidebar begins here -->
			   <?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
			    <div id="sidebar">			        
					<?php get_sidebar(); ?>
			    </div> 
				<?php } ?>
			    <!-- Sidebar ends here--> 

<?php get_footer(); ?>
