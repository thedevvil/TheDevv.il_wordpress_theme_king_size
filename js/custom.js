jQuery(document).ready(function($) {          


	//DROPDOWN SCRIPT
	$('#navbar ul').css({display: "none"}); 
	$('#navbar li').hover(function(){
		$(this).find('ul:first').css({visibility: "visible", display: "none"}).fadeIn('fast');
		},function(){
		$(this).find('ul:first').css({visibility: "hidden"});
		});	
	
		// IE navbar last child fix		
		$('#navbar li ul li:last-child').css('border-bottom', 'none');	
		

    //GALLERY IMAGES HOVER SCRIPT
		
		//add span that will be shown on hover on gallery item
		$(".gallery li a.image").append('<span class="image_hover"></span>'); //add span to images
		$(".gallery  li a.video").append('<span class="video_hover"></span>'); //add span to videos

		$('.gallery  li a span').css('opacity', '0').css('display', 'block') //span opacity = 0 
		
		// show / hide span on hover
		$(".gallery li a").hover(
			 function () {
				 $(this).find('.image_hover, .video_hover').stop().fadeTo('slow', .7); }, 
			function () {
		  		  $('.image_hover, .video_hover').stop().fadeOut('slow', 0);
		});
			
	
    //IF BODY HAS CLASS VIDEO_BACKGROUND, MAKE HTML HEIGHT 100% AND ABILITY TO HIDE AND SHOW NAVIGATION ON HOME PAGE

		
	$('#hide_menu a').css('display', 'block');	
		                  	         
    //SHOWING MENU TOOLTIP ------ delete if you don't want it!                    
    $('#hide_menu a').hover( function(){
         $('.menu_tooltip').stop().fadeTo('fast', 1);            	
     },
     function () {
     	$('.menu_tooltip').stop().fadeTo('fast', 0);  
	});
             
		// Hide menu on the homepage	//	if($('body').hasClass('slider'))//	{ $('#hide_menu a.menu_visible').removeClass('menu_visible').addClass('menu_hidden').attr('title', 'Show the navigation');//	//	$('#menu_wrap').animate({top: "-=480px"}, 0);////	}
	 
	 	var navHeight = $('#menu_wrap').height();
	 	var hideHeight = navHeight - 120; 
	 
	 
	 	if ($('body').hasClass('body_hiding_menu'))
	 		{
	 		
	 		//add class hidden
	 			$('#hide_menu a.menu_visible')
	 				.removeClass('menu_visible')
	 				.addClass('menu_hidden')
	 				.attr('title', 'Show the navigation');
	 		
	 			// hide the tooltip     
	 			$('.menu_tooltip').css('opacity', '0');
	 			  
	 			//move navigation up, after replace the text                  
	 			$('#menu_wrap').animate({top: '-='+ hideHeight + 'px'}, "normal", function() {      	
	 				$('.menu_tooltip .tooltip_hide').hide();	   
	 				$('.menu_tooltip .tooltip_show').show();	
	 						
	 			 });	 		
	 		}
	 
				
	   //HIDING MENU     

		
		//click on hide menu button (arrow points up)                            
		$('#hide_menu a.menu_visible').live('click',function(){	
											  
		   $('#supersized-loader').remove();		//Hide loading animation
		   $('#supersized-loader').remove();		//Hide loading animation	        	

				//add class hidden
				$('#hide_menu a.menu_visible')
					.removeClass('menu_visible')
					.addClass('menu_hidden')
					.attr('title', 'Show the navigation');
			   
				// hide the tooltip     
				$('.menu_tooltip').css('opacity', '0');
				  
				//move navigation up, after replace the text                  
				$('#menu_wrap').animate({top: '-='+ hideHeight + 'px'}, "normal", function() {      	
					$('.menu_tooltip .tooltip_hide').hide();	   
					$('.menu_tooltip .tooltip_show').show();	
							
				 });
				 
//				 $('#main_wrap').fadeOut();
				 
//				 $(window).trigger('resize');
								
				return false;
				
				
				
			});
				  
					
		//SHOWING MENU	
			//click on show menu button (arrow points down)                      	
			 $('#hide_menu a.menu_hidden').live('click', function(){	

			  $('#supersized-loader').remove();		//Hide loading animation
			  $('#supersized-loader').remove();		//Hide loading animation	 
				
				 //add class visible	
				 $('#hide_menu a.menu_hidden')
					 .removeClass('menu_hidden')
					 .addClass('menu_visible');
			
				// hide the tooltip      
				    $('.menu_tooltip').css('opacity', '0');    
					$('#menu_wrap').animate({ top: '+='+ hideHeight + 'px'}, 'normal');  
					$('.menu_tooltip .tooltip_show').hide();
					$('.menu_tooltip .tooltip_hide').show();
					
					
				if($('body').hasClass('body_show_content'))
				{
				
					$('#main_wrap').fadeIn();	
				
				}	
					
			
					
				 return false;    
			 });

/////////////// End of showHide menu //////////////	  


	//FORM (CONTACT & COMMENTS) SCRIPTS

		//set variables
		var nameVal = $("#form_name").val();
		var emailVal = $("#form_email").val();
		var websiteVal = $("#form_website").val();
		var messageVal = $("#form_message").val();
				

		//if name field is empty, show label in it
		if(nameVal == '') {
		$("#form_name").parent().find('label').css('display', 'block');	
		}
		
		//if email field is empty, show label in it
		if(emailVal == '') {
		$("#form_email").parent().find('label').css('display', 'block');	
		}
		
		//if website field is empty, show label in it
		if(websiteVal == '') {
		$("#form_website").parent().find('label').css('display', 'block');	
		}
					
		
		//if message field is empty, show label in it
		if(messageVal == '') {
		$("#form_message").parent().find('label').css('display', 'block');	
		}

				
		//hide labels on focus		
		$('#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea').focus(function(){
			$(this).parent().find('label').fadeOut('fast');		
		});		
		
		//show labels when field is not focused - only if there are no text
		$('#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea').blur(function(){
			var currentInput = 	$(this);	
			if (currentInput.val() == ""){
   			 $(this).parent().find('label').fadeIn('fast');
 			 }
		});		
		
		
	// CONTACT FORM HANDLING SCRIPT - WHEN USER CLICKS "SUBMIT"
	$("#contact_form #form_submit").click(function(){		
				   				 		
		// hide all error messages
		$(".error").hide();
		
		// remove "error" class from text fields
		$("#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea").focus(function() {
 			$(this).removeClass('error_input');
			});
		
		// remove error messages when user starts typing		
		$("#contact_form input, #contact_form textarea, #comment_form input, #comment_form textarea").keypress(function() {
 			$(this).parent().find('span').fadeOut();	
		});
		
		$("#form_message").keypress(function() {	
			$(this).animate({ 
  			  width: "380px"
 			 }, 100); 
		});
		
		// set variables
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		
		// validate "name" field
		var nameVal = $("#form_name").val();
		if(nameVal == '') {
			$("#form_name")
			.after('<span class="error">Please enter your name</span>')
			.addClass('error_input')				  
			hasError = true;
		}

	
		// validate "e-mail" field - andd error message and animate border to red color on error
		var emailVal = $("#form_email").val();
		if(emailVal == '') {
			$("#form_email")
			.after('<span class="error">Please enter your e-mail</span>')
			.addClass('error_input')
			hasError = true; 
				
		} else if(!emailReg.test(emailVal)) {	
			$("#form_email")
			.after('<span class="error">Please provide a valid e-mail</span>')
			.addClass('error_input')
			hasError = true;
		}
		
				
		// validate "message" field
		var messageVal = $("#form_message").val();
		if(messageVal == '') {
			
			$("#form_message")
			.animate({ 
  			  	width: "250px"
 			 }, 100 )
			.after('<span class="error comment_error">Please enter your message</span>')
			.addClass('error_input')
			hasError = true;
		}
		
                // if the are errors - return false
                if(hasError == true) { return false; }
            
		// if no errors are found - submit the form with AJAX
		if(hasError == false) {
			
		var dataString = $('#contact_form').serialize();

			//hide the submit button and show the loader image	
			$("#form_submit").fadeOut('fast', function () {
			$('#contact_form').append('<span id="loader"></span>'); 
			});
			       
			
		// make an Ajax request
        $.ajax({
            type: "POST",
            url: template_directory+"/php/contact-send.php",
            data: dataString,
            success: function(){ 
           
          // on success fade out the form and show the success message
          $('#loader').remove();
          $('#contact_form').children().fadeOut('fast');
          $('.contact_info').fadeOut('fast');
           $('.success').fadeIn();    	
            }
        }); // end ajax

		 return false;  
		} 	
		
	});		
	
	//CONTACT PAGE MAP - CHANGE OPACITY ON HOVER
		$('img.map').css('opacity', '.5');
		
		$('img.map').hover(function(){
			$(this).fadeTo('fast', 1);	
		},
		function(){
			$(this).fadeTo('fast', .5);	
		});
	
	
	// FOOTER TOOLTIPS
	$('.tooltip_link').tipsy({gravity: 's', fade: 'true' });	
	
	
	
	//SHORTCODES & ELEMENTS
	
		//tabs

$(".tab_content").hide();
$("ul.tabs").each(function() {
    $(this).find('li:first').addClass("active");
    $(this).next('.tab_container').find('.tab_content:first').show();
});

$("ul.tabs li a").click(function() {
    var cTab = $(this).closest('li');
    cTab.siblings('li').removeClass("active");
    cTab.addClass("active");
    cTab.closest('ul.tabs').nextAll('.tab_container:first').find('.tab_content').hide();

    var activeTab = $(this).attr("href"); //Find the href attribute value to identify the active tab + content
    $(activeTab).fadeIn(); //Fade in the active ID content
    return false;
});


	// accordion
	 
 $('.accordion div.accordion_content').hide();

 $('.accordion div.active_acc').next().show();

  $('.accordion div.accordion_head a').click(function(){
  
	if ($(this).parent().hasClass('active_acc'))
	
	 {
		
	$(this).parent().removeClass('active_acc').next().slideUp('1000');
	
	}
	
	else {
		$(this).closest('.accordion').find('.active_acc').removeClass('active_acc');
		 $(this).closest('.accordion').find('.accordion_content').slideUp(); 
		 $(this).parent().addClass('active_acc');
		 $(this).parent().next().slideDown();
	}
  
	 
          return false;
  });
  
  
  	//toggls
  	

  	$(".hide").hide();
  	 
  	$(".toggle").click(function(){
  	 
  	$(this).closest(".toggle_box").find(".hide").toggle("fast");
  	
	$(this).toggleClass('active');
  	
  	return false;
  	}); 	
	
}); //document.ready function ends here

$(window).load(function (){	
	if($('body').hasClass('body_about')){
		$('body').append('<div class="grid"></div>');		
	}	
});
