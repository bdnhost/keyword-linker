<?php
class Keyword_Linker_i18n {

    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'keyword-linker',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}