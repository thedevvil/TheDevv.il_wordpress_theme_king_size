<?php
/**
 * @KingSize 2011
 **/
$tpl_body_id = 'prettyphoto';
$tpl_body_id = 'blog_overview';
get_header(); 
update_option('current_page_template','body_portfolio body_portfolio body_gallery_2col_pp');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h2><!-- This is your section title -->
     			
    			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
				<?php if(get_post_meta($post->ID, 'portfolio_sidebar_hide', true)) { ?>
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
						<?php the_content(); ?>
					
						
						<!-- Portfolio Tags v4 -->
						<?php
				          if(get_the_term_list(get_the_ID(), 'portfolio-tags', __('Tags: ', 'kslang'), ', ', '')) :                            
					    ?>
							<div class="metadata_tags">
								<p class="post_tags"><?php echo(get_the_term_list(get_the_ID(), 'portfolio-tags', __('Tags: ', 'kslang'), ', ', '')); ?></p>
							</div>
						<?php endif; ?>
						<!-- End of Portfolio Tags v4 -->

						<?php if ( $data['wm_show_comments'] == "1" ) {?>
							<?php if ( $data['wm_sidebar_enabled'] == "1" ) {?>
							<div id="content_gallery_bottom">
							<style>#comment_form textarea { width: 98%; }</style>
							<?php } else { ?>
							<div id="content" class="content_full_width">
							<?php } ?>
								<?php comments_template( '/comments.php' ); ?>
							</div>
						<? } else { ?>
						<!-- No Comments -->
						<?php } ?>
				</div>	
				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			    <!-- Sidebar begins here -->
			    <?php if(get_post_meta($post->ID, 'portfolio_sidebar_hide', true)) { ?>
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