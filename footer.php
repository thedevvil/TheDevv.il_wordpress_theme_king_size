<?php
/**
 * @KingSize 2011
 **/
 global $data;
?>
					<!-- Footer -->
					<div id="footer">
						
						<!-- Footer information: copyright, social, etc -->
						<div id="footer_info">
							
							<?php if ( $data['wm_show_footer'] == "1" ) {?>
							<!-- Footer columns -->
							<div id="footer_columns">
						
								<div>
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Left") ) : ?> 
									<h3>Learn More</h3>
									<ul>
									<li><a href="/blog/">Blog</a></li>
									<li><a href="/contact/">Contact Us</a></li>
									<li><a href="/colorbox/2-columns/">Portfolio</a></li>
									</ul>
									<?php endif; ?>
								</div>

								<div>
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Center") ) : ?>
									<h3>Get In Touch</h3>
									<ul>
									<li><a href="#">Contact Us Today</a></li>
									<li><a href="http://www.themeforest.net/user/Denoizzed?ref=Denoizzed" target="blank">Denoizzed</a></li>
									<li><a href="http://www.themeforest.net/user/OurWebMedia?ref=OurWebMedia" target="blank">Our Web Media</a></li>
									</ul>
									<?php endif; ?>
								</div>
								
								<div class="last">
									<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer - Right") ) : ?>
									<h3>Need to Know</h3>
									<p class="copyright">&copy; 2010 - 2011, King Size.
									<br />Include your tagline if you want to.
									<br />This footer is Widget Ready x 3.</p>
									<?php endif; ?>
								</div>
								
							</div>
							<!-- Footer columns end here -->
							<?php } ?>
							
							<!-- Copyright / Social Footer Begins Here -->
							<div id="footer_copyright">
								<p class="copyright"><?php echo stripslashes($data['wm_footer_copyright']);?></p>
									<ul class="social">
									
									<!-- SOCIAL ICONS -->
									<?php include (TEMPLATEPATH . "/lib/social-networks.php"); ?>
									<!-- SOCIAL ICONS -->
									
									</ul>
							</div>
							<!-- Copyright / Social Footer Ends Here -->
							
						</div>
						
					</div>        
					<!-- Footer ends here --> 

		</div>
		<!-- main ends here -->
		
	</div>
	<!-- main wrap ends here -->

</div>
<!-- wrapper ends here -->

<?php
	wp_footer();
?>

<!-- GOOGLE ANALYTICS -->
<?php include (TEMPLATEPATH . "/lib/google-analytics-input.php"); ?>
<!-- GOOGLE ANALYTICS -->

<!-- Portfolio control CSS and JS-->
<?php include (TEMPLATEPATH . "/lib/footer_gallery.php"); ?>
<!-- END Portfolio control CSS and JS-->
</body>
</html>
