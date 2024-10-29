<?php

/*
  Plugin Name: AP Background
  Plugin URI: https://apbackground.sdemo.site
  Description: AP Background is a responsive WordPress advanced parallax background plugin. It allows users to easily create background blocks with parallax effect of background and content (Image & video gallery, WordPress posts and Woo Commerce). AP Background makes your site be impressive and professional.
  Version: 3.8.2
  Author: SFThemes
  Author URI: https://sfwebservice.com
  License: GNU General Public License v2 or later
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

defined('ABSPATH') or die();

class SFAPB_Class {

    /**
     * Define plugin version
     */
    public $version = '3.8.2';

    /**
     * The single instance of the class.
     *
     */
    protected static $_instance = null;

    /**
     * Main AP Background Instance.
     *
     * Ensures only one instance of AP Background is loaded or can be loaded.
     *
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * AP Background Constructor.
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Define AP Background Constants.
     */
    private function define_constants() {
        define('SFAPB_VERSION', $this->version);
        define('SFAPB_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('SFAPB_PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    /**
     * Include plugin functions
     */
    public function includes() {
        if (is_admin()) {
            include_once SFAPB_PLUGIN_DIR . 'includes/functions.admin.php';
        }
        include_once SFAPB_PLUGIN_DIR . 'includes/functions.front.php';
        include_once SFAPB_PLUGIN_DIR . 'includes/ajaxs.php';
        include_once SFAPB_PLUGIN_DIR . 'includes/shortCodeClass.php';
    }

    /**
     * Hook into actions and filters.
     */
    private function init_hooks() {
        register_activation_hook(__FILE__, 'ap_background_install');
        register_uninstall_hook(__FILE__, 'ap_background_uninstall');
        //add_action('plugins_loaded', array('SFAPB_Install', 'update'));
        add_action('init', array($this, 'init'), 0);
        add_action('admin_init', array($this, 'admin_init'), 0);
        //Add parralax menu
        add_action('admin_menu', 'btParallaxBackgroundAddAdminMenu');

        //Post action save slider || save and close
        add_action('admin_post_bt_advParallaxBackAdminSaveSlider', 'advParallaxBackAdminSaveSlider', 10, FALSE);

        //add script for admin page
        add_action('admin_enqueue_scripts', 'advParallaxBackAdminAddScript');

        //Add site script
        add_action('wp_enqueue_scripts', 'adv_parallax_add_site_script');
    }

    /**
     * Load Localisation files.
     *
     */
    public function load_plugin_textdomain() {
        $locale = apply_filters('plugin_locale', get_locale(), 'ap-background');

        load_textdomain('ap-background', SFAPB_PLUGIN_DIR . '/ap-background-' . $locale . '.mo');
        load_plugin_textdomain('ap-background', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Init AP Background when WordPress Initial.
     */
    public function init() {
        // Set up localisation.
        $this->load_plugin_textdomain();
        $this->start_session();
    }

    public function admin_init() {
        //Add BT Parallax Background button to Visual Composer
        addVisualComposerButton();
        //Add editer bt parallax background button
        btAddButton();
    }

    function start_session() {
        if (!session_id()) {
            session_start();
        }
    }

}

if (!function_exists('SFAPB')) {

    function SFAPB() {
        return SFAPB_Class::instance();
    }

}

// Global for backwards compatibility.
$GLOBALS['sfapb'] = SFAPB();
