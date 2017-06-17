(function($, window){
    var BrooksTheme = window.BrooksTheme || {};

    var setSVG = BrooksTheme.setSVG = {
        initialize: function(elms){
            $(elms).each(this.align);

        },
        align: function(_, elm) {
            var el = elm instanceof $ ? elm : $(elm);
            var method = el.attr('data-alignment');
            if (method == 'left'){
                // do nothing

            }
            if (method == 'right'){
                $(el.parents('div')[0]).css('padding-left', 0);
                var thisWidth = el.get()[0].getBoundingClientRect().width;
                var parentWidth = el.parent().width();
                $(el.parents('div')[0]).css('padding-left', (+parentWidth - thisWidth - 2) );
            }
            if (method == 'center'){
                $(el.parents('div')[0]).css('padding-left', 0);
                var thisWidth = el.get()[0].getBoundingClientRect().width;
                var parentWidth = el.parents('div').width();
                $(el.parents('div')[0]).css('padding-left', (+parentWidth - thisWidth)/2 );

            }

        }
    }

    document.addEventListener("DOMContentLoaded", function(){
        setTimeout(function(){
            setSVG.initialize('[data-alignment]');
        },100);
        window.onresize = function(event) {
            setSVG.initialize('[data-alignment]');
        };
    });

})(jQuery, window);