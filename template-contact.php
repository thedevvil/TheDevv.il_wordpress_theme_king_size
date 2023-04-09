<?php
/**
 Template Name: Contact Page
 **/
$tpl_body_id = 'contactpage';
get_header(); 
global $data;
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- Main wrap -->
		<div id="main_wrap">  
			  
    		<!-- Main -->
   			<div id="main">
   			 	
      			<h2 class="section_title"><?php the_title(); ?></h2><!-- This is your section title -->
      			
    			<!-- Content has class "content_two_thirds" to leave some place for the sidebar -->
  				<div id="content" class="content_two_thirds contact">
					<?php the_content(); ?>

  					<!-- Post -->
     				<div class="post">
							
		     			<form method="post" action="php/contact-send.php" id="contact_form">

						<p><label class="form_label" for='form_name'><?php _e('Name', 'kslang'); ?></label>
							<input id='form_name' type='text' name='name' class="textbox" value='' /></p>
							
						<p><label class="form_label" for='form_email'><?php _e('E-mail', 'kslang'); ?></label>
							<input id='form_email' type='text' name='email' class="textbox" value='' /></p>
							
						<p><label class="form_label" for='form_message'><?php _e('Message', 'kslang'); ?></label>
							<textarea id='form_message' rows='5' cols='25' name='message' class="textbox"></textarea></p>
				
						<input id='form_submit' type='submit' name='submit' value='<?php _e('Send message', 'kslang'); ?>' />

						
						<!-- hidden input for basic spam protection -->
						<div class='hide'>
							<label for='spamCheck'>Do not fill out this field</label>
							<input id="spamCheck" name='spam_check' type='text' value='' />
						</div>

						<input  name="input_to_email" type="hidden" value="<?php webmaster_email; ?>" />			
								
						</form>	
						<!-- contact form ends here-->	
				
						<!-- This div will be shown if mail was sent successfully -->		
						<div class="hide success">
						<p><?php if ( $data['wm_contact_email_template']!= "" ) {?><?php echo $data['wm_contact_email_template'];?><?php } else { ?><?php _e('Thank you for contacting us! Your message has been successfully delivered and we will be getting in touch real soon!', 'kslang'); ?><?php } ?></p>
						</div>
						
						<br /><br />
						
    		  		</div>	
      				<!-- Post ends here -->
     			
  			 </div>
  			 <!-- Content ends here -->
			 
  			   <!-- Sidebar -->
			    <div id="sidebar">			        

				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Page Sidebar") ) : ?> 

				<?php endif; ?>
			        
			    </div> 
			    <!-- Sidebar ends here--> 	
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>
