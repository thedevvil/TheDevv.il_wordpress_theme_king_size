<?php
$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

//print "<pre>";
//print_r($term);

define('TERM_TAXONOMY', $wpdb->prefix . 'term_taxonomy');
define('POSTS', $wpdb->prefix . 'posts');
define('TERM_RELATIONSHIPS', $wpdb->prefix . 'term_relationships');
global $data;

$tpl_body_id = 'prettyphoto';
get_header(); 
update_option('current_page_template','body_portfolio body_prettyphoto body_gallery_2col_pp');

global $wp_query,$no_of_page_columns;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

$no_of_page_columns = get_post_meta( $wp_query->post->ID, 'kingsize_page_columns', true );
if(empty($no_of_page_columns))
$no_of_page_columns = "2columns";


#### Getting the portfolio selected category from meta data ####
$kingsize_page_porfolio_category = get_post_meta( $wp_query->post->ID, 'kingsize_page_porfolio_category', true );

/// SQL FOR THE PORTFOLIO CATEGORY DATA ///
$sql_term_taxonomy_id = "";
if($term->term_taxonomy_id > 0 )
	$sql_term_taxonomy_id = '  AND '.TERM_TAXONOMY.'.term_taxonomy_id = "'.$term->term_taxonomy_id.'"';
if($term->term_taxonomy_id > 0 )
	$sql_term_taxonomy_id .= '  AND '.TERM_TAXONOMY.'.term_id = "'.$term->term_id.'"';

$get_portfolio = 'SELECT * 
FROM '.POSTS.'
LEFT JOIN '.TERM_RELATIONSHIPS.' ON ( '.POSTS.'.ID = '.TERM_RELATIONSHIPS.'.object_id )
LEFT JOIN '.TERM_TAXONOMY.' ON ( '.TERM_RELATIONSHIPS.'.term_taxonomy_id = '.TERM_TAXONOMY.'.term_taxonomy_id )
WHERE '.POSTS.'.post_type = "portfolio"
AND '.POSTS.'.post_status = "publish"
AND '.TERM_TAXONOMY.'.taxonomy = "'.$term->taxonomy.'"
'. $sql_term_taxonomy_id .' GROUP BY '.POSTS.'.ID
ORDER BY '.POSTS.'.post_date DESC';

/// PAGING GO HERE //
if($data['wm_portfolio_num_items'])
$_portfolio_num_items = $data['wm_portfolio_num_items'];
else
$_portfolio_num_items = 10;

$totalposts = $wpdb->get_results($get_portfolio, OBJECT); 
$ppp = intval($_portfolio_num_items); //10 posts per page you might use $ppp = intval(get_query_var('posts_per_page')); //$ppp Page per post
$wp_query->found_posts = count($totalposts);
$wp_query->max_num_pages = ceil($wp_query->found_posts / $ppp);
$on_page = intval(get_query_var('paged'));
if($on_page == 0){ $on_page = 1; }
$offset = ($on_page-1) * $ppp;

//paging offset
$paging_sql = "  LIMIT $ppp OFFSET $offset";
$get_portfolio .= $paging_sql; 
?>		

<!-- Main wrap -->
<div id="main_wrap">			
<!-- Main -->
<div id="main">   	
 
 <h2 class="section_title"><?php if(is_archive()) { echo "Portfolio"; } ?><?php if($term->name) { ?> / <?php } ?><?php echo $term->name; ?></h2>


	<!-- Gallery with PrettyPhoto plugin -->
	<div id="gallery_prettyphoto" class="portfolio">
		 <ul class="gallery_<?php echo $no_of_page_columns;?>">
		 <?php 
			$count = 1;
			$pageposts = $wpdb->get_results($get_portfolio, 'ARRAY_A');
			if (empty($pageposts)) :
				echo "<li>No portfolio yet.</li>";								
			else :
			foreach($pageposts as $post) :
				 setup_postdata($post); 

				$the_post = get_post( $post["ID"], ARRAY_A );
				
				//if CUSTOM LINK has been set from write up panel for the permalink
				if(get_post_meta( $post["ID"], 'portfolios_read_more_link', true ) != '') :
					$permalink = get_post_meta( $post["ID"], 'portfolios_read_more_link', true );
				else :
					$permalink = get_permalink( $post["ID"] );
				endif;
			?>
			<li>            
				<h3 class="post_title"><a href="<?php echo $permalink; ?>"><?php echo $the_post["post_title"]; ?></a></h3>  
				<!-- Portfolio post-thumb gallery -->
					<?php kingsize_thumb_box($post["ID"]); ?>
				<!-- END Portfolio post-thumb gallery -->
				 <!--BEGIN excerpt content -->
					<p><?php echo substr($post["post_excerpt"],0,240); ?></p>
				 <!--END excerpt content -->

				<?php
				//checking read more text has been set from the write up panel
				if(get_post_meta( $post["ID"], 'portfolios_read_more_disable', true ) != 1) :

					if(get_post_meta( $post["ID"], 'portfolios_read_more_text', true ) != '') :
						echo '<a href="'.$permalink.'" class="more-link">'.get_post_meta( $post["ID"], 'portfolios_read_more_text', true ).'</a>';
					else :
						echo '<a href="'.$permalink.'" class="more-link">Read More</a>';
					endif;
				
				endif;
				?>
			</li>	
			<?php
			$count++;
			?>
			<?php endforeach; 
			wp_reset_postdata();
			endif;								
			?>
		</ul>													
	</div>	
	<!-- Gallery ends here -->	

<!-- Pagination -->
<?php if (  $wp_query->max_num_pages > 1 ) : $paged = intval(get_query_var('paged')); ?>							
		<div id="pagination-full">										
		<div class="older"><?php next_posts_link( __( 'Older entries', 0 ) ); ?></div>

		<?php if($paged > 1) :?>
			<div class="newer"><?php previous_posts_link( __( 'Newer entries', 0 ) ); ?></div>
		<?php endif; ?>
	</div><!-- #nav-below -->						
<?php endif; ?>
<!-- End Pagination -->