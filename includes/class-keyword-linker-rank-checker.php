<?php
/**
 * מטפל בבדיקת הדירוג של פוסטים.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Keyword_Linker
 * @subpackage Keyword_Linker/includes
 */

class Keyword_Linker_Rank_Checker {

    private $min_rank_to_update;

    public function __construct() {
        $options = get_option('keyword_linker_options');
        $this->min_rank_to_update = $options['min_rank_to_update'];
    }

    public function check_rank($post_id) {
        // בפועל, כאן היינו משתמשים ב-API של שירות SEO לקבלת דירוג אמיתי
        // לצורך הדגמה, נשתמש בערך אקראי
        $cached_rank = get_post_meta($post_id, '_keyword_linker_rank', true);
        
        if (!$cached_rank) {
            $rank = rand(1, 100);
            update_post_meta($post_id, '_keyword_linker_rank', $rank);
            return $rank;
        }
        
        return $cached_rank;
    }

    public function should_update($post_id) {
        $current_rank = $this->check_rank($post_id);
        return $current_rank <= $this->min_rank_to_update;
    }

    public function update_rank($post_id) {
        // בפועל, כאן היינו מעדכנים את הדירוג מ-API חיצוני
        $new_rank = rand(1, 100);
        update_post_meta($post_id, '_keyword_linker_rank', $new_rank);
        return $new_rank;
    }
}