<?php
class Keyword_Linker_Link_Updater {

    private $options;

    public function __construct() {
        $this->options = get_option('keyword_linker_options');
    }

    public function update_content_links($content) {
        $keywords = $this->extract_keywords($content);
        foreach ($keywords as $keyword) {
            $link = $this->get_link_for_keyword($keyword);
            if ($link) {
                $content = $this->replace_keyword_with_link($content, $keyword, $link);
            }
        }
        return $content;
    }

    private function extract_keywords($content) {
        $words = str_word_count(strip_tags($content), 1);
        $keywords = array_unique($words);
        return array_slice($keywords, 0, $this->options['max_keywords']);
    }

    private function get_link_for_keyword($keyword) {
        // כאן תהיה הלוגיקה לקבלת קישור עבור מילת מפתח, למשל שימוש ב-Google API
        // לצורך הדוגמה, נחזיר קישור דמה
        return 'https://example.com/search?q=' . urlencode($keyword);
    }

    private function replace_keyword_with_link($content, $keyword, $link) {
        $pattern = '/\b' . preg_quote($keyword, '/') . '\b(?![^<]*>|[^<>]*<\/a>)/i';
        $replacement = '<a href="' . esc_url($link) . '" target="_blank">' . $keyword . '</a>';
        return preg_replace($pattern, $replacement, $content, 1);
    }
}