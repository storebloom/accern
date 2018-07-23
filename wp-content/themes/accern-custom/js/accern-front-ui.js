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

				if ( false === this.data.mobile ) {

					// Engage scrollify.
					this.scrollifySections( 'company' );
				}
			}

			if ( 'Use Cases' === this.data.page && false === this.data.mobile ) {
				this.scrollifySections( 'usecase' );
			}

			// Focus labels on forms
			$('input').each(function() {
				$(this).on('focus', function() {
					$(this).closest('.form-wrap').addClass('is-focused');
				});
				$(this).on('blur', function() {
					if ($(this).val().length == 0) {
						$(this).closest('.form-wrap').removeClass('is-focused');
					}
				});
				if ($(this).val() != '') {
					$(this).closest('.form-wrap').addClass('is-focused');
				}
			});

			// Disable "other" field on page load
			$( '#other-firm-type' ).prop( 'disabled', true );

			// Create select menu GUI & Toggle other field if selected
			$( '.form-select-chosen' ).on( 'click', function() {
				$(this).parent().addClass('is-active');
			});
			$( '.form-select-menu li' ).not(':first').on( 'click', function() {
				var optionVal = $( this ).text();
				$( this ).parent().prev( '.form-select-value' ).find( 'input' ).val( optionVal );
				$( this ).parent().find( 'li' ).removeClass( 'is-selected' );
				$( this ).addClass( 'is-selected' );
				$( this ).closest( '.form-wrap' ).addClass( 'is-focused' );
				$( this ).parent().removeClass( 'is-active' );
				if ( 'Other' === optionVal ) {
					$( '#form-wrap-other' ).addClass( 'is-active' );
					$( '#other-firm-type' ).prop( 'disabled', false );
				} else {
					$( '#form-wrap-other' ).removeClass( 'is-active' );
					$( '#other-firm-type' ).prop( 'disabled', true );
				}
			});
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

			this.$pageContainer.on( 'click', '.footer-accern-overlay-button', function() {
				var section = $( this ).attr( 'data-section' ),
					overlayNum = $( this ).attr( 'data-num' );

				self.openFooterOverlay( section, overlayNum );
			} );

			// Close overlay.
			this.$pageContainer.on( 'click', '#close-overlay', function( event ) {
				$( this ).siblings( '.accern-overlay-content' ).html( '' );
				$( '.accern-overlay-content-wrap' ).removeClass( 'open' );
				$( 'body' ).removeClass( 'modal-active' );

				// Reenable when modal is closed.
				$.scrollify.enable();
			} );

			// Nav click sectin.
			this.$pageContainer.on( 'click', '.homepage-nav-section, .company-nav-section, .usecase-nav-section', function() {
				var section = $( this ).attr( 'data-section' ),
					homepage = $( this ).hasClass( 'homepage-nav-section' ),
					bodyClass,
					page;

				if ( 'Company' === self.data.page ) {
					page = 'company';
				}

				if ( 'Use Cases' === self.data.page ) {
					page = 'usecase';
				}

				if ( false === homepage && self.data.mobile ) {
					bodyClass = $( '.currently-active-section' ).attr( 'data-section' );
					$( 'body' ).removeClass( 'current-section-id-' + bodyClass );

					// Add class to current section.
					$( '#content .' + page + '-section' ).removeClass( 'currently-active-section' );
					$( '#content .' + page + '-section:nth-of-type(' + section + ')' ).addClass( 'currently-active-section' );

					// Add class to body of current section.
					bodyClass = $( '.currently-active-section' ).attr( 'data-section' );
					$( 'body' ).addClass( 'current-section-id-' + bodyClass );

					$( '.' + page + '-nav-section' ).removeClass( 'current-section' );
					$( '#section-' + section ).addClass( 'current-section' );
				}

				if ( false === self.data.mobile || homepage ) {
					$.scrollify.move( '#' + section );
				}
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

			$( document ).click( function( event ) {
				// If you click on anything except the modal itself or the "open modal" link, close the modal.
				if ( !$( event.target ).closest( '.footer-accern-overlay-button, .accern-overlay-button, .accern-overlay-content-wrap-inner, .accern-overlay-content' ).length ) {
					$('body').find( '.accern-overlay-content-wrap' ).removeClass( 'open' );
					$('body').removeClass( 'modal-active' );

					if ( $.scrollify.isDisabled() ) {

						// Reenable when modal is closed.
						$.scrollify.enable();
					}
				}
			} );

			// Use case tab reveal.
			this.$pageContainer.on( 'click', '.tab-item', function() {
				var tabid = $( this ).attr( 'data-tab' );

				$( this ).closest( '.usecase-tabs' ).find( '.tab-item' ).removeClass( 'current-tab' );
				$( this ).addClass( 'current-tab' );
				$( '#' + tabid ).closest( '.usecase-tab-content' ).find( '.use-case-content-wrap' ).removeClass( 'active-tab' );
				$( '#' + tabid ).addClass( 'active-tab' );
				$( 'html, body' ).animate({
					scrollTop: $( this ).closest( '.usecase-section' ).offset().top,
				}, 1000);
			} );

			// Scroll down to next section.
			this.$pageContainer.on( 'click', '#scroll-down-one, .mobile-down-arrow', function() {
				$.scrollify.next();
			} );

			// Scroll up to previous section.
			this.$pageContainer.on( 'click', '.mobile-up-arrow', function() {
				$.scrollify.previous();
			} );

			// Contact form Success Message
			document.addEventListener( 'wpcf7mailsent', function( event ) {
				$( '#contact-form-section' ).addClass( 'message-sent' );
				$( '#contact-confirmation' ).addClass( 'active-message' );
			} );
		},

		/**
		 * Return the overlay content to show in overlay.
		 *
		 * @param section
		 * @param overlayNum
		 */
		openOverlay: function( section, overlayNum ) {
			$( '.accern-overlay-content-wrap' ).addClass( 'open' );
			$( 'body' ).addClass( 'modal-active' );

			// Disable when overlay is open.
			$.scrollify.disable();

			wp.ajax.post( 'get_overlay_content', {
				section: section,
				number: overlayNum,
				postid: this.data.postid,
				nonce: this.data.nonce
			} ).always( function( results ) {
				$( '.accern-overlay-content' ).html( results );
			} );
		},

		/**
		 * Return the overlay content for footer links in overlay.
		 *
		 * @param section
		 * @param overlayNum
		 */
		openFooterOverlay: function( section, overlayNum ) {
			$( '.accern-overlay-content-wrap' ).addClass( 'open' );
			$( 'body' ).addClass( 'modal-active' );

			// Disable when modal is open.
			$.scrollify.disable();

			wp.ajax.post( 'get_overlay_content', {
				section: section,
				number: overlayNum,
				footer: true,
				nonce: this.data.nonce
			} ).always( function( results ) {
				$( '.accern-overlay-content' ).html( results );
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
						section = index + 1,
						nthChild = index + 2;

					if ( 'usecase' === page ) {
						nthChild = index + 1;
					}

					if ( 'homepage' === page ) {
						self.$animate.transitionTo( index );
					} else {
						if ( self.data.mobile ) {
							$.scrollify.disable();
						}
					}

					$( '.' + page + '-nav-section' ).removeClass( 'current-section' );
					$( '#section-' + section ).addClass( 'current-section' );

					// Add class to current section.
					$( '#content .' + page + '-section' ).removeClass( 'currently-active-section' );
					$( '#content .' + page + '-section:nth-of-type(' + nthChild + ')' ).addClass( 'currently-active-section' );

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
					var section = index + 1,
						bodyClass,
						nthChild = index + 2;

					if ( 'usecase' === page ) {
						nthChild = index + 1;
          }

					bodyClass = $( '.currently-active-section' ).attr( 'data-section' );
					$( 'body' ).removeClass( 'current-section-id-' + bodyClass );

					// Add class to current section.
					$( '#content .' + page + '-section' ).removeClass( 'currently-active-section' );
					$( '#content .' + page + '-section:nth-of-type(' + nthChild + ')' ).addClass( 'currently-active-section' );

					// Add class to body of current section.
					bodyClass = $( '.currently-active-section' ).attr( 'data-section' );
					$( 'body' ).addClass( 'current-section-id-' + bodyClass );

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
