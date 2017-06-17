/**
 * Brooks Responsive Param for VC
 */

( function( $ ) {
    "use strict";
    var $popup = $( '#vc_ui-panel-edit-element' );

    function setParamData(data, param_name, size, value) {
        if(value) {
            data[param_name] = data[param_name] || {};
            data[param_name][size] = value;
        } else {
            if(data[param_name] && data[param_name][size]) {
                delete data[param_name][size];
                if(Object.keys(data[param_name]).length === 0)
                    delete data[param_name];
            }
        }

        return data;
    }

    $popup.find( '.vc_wrapper-param-type-brooks_responsive_param' ).each( function() {
        var $this = $( this ),
            $field_value       = $this.find( '.brooks_responsive_param_field_value'),
            data = $field_value.val();

        data = (data)?JSON.parse(data):{};

        var selector = '[name^="responsive_item_"]';
        $this.find(selector).on( 'change', function() {
            if($(this).data('field-type') == 'size') {
                var val = $(this).val();

                if(!val.match( /^-?[0-9]+((px)|(%))?$/ )) {
                    val = isNaN( parseInt( val ) ) ? '' : ( parseInt( val ) + 'px' );
                    $(this).val( val );
                } else if(val.match( /^-?[0-9]+$/ )) {
                    val = parseInt( val ) + 'px';
                    $(this).val( val );
                }
            }

            data = setParamData(data, $(this).attr('name').replace('responsive_item_', ''), $(this).parent().data('size'), $(this).val());

            $field_value.val( JSON.stringify( data ) );
        } );

    });

} )( jQuery );
