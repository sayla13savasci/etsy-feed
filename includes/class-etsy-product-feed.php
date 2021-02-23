<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Etsy_Product_Feed
 * @subpackage Etsy_Product_Feed/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Etsy_Product_Feed
 * @subpackage Etsy_Product_Feed/includes
 * @author     RexTheme <#>
 */
class Etsy_Product_Feed {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Etsy_Product_Feed_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ETSY_PRODUCT_FEED_VERSION' ) ) {
			$this->version = ETSY_PRODUCT_FEED_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'etsy-product-feed';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Etsy_Product_Feed_Loader. Orchestrates the hooks of the plugin.
	 * - Etsy_Product_Feed_i18n. Defines internationalization functionality.
	 * - Etsy_Product_Feed_Admin. Defines all hooks for the admin area.
	 * - Etsy_Product_Feed_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/autoload.php';


        /**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-etsy-product-feed-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-etsy-product-feed-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-etsy-product-feed-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-etsy-product-feed-public.php';

		$this->loader = new Etsy_Product_Feed_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Etsy_Product_Feed_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Etsy_Product_Feed_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
	    //object for ajax class
        $admin_ajax = new Etsy_Product_Feed_Ajax();
        $upload_product_obj = new upload_product\Upload_Product();
        $admin_notice_object = new admin_notice\Admin_notice();

		$plugin_admin = new Etsy_Product_Feed_Admin( $this->get_plugin_name(), $this->get_version() );
		$auth = new Etsy_Authorization();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        //add menu for plugin
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'wpdocs_register_my_custom_menu_page' );

        //add hook for calling function
        $this->loader->add_action( 'admin_init', $admin_ajax, 'init' );
        $this->loader->add_action( 'admin_init', $auth, 'authorize' );

        //add hook for admin notice
        $sending_status = get_option('sending_status');
        error_log(print_r($sending_status,1));
        if($sending_status==='completed'){
            $this->loader->add_action( 'admin_notices', $admin_notice_object, 'sample_admin_notice__success' );
        }elseif ($sending_status==='sending'){
            $this->loader->add_action( 'admin_notices', $admin_notice_object, 'sample_admin_notice__sending' );
        }
        elseif ($sending_status==='sending_status_error'){
            $this->loader->add_action( 'admin_notices', $admin_notice_object, 'sample_admin_notice__sending_error' );
        } elseif ($sending_status==='listing_price_conflict'){
            $this->loader->add_action( 'admin_notices', $admin_notice_object, 'sample_admin_notice__listing_price_conflict' );
        }
        else{
            $sending_error = get_option('sending_status_error');
            if($sending_error==='sending_error'){
                $this->loader->add_action( 'admin_notices', $admin_notice_object, 'sample_admin_notice__error' );
            }
        }
    }

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Etsy_Product_Feed_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Etsy_Product_Feed_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
