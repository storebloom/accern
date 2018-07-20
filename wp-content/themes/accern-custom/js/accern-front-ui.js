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
			var animateEl = document.getElementById( 'home-page-animations' );

			this.$pageContainer = $( 'body.page' );
			this.listen();
			this.setSectionHeight( this.data.page.toLowerCase() );

			if ( animateEl ) {
				this.$animate = window.__mountVisualization( animateEl, {
					sequences: [0, 1, 2, 3, 4, 5, 6]
				} );

				this.scrollifySections( 'homepage' );
			}

			if ( 'Company' === this.data.page ) {
				this.scrollifySections( 'company' );
			}
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
			this.$pageContainer.on( 'click', '.homepage-nav-section, .company-nav-section', function() {
				var section = $( this ).attr( 'data-section' );

				$.scrollify.move( '#' + section );
			} );

			// Show page name in nav icons.
			$( '.homepage-nav-section, .company-nav-section' ).hover( function() {
				$( this ).find( '.nav-page-name' ).fadeIn();
			},
			function() {
				$( this ).find( '.nav-page-name' ).fadeOut();
			} );

			// Open main menu.
			$( '#site-navigation' ).on( 'click', '#open-accern-menu', function() {
				$( '#site-navigation' ).addClass( 'is-active' );
				$( 'body' ).addClass( 'nav-active' );
			} );

			// Close main menu.
			$( '#site-navigation' ).on( 'click', '.accern-main-menu-close', function() {
				$( '#site-navigation' ).removeClass( 'is-active' );
				$( 'body' ).removeClass( 'nav-active' );
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
			$( '.page-template-' + page + '-template .' + page + '-section' ).css( 'min-height', $( window ).height() );
		},

		/**
		 * Auto scroll to sections.
		 *
		 * @param page
		 */
		scrollifySections: function( page ) {
			var self = this;

			$.scrollify( {
				section : '.' + page + '-section',
				scrollbars: true,
				sectionName: false,
				updateHash: false,
				overflowScroll: true,
				afterRender: function() {
					var index = $.scrollify.currentIndex(),
						section = parseInt( index ) + 1;

					if ( 'homepage' === page ) {
						self.$animate.transitionTo( index );
					}

					$( '.' + page + '-nav-section' ).removeClass( 'current-section' );
					$( '#section-' + section ).addClass( 'current-section' );
				},
				before: function (index, sections) {
					var section = index + 1;

					index = 5 === index ? 6 : index;

					$( '.' + page + '-nav-section' ).removeClass( 'current-section' );
					$( '#section-' + section ).addClass( 'current-section' );

					if ( 'homepage' === page ) {
						self.$animate.transitionTo( index );
					}
				},
			} );
		}
	};
} )( window.jQuery, window.wp );
