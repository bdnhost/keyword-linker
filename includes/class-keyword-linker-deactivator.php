<?php
/**
 * מופעל במהלך כיבוי התוסף.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Keyword_Linker
 * @subpackage Keyword_Linker/includes
 */

class Keyword_Linker_Deactivator {

    public static function deactivate() {
        // שמירת נתונים או ביצוע פעולות ניקוי חלקיות
        // לדוגמה, נוכל לשמור את תאריך הכיבוי האחרון
        update_option( 'keyword_linker_last_deactivation', current_time( 'mysql' ) );

        // ביטול משימות מתוזמנות אם קיימות
        wp_clear_scheduled_hook( 'keyword_linker_daily_update' );
    }
}