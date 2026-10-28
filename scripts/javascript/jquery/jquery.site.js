jQuery(document).ready(function($) {
	var mega = 0;
	$('#contact').contactable({subject: 'Design Chemical Online Contact Form'});
	$('#contact-banner').click(function(e){
		if($('div#contactable').hasClass('active')){
		$('div#contactable').removeClass('active').animate({"marginLeft": "-=387px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
		$('#contactForm').animate({"marginLeft": "-=390px"}, "slow");
		} else {
		$('div#contactable').addClass('active');
		$('div#contactable').animate({"marginLeft": "-=5px"}, "fast"); 
		$('#contactForm').animate({"marginLeft": "-=0px"}, "fast");
		$('div#contactable').animate({"marginLeft": "+=387px"}, "slow"); 
		$('#contactForm').animate({"marginLeft": "+=390px"}, "slow");
		}
		e.preventDefault();
	});
	$('#header').mouseover(function(){
		if(mega == 0){
			mega = 1;
			$('#slide ul li a:gt(0)').each(function(){
				if(!$('img',this).length){
					var rel = $(this).attr('rel');
					var img = $("<img />").attr('src', 'http://www.designchemical.com/media/images/'+rel).load();
					$(this).prepend(img);
				}
			});
		}
	});
	$('.email').nospam({replaceText: true, filterLevel: 'normal'});
	var content = $(".email");
    content.load("/emailaddress.htm");
	$('a[rel*=external]').click(function(){
		this.target = "_blank";
	});
	$(".img-swap").hover(
          function(){this.src = this.src.replace("_off","_on");},
          function(){this.src = this.src.replace("_on","_off");
     });
	$('.demo').each(function(){
		var linkText = $(this).text();
		linkText = '<span>'+linkText+'</span>';
		$(this).empty().append(linkText);
	});
	jQuery('#nav-main-mega').dcMegaMenuCustom({
        rowItems: '4',
        speed: 'fast',
		effect: 'fade',
		subPad: 170
    });
	
  var currentPosition = 0;
  var slideWidth = 402;
  var slides = $('#slide li');
  var numberOfSlides = slides.length;
  slides.wrapAll('<div id="slideInner"></div>').css({'float' : 'left','width' : slideWidth});
  $('#slideInner').css('width', slideWidth * numberOfSlides);
  $('#slide-links ul li a').hover(function(){
	if(!$('#slide-links').hasClass('slide-static')){
		$('#slide-links ul li').removeClass('links-hover');
		var ind = $(this).index('#slide-links ul li a');
		$(this).parent().addClass('links-hover');
		$('#slideInner').stop().animate({'marginLeft' : slideWidth*(-ind)});
	}
  });
  $('#slide-links ul li a').click(function(){
	$('#slide-links').addClass('slide-static');
  });
  $(window).scroll(function(){
	 if($('.dcssb-float').length){
		buttonPosition($('.dcssb-float'));
	}
  });
  $('#social-share').dcSocialShare({buttons: "twitter,facebook,plusone,stumbleupon,digg,delicious", twitterId: "designchemical", align: "left",offsetLocation: 0,center: 577,floater:false});
});

function buttonPosition(obj){
    var top = $(document).scrollTop();
    var p = top > 178 ? {marginTop: '20px'} : {marginTop: (178-top)+'px'} ;
    obj.css(p);
}
function defaulttextFunction(){
			$(".defaultText").focus(function(srcc) {
				if ($(this).val() == $(this)[0].title) {
					$(this).removeClass("defaultTextActive");
					$(this).val("");
				}
			});
			$(".defaultText").blur(function() {
				if ($(this).val() == "") {
					$(this).addClass("defaultTextActive");
					$(this).val($(this)[0].title);
				}
			});
			$(".defaultText").addClass("defaultTextActive").blur();
		}

Type
MIME Type	application/javascript
Resource Type	Script
Location
Full URL	http://www.designchemical.com/js/jquery.site.js
Scheme	http
Host	www.designchemical.com
Path	/js/jquery.site.js
Filename	jquery.site.js