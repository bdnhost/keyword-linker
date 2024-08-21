<?php
/**
 * הקובץ הראשי של התוסף Keyword Linker
 *
 * @link              https://example.com
 * @since             1.0.0
 * @package           Keyword_Linker
 *
 * @wordpress-plugin
 * Plugin Name:       Keyword Linker
 * Plugin URI:        https://example.com/keyword-linker
 * Description:       תוסף חכם ליצירת קישורים אוטומטיים למילות מפתח בתוכן האתר
 * Version:           1.0.0
 * Author:            שמך
 * Author URI:        https://example.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       keyword-linker
 * Domain Path:       /languages
 */

// אם קובץ זה נקרא ישירות, צא.
if (!defined('WPINC')) {
    die;
}

define('KEYWORD_LINKER_VERSION', '1.0.0');
define('KEYWORD_LINKER_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('KEYWORD_LINKER_PLUGIN_URL', plugin_dir_url(__FILE__));

function activate_keyword_linker() {
    require_once KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker-activator.php';
    Keyword_Linker_Activator::activate();
}

function deactivate_keyword_linker() {
    require_once KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker-deactivator.php';
    Keyword_Linker_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_keyword_linker');
register_deactivation_hook(__FILE__, 'deactivate_keyword_linker');

function keyword_linker_load_textdomain() {
    load_plugin_textdomain('keyword-linker', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'keyword_linker_load_textdomain');

function keyword_linker_register_settings() {
    register_setting(
        'keyword_linker_options',
        'keyword_linker_options',
        'keyword_linker_sanitize_options'
    );
}

function keyword_linker_sanitize_options($options) {
    $sanitized = array();
    if (isset($options['google_api_key'])) {
        $sanitized['google_api_key'] = sanitize_text_field($options['google_api_key']);
    }
    if (isset($options['search_engine_id'])) {
        $sanitized['search_engine_id'] = sanitize_text_field($options['search_engine_id']);
    }
    if (isset($options['min_rank_to_update'])) {
        $sanitized['min_rank_to_update'] = intval($options['min_rank_to_update']);
    }
    if (isset($options['max_keywords'])) {
        $sanitized['max_keywords'] = intval($options['max_keywords']);
    }
    return $sanitized;
}

add_action('admin_init', 'keyword_linker_register_settings');

require KEYWORD_LINKER_PLUGIN_DIR . 'includes/class-keyword-linker.php';

function run_keyword_linker() {
    $plugin = new Keyword_Linker();
    $plugin->run();

    // הוספת הפונקציונליות של AJAX
    $admin = new Keyword_Linker_Admin($plugin->get_plugin_name(), $plugin->get_version());
    add_action('admin_init', array($admin, 'init_ajax'));
}
run_keyword_linker();