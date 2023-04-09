<?php
/**
 * @KingSize 2011
 **/
$tpl_body_id = 'blog_overview';
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h2><!-- This is your section title -->
      			
    			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
				<?php if(get_post_meta($post->ID, 'post_sidebar_hide', true)) { ?>
				<div id="content" class="content_full_width">
				<?php } else { ?>
  				<?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
      			<div id="content" class="content_two_thirds">
				<?php } else { ?>
				<div id="content" class="content_full_width">
				<?php } ?>
				<?php } ?>
					
  					<!-- Post -->
     				<div class="post single_post">
						  <h3 class="post_title"><a href=""><?php the_title(); ?></a></h3>
     							
					  		<!-- Post details -->
							<div class="metadata">
				                <p class="post_date"><?php the_time(get_option('date_format')); ?></p>
				            </div>	
							
							<?php 
								///Enable the gallery with next previous of images
								if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {								
									$post_content = get_the_content($more_link_text, $stripteaser, $more_file);
									$post_content = apply_filters('the_content', $post_content);
									$post_content = str_replace(']]>', ']]&gt;', $post_content);

									//Gallery Shortcode is being used 
									//$pattern = get_shortcode_regex(); 
									//preg_match('/'.$pattern.'/s', $post->post_content, $matches);
									//if (is_array($matches) && $matches[2] == 'img_gallery') { 

									global $tpl_body_id;
									if($tpl_body_id == "colorbox" ||  $tpl_body_id == "fancybox") {

										$post_content = str_replace("<a ","<a rel='gallery' ",$post_content);
										echo $post_content;
									} 	
									else {
										echo $post_content = str_replace("<a ","<a rel='prettyPhoto[gallery]' ",$post_content);
									}
								}
								else {
									the_content();
								}
							?>

						<?php
							if(get_the_tag_list()) :							
						 ?>
							<div class="metadata_tags">
								<p class="post_tags"><?php the_tags(__('Tags: ', 'kslang'),', '); ?></p>
							</div>	
						<?php endif; ?>

						<?php if ( $data['wm_show_comments'] == "1" ) {?>
							<div id="content_gallery_bottom">
								<?php comments_template( '/comments.php' ); ?>
							</div>
						<?php } ?>

    		  		</div>	
      				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			    <!-- Sidebar begins here -->
			    <?php if(get_post_meta($post->ID, 'post_sidebar_hide', true)) { ?>
			    <!-- NO SIDEBAR SELECTED -->
			    <?php } else { ?>
			    <?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
			    <div id="sidebar">			        
					<?php get_sidebar(); ?>
			    </div> 
				<?php } ?>
				<?php } ?>
			    <!-- Sidebar ends here--> 	
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>