<?php
class Keyword_Linker_Public {

    private $plugin_name;
    private $version;
    private $link_updater;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->link_updater = new Keyword_Linker_Link_Updater();
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/keyword-linker-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/keyword-linker-public.js', array('jquery'), $this->version, false);
    }

    public function update_content($content) {
        if (is_singular() && in_the_loop() && is_main_query()) {
            return $this->link_updater->update_content_links($content);
        }
        return $content;
    }
}