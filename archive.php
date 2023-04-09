<?php if(is_tax() && taxonomy_exists('portfolio-category')) { 
 include('portfolio-list.php');

 } else { 
	 
	 $tpl_body_id = 'blog_overview'; get_header(); 
	 get_template_part( 'loop' ); ?>

<?php } ?>			

<?php get_footer(); ?>