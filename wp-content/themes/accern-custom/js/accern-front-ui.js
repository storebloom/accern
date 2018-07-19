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
			var animateEl = document.getElementById( 'home-page-animations' ),
				section = undefined !== window.location.hash ? parseInt( window.location.hash.replace( '#', '' ) ) - 1 : 0;

			this.$pageContainer = $( 'body.page' );
			this.listen();
			this.setSectionHeight( this.data.page.toLowerCase() );
			this.scrollifySections();
			this.$animate = window.__mountVisualization( animateEl, {
				sequences: [0, 1, 2, 3, 4, 6]
			} );

			this.$animate.transitionTo( section );
		},

		/**
		 * Initiate listeners.
		 */
		listen: function() {
			var self = this,
				timer = '';

			this.$pageContainer.on( 'click', '.accern-overlay-button', function() {
				var section = $( this ).attr( 'data-section' ),
					overlayNum = $( this ).attr( 'data-num' );

				self.openOverlay( section, overlayNum );
			} );

			// Close overlay.
			this.$pageContainer.on( 'click', '#close-overlay', function() {
				$( this ).siblings( '.accern-overlay-content' ).html( '' );
				$( this ).parent( 'div' ).removeClass( 'open' );
			} );

			// Nav click sectin.
			this.$pageContainer.on( 'click', '.home-nav-section', function() {
				var section = $( this ).attr( 'data-section' );

				$.scrollify.move( '#' + section );
			} );

			// Show page name in nav icons.
			$( '.home-nav-section' ).hover( function() {
				$( this ).find( '.nav-page-name' ).fadeIn();
			},
			function() {
				$( this ).find( '.nav-page-name' ).fadeOut();
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
		},

		/**
		 * Set the section height to browser.
		 *
		 * @param page
		 */
		setSectionHeight: function( page ) {
			$( '.page-template-' + page + '-template .' + page + '-section' ).css( 'height', $( window ).height() );
		},

		/**
		 * Auto scroll to sections.
		 */
		scrollifySections: function() {
			var self = this;

			$.scrollify( {
				section : ".homepage-section",
				scrollbars: false,
				before: function (index, sections) {
					var section = index + 1;

					index = 5 === index ? 6 : index;

					$( '.home-nav-section' ).removeClass( 'current-section' );
					$( '#section-' + section ).addClass( 'current-section' );

					self.$animate.transitionTo( index );
				},
			} );
		}
	};
} )( window.jQuery, window.wp );
