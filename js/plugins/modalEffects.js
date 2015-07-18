/**
 * modalEffects.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var ModalEffects = (function() {

	function init() {

		var overlay = document.querySelector( '.md-overlay' );

		[].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {

			var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) );
				//close = modal.querySelector( '.md-close' );

			function removeModal( hasPerspective ) {
				classie.remove( modal, 'md-show' );

				if( hasPerspective ) {
					classie.remove( document.documentElement, 'md-perspective' );
				}
			}

			function removeModalHandler() {
				removeModal( classie.has( el, 'md-setperspective' ) );
                $("#bookingFrame").attr('src', 'about:blank');
			}

            // Create Modal
			el.addEventListener( 'click', function( ev ) {
                var tourid = $(this).attr('tourid');
                var voucherid = $(this).attr('voucherid');

                if (tourid != undefined){
                    $("#bookingFrame").attr('src', 'booking.php?tour_id=' + tourid + '&subpage=step1')
                }

                if (voucherid != undefined){
                    $("#bookingFrame").attr('src', 'booking.php?voucher_id=' + voucherid+ '&subpage=voucher_step1')
                }


				classie.add( modal, 'md-show' );
				overlay.removeEventListener( 'click', removeModalHandler );
				overlay.addEventListener( 'click', removeModalHandler );

				if( classie.has( el, 'md-setperspective' ) ) {
					setTimeout( function() {
						classie.add( document.documentElement, 'md-perspective' );
					}, 25 );
				}



			});

			//close.addEventListener( 'click', function( ev ) {
			//	ev.stopPropagation();
			//	removeModalHandler();
			//});

		} );

	}

    $(document).ready(function(){
        init();
    })


})();