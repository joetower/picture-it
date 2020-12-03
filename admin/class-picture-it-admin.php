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
	 * @var      string    $picture_it    The ID of this plugin.
	 */
	private $picture_it;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $picture_it       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $picture_it, $version ) {

		$this->picture_it = $picture_it;
		$this->version = $version;

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

		wp_enqueue_style( $this->picture_it, plugin_dir_url( __FILE__ ) . 'css/picture-it-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->picture_it, plugin_dir_url( __FILE__ ) . 'js/picture-it-admin.js', array( 'jquery' ), $this->version, false );

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
			array($this, 'admin_page_display')
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

		// Add Settings Section
		$this->add_settings_section();

		// Add Settings Fields
		$this->add_settings_field();

		// Save Settings
		$this->save_fields();

	}

	// Add Settings Sections for Plugin Options
	public function add_settings_section() {
		add_settings_section(
			'pi-general-section',
			'General Settings',
			function() {
				echo '<p>These are general settings for Picture It</p>';
			},
			'pi-settings-page'
		);

		add_settings_section(
			'pi-image-size-section',
			'Define all image sizes',
			function() {
				echo '<p>Here you can add custom image styles to use within your Breakpoint Groups.</p>';
			},
			'pi-settings-page'
		);

		add_settings_section(
			'pi-breakpoint-group-section',
			'Define a breakpoint group and its breakpoints.',
			function() {
				echo '<p>Here you can define a Breakpoint Group name and add breakpoints.</p>';
			},
			'pi-settings-page'
		);

		add_settings_section(
			'pi-picture-mapping-section',
			'Select which images to use for each breakpoint.',
			function() {
				echo '<p>Map each custom image size (by name) to the appropriate breakpoint in which you would like it applied.</p>';
			},
			'pi-settings-page'
		);
	}

	// Add settings fields
	public function add_settings_field() {

		add_settings_field(
			'pi_image_size_name',
			'Image Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_name',
					'value' => get_option('pi_image_size_name')
			)
		);
		add_settings_field(
			'pi_image_size_width',
			'Image Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_width',
					'value' => get_option('pi_image_size_width')
			)
		);
		add_settings_field(
			'pi_image_size_height',
			'Image Height (optional)',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_height',
					'value' => get_option('pi_image_size_height')
			)
		);

		add_settings_field(
			'pi_image_size_name2',
			'Image Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_name2',
					'value' => get_option('pi_image_size_name2')
			)
		);
		add_settings_field(
			'pi_image_size_width2',
			'Image Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_width2',
					'value' => get_option('pi_image_size_width2')
			)
		);
		add_settings_field(
			'pi_image_size_height2',
			'Image Height (optional)',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-image-size-section',
			array(
					'name' => 'pi_image_size_height2',
					'value' => get_option('pi_image_size_height2')
			)
		);

		add_settings_field(
			'pi_breakpoint_group_name',
			'Breakpoint Group Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_group_name',
					'value' => get_option('pi_breakpoint_group_name')
			)
		);

		add_settings_field(
			'pi_breakpoint_size_name',
			'Breakpoint Size Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_size_name',
					'value' => get_option('pi_breakpoint_size_name')
			)
		);
		add_settings_field(
			'pi_breakpoint_item',
			'Breakpoint Minimum Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_item',
					'value' => get_option('pi_breakpoint_item')
			)
		);

		add_settings_field(
			'pi_breakpoint_size_name2',
			'Breakpoint Size Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_size_name2',
					'value' => get_option('pi_breakpoint_size_name2')
			)
		);
		add_settings_field(
			'pi_breakpoint_item2',
			'Breakpoint Minimum Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_item2',
					'value' => get_option('pi_breakpoint_item2')
			)
		);

		add_settings_field(
			'pi_breakpoint_size_name3',
			'Breakpoint Size Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_size_name3',
					'value' => get_option('pi_breakpoint_size_name3')
			)
		);
		add_settings_field(
			'pi_breakpoint_item3',
			'Breakpoint Minimum Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_item3',
					'value' => get_option('pi_breakpoint_item3')
			)
		);

		add_settings_field(
			'pi_breakpoint_size_name4',
			'Breakpoint Size Name',
			array($this, 'markup_text_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_size_name4',
					'value' => get_option('pi_breakpoint_size_name4')
			)
		);
		add_settings_field(
			'pi_breakpoint_item4',
			'Breakpoint Minimum Width',
			array($this, 'markup_number_fields_cb'),
			'pi-settings-page',
			'pi-breakpoint-group-section',
			array(
					'name' => 'pi_breakpoint_item4',
					'value' => get_option('pi_breakpoint_item4')
			)
		);

		add_settings_field(
			'pi_image_size_select',
			'Select Image Size',
			array($this, 'markup_select_fields_cb'),
			'pi-settings-page',
			'pi-picture-mapping-section',
			array(
				'name' => 'pi_image_size_select',
				'value' => get_option('pi_image_size_select'),
				'options' => array(
					'group_1' => __(get_option('pi_image_size_name'), 'picture-it'),
					'group_2' => __(get_option('pi_image_size_name2'), 'picture-it')

				)
			)
		);
	}

	// Save settings fields

	public function save_fields() {
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_name',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_width',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_height',
			array(
				'sanitize_callback' =>'absint'
			)
		);

		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_name2',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_width2',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_height2',
			array(
				'sanitize_callback' =>'absint'
			)
		);

		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_group_name',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_size_name',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_size_name2',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_size_name3',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_size_name4',
			array(
				'sanitize_callback' =>'sanitize_text_field'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_item',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_item2',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_item3',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_breakpoint_item4',
			array(
				'sanitize_callback' =>'absint'
			)
		);
		register_setting(
			'pi-settings-page-options-group',
			'pi_image_size_select'
		);
	}

	// add function for text fields
	public function markup_text_fields_cb($args) {
		if (!is_array($args)) {
			return null;
		}

		$name = (isset($args['name'])) ? esc_html($args['name']) : ''; 
		$value = (isset($args['value'])) ? esc_html($args['value']) : ''; 

		?>
		
		<input 
			type="text" 
			name="<?php echo $name ?>" 
			value="<?php echo $value ?>" 
			class="field-<?php echo $name ?>"
		/>

		<?php
	}

	// add function for number fields
	public function markup_number_fields_cb($args) {
		if (!is_array($args)) {
			return null;
		}

		$name = (isset($args['name'])) ? esc_html($args['name']) : ''; 
		$value = (isset($args['value'])) ? esc_html($args['value']) : ''; 

		?>
		
		<input 
			type="number" 
			name="<?php echo $name ?>" 
			value="<?php echo $value ?>" 
			class="field-<?php echo $name ?>"
		/>

		<?php
	}
	// add function for select fields
	public function markup_select_fields_cb($args) {
		if (!is_array($args)) {
			return null;
		}

		$name = (isset($args['name'])) ? esc_html($args['name']) : ''; 
		$value = (isset($args['value'])) ? esc_html($args['value']) : ''; 
		$options = (
			isset($args['options']) && is_array($args['options'])
			) ? $args['options'] : array()
		?>
		
		<select
			type="text" 
			name="<?php echo $name ?>" 
			class="field-<?php echo $name ?>"
		>
		<?php 
		foreach ($options as $option_key => $option_label) {
			echo "<option
				value='{$option_key}'
				".
					selected($option_key, $value)
			."
				>
				{$option_label}</option>";
		}
		?>
			</select>
		<?php
	}

	// add plugin action links
	
	public static function add_plugin_action_links($actions) {
		$actions[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=picture-it') ) .'">Settings</a>';
		return $actions;
	}
}
