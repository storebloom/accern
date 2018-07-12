<?php
/**
 * Custom Fields
 *
 * @package Accern_Custom
 */

namespace AccernCustom;

/**
 * Custom_Fields Class
 *
 * @package Accern_Custom
 */
class Custom_Fields {

	/**
	 * Theme instance.
	 *
	 * @var object
	 */
	public $theme;

	/**
	 * Class constructor.
	 *
	 * @param object $plugin Plugin class.
	 */
	public function __construct( $theme ) {
		$this->theme = $theme;
	}

	/**
	 * Register the page description metabox in page editor.
	 *
	 * @action add_meta_boxes
	 */
	public function register_theme_metaboxes( $post_type, $post ) {
		$template_file = get_post_meta( $post->ID,'_wp_page_template',true );
		$metaboxes = $this->set_the_meta_boxes( $post->ID, $template_file );

		foreach ( $metaboxes as $metabox ) {
			add_meta_box(
				$metabox['id'],
				$metabox['description'],
				array( $this, 'get_metabox_html' ),
				$metabox['screen'],
				$metabox['context'],
				$metabox['priority'],
				$metabox['args']
			);
		}
	}

	/**
	 * Building function for metabox html.
	 *
	 * @param string $fields The html for all custom fields in that metabox.
	 */
	public function get_metabox_html( $postid, $fields = array() ) {
		$allowed_tags = wp_kses_allowed_html( 'post' );
		$allowed_tags['input'] = array(
			'value' => true,
			'name' => true,
			'class' => true,
		);
		$html = $fields['args'];

		// Noncename needed to verify where the data originated.
		wp_nonce_field( 'accern-meta-settings', 'accern_meta_noncename' );

		echo wp_kses( $html, $allowed_tags );
	}

	/**
	 * Save the custom field meta metabox data.
	 *
	 * @action save_post
	 *
	 * @param integer $post_id the current posts id.
	 * @param object  $post the current post object.
	 */
	public function save_meta( $post_id, $post ) {
		$value = array();

		if ( isset( $_POST['accern_meta_noncename'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['accern_meta_noncename'] ) ), 'accern-meta-settings' ) ) { // WPSC: input var ok;
			return $post->ID;
		}

		// Is the user allowed to edit the post or page?
		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return $post->ID;
		}

		// Make sure this is not a revision.
		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( isset( $_POST['page-meta'] ) && is_array( $_POST['page-meta'] ) ) {
			foreach ( $_POST['page-meta'] as $section => $meta ) {
				$value[ $section ] = array_map( 'sanitize_text_field', wp_unslash( $meta ) );
			}
		}

		update_post_meta( $post->ID, 'page-meta', $value );
	}

	/**
	 * Set all custom metaboxes in this function.
	 *
	 * @param integer $postid The post id of current page.
	 * @param string  $page_template The page template to get metaboxes for.
	 */
	private function set_the_meta_boxes( $postid, $page_template ) {
		$metabox_array = array();

		switch ( $page_template ) {
			case 'page-templates/homepage-template.php' :
				// Remove all page editors that have custom metaboxes.
				remove_post_type_support( 'page', 'editor' );

				$prefix = 'home-section-1';

				// Section 1 Custom Fields.
				$title_field = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
				$sub_title_field = $this->create_custom_field( $postid, $prefix, 'sub-title', 'text' );
				$cta_url_field = $this->create_custom_field( $postid, $prefix,'cta-url', 'text' );
				$cta_text_field = $this->create_custom_field( $postid, $prefix,'cta-text', 'text' );
				$logo_repeater_field = $this->create_custom_field( $postid, $prefix, 'trust-by', 'image_repeater' );

				$metabox_array = array(
					array(
						'id' => $prefix . '-accern',
						'description' => esc_html__( 'Home Section 1', 'accern-custom' ),
						'screen'   => 'page',
						'context'  => 'normal',
						'priority' => 'high',
						'args' => $title_field . $sub_title_field . $cta_url_field . $cta_text_field . $logo_repeater_field,
					),
				);
			break;
		} // End switch().

		return $metabox_array;
	}

	/**
	 * Building function for registering and returning custom fields html.
	 *
	 * @param integer $postid The post/page/cpt to get custom field value from.
	 * @param string  $section The metabox section.
	 * @param string  $name The field name.
	 * @param string  $type The type of field to create.
	 *
	 * @return string
	 */
	private function create_custom_field( $postid, $section, $name, $type ) {
		$value = get_post_meta( $postid, 'page-meta', true );
		$value = isset( $value[ $section ][ $name ] ) ? $value[ $section ][ $name ] : '';
		$field_type = 'get_' . $type . '_field_html';

		return $this->$field_type( $section, $name, $value );
	}

	/**
	 * Call back function for returning custom text field html
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_text_field_html( $section, $name, $value = '' ) {
		$html = '<div class="accern-text-field">';
		$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . '</label>';
		$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . ']" value="' . $value . '">';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Call back function for returning custom image repeater field html
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_image_repeater_field_html( $section, $name, $value = array() ) {
		$html = '<div class="accern-image-repeater-field">';
		$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . '</label>';
		$html .= '<p>';
		$html .= '<button type="button" class="upload-accern-image">';
		$html .= esc_html__( 'add image', 'prodigy-commerce' );
		$html .= '</button>';
		$html .= '</p>';
		$html .= '<div class="accern-image-list-wrap">';

		if ( is_array( $value ) ) {
			foreach ( $value as $num => $image_url ) {
				$html .= '<div class="accern-image">';
				$html .= '<span class="accern-remove-image">';
				$html .= 'x';
				$html .= '</span>';
				$html .= '<img src="' . $image_url . '">';
				$html .= '<input type="hidden" name="page-meta[' . $section . '][' . $name . '][' . $num . ']" id="accern-' . $name . '-' . $num . '" value="' . $image_url . '">';
				$html .= '</div>';
			}
		}

		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
