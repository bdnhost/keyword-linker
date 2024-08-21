<?php
/**
 * מופעל במהלך הפעלת התוסף.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Keyword_Linker
 * @subpackage Keyword_Linker/includes
 */

class Keyword_Linker_Activator {

    public static function activate() {
        // יצירת טבלה במסד הנתונים אם נדרש
        global $wpdb;
        $table_name = $wpdb->prefix . 'keyword_linker_links';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            post_id mediumint(9) NOT NULL,
            keyword varchar(255) NOT NULL,
            link varchar(255) NOT NULL,
            created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        // הגדרת ערכים ראשוניים לאפשרויות התוסף
        $default_options = array(
            'google_api_key' => '',
            'search_engine_id' => '',
            'min_rank_to_update' => 10,
            'max_keywords' => 5
        );
        add_option( 'keyword_linker_options', $default_options );
    }
}