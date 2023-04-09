<?php
/*
Template Name: Portfolio Page
*/
?>
<?php
define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');
global $data,$portfolio_page;

$tpl_body_id = 'prettyphoto';
get_header(); 
update_option('current_page_template','body_portfolio body_prettyphoto body_gallery_2col_pp');

$portfolio_page = 'portfolio';

global $wp_query,$no_of_page_columns;

$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

$no_of_page_columns = get_post_meta( $post->ID, 'kingsize_page_columns', true );
if(empty($no_of_page_columns))
	$no_of_page_columns = "2columns";


#### Getting the portfolio selected category from meta data ####
$kingsize_page_porfolio_category = get_post_meta( $post->ID, 'kingsize_page_porfolio_category', true );
$kingsize_page_porfolio_category_arr = explode(",",$kingsize_page_porfolio_category);

//$kingsize_page_porfolio_category_arr = array("0"=>12);

#### Getting the portfolio selected ORDERBY from meta data ####
if(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "custom_id") {
	$porfolio_orderby = "menu_order";	
	$porfolio_order = "ASC";
}
elseif(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "rand") {
	$porfolio_orderby = "rand";	
	$porfolio_order = "";
}
elseif(get_post_meta( $post->ID, 'kingsize_page_porfolio_orderby', true ) == "asc_order") {
	$porfolio_orderby = "date";	
	$porfolio_order = "ASC";
}
else { 
	$porfolio_orderby = "date";
	$porfolio_order = "DESC";
}


#### PAGING GO HERE  #### 
if($data['wm_portfolio_num_items'])
	$_portfolio_num_items = $data['wm_portfolio_num_items'];
else
	$_portfolio_num_items = 10;


if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

#### creating arguments #######
if($kingsize_page_porfolio_category != '') :
	$args_portfolio=array(
		"tax_query" => array(
			array(
				"taxonomy" => "portfolio-category",
				"field" => "id",
				"terms" => $kingsize_page_porfolio_category_arr
			)
		),
		'post_type' => array('portfolio'),
		'order' => $porfolio_order,
		'orderby' => $porfolio_orderby,
		'posts_per_page' => $_portfolio_num_items,
		'paged' => $paged,
	);		
else :
	$args_portfolio=array(
		'post_type' => array('portfolio'),
		'order' => $porfolio_order,
		'orderby' => $porfolio_orderby,
		'posts_per_page' => $_portfolio_num_items,
		'paged' => $paged,
	);		
endif;
?>		

	<!-- Main wrap -->
		<div id="main_wrap">			
	  		<!-- Main -->
   			 <div id="main">   			 	
	
					 <?php if (have_posts()) : while (have_posts()) : the_post(); ?><!-- This is your section title -->
					 <h2 class="section_title"><?php the_title();?></h2>

					<?php if($content = $post->post_content) { ?>
						<div id="content_gallery_top" class="content_full_width">
						<?php the_content(); ?>
						</div>				
					<?php } else { 
						the_content(); 
					 } ?>
			 
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
					
      					<!-- Gallery with PrettyPhoto plugin -->
      					<div id="gallery_prettyphoto" class="portfolio">
						     <ul class="gallery_<?php echo $no_of_page_columns;?>">
							 <?php 
								$count = 1;
								$temp = $wp_query;
							    $wp_query= null;
								

								$wp_query = new WP_Query();
								$wp_query->query($args_portfolio);	

								//echo $GLOBALS['wp_query']->request;

							if ($wp_query->max_num_pages > 0) : 								

								while ($wp_query->have_posts()) : $wp_query->the_post();

									$the_post = get_post( $post->ID, ARRAY_A );

									//if CUSTOM LINK has been set from write up panel for the permalink
									if(get_post_meta( $post->ID, 'portfolios_read_more_link', true ) != '') :
										$permalink = get_post_meta( $post->ID, 'portfolios_read_more_link', true );
									else :
										$permalink = get_permalink( $post->ID );
									endif;
								?>
								<li>            
                                    <h3 class="post_title"><a href="<?php echo $permalink; ?>"><?php echo $the_post["post_title"]; ?></a></h3>  
									<!-- Portfolio post-thumb gallery -->
										<?php kingsize_thumb_box($post->ID); ?>
									<!-- END Portfolio post-thumb gallery -->
									 <!--BEGIN excerpt content -->
	                                    <p><?php echo substr($post->post_excerpt,0,240); ?></p>
									 <!--END excerpt content -->

									<?php
									//checking read more text has been set from the write up panel
									if(get_post_meta( $post->ID, 'portfolios_read_more_disable', true ) != 1) :

										if(get_post_meta( $post->ID, 'portfolios_read_more_text', true ) != '') :
											echo '<a href="'.$permalink.'" class="more-link">'.get_post_meta( $post->ID, 'portfolios_read_more_text', true ).'</a>';
										else :
											echo '<a href="'.$permalink.'" class="more-link">Read More</a>';
										endif;
									
									endif;
									?>
                                </li>	
								<?php $count++; endwhile; ?>										
							<?php 
							else : 
								echo '<li>No portfolio yet.</li>';
							endif; 
						?>	
						</ul>
					  </div>	

					  <!-- Pagination -->
						<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>							
								<div id="pagination-full">										
								<div class="older"><?php next_posts_link( __( ' &larr; Older entries', 0 ) ); ?></div>
				
								<?php if($paged > 1) :?>
									<div class="newer"><?php previous_posts_link( __( 'Newer entries &rarr;', 0 ) ); ?>  </div>
								<?php endif; ?>
							</div><!-- #nav-below -->						
						<?php endif; ?>
						<!-- End Pagination -->
					<?php 
					wp_reset_postdata();
					$wp_query = null; $wp_query = $temp; 
					?>
						
				<?php endif; //password protected check ?> 
				<?php endwhile; ?>
				<?php endif;?>
				<!-- Gallery ends here -->	

<?php get_footer(); ?>