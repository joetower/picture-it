<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Picture_It
 * @subpackage Picture_It/admin
 * @author     Your Name <email@example.com>
 */

class Picture_It_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $picture_it The ID of this plugin.
	 */
	private $picture_it;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $picture_it The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $picture_it, $version ) {

		$this->picture_it = $picture_it;
		$this->version    = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Picture_It_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Picture_It_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'picture-it-admin-css', plugin_dir_url( __FILE__ ) . 'css/picture-it-admin.css', [], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {
		if ( $hook !== 'settings_page_picture-it' ) {
			return;
		}
		wp_register_script( 'picture-it-admin', plugin_dir_url( __FILE__ ) . 'js/picture-it-admin.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( 'picture-it-admin' );
	}

	/**
	 * Add Admin Menu for plugin
	 *
	 */

	public function add_admin_menu() {

		// Top Level Menu
		// add_menu_page(
		// 	'Picture It Settings',
		// 	'Picture It',
		// 	'manage_options',
		// 	'picture-it',
		// 	array($this, 'admin_page_display'),
		// 	'dashicons-images-alt2',
		// 	60
		// );

		// Sub Menu
		add_options_page(
			'Picture It Settings',
			'Picture It',
			'manage_options',
			'picture-it',
			[ $this, 'admin_page_display' ]
		);
	}

	/**
	 * Admin Page Display
	 */
	public function admin_page_display() {

		include 'partials/picture-it-admin-display.php';

		// old method of saving options display
		// include 'partials/picture-it-admin-display-form-method.php';
	}

	// All the hooks for admin_init
	public function admin_init() {

	    // Adding image sizes;
	    $this->register_sizes();

		// Add Settings Section
		$this->add_settings_section();

		// Add Settings Fields
		$this->add_settings_field();

		// Save Settings
		$this->save_fields();

	}

	public function register_sizes() {
	    add_theme_support('post_thumbnails');
		$sizes = get_option( 'pi_image_sizes', [] );
		if ( $sizes !== [] ) {
			foreach ( $sizes as $size ) {
				add_image_size(
					sanitize_title( $size['name'] ),
					$size['width'],
					$size['height']
                );
			}
		}
	}

	// Add Settings Sections for Plugin Options
	public function add_settings_section() {

		add_settings_section(
			'pi-image-size-section',
			'Image Sizes',
			function () {
				echo '<p>Define image sizes to use in your breakpoint image maps.</p>';
			},
			'pi-settings-page'
		);

		add_settings_section(
			'pi-breakpoint-group-section',
			'Breakpoint Groups',
			function () {
				echo '<p>Define a Breakpoint Group name and add breakpoints.</p>';
			},
			'pi-settings-page-bp-group'
		);

		add_settings_section(
			'pi-picture-mapping-section',
			'Breakpoint Image Maps',
			function () {
				echo '<p>Map each custom image size (by name) to the appropriate breakpoint in which you would like it applied.</p>';
			},
			'pi-settings-page-bp-map'
		);
	}

	// Add settings fields
	public function add_settings_field() {

		add_settings_field(
			'pi_image_sizes',
			'',
			[ $this, 'markup_image_sizes' ],
			'pi-settings-page',
			'pi-image-size-section',
			[
				'name'  => 'pi_image_sizes',
				'value' => get_option( 'pi_image_sizes' ),
			]
		);

		add_settings_field(
			'pi_existing_image_sizes',
			'',
			[ $this, 'markup_existing_sizes' ],
			'pi-settings-page',
			'pi-image-size-section',
			[
				'name'  => 'pi_image_sizes',
				'value' => get_option( 'pi_image_sizes' ),
			]
		);

		add_settings_field(
		    'pi_breakpoint_groups',
            'Breakpoint Groups',
            [ $this, 'markup_breakpoint_groups' ],
            'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
            [
                'name' => 'pi_breakpoint_groups',
                'value' => get_option( 'pi_breakpoint_groups' ),
            ]
        );


		add_settings_field(
			'pi_breakpoint_group_name',
			'Breakpoint Group Name',
			[ $this, 'markup_text_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_group_name',
				'value' => get_option( 'pi_breakpoint_group_name' ),
			]
		);

		add_settings_field(
			'pi_breakpoint_size_name',
			'Breakpoint Size Name',
			[ $this, 'markup_text_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_size_name',
				'value' => get_option( 'pi_breakpoint_size_name' ),
			]
		);
		add_settings_field(
			'pi_breakpoint_item',
			'Breakpoint Minimum Width',
			[ $this, 'markup_number_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_item',
				'value' => get_option( 'pi_breakpoint_item' ),
			]
		);

		add_settings_field(
			'pi_breakpoint_size_name2',
			'Breakpoint Size Name',
			[ $this, 'markup_text_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_size_name2',
				'value' => get_option( 'pi_breakpoint_size_name2' ),
			]
		);
		add_settings_field(
			'pi_breakpoint_item2',
			'Breakpoint Minimum Width',
			[ $this, 'markup_number_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_item2',
				'value' => get_option( 'pi_breakpoint_item2' ),
			]
		);

		add_settings_field(
			'pi_breakpoint_size_name3',
			'Breakpoint Size Name',
			[ $this, 'markup_text_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_size_name3',
				'value' => get_option( 'pi_breakpoint_size_name3' ),
			]
		);
		add_settings_field(
			'pi_breakpoint_item3',
			'Breakpoint Minimum Width',
			[ $this, 'markup_number_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_item3',
				'value' => get_option( 'pi_breakpoint_item3' ),
			]
		);

		add_settings_field(
			'pi_breakpoint_size_name4',
			'Breakpoint Size Name',
			[ $this, 'markup_text_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_size_name4',
				'value' => get_option( 'pi_breakpoint_size_name4' ),
			]
		);
		add_settings_field(
			'pi_breakpoint_item4',
			'Breakpoint Minimum Width',
			[ $this, 'markup_number_fields_cb' ],
			'pi-settings-page-bp-group',
			'pi-breakpoint-group-section',
			[
				'name'  => 'pi_breakpoint_item4',
				'value' => get_option( 'pi_breakpoint_item4' ),
			]
		);

		add_settings_field(
			'pi_image_size_select',
			'Select Image Size',
			[ $this, 'markup_select_fields_cb' ],
			'pi-settings-page-bp-map',
			'pi-picture-mapping-section',
			[
				'name'    => 'pi_image_size_select',
				'value'   => get_option( 'pi_image_size_select' ),
				'options' => [
					'group_1' => __( get_option( 'pi_image_size_name' ), 'picture-it' ),
					'group_2' => __( get_option( 'pi_image_size_name2' ), 'picture-it' ),

				],
			]
		);
	}

	// Save settings fields

	public function save_fields() {
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_sizes',
			[
				'type'              => 'array',
				'sanitize_callback' => [ $this, 'sanitize_image_size' ],
			]
		);
		register_setting(
		    'pi-settings-page-bp-group',
            'pi_breakpoint_groups',
            [
                'type' => 'array',
                'sanitize_callback' => [ $this, 'sanitize_breakpoint_groups'],
            ]
        );
		register_setting(
			'pi-settings-page-bp-map',
			'pi_image_size_select'
		);
	}

	// Merging our options rather than just overriding.
	public function sanitize_image_size( $args ) {
		$option = get_option( 'pi_image_sizes', [] );
		if ( $option == [] ) {
			return $args;
		}

		// If we have existing values let's merge them and replace by name.
		return array_replace( $option, $args );
	}

	// This will need to expand in the future so we'll duplicate it for now.
	public function sanitize_breakpoint_groups( $args ) {
		$option = get_option( 'pi_breakpoint_groups', [] );
		if ( $option == [] ) {
			return $args;
		}

		// If we have existing values let's merge them and replace by name.
		return array_replace( $option, $args );
    }

	// Build repeating image size fields.
	public function markup_image_sizes( $args ) {
		$hide_form = true;
		$name      = '';
		$width     = '';
		$height    = '';
		if ( empty( $args['value'] ) ) {
			$next_key      = 0;
			$args['value'] = [
				[
					'name'   => '',
					'width'  => '',
					'height' => '',
				],
			];
		} elseif ( isset( $_GET['size'] ) ) {
			$next_key  = $_GET['size'];
			$hide_form = false;
			if ( isset( $args['value'][ $next_key ] ) ) {
				$name   = $args['value'][ $next_key ]['name'];
				$width  = $args['value'][ $next_key ]['width'];
				$height = $args['value'][ $next_key ]['height'];
			}
		} else {
			$next_key = count( $args['value'] );
		}

		$fields = [
			'name'   => [
				'name'  => $args['name'] . '[' . $next_key . '][name]',
				'value' => $name,
			],
			'width'  => [
				'name'  => $args['name'] . '[' . $next_key . '][width]',
				'value' => $width,
			],
			'height' => [
				'name'  => $args['name'] . '[' . $next_key . '][height]',
				'value' => $height,
			],
		];
		?>
<?php if ( $hide_form ) { ?>
<button class="pi-reveal-form">Add Image Size</button>
<?php } ?>
<div class="pi-image-sizes <?php echo $hide_form ? 'hidden' : ''; ?>">
  <table class="pi-image-sizes-form">
    <tr class="pi-image-size">
      <td>
        <label for="pi_image_sizes[<?php echo $next_key; ?>][name]"><strong>Name</strong></label>
        <?php
						$this->markup_text_fields_cb( $fields['name'] );
						?>
      </td>
      <td>
        <label for="pi_image_sizes[<?php echo $next_key; ?>][width]"><strong>Width</strong></label>
        <?php
						$this->markup_number_fields_cb( $fields['width'] );
						?>
      </td>
      <td>
        <label for="pi_image_sizes[<?php echo $next_key; ?>][height]"><strong>Height
            (Optional)</strong></label>
        <?php
						$this->markup_number_fields_cb( $fields['height'] );
						?>
      </td>
    </tr>
  </table>
  <?php if ( $hide_form ) { ?>
  <button class="add-more add-more-image-sizes">Add another</button>
  <?php } ?>
</div>
<?php
	}

	// Display existing image sizes
	public function markup_existing_sizes( $args ) {
		if ( ! empty( $args['value'] ) ) {
			echo '<h3>Manage Existing Image Sizes</h3>';
			?>
<div class="pi-existing-sizes">
  <?php
				$url = admin_url( 'options-general.php?page=picture-it' );
				foreach ( $args['value'] as $key => $value ) {
					?>
  <div class="pi-image-size">
    <span class="image-size-name"><?php echo $value['name']; ?></span>
    <span class="image-size-width"><?php echo( ! empty( $value['width'] ) ? $value['width'] . 'px' : '' ); ?></span>
    <?php if( ! empty( $value['height'] )):?>
    <span class="image-size-height">
      <?php echo( ! empty( $value['height'] ) ? $value['height'] . 'px' : '' ); ?></span>
    <?php endif; ?>
    <div class="pi-image-size-edit">
      <a href="<?php echo $url . '&size=' . $key ?>" class="size-edit">
        <span class="dashicons dashicons-edit"></span>
        <span class="pi-image-size-edit-label">Edit</span>
      </a>
    </div>
  </div>
  <?php
				}
				?>
</div>
<?php
		}
	}

	// add function for text fields
	public function markup_text_fields_cb( $args ) {
		if ( ! is_array( $args ) ) {
			return null;
		}

		$name  = ( isset( $args['name'] ) ) ? esc_html( $args['name'] ) : '';
		$value = ( isset( $args['value'] ) ) ? esc_html( $args['value'] ) : '';

		?>

<input type="text" name="<?php echo $name ?>" value="<?php echo $value ?>" class="field-<?php echo $name ?>" />

<?php
	}

	// add function for number fields
	public function markup_number_fields_cb( $args ) {
		if ( ! is_array( $args ) ) {
			return null;
		}

		$name  = ( isset( $args['name'] ) ) ? esc_html( $args['name'] ) : '';
		$value = ( isset( $args['value'] ) ) ? esc_html( $args['value'] ) : '';

		?>

<input type="number" name="<?php echo $name ?>" value="<?php echo $value ?>" class="field-<?php echo $name ?>" />

<?php
	}

	// add function for select fields
	public function markup_select_fields_cb( $args ) {
		if ( ! is_array( $args ) ) {
			return null;
		}

		$name    = ( isset( $args['name'] ) ) ? esc_html( $args['name'] ) : '';
		$value   = ( isset( $args['value'] ) ) ? esc_html( $args['value'] ) : '';
		$options = (
			isset( $args['options'] ) && is_array( $args['options'] )
		) ? $args['options'] : []
		?>

<select type="text" name="<?php echo $name ?>" class="field-<?php echo $name ?>">
  <?php
			foreach ( $options as $option_key => $option_label ) {
				echo "<option
				value='{$option_key}'
				" .
				     selected( $option_key, $value )
				     . "
				>
				{$option_label}</option>";
			}
			?>
</select>
<?php
	}

	// add plugin action links

	public static function add_plugin_action_links( $actions ) {
		$actions[] = '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=picture-it' ) ) . '">Settings</a>';

		return $actions;
	}

	public function markup_breakpoint_groups( $args ) {
	    $option = $args['value'];
	    $default = [
	      [
	          'name' => '',
              'sizes' => [
                  [
	                  'name' => '',
	                  'width' => 0,
                  ]
              ]
          ]
        ];
	    $values = $option;
	    if ($option == []) {
	        $values = $default;
	    }
	    foreach ($values as $key => $data) {
	        include 'partials/picture-it-breakpoint-group-form-partial.php';
	    }
	}

	// Adds our custom sizes to the admin for use.
	public function add_image_sizes( $sizes ) {
		$pi_sizes = get_option( 'pi_image_sizes', [] );
		if ( $pi_sizes != [] ) {
			foreach ( $pi_sizes as $size ) {
				$sizes[sanitize_title($size['name'])] = $size['name'];
			}
		}
		return $sizes;
	}


	/**
	 * @param $the_content
     * @see: https://jhtechservices.com/changing-your-image-markup-in-wordpress/
	 */
	public function image_markup_alter( $the_content ) {
		libxml_use_internal_errors(true);
	    $post = new DOMDocument();
			if (!empty($the_content)) {
	    	$post->loadHTML($the_content);
			}
	    $img_tags = $post->getElementsByTagName('img');

	    foreach( $img_tags as $img) {
	        $pict = $post->createElement('picture');
	        $pict->setAttribute('class','pi-image');
	        $source = $post->createElement('source');
	        $source->setAttribute('srcset', $img->getAttribute('srcset'));
	        $pict->appendChild($source);
	        $img->parentNode->appendChild($pict);
	        $pict->appendChild($img);
	    }

	    return $post->saveHTML();
	}
}
