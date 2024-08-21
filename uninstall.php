<?php
/**
 * קובץ זה מופעל כאשר התוסף מוסר.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Keyword_Linker
 */

// אם uninstall לא נקרא מוורדפרס, צא.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// מחיקת האפשרויות מבסיס הנתונים.
delete_option( 'keyword_linker_options' );

// מחיקת טבלאות מבסיס הנתונים אם קיימות.
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}keyword_linker_links" );

// מחיקת מטא-דאטה של פוסטים.
$wpdb->query( "DELETE FROM $wpdb->postmeta WHERE meta_key LIKE 'keyword_linker_%'" );