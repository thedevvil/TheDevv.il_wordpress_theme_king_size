<?php
/*
* @KingSize 2012
** Add Gallery Post Type **
*/
function kingsize_create_post_type_gallery() 
{
	$labels = array(
		'name' => __( 'Galleries'),
		'singular_name' => __( 'Gallery' ),
		'add_new' => _x('Add New', 'gallery'),
		'add_new_item' => __('Add New Gallery'),
		'edit_item' => __('Edit Gallery'),
		'new_item' => __('New Gallery'),
		'view_item' => __('View Gallery'),
		'search_items' => __('Search Galleries'),
		'not_found' =>  __('No galleries found'),
		'not_found_in_trash' => __('No galleries found in Trash'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => __( 'galleries' )),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
	    'supports' => array('title','editor','thumbnail','excerpt') //,'custom-fields'
	  ); 
	  
	  register_post_type(__( 'galleries' ),$args);
}
add_action( 'init', 'kingsize_create_post_type_gallery' );



add_filter('manage_posts_columns', 'kingsize_gallery_columns');
function kingsize_gallery_columns($defaults) {
    $defaults['postid'] = __('POST ID');
    return $defaults;
}

/*add_action('manage_posts_custom_column', 'kingsize_gallery_custom_column', 10, 2);

function kingsize_gallery_custom_column($column_name, $post_id) {
    global $wpdb;
	if( $column_name == 'postid' ) {
		echo $post_id;
	}
}*/
?>