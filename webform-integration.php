<?php
/*
Plugin Name:Webform Integration
Plugin URI:http://www.miraclewebsoft.com
Description:Webform Integration into wordpress
Version:1
Author:sony7596, miraclewebssoft, reachbaljit
Author URI:http://www.miraclewebsoft.com
License:GPL2
License URI:https://www.gnu.org/licenses/gpl-2.0.html
*/
if (!defined('ABSPATH')) {
    exit;
}

if (!defined("GWCI_URL")) define("GWCI_URL", plugin_dir_url( __FILE__ ) );
if (!defined("GWCI_DIR")) define("GWCI", plugin_dir_path(__FILE__));
if (!defined("GWCI_PLUGIN_NM")) define("GWCI_PLUGIN_NM", 'Webform Integration');


Class GWCI
{
    public $pre_name = 'gwci';

    public function __construct()
    {
        // Installation and uninstallation hooks
        register_activation_hook(__FILE__, array($this, $this->pre_name . '_activate'));
        register_deactivation_hook(__FILE__, array($this, $this->pre_name . '_deactivate'));
        add_action('admin_menu', array($this, $this->pre_name . '_setup_admin_menu'));
        add_action("admin_init", array($this, $this->pre_name . '_backend_plugin_js_scripts_filter_table'));
        add_action("admin_init", array($this, $this->pre_name . '_backend_plugin_css_scripts_filter_table'));
        add_action('admin_init', array($this, $this->pre_name . '_settings'));
        add_action('wp_footer', array($this, $this->pre_name . '_front_end_js_css'));
        add_shortcode( 'webform', array($this, $this->pre_name . '_crm_form'));
        add_action('init', array($this, $this->pre_name . '_enable_widgets'));


    }


    public function gwci_setup_admin_menu()
    {
        add_submenu_page('options-general.php', __('Webform Integration', 'gwci_td'), GWCI_PLUGIN_NM, 'manage_options', 'gwci_slug', array($this, 'gwci_admin_page'));
    }

    public function gwci_admin_page()
    {
        include(plugin_dir_path(__FILE__) . 'views/dashboard.php');
    }

    function gwci_backend_plugin_js_scripts_filter_table()
    {
        wp_enqueue_script("jquery");
        wp_enqueue_script("gwci.js", GWCI_URL . "assets/js/gwci.js");
    }

    function gwci_backend_plugin_css_scripts_filter_table()
    {
        wp_enqueue_style("gwci.css", GWCI_URL . "assets/css/gwci.css");
    }

    public function gwci_activate()
    {

    }

    public function gwci_deactivate()
    {
    }


    function gwci_settings()
    {

        register_setting('gcwi_group', 'webform-html');


    }

    function gwci_front_end_js_css()
    {
        wp_enqueue_script("gwci_front.js", GWCI_URL . "assets/js/gwci_front.js");
        wp_enqueue_style("gwci_front.css", GWCI_URL . "assets/css/gwci_front.css");
    }

    function gwci_crm_form(){

        $form_data = get_option('webform-html');
        return $form_data;
    }

    function gwci_enable_widgets(){

        // Enable shortcodes in text widgets
        add_filter('widget_text','do_shortcode');
    }

}

$GWCI_obj = new GWCI();
