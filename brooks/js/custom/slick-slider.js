(function($, window){
    var BrooksTheme = window.BrooksTheme || {};
    var defaultOptions = {
        container : '.brooks__slider',

    };
    var _sSlider = BrooksTheme.slickSlider = {
        options : {},
        initialize: function($container){
            this.options = Object.assign({},defaultOptions);
            this.options.container = $container;
            this.getHTMLdata($container);
            var _self = this;
            $( '.brooks__slider-in', this.options.container ).imagesLoaded( function() {


                $( '#' + _self.options.id ).slick({
                    slidesToShow: _self.options.slidesToShow || 1,
                    slidesToScroll: _self.options.slidesToScroll || 1,
                    dots: _self.options.dots || false,
                    centerMode: _self.options.centerMode || false,
                    focusOnSelect: _self.options.focusOnSelect || false,
                    arrows: _self.options.arrows || false,
                    adaptiveHeight: _self.options.adaptiveHeight || false,
                    autoplay: _self.options.autoplay || false,
                    autoplaySpeed :_self.options.autoplaySpeed || 3000,
                    centerPadding : _self.options.centerPadding + 'px' || '50px',
                    draggable : _self.options.draggable || true,
                    fade : _self.options.fade || false,
                    variableWidth : _self.options.variableWidth || false,
                    vertical: _self.options.vertical || false,
                    speed: _self.options.speed || 300,
                    rtl: Object.keys(BrooksTheme.ThemeOptions).indexOf('rtl') > -1

                });
            } );


        },

        getHTMLdata: function($el){
            $el = ($el instanceof $)? $el : $($el) ;
            var data = $el.data('slider');
            if( typeof data === 'object' ){
                for (key in data){
                    if (data.hasOwnProperty(key)) {
                        var val = data[key];
                        if( $.isNumeric(data[key])  )
                            val = parseInt(data[key]);
                        if( data[key] == 'yes')
                            val = true;
                        this.options[key] = val;
                    }
                }
            }
            else
                console.log(" Incorrect HTML Data ");
        }
    }

    $(document).ready(function(){
        var container = (defaultOptions.container instanceof $)? defaultOptions.container : $(defaultOptions.container) ;
        container.each(function(i){
            _sSlider.initialize(this);
        });
    });

})(jQuery, window);