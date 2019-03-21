$(document).ready(function() {
	"use strict";


// ------------- Pre-loader--------------  

// makes sure the whole site is loaded

$(window).load(function() {
    // will first fade out the loading animation
    $(".preloader").fadeOut();
    //then background color will fade out slowly
    $("#faceoff").delay(200).fadeOut("slow");
});


 
  //var winWidth = $(window).width();
  $(window).scroll(function() {
    //if (winWidth > 767) {
      var $scrollHeight = $(window).scrollTop();
      if ($scrollHeight > 600) {
        $('#home').slideDown(400);
      }else{
        $('#home').slideUp(400);
      }
    //}
	
	//got o top
	  if ($(this).scrollTop() > 200) {
			$('#go-to-top a').fadeIn('slow');
		  } else {
			$('#go-to-top a').fadeOut('slow');
	  }  
  });
  
  //-------scroll to top---------
  
 $('#go-to-top a').click(function(){
	$("html,body").animate({ scrollTop: 0 }, 750);
	return false;
  });
  
//--------------- SmoothSroll--------------------

var scrollAnimationTime = 1200,
    scrollAnimation = 'easeInOutExpo';
$('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    $('html, body').stop().animate({
        'scrollTop': $(target).offset().top
    }, scrollAnimationTime, scrollAnimation, function () {
        window.location.hash = target;
    });
});



//--------------- for navigation---------------------
  
    $('.navbar-collapse ul li a').click(function() {
      $('.navbar-toggle:visible').click();
  });
  
//--------------- -Loading the map ------------------

 $(document).on('click','.contact-map',function(event){
	event.preventDefault();
	initialize();
 });


 



    
// --------------Newsletter-----------------------



function mailchimpResponse(resp) {
     if(resp.result === 'success') {
	 
        $('.newsletter-success').html(resp.msg).fadeIn().delay(3000).fadeOut();
        
    } else if(resp.result === 'error') {
        $('.newsletter-error').html(resp.msg).fadeIn().delay(3000).fadeOut();
    }  
};

  // --------------Contact Form Ajax request-----------------------

    $('.form-horizontal').on('submit', function(event){
    event.preventDefault();

    $this = $(this);

    var data = {
      first_name: $('#first_name').val(),
      last_name: $('#last_name').val(),
      email: $('#email').val(),
      subject: $('#subject').val(),
      message: $('#message').val()
    };

    $.ajax({
      type: "POST",
      url: "email.php",
      data: data,
      success: function(msg){
	     $('.contact-success').fadeIn().delay(3000).fadeOut();
      }
    });
  });
  
});


var fullScreenHome = function() {
    if(matchMedia( "(min-width: 992px) and (min-height: 500px)" ).matches) {
      "use strict"; //RUN JS IN STRICT MODE
    var height = $(window).height();
      contH = $(".banner .col-sm-12").height(),
      contH = $(".banner-carousel .col-sm-12").height(),
      contMT = (height / 2) - (contH / 2);
    $(".banner-carousel").css('min-height', height + "px");
    $(".trans-bg").css('min-height', height + "px");
    $(".banner .col-sm-12").css('margin-top', (contMT - 350) + "px");
    $(".banner-carousel .col-sm-12").css('margin-top', (contMT - 10) + "px");
  }
}

$(document).ready(fullScreenHome);
$(window).resize(fullScreenHome);