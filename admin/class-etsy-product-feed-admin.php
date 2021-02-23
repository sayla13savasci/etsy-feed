<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Etsy_Product_Feed
 * @subpackage Etsy_Product_Feed/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Etsy_Product_Feed
 * @subpackage Etsy_Product_Feed/admin
 * @author     RexTheme <#>
 */
class Etsy_Product_Feed_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

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
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Etsy_Product_Feed_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Etsy_Product_Feed_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        //check screen for loading css
        $screen = get_current_screen();
        if($screen->id=='etsy-feed_page_show_etsy_product'||$screen->id=='etsy-feed_page_etsy-api-settings'){
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/etsy-product-feed-admin.css', array(), $this->version, 'all');

        }

        //style for select 2
        wp_register_style('my-plugin-select2-style', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css');
        wp_enqueue_style('my-plugin-select2-style');


    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Etsy_Product_Feed_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Etsy_Product_Feed_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/etsy-product-feed-admin.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'rexetsy_obj', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajax_nonce' => wp_create_nonce('rexetsy'),
        ));

        //scripts for select 2
        wp_register_script('my-plugin-select2-script', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js', array('jquery'));
        wp_register_script('my-plugin-script', plugins_url('static/scripts.js', __FILE__), array('jquery'));
        wp_enqueue_script('my-plugin-select2-script');
        wp_enqueue_script('my-plugin-script');

    }

    /**
     * Register a custom menu page.
     */
    //add menu for plugin
    function wpdocs_register_my_custom_menu_page()
    {
        add_menu_page(
            __('Custom Menu Title', 'textdomain'),
            'Etsy Feed',
            'manage_options',
            'etsyproductfeed',
            array($this, 'etsy_api_settings'),
            'dashicons-share-alt2',
            20
        );

        add_submenu_page(
            'etsyproductfeed',
            __('Dashboard', 'etsy-product-feed'),
            'Etsy API Settings',
            'manage_options',
            'etsy-api-settings',
            array($this, 'etsy_api_settings')
        );

        remove_submenu_page( 'etsyproductfeed', 'etsyproductfeed');

    }

    /**
     * Display a custom menu page
     */
    function my_custom_menu_page()
    {
        esc_html_e('Admin Page Test', 'etsy-product-feed');
    }


    /**
     * Display a submenu page
     */
    function etsy_api_settings()
    {
        require plugin_dir_path(__FILE__) . '/partials/etsy-api-settings.php';
    }

    /**
     * Display a submenu page
     */
    function show_prodcuts()
    {
        require plugin_dir_path(__FILE__) . '/partials/show-product.php';
    }

    /**
     * craete shipping template submenu
     */
    function shipping_template_id(){
        require plugin_dir_path(__FILE__) . '/partials/shipping_template_id.php';
    }


}
