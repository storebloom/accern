/**
 * Accern Custom Fields.
 *
 * @package Accern_Custom
 */

/* exported AccernCustomFields */
var AccernCustomFields = ( function( $, wp ) {
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
			this.$container = $( '.wp-admin' );
			this.listen();
		},

		/**
		 * Initiate listeners.
		 */
		listen: function() {
			var self = this,
				timer = '';

			this.$container.on( 'click', '.add-overlay-field', function() {
				var section = $( this ).closest( '.postbox' ).attr( 'id' ).replace( '-accern', '' ),
					count = $( this ).closest( '.postbox' ).find( '.inside .accern-overlay-field:last-of-type' ).attr( 'data-num' );

				self.addOverlayField( count, section );
			} );

			// Remove overlay field from admin.
			this.$container.on( 'click', '.remove-overlay-field', function() {
				$( this ).parent( '.accern-overlay-field' ).remove();
			} );
		},

		/**
		 * Add new overlay field to section.
		 *
		 * @param count
		 * @param section
		 */
		addOverlayField: function( count, section ) {
			wp.ajax.post( 'get_overlay_field', {
				count: count,
				section: section,
				nonce: this.data.nonce
			} ).always( function( results ) {
				var newCount = parseInt( count ) + 1,
					theId = section + '_overlay-repeater_' + newCount;

				//  Add title and label.
				$( '#' + section + '-accern .inside .accern-overlay-field:last-of-type' ).after(
					'<div data-num="' + newCount + '" class="accern-overlay-field">' +
					'<button type="button" class="remove-overlay-field">-</button>' +
					'<label class="accern-admin-label">Overlay Repeater Title</label>' +
					'<input type="text" name="page-meta[' + section + '][overlay-repeater][' + newCount + '][title]" value="" size="60">' +
					'<label class="accern-admin-label">Overlay Repeater Content</label>' +
					'</div>'
				);

				// Add new editor to the page.
				$( '#' + section + '-accern .inside .accern-overlay-field:last-of-type' ).append( results );

				// Reload scripts/assets for tinymce for new editor.
				tinymce.execCommand('mceAddEditor', false, theId);
				quicktags({id : theId});
			} );
		}
	};
} )( window.jQuery, window.wp );
