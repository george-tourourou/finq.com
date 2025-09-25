(function ($, Drupal) {

    function toggleCategoryData(){
        $(this).toggleClass("arrow_right_small");
        $('#' + $(this).attr('rel') + '-data').toggle();
    }

    Drupal.behaviors.instrumentsListBehavior = {
        attach: function () {
            $(".i-tables h4")
                .each(toggleCategoryData)
                .on('click', toggleCategoryData);
        }
    };

})(jQuery, Drupal);