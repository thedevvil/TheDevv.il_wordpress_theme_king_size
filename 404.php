<?php
/**
 * @KingSize 2011
 **/
get_header(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php _e('Sorry! This page was not found.', 'kslang'); ?></h2><!-- This is your section title -->
      			
    			<!-- Content has class "content_full_width" -->
  				<div id="content" class="content_full_width">
					
  					<!-- Post -->
     				<div class="post">
					
							<h3 class="post_title"><?php _e('The page you\'re looking for isn\'t available...', 'kslang'); ?></h3>
						
							<p><?php _e('We\'re very sorry for the inconvenience but the page you are looking for either no longer exists or has been moved. Try using the below search box or site index to locate what you\'re looking for.', 'kslang'); ?></p>
							
							<h3><?php _e('Search can help', 'kslang'); ?></h3>
							<p><?php _e('Please try searching using the search form below.', 'kslang'); ?></p>
							
							<div id="page_search">
								<?php get_search_form();?>	
							</div> 
						
							<div class="one_third">
							<h3><?php _e('Site Map', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_list_pages('depth=3&sort_column=menu_order&title_li='); ?></ul>
							</div>	
								
							<div class="one_third">
							<h3><?php _e('Categories', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_list_categories(); ?></ul>
							</div>

							<div class="one_third_last">
							<h3><?php _e('Archives', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_get_archives(); ?></ul>
							</div>
     						
    		  		</div>	
      				<!-- Post ends here -->
  			 </div>
  			 <!-- Content ends here -->

<?php get_footer(); ?>