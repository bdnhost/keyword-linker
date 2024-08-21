<?php
class Keyword_Linker {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->version = KEYWORD_LINKER_VERSION;
        $this->plugin_name = 'keyword-linker';
        
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker-loader.php';
        require_once KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker-i18n.php';
        require_once KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker-link-updater.php';
        require_once KEYWORD_LINKER_PLUGIN_DIR . 'admin/class-keyword-linker-admin.php';
        require_once KEYWORD_LINKER_PLUGIN_DIR . 'public/class-keyword-linker-public.php';
    
        $this->loader = new Keyword_Linker_Loader();
    }

    private function set_locale() {
        $plugin_i18n = new Keyword_Linker_i18n();
        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    private function define_admin_hooks() {
        $plugin_admin = new Keyword_Linker_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_options_page');
    }

    private function define_public_hooks() {
        $plugin_public = new Keyword_Linker_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_filter('the_content', $plugin_public, 'update_content');
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
}