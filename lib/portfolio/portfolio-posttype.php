<?php
/*
* @KingSize 2011
** Add Portfolio Post Type **
*/
function kingsize_create_post_type_portfolios() 
{
	$labels = array(
		'name' => __( 'Portfolio'),
		'singular_name' => __( 'Portfolio' ),
		'add_new' => _x('Add New', 'slide'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('No portfolios found'),
		'not_found_in_trash' => __('No portfolios found in Trash'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => __( 'portfolio' )),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
	    'supports' => array('title','editor','author','thumbnail','excerpt','custom-fields','comments','page-attributes')
	  ); 
	  
	  register_post_type(__( 'portfolio' ),$args);
}




function kingsize_build_taxonomies(){
	register_taxonomy(__( "portfolio-category" ), array(__( "portfolio" )), array("hierarchical" => true, "label" => __( "Portfolio Categories" ), "singular_label" => __( "Categories" ), "rewrite" => array('slug' => 'portfolio-category', 'hierarchical' => true))); 
}

/*************************** Portfolio Tags ***************************/ /*V4*/
register_taxonomy('portfolio-tags', array(__( "portfolio" )), array('hierarchical' => false, 'labels' => array('name' => __( 'Portfolio Tags' ), 'singular_label' => __('Portfolio Tags'), 'add_new_item' => __( 'Add New Portfolio Tags' ), 'search_items' => __( 'Search Portfolio Tags' )), 'rewrite' => array('slug' => 'portfolio-tags')));



function kingsize_portfolio_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Portfolio Item Title' ),
            "portfolio_categories" => __( 'Portfolio Categories' ),
			"portfolio_image" => __('Image'),
			"date" => __('Date')
        );  
  
        return $columns;  
}  
  
function kingsize_portfolio_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case "portfolio_categories" :  
                echo get_the_term_list($post->ID, __( 'portfolio-category' ), '', ', ','');  
                break;
			case "portfolio_image" :
					$image_portfolio = get_post_meta($post->ID, 'upload_image', true);
					$video_thumb_image = get_post_meta($post->ID, 'upload_image_thumb', true);

					if($image_portfolio != '')
						$overview_image = $image_portfolio;
					elseif($video_thumb_image!='')
						$overview_image = $video_thumb_image;
					else
						$overview_image = kingsize_get_the_post_thumbnail_url($post->ID);

					$url_post_img = wm_image_resize('50','50', $overview_image);

					echo '<img src="'.$url_post_img.'" width="50" height="50" alt="" />';
					
				break;	
        }  
}  

add_action( 'init', 'kingsize_create_post_type_portfolios' );
add_action( 'init', 'kingsize_build_taxonomies', 0 );
add_filter("manage_edit-portfolio_columns", "kingsize_portfolio_edit_columns");  
add_action("manage_posts_custom_column",  "kingsize_portfolio_custom_columns");  
?>