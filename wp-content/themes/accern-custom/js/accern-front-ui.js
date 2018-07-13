/**
 * Accern Front UI.
 *
 * @package Accern_Custom
 */

/* exported AccernFrontUI */
var AccernFrontUI = ( function( $, wp ) {
	'use strict';

	return {
		/**
		 * Holds data.
		 */
		data: {},

		/**
		 * Boot plugin.
		 */
		boot: function( data ) {
			this.data = data;

			$( document ).ready( function() {
				this.init();
			}.bind( this ) );
		},

		/**
		 * Initialize plugin.
		 */
		init: function() {
			this.$pageContainer = $( 'body.page' );
			this.listen();
		},

		/**
		 * Initiate listeners.
		 */
		listen: function() {
			var self = this,
				timer = '';

			this.$pageContainer.on( 'click', '.accern-overlay-button', function() {
				var section = 'home-section-' + $( this ).attr( 'data-section' ),
					overlayNum = $( this ).attr( 'data-num' );

				self.openOverlay( section, overlayNum );
			} );

			// Close overlay.
			this.$pageContainer.on( 'click', '#close-overlay', function() {
				$( this ).siblings( '.accern-overlay-content' ).html( '' );
				$( this ).parent( 'div' ).removeClass( 'open' );
			} );
		},

		/**
		 * Return the overlay content to show in overlay.
		 *
		 * @param section
		 * @param overlayNum
		 */
		openOverlay: function( section, overlayNum ) {
			wp.ajax.post( 'get_overlay_content', {
				section: section,
				number: overlayNum,
				postid: this.data.postid,
				nonce: this.data.nonce
			} ).always( function( results ) {
				$( '.accern-overlay-content' ).html( results ).addClass( 'open' );
			} );
		}
	};
} )( window.jQuery, window.wp );
