      $(document).ready(function(){
      $('#slide1').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    dots:false,
	    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
});
    $( ".owl-prev").html('<i class="fa fa-chevron-left"></i>');
 	$( ".owl-next").html('<i class="fa fa-chevron-right"></i>');

 	 $('#slide2').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
 	 $( ".owl-prev").html('<i class="fa fa-chevron-left"></i>');
 	$( ".owl-next").html('<i class="fa fa-chevron-right"></i>');
      });


