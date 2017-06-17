(function($){
    BrooksTheme.Loader.done(function() {
        $(".theme__animation-typed").each(function (_, item) {
            var $item = $(item);
            $item.waypoint(function () {
                $item.find('.typed').typed({
                    stringsElement: $item.find('.typed-strings'),
                    showCursor: false,
                    typeSpeed: 50,
                });

            }, {
                offset: "90%",
                triggerOnce: true
            });

        });

    });

})(jQuery,window);