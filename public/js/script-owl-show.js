$(document).ready(function() {
	var owl = $('.owl-carousel');
  owl.owlCarousel({
    items:1,
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:1000, 
    autoplayHoverPause:true
  });

  //ScrollTo menu
  $('.menu-center a').click(function(e){
    e.preventDefault();
    var enlace = $(this).attr('href');
    var numMover = 0;

    $('.menu-center a').each(function () {
      $(this).removeClass('active');
    })
    $(this).addClass('active');

    if(enlace == '#sestion-one'){
      numMover = 350;
    }else if(enlace == '#sestion-two'){
      numMover = 820;
    }else if(enlace == '#sestion-three'){
      numMover = 1180;
    }
    $('html,body').animate({
      scrollTop: numMover
    }, 1000);
  });
});