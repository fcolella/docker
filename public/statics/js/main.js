$(function() {

    if($('#main-slider').length > 0){
        $('#main-slider').owlCarousel({
        	items: 1,
        	nav: true,
            loop: true,
        	lazyLoad: true,
        	navSpeed: 600,
        	dotsSpeed: 600,
            navRewind: false,
        	navText: ["<span class='icon-arrow-left-thin'></span>", "<span class='icon-arrow-right-thin'></span>"],
            autoplay: 3000    
    	});
    }

    if($('.slider-producto').length > 0){
    	$('.slider-producto').owlCarousel({
    	    margin: 24,
    	    autoWidth: true,
    	    items: 4,
            loop: true,
    	    dots: false,
    	    nav: true,
    	    lazyLoad: true,
        	navText: ["<span class='icon-arrow-left-thin'></span>", "<span class='icon-arrow-right-thin'></span>"]
    	});
    }

    if($('.slider-pastillas').length > 0){
    	$('.slider-pastillas').owlCarousel({
    	    margin: 24,
    	    //autoWidth: true,
    	    dots: false,
    	    nav: true,
    	    lazyLoad: true,
        	navText: ["<span class='icon-arrow-left-thin'></span>", "<span class='icon-arrow-right-thin'></span>"],
        	responsive: {
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                992:{
                    items:3
                }
            }
    	});
    }


    if($('.slider-medios-pago').length > 0){
        $('.slider-medios-pago').owlCarousel({
            margin: 24,
            dots: false,
            nav: true,
            loop: true,
            navText: ["<span class='icon-arrow-left-thick'></span>", "<span class='icon-arrow-right-thick'></span>"],
            responsive: {
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                992:{
                    items:4
                },
                1200:{
                    items:5
                }
            },
            autoplay: 1000
        });
    }

    if($('.slider-tarjeta-pago').length > 0){
        $('.slider-tarjeta-pago').owlCarousel({
            margin: 24,
            dots: false,
            nav: true,
            loop: true,
            //lazyLoad: true,
            navText: ["<span class='icon-arrow-left-thick'></span>", "<span class='icon-arrow-right-thick'></span>"],
            responsive: {
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                992:{
                    items:3
                },
                1200:{
                    items:3
                }
            }
        });
    }

    if($('#slider-buttons').length > 0) {

        $itemsQty = $('#slider-buttons').find('.itemsQty').val();

        $itemsQty = ($('.region-link.selected').length > 0) ? $itemsQty-2 : $itemsQty;

        $('.slider-buttons').owlCarousel({
            //margin: 24,
            dots: false,
            nav: true,
            loop: true,
            navText: ["<span class='icon-arrow-left-thick'></span>", "<span class='icon-arrow-right-thick'></span>"],
            responsive: {
                0: {
                    items: $itemsQty - 3
                },
                600: {
                    items: $itemsQty - 2
                },
                992: {
                    items: $itemsQty - 1
                },
                1200: {
                    items: $itemsQty
                }
            }
        });
    }


    // Tabs Widget Busquedas
    $('#widget-busqueda a').click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });
    

    $('#main-slider .item-group').first().remove();
    $('#main-slider .item-group').fadeIn();

    $('#main-slider').hover(function(){
        $(this).find('.owl-prev').animate({opacity: 1});
        $(this).find('.owl-next').animate({opacity: 1});
    }, function(){
        $(this).find('.owl-prev').animate({opacity: 0});
        $(this).find('.owl-next').animate({opacity: 0});
    });


    if($('.region-link').length > 0){

        $('.region-link').mouseover(function(){
            if(!$(this).hasClass('selected')) {
                $imgPath = $(this).find('img').attr('src');
			//	$imgPathP = $imgPath.split('.');
			//	$imgPathHover = $imgPathP[0] + '-hover' + '.' + $imgPathP[1];
				var rest = $imgPath.substring(0, $imgPath.lastIndexOf("."));
				var last = $imgPath.substring($imgPath.lastIndexOf(".") + 1, $imgPath.length);
				$imgPathHover = rest + '-hover.' + last;
                $(this).find('img').attr('src', $imgPathHover);
                $(this).find('span').css('color', 'white');
            }
        });

        $('.region-link').mouseout(function(){
            if(!$(this).hasClass('selected')) {
                $imgPathHover = $(this).find('img').attr('src');
                $imgPathOrig = $imgPathHover.replace('-hover', '');

                $(this).find('img').attr('src', $imgPathOrig);
                $(this).find('span').css('color', '#545454');
            }
        });

    }

    if($('.jRating').length > 0)
        $('.jRating').jRating({isDisabled : true});



    
});