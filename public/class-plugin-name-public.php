<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Picture_It
 * @subpackage Picture_It/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Picture_It
 * @subpackage Picture_It/public
 * @author     Your Name <email@example.com>
 */
class Picture_It_Public {

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
	 * @param      string    $picture_it       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $picture_it, $version ) {

		$this->picture_it = $picture_it;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->picture_it, plugin_dir_url( __FILE__ ) . 'css/picture-it-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->picture_it, plugin_dir_url( __FILE__ ) . 'js/picture-it-public.js', array( 'jquery' ), $this->version, false );

	}

}
