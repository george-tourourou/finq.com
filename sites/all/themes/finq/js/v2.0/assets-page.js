jQuery(document).ready(function() {
    jQuery(".sub-category-tab").click(function() {
        var isActive = jQuery(this).hasClass("active");

        if(!isActive) {
            jQuery(this).parent().find(".sub-category-tab.active").removeClass("active").removeClass("btn").removeClass("btn-promo");
            jQuery(this).addClass("active btn btn-promo");
        }
    });

    var body = document.body;
    body.classList.add("assets-page-body");

});
$(window).on('load resize orientationchange', function() {
    $('.cfds-list-icons-row').each(function(){
        var $carousel = $(this);
        /* Initializes a slick carousel only on mobile screens */
        // slick on mobile
        if ($(window).width() > 500) {
            if ($carousel.hasClass('slick-initialized')) {
                $carousel.slick('unslick');
            }
        }
        else{
            if (!$carousel.hasClass('slick-initialized')) {
                $carousel.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    initialSlide: 2,
                    infinite: false,
                    autoplaySpeed: 2000,
                    // centerMode: false,
                    centerMode: true,
                    // centerPadding: '60px',
                    dots: false,
                    arrows: false,
                    focusOnSelect: true,
                    variableWidth: true
                    // responsive: [
                    //     {
                    //         breakpoint: 500,
                    //         settings: {
                    //             slidesToShow: 1,
                    //             slidesToScroll: 1
                    //         }
                    //     }
                    // ]
                });
            }
        }
    });
});

function sellectTab(n) {

    var show_class = "category-" + n;

    var slides = document.getElementsByClassName("assets-category");
    var slides_tab = document.getElementsByClassName("cfds-list-icon-area");
    //console.log(show_class);
    //console.log("slides.length "+ slides.length);
    for (i = 0; i < slides.length; i++) {
        //console.log("Counter "+ i);
        if (slides[i].classList.contains(show_class)){
            slides[i].classList.add("show");
            slides_tab[i].classList.add("active");
            //console.log("Counter if:"+ i);
        }else{
            slides[i].classList.remove("show");
            slides_tab[i].classList.remove("active");
            //console.log("Counter else: "+ i);
        }
    }
}

function sellectPlatformTab(n) {
    var show_class = "tab-" + n;
    var platformTab = document.getElementsByClassName("tabs-platform");
    var platformContainer = document.getElementsByClassName("container-platform");
    for (i = 0; i < platformTab.length; i++) {
        if (platformTab[i].classList.contains(show_class)){
            platformTab[i].classList.add("show");
            platformContainer[i].classList.add("show");
        }else{
            platformTab[i].classList.remove("show");
            platformContainer[i].classList.remove("show");
        }
    }
}

setupTimeOnTimeline();
timeUpdate();
createHours('timeline_yesterday');
createHours('timeline_today');
createHours('timeline_tomorrow');


jQuery("#timelines-days").draggable({
    revert: !0,
    axis: "x",
    scroll: !1
});

// On before slide change
category = ['stocks','forex','indices','crypto','commodities','bonds','etfs'];
$('.cfds-list-icons-row').on('beforeChange', function(event, slick, currentSlide, nextSlide){
    console.log(currentSlide + ' - ' + nextSlide + ' - ' + category[nextSlide]);
    sellectTab(category[nextSlide]);
});