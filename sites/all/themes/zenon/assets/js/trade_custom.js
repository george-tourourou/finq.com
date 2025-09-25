/*
* @Author: Florin M.
* @Date:   2016-04-21 18:09:13
* @Last Modified by:   Florin M.
* @Last Modified time: 2016-05-16 10:46:59
*/

jQuery(document).ready(function($){
	var topMenuLoggedOut = $("#block-menu-menu-top-menu-logged-out");
	topMenuLoggedOut.clone().addClass("hidden-md hidden-lg").insertAfter($("#block-block-59"));

	var logoBlock = $("#block-delta-blocks-logo");
	logoBlock.clone().addClass("hidden-md hidden-lg").insertBefore($(".region-header-top-center #block-menu-menu-top-menu-logged-out"));
	/*.addClass("hidden-md hidden-lg")*/

	$(".trigger-minilogin-widget").on("click", function(e){
		e.preventDefault();	
		$(this).toggleClass("activated");
		$("#block-block-17.Login-Mini-Widget").slideToggle();
	})


		// console.log($("#block-block-17"));
			$("#block-block-17.Login-Mini-Widget").css("top", function(){
				var offTop = $("#globalheaderwrapper").offset().top;
				var topHeight = $("#globalheaderwrapper").height();

				return (offTop + topHeight + 1);
				// return("asdasdasd")
			})

	window.isMobile = "";
	$(window).resize(function(){
		if ($("#main-menu-trigger").css("display") !== "none") {
			isMobile = true ;
		} else {
			isMobile = false ;
		};
		mainMenu.removeClass("active");
		$(".trigger-minilogin-widget").removeClass("activated");
		$("#block-block-17.Login-Mini-Widget").slideUp();

	})

	var menuTriggerButton = $("#main-menu-trigger i");
	var mainMenu = $("#block-tb-menu-0 nav#main-menu");
	menuTriggerButton.on("click", function(){
		$("#block-tb-menu-0 nav#main-menu").toggleClass("active")
	});		

	if (isMobile == true) {
		mainMenu.removeClass("active");
		$("#block-block-17").css("top", function(){
			var offTop = $("#globalheaderwrapper").offset().top;
			var topHeight = $("#globalheaderwrapper").height();
		})
	};


	/*Video area*/
	$("#video-player-container .nav-tabs > li > a").on("click", function(){
		$("#video-player-container .tab-content .tab-pane video")[0].pause();
	})	

	$("#block-block-60 form.demo-account, #block-block-60 form.demo-account input").on("click", function(){
		console.log("asd");
		window.location = "/open-demo-account";
	})
	/* /// Video area*/

	/*video area timestamps*/

		var videoTab = $("#video-tabs > li > a");
		videoTab.each(function(){
			var str = $(this).attr("href");
			var tabId = str.split("#")[1];	
			var corespondingVideo = $("#video-content .tab-pane#" + tabId + " video");
			// console.log(corespondingVideo[0]["duration"]);
			// corespondingVideo.onloadedmetadata = function() {
			// console.log(corespondingVideo["duration"]);
			//     alert("Meta data for video loaded");
			// };
		});

		setTimeout(function(){
		// console.log($("#video-content .tab-pane#" + 2 + " video")[0]["duration"]);
		},2500)
		// console.log($("#video-content .tab-pane#2 video")[0].duration);

	/* /// video area timestamps*/

	$(window).on('resize', function(){
		var containerWidth = $("#promogroup1").width();
		var sliderCaption = $("#fullwidthslider1 .slide-caption");
		// sliderCaption.css("width", function(){
		// 	return containerWidth;
		// });
		sliderCaption.parent().css("width", function(){
			return containerWidth;
		});
		sliderCaption.parent().css("right", "0");
		sliderCaption.parent().css("marginLeft", "auto");
		sliderCaption.parent().css("marginRight", "auto");
		// console.log($("#promogroup1").width());
	})
	
	$("#js-rotating").Morphext({
    // The [in] animation type. Refer to Animate.css for a list of available animations.
    animation: "fadeIn",
    // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
    separator: "@",
    // The delay between the changing of each phrase in milliseconds.
    speed: 6000,
    complete: function () {
        // Called after the entrance animation is executed.
    }
});

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
	
})
