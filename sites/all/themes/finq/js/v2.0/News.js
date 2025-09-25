$(document).ready(function () {
    var list = $("#hidden-news li");
    var length = list.length;
    var jsonArr = [];

    for (var i = 0; i < length; i++) {
        var obj = new Object();
        var element = list.eq(i);

        obj.title = element.find("h5").eq(0).text();
        obj.href = element.find("a").eq(0).attr("href");
        obj.subtitle = element.find("a").eq(0).text();
        obj.imgSrc = element.find("img").eq(0).attr("src");
        obj.description = element.find("p").eq(0).text();
        obj.dateDescription = element.find("h6").eq(0).text();

        jsonArr.push(obj);
    }

    initializeNews();
    var slideIndex = 1, maxSlideIndex = jsonArr.length - 1;

    $('.assets-news a#previousSlide, .assets-news a#nextSlide').click(function () {

        var id = $(this).attr("id");
        var n = -1;

        if (id == "previousSlide") {
            n = 1;
        }

        var i = slideIndex + n;

        slideIndex = getSlideIndex(i);

        var previous = getSlideIndex(i - 1);
        var next = getSlideIndex(i + 1);

        console.log("in " + previous + " " + slideIndex + " " + next);

        loadBanner('news-slider-previous', previous);
        loadBanner('news-slider-current', slideIndex);
        loadBanner('news-slider-next', next);
    });

    function loadBanner(id, index) {
        var node = $('#' + id);
		var context = jsonArr[index];

        node.find('h3').eq(0).text(context.subtitle);
        //node.attr('href', context.href);
        //node.find('a').eq(0).text(context.href);
        node.find('a').eq(0).attr('href', context.href);
        node.find('img').eq(0).attr('src', context.imgSrc);
        node.find('p').eq(0).text(context.description);
        node.find('small').eq(0).text(context.dateDescription);
    }

    function getSlideIndex(i) {
        if (i == maxSlideIndex + 1) {
            i = 0;
        }
        else if (i == maxSlideIndex + 2) {
            i = 1;
        }
        else if (i == -1) {
            i = maxSlideIndex;
        }
        else if (i == -2) {
            i = maxSlideIndex - 1;
        }

        return i;
    }

    function initializeNews() {
        var i = 1;

        var previous = getSlideIndex(i - 1);
        var next = getSlideIndex(i + 1);

        loadBanner('news-slider-previous', previous);
        loadBanner('news-slider-current', i);
        loadBanner('news-slider-next', next);
    }
});