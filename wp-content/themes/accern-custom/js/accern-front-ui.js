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
				companyAnimateEl = document.getElementById( 'company-page-animations' );

			this.$pageContainer = $( 'body.page' );
			this.listen();
			this.setSectionHeight( this.data.page.toLowerCase() );

			if ( animateEl ) {
				this.$animate = window.__mountVisualization( animateEl, {
					sequences: [0, 1, 2, 3, 4, 5, 6]
				} );

				this.scrollifySections( 'homepage' );
			}

			if ( companyAnimateEl ) {
				this.$companyAnimate = window.__mountVisualization( companyAnimateEl, {
					sequences: [0, 1, 2, 3, 4, 5, 6]
				} );

				// Start company animation.
				this.$companyAnimate.transitionTo( 5 );

				// Engage scrollify.
				this.scrollifySections( 'company' );
			}

			if ( 'Use Cases' === this.data.page ) {
				this.scrollifySections( 'usecase' );
			}

			// Show other field if other selected on contact page.
			this.$pageContainer.on( 'change', '.your-firm-type select', function() {
				var optionVal = $( this ).find( 'option:selected' ).val();

				if ( 'Other' === optionVal ) {
					$( '.your-firm-other' ).show();
				} else {
					$( '.your-firm-other' ).hide();
				}
			} );
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

			this.$pageContainer.on( 'click', '.footer.accern-overlay-button', function() {
				var section = $( this ).attr( 'data-section' ),
					overlayNum = $( this ).attr( 'data-num' );

				self.openFooterOverlay( section, overlayNum );
			} );

			// Close overlay.
			this.$pageContainer.on( 'click', '#close-overlay', function() {
				$( this ).siblings( '.accern-overlay-content' ).html( '' );
				$( '.accer-overlay-content-wrap' ).removeClass( 'open' );
			} );

			// Nav click sectin.
			this.$pageContainer.on( 'click', '.homepage-nav-section, .company-nav-section, .usecase-nav-section', function() {
				var section = $( this ).attr( 'data-section' );

				$.scrollify.move( '#' + section );
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

			// Use case tab reveal.
			this.$pageContainer.on( 'click', '.tab-item', function() {
				var tabid = $( this ).attr( 'data-tab' );

				$( this ).closest( '.usecase-tabs' ).find( '.tab-item' ).removeClass( 'current-tab' );
				$( this ).addClass( 'current-tab' );
				$( '#' + tabid ).closest( '.usecase-tab-content' ).find( '.use-case-content-wrap' ).removeClass( 'active-tab' );
				$( '#' + tabid ).addClass( 'active-tab' );
			} );

			// Scroll down to next section.
			this.$pageContainer.on( 'click', '#scroll-down-one', function() {
				$.scrollify.next();
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
				$( '.accern-overlay-content' ).html( results );
				$( '.accern-overlay-content-wrap' ).addClass( 'open' );
			} );
		},

		/**
		 * Return the overlay content for footer links in overlay.
		 *
		 * @param section
		 * @param overlayNum
		 */
		openFooterOverlay: function( section, overlayNum ) {
			wp.ajax.post( 'get_overlay_content', {
				section: section,
				number: overlayNum,
				footer: true,
				nonce: this.data.nonce
			} ).always( function( results ) {
				$( '.accern-overlay-content' ).html( results );
				$( '.accern-overlay-content-wrap' ).addClass( 'open' );
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

					// Detect the footer
					$( window ).on( 'scroll touchstart', function() {
						var currentSection = $.scrollify.current().attr('id')
						var footerTriggers = ['home-section-cases', 'company-partners-section', 'usecase-last-section'];

						if ( -1 === $.inArray( currentSection, footerTriggers ) ) {
							$( '.site-footer' ).removeClass( 'is-active' );
						} else {
							$( '.site-footer' ).addClass( 'is-active' );
						}
					});
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
