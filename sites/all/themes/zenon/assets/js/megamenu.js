window.Megamenu = {
    new: '',
    selected: '',
    instance: false,
    height: 0,
    kill: function(instance) {
        window.clearInterval(instance);
    },
};


+(function($){

	

		window.isMobile = "";
		if ($("#main-menu-trigger").css("display") !== "none") {
			isMobile = true ;
		} else {
			isMobile = false ;
		};
	$(window).on("resize", function(){
		if ($("#main-menu-trigger").css("display") !== "none") {
			isMobile = true ;
		} else {
			isMobile = false ;
		};
	});	




	    $(document)

	    .on('mouseover', '[class^="megamenu_"]', function(e){

	        Megamenu.new = $(this).attr('name');

	        if ( Megamenu.selected !== Megamenu.new ) {
	            Megamenu.selected = Megamenu.new;
	        } else {
	            Megamenu.kill( Megamenu.instance );
	        }

	        $(this).parent('li').addClass('active');
	        $('#megamenu .'+Megamenu.new).addClass('active');

	    })

	    .on('mouseout', '[class^="megamenu_"]', function(e){
	        var element = Megamenu.selected;

	        // if ( Megamenu.selected !== Megamenu.new ) {
	        	// console.log('diff');
	            Megamenu.instance = setTimeout(function(){
	                $('#main-menu [name="'+element+'"]').parent('.active').removeClass('active');
	                $('#megamenu [name="'+element+'"].active').removeClass('active');
	            }, 50);
	        // } else {
	        // 	console.log('same');
	        // }
	    })



	    .ready(function(){

	    });

	    $(window)

	    .on('scroll', function(){
	        if ( $(window).scrollTop() >= 100 ) {
	            $('#megamenu').addClass('sticky');
	        } else {
	            $('#megamenu').removeClass('sticky');
	        }
	    });		



})(jQuery);



