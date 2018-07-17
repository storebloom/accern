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
	 * Enqueue Assets for custom fields.
	 *
	 * @action admin_enqueue_scripts
	 */
	public function enqueue_admin_assets() {
		wp_enqueue_script( "{$this->theme->assets_prefix}-custom-fields" );
		wp_add_inline_script( "{$this->theme->assets_prefix}-custom-fields", sprintf( 'AccernCustomFields.boot( %s );',
			wp_json_encode( array(
				'nonce'         => wp_create_nonce( $this->theme->meta_prefix ),
			) )
		) );
	}

	/**
	 * Enqueue front Assets for custom fields.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function enqueue_front_assets() {
		global $post;

		wp_enqueue_script( "{$this->theme->assets_prefix}-front-ui" );
		wp_add_inline_script( "{$this->theme->assets_prefix}-front-ui", sprintf( 'AccernFrontUI.boot( %s );',
			wp_json_encode( array(
				'nonce'  => wp_create_nonce( $this->theme->meta_prefix ),
				'postid' => $post->ID,
			) )
		) );
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
		// Noncename needed to verify where the data originated.
		wp_nonce_field( 'accern-meta-settings', 'accern_meta_noncename' );

		echo isset( $fields['args'] ) ? $fields['args'] : ''; // XSS ok. All html is sanitized before getting to this point.
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

		// Sanitize all types of meta data.
		if ( isset( $_POST['page-meta'] ) && is_array( $_POST['page-meta'] ) ) {
			foreach ( $_POST['page-meta'] as $section => $meta ) {
				foreach ( $meta as $field_name => $field_value ) {
					if ( 'overlay-repeater' === $field_name ) {
						foreach ( $field_value as $num => $overlay_values ) {
							$value[ $section ][ $field_name ][ $num ]['title'] = sanitize_text_field( wp_unslash( $overlay_values['title'] ) );
							$value[ $section ][ $field_name ][ $num ]['url'] = esc_url_raw( $overlay_values['url'] );
							$value[ $section ][ $field_name ][ $num ]['content'] = wp_kses_post( wp_unslash( $overlay_values['content'] ) );
						}
					} elseif ( 'link-repeater' === $field_name ) {
						foreach ( $field_value as $num => $link_values ) {
							$value[ $section ][ $field_name ][ $num ]['title'] = sanitize_text_field( wp_unslash( $link_values['title'] ) );
							$value[ $section ][ $field_name ][ $num ]['url'] = str_replace( 'http://', '', esc_url_raw( $link_values['url'] ) );
						}
					} elseif ( 'wysiwyg-repeater' === $field_name ) {
						foreach ( $field_value as $num => $wysiwyg_values ) {
							$value[ $section ][ $field_name ][ $num ]['content'] = wp_kses_post( wp_unslash( $wysiwyg_values['content'] ) );
						}
					} else {
						$value[ $section ][ $field_name ] = wp_kses_post( wp_unslash( $field_value ) );
					}
				}
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
		$post_type = get_post_type( $postid );

		switch ( $page_template ) {
			case 'page-templates/homepage-template.php' :
				// Remove editor features for specific page.
				remove_post_type_support( 'page', 'editor' );

				// Set for 6 homepage sections.  Looping since all metaboxes have same fields.
				for ( $x = 1; $x <= 6; $x ++ ) {
					if ( $x < 6 ) {
						$prefix          = 'home-section-' . $x;
						$title_field     = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
						$sub_title_field = $this->create_custom_field( $postid, $prefix, 'sub-title', 'text' );
						$overlay_field   = $this->create_custom_field( $postid, $prefix, 'overlay-repeater', 'overlay' );

						$metabox_array[] = array(
							'id'          => $prefix . '-accern',
							'description' => 'Home Section ' . $x,
							'screen'      => 'page',
							'context'     => 'normal',
							'priority'    => 'high',
							'args'        => $title_field . $sub_title_field . $overlay_field,
						);
					} else {
						// Home Use Cases Link Section.
						$prefix        = 'home-section-cases';
						$title_field   = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
						$link_repeater = $this->create_custom_field( $postid, $prefix, 'link-repeater', 'link_repeater' );

						$metabox_array[] = array(
							'id'          => $prefix . '-accern',
							'description' => esc_html__( 'Home Use Cases Section', 'accern-custom' ),
							'screen'      => 'page',
							'context'     => 'normal',
							'priority'    => 'high',
							'args'        => $title_field . $link_repeater,
						);
					}
				}
			break;
			case 'page-templates/company-template.php' :
				// Remove editor features for specific page.
				remove_post_type_support( 'page', 'editor' );

				$prefix          = 'company-main-section';
				$title_field     = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
				$sub_title_field = $this->create_custom_field( $postid, $prefix, 'sub-title', 'text' );
				$wysiwyg_field   = $this->create_custom_field( $postid, $prefix, 'content', 'wysiwyg' );

				$prefix2          = 'company-team-section';
				$title_field2     = $this->create_custom_field( $postid, $prefix2, 'title', 'text' );
				$sub_title_field2 = $this->create_custom_field( $postid, $prefix2, 'sub-title', 'text' );
				$wysiwyg_field2   = $this->create_custom_field( $postid, $prefix2, 'content', 'wysiwyg' );
				$overlay_field2   = $this->create_custom_field( $postid, $prefix2, 'overlay-repeater', 'overlay' );

				$prefix3          = 'company-partners-section';
				$title_field3     = $this->create_custom_field( $postid, $prefix3, 'title', 'text' );
				$sub_title_field3 = $this->create_custom_field( $postid, $prefix3, 'sub-title', 'text' );
				$wysiwyg_field3   = $this->create_custom_field( $postid, $prefix3, 'content', 'wysiwyg' );
				$overlay_field3   = $this->create_custom_field( $postid, $prefix3, 'overlay-repeater', 'overlay' );

				$metabox_array = array(
					array(
					'id'          => $prefix . '-accern',
					'description' => 'Company Main Section',
					'screen'      => 'page',
					'context'     => 'normal',
					'priority'    => 'high',
					'args'        => $title_field . $sub_title_field . $wysiwyg_field,
					),
					array(
						'id'          => $prefix2 . '-accern',
						'description' => 'Company Team Section',
						'screen'      => 'page',
						'context'     => 'normal',
						'priority'    => 'high',
						'args'        => $title_field2 . $sub_title_field2 . $wysiwyg_field2 . $overlay_field2,
					),
					array(
						'id'          => $prefix3 . '-accern',
						'description' => 'Company Partners Section',
						'screen'      => 'page',
						'context'     => 'normal',
						'priority'    => 'high',
						'args'        => $title_field3 . $sub_title_field3 . $wysiwyg_field3 . $overlay_field3,
					),
				);
			break;
			case 'page-templates/community-template.php' :
				// Remove editor features for specific page.
				remove_post_type_support( 'page', 'editor' );

				$prefix          = 'community-main-section';
				$title_field     = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
				$sub_title_field = $this->create_custom_field( $postid, $prefix, 'sub-title', 'text' );
				$overlay_field   = $this->create_custom_field( $postid, $prefix, 'overlay-repeater', 'overlay' );

				$metabox_array = array(
					array(
						'id'          => $prefix . '-accern',
						'description' => 'Community Main Section',
						'screen'      => 'page',
						'context'     => 'normal',
						'priority'    => 'high',
						'args'        => $title_field . $sub_title_field . $overlay_field,
					),
				);
				break;
			case 'page-templates/contact-template.php' :
				// Remove editor features for specific page.
				remove_post_type_support( 'page', 'editor' );
				remove_meta_box( 'postimagediv', 'page', 'side' );

				// Form Section.
				$prefix         = 'contact-form-section';
				$title_field    = $this->create_custom_field( $postid, $prefix, 'title', 'text' );
				$wysiwyg_field  = $this->create_custom_field( $postid, $prefix, 'content', 'wysiwyg' );
				$form_shortcode = $this->create_custom_field( $postid, $prefix, 'shortcode', 'text' );

				// Locations Section.
				$prefix2          = 'contact-locations-section';
				$title_field2     = $this->create_custom_field( $postid, $prefix2, 'title', 'text' );
				$wysiwyg_field2   = $this->create_custom_field( $postid, $prefix2, 'content', 'wysiwyg' );
				$wysiwyg_repeater = $this->create_custom_field( $postid, $prefix2, 'wysiwyg-repeater', 'wysiwyg_repeater' );

				$metabox_array = array(
					array(
						'id'          => $prefix . '-accern',
						'description' => esc_html__( 'Form Section', 'accern-custom' ),
						'screen'      => 'page',
						'context'     => 'normal',
						'priority'    => 'high',
						'args'        => $title_field . $wysiwyg_field . $form_shortcode,
					),
					array(
						'id'          => $prefix2 . '-accern',
						'description' => esc_html__( 'Locations Section', 'accern-custom' ),
						'screen'      => 'page',
						'context'     => 'normal',
						'priority'    => 'high',
						'args'        => $title_field2 . $wysiwyg_field2 . $wysiwyg_repeater,
					),
				);
			break;
		} // End switch().

		if ( 'team' === $post_type ) {
			$url_field = $this->create_custom_field( $postid, 'team-section-accern', 'linkedin', 'text' );

			$metabox_array = array(
				array(
					'id'          => 'team-section-accern',
					'description' => 'Linkedin Account Url',
					'screen'      => 'team',
					'context'     => 'normal',
					'priority'    => 'high',
					'args'        => $url_field,
				),
			);
		}

		if ( 'partner' === $post_type ) {
			$url_field = $this->create_custom_field( $postid, 'partner-section-accern', 'link', 'text' );

			$metabox_array = array(
				array(
					'id'          => 'partner-section-accern',
					'description' => 'Company Url',
					'screen'      => 'partner',
					'context'     => 'normal',
					'priority'    => 'high',
					'args'        => $url_field,
				),
			);
		}

		return $metabox_array;
	}

	/**
	 * Building function for registering and returning custom fields html.
	 *
	 * @param integer $postid The post/page/cpt to get custom field value from.
	 * @param string  $section The metabox section.
	 * @param string  $name The field name.
	 * @param string  $type The type of field to create.
	 * @param string  $post_type The post type of the post specified.
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
		$allowed_tags = wp_kses_allowed_html( 'post' );
		$allowed_tags['input'] = array(
			'value' => true,
			'name' => true,
			'class' => true,
			'size' => true,
		);

		$html = '<div class="accern-text-field">';
		$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . '</label>';
		$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . ']" value="' . esc_html( $value ) . '" size="60">';
		$html .= '</div>';

		return wp_kses( $html, $allowed_tags );
	}

	/**
	 * Call back function for returning wysiwyg field html.
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_wysiwyg_field_html( $section, $name, $value = '' ) {
		$html = '';

		$options = array(
			'media_buttons' => true,
			'textarea_name' => 'page-meta[' . $section . '][' . $name . ']',
		);
		$id = $section . '_' . $name . '_1';

		$html .= '<div class="accern-wysiwyg-field">';
		$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . '</label>';

		ob_start();
		wp_editor( $value, $id, $options );

		$html .= ob_get_clean();
		$html .= \_WP_Editors::enqueue_scripts();
		$html .= \_WP_Editors::editor_js();
		$html .= '</div>';

		return $html;
	}

	/**
	 * Call back function for returning repeater wysiwyg field html.
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_wysiwyg_repeater_field_html( $section, $name, $value = '' ) {
		$html = '';

		if ( is_array( $value ) ) {
			foreach ( $value as $field_num => $field_value ) {
				$title = isset( $field_value['title'] ) ? $field_value['title'] : '';
				$content = isset( $field_value['content'] ) ? $field_value['content'] : '';
				$url = isset( $field_value['url'] ) ? $field_value['url'] : '';
				$options = array(
					'media_buttons' => true,
					'textarea_name' => 'page-meta[' . $section . '][' . $name . '][' . $field_num . '][content]',
				);
				$id = $section . '_' . $name . '_' . $field_num;

				$html .= '<div data-num="' . $field_num . '" class="accern-wysiwyg-repeater-field">';

				if ( 1 < count( $value ) && ! empty( $field_value['content'] ) ) {
					$html .= '<button type="button" class="remove-wysiwyg-repeater-field">-</button>';
				}

				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Content</label>';

				ob_start();
				wp_editor( $content, $id, $options );

				$html .= ob_get_clean();
				$html .= \_WP_Editors::enqueue_scripts();
				$html .= \_WP_Editors::editor_js();
				$html .= '</div>';
			}
		} else {
			$options = array(
				'media_buttons' => true,
				'textarea_name' => 'page-meta[' . $section . '][' . $name . '][1][content]',
			);
			$id = $section . '_' . $name . '_1';

			$html .= '<div data-num="1" class="accern-wysiwyg-repeater-field">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Content</label>';

			ob_start();
			wp_editor( '', $id, $options );

			$html .= ob_get_clean();
			$html .= \_WP_Editors::enqueue_scripts();
			$html .= \_WP_Editors::editor_js();
			$html .= '</div>';
		} // End if().

		$html .= '<button type="button" class="add-wysiwyg-repeater-field">+</button>';

		return $html;
	}

	/**
	 * Call back function for returning custom overlay repeater wysiwyg field html
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_overlay_field_html( $section, $name, $value = '' ) {
		$html = '';

		if ( is_array( $value ) ) {
			foreach ( $value as $field_num => $field_value ) {
				$title = isset( $field_value['title'] ) ? $field_value['title'] : '';
				$content = isset( $field_value['content'] ) ? $field_value['content'] : '';
				$url = isset( $field_value['url'] ) ? $field_value['url'] : '';
				$options = array(
					'media_buttons' => true,
					'textarea_name' => 'page-meta[' . $section . '][' . $name . '][' . $field_num . '][content]',
				);
				$id = $section . '_' . $name . '_' . $field_num;

				$html .= '<div data-num="' . $field_num . '" class="accern-overlay-field">';

				if ( 1 < count( $value ) && ! empty( $field_value['content'] ) ) {
					$html .= '<button type="button" class="remove-overlay-field">-</button>';
				}

				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Title</label>';
				$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][' . $field_num . '][title]" value="' . esc_attr( $title ) . '" size="60">';
				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' URL (Leave empty if overlay)</label>';
				$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][' . $field_num . '][url]" value="' . esc_attr( $url ) . '" size="60">';
				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Content</label>';

				ob_start();
				wp_editor( $content, $id, $options );

				$html .= ob_get_clean();
				$html .= \_WP_Editors::enqueue_scripts();
				$html .= \_WP_Editors::editor_js();
				$html .= '</div>';
			}
		} else {
			$options = array(
				'media_buttons' => true,
				'textarea_name' => 'page-meta[' . $section . '][' . $name . '][1][content]',
			);
			$id = $section . '_' . $name . '_1';

			$html .= '<div data-num="1" class="accern-overlay-field">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Title</label>';
			$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][1][title]" value="" size="60">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' URL (Leave empty if overlay)</label>';
			$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][1][url]" value="" size="60">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Content</label>';

			ob_start();
			wp_editor( '', $id, $options );

			$html .= ob_get_clean();
			$html .= \_WP_Editors::enqueue_scripts();
			$html .= \_WP_Editors::editor_js();
			$html .= '</div>';
		} // End if().

		$html .= '<button type="button" class="add-overlay-field">+</button>';

		return $html;
	}

	/**
	 * Call back function for returning custom overlay repeater wysiwyg field html
	 *
	 * @param string $section The metabox section.
	 * @param string $name The field name.
	 * @param string $value The custom field value if any.
	 */
	private function get_link_repeater_field_html( $section, $name, $value = '' ) {
		$html = '';

		if ( is_array( $value ) ) {
			foreach ( $value as $field_num => $field_value ) {
				$title = isset( $field_value['title'] ) ? $field_value['title'] : '';
				$url = isset( $field_value['url'] ) ? $field_value['url'] : '';
				$html .= '<div data-num="' . $field_num . '" class="accern-link-field">';

				if ( 1 < count( $value ) && ! empty( $field_value['url'] ) ) {
					$html .= '<button type="button" class="remove-link-field">-</button>';
				}

				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Title</label>';
				$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][' . $field_num . '][title]" value="' . esc_attr( $title ) . '" size="60">';
				$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' URL</label>';
				$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][' . $field_num . '][url]" value="' . esc_attr( $url ) . '" size="60">';
				$html .= '</div>';
			}
		} else {
			$html .= '<div data-num="1" class="accern-link-field">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' Title</label>';
			$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][1][title]" value="" size="60">';
			$html .= '<label class="accern-admin-label">' . ucfirst( str_replace( '-', ' ', $name ) ) . ' URL</label>';
			$html .= '<input type="text" name="page-meta[' . $section . '][' . $name . '][1][url]" value="" size="60">';
			$html .= '</div>';
		} // End if().

		$html .= '<button type="button" class="add-link-field">+</button>';

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

	/**
	 * AJAX Call Back function to return a new wysiwyg for overlay
	 *
	 * @action wp_ajax_get_overlay_field
	 */
	public function get_overlay_field() {
		check_ajax_referer( $this->theme->meta_prefix, 'nonce' );

		if ( ! isset( $_POST['count'] ) || '' === $_POST['count'] ) { // WPCS: input var ok.
			wp_send_json_error( 'Get overlay field failed' );
		}

		$count = intval( $_POST['count'] ) + 1 ; // WPCS: input var ok.
		$section = sanitize_text_field( wp_unslash( $_POST['section'] ) ); // WPCS: input var ok.

		$options = array(
			'media_buttons' => true,
			'textarea_name' => 'page-meta[' . $section . '][overlay-repeater][' . $count . '][content]',
		);
		$id = $section . '_overlay-repeater_' . $count;

		wp_editor( '', $id, $options );

		wp_die();
	}

	/**
	 * AJAX Call Back function to return a new wysiwyg.
	 *
	 * @action wp_ajax_get_wysiwyg_field
	 */
	public function get_wysiwyg_field() {
		check_ajax_referer( $this->theme->meta_prefix, 'nonce' );

		if ( ! isset( $_POST['count'] ) || '' === $_POST['count'] ) { // WPCS: input var ok.
			wp_send_json_error( 'Get overlay field failed' );
		}

		$count = intval( $_POST['count'] ) + 1 ; // WPCS: input var ok.
		$section = sanitize_text_field( wp_unslash( $_POST['section'] ) ); // WPCS: input var ok.

		$options = array(
			'media_buttons' => true,
			'textarea_name' => 'page-meta[' . $section . '][wysiwyg-repeater][' . $count . '][content]',
		);
		$id = $section . '_wysiwyg-repeater_' . $count;

		wp_editor( '', $id, $options );

		wp_die();
	}

	/**
	 * AJAX Call Back function to return a the overlay content for specified link.
	 *
	 * @action wp_ajax_get_overlay_content
	 */
	public function get_overlay_content() {
		check_ajax_referer( $this->theme->meta_prefix, 'nonce' );

		if ( ! isset( $_POST['section'] ) || '' === $_POST['section'] ) { // WPCS: input var ok.
			wp_send_json_error( 'Get overlay content failed' );
		}

		$section = sanitize_text_field( wp_unslash( $_POST['section'] ) ); // WPCS: input var ok.
		$number = sanitize_text_field( wp_unslash( $_POST['number'] ) ); // WPCS: input var ok.
		$postid = (int) $_POST['postid'];

		$post_meta = get_post_meta( $postid, 'page-meta', true );
		$content = isset( $post_meta[ $section ]['overlay-repeater'][ $number ]['content'] ) ? $post_meta[ $section ]['overlay-repeater'][ $number ]['content'] : '';

		wp_send_json_success( $content );
	}
}
