(function($) {
    var slider = $( 'input[type="range"]' ),
        quantity = $( '.quantity_slide' );
    minus = $( '.minus' ),
        plus = $( '.plus' );
    slider.on( 'input', function() {
        var val = $(this).val();
        quantity.text( val );
        $('input.qty').val(val).trigger('change');
    });

    minus.on( 'click', function() {
        var val = parseInt( slider.val() ) - 1;
        if ( val < parseInt( slider.attr( 'min' ) ) ) {
            val = parseInt( slider.attr( 'min' ) );
        }
        slider.val( val ).trigger( 'input' );
    });

    plus.on( 'click', function() {
        var val = parseInt( slider.val() ) + 1;
        if ( val > parseInt( slider.attr( 'max' ) ) ) {
            val = parseInt( slider.attr( 'max' ) );
        }
        slider.val( val ).trigger( 'input' );
    });
    $(".lty_addon_accordion_head").on("click", function (){
       $(this).next().slideToggle();
    });
    //    add custom text after after price in shop page
    $( "body.single-product .summary .price .woocommerce-Price-amount" ).append( "<span class='lta_after_price'>Per Entry</span>" );
    $( ".woocommerce ul.products li.product .price ins" ).append( "<span class='lta_after_price'>Per Entry</span>" );
})(jQuery);