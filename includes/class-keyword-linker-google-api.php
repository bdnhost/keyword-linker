<?php
/**
 * מטפל בתקשורת עם Google Custom Search API.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Keyword_Linker
 * @subpackage Keyword_Linker/includes
 */

class Keyword_Linker_Google_API {

    private $api_key;
    private $search_engine_id;

    public function __construct() {
        $options = get_option( 'keyword_linker_options' );
        $this->api_key = $options['google_api_key'];
        $this->search_engine_id = $options['search_engine_id'];
    }

    public function search( $keyword ) {
        $url = 'https://www.googleapis.com/customsearch/v1';
        $args = array(
            'key' => $this->api_key,
            'cx' => $this->search_engine_id,
            'q' => urlencode( $keyword ),
            'num' => 1,
            'fields' => 'items(link)'
        );

        $request_url = add_query_arg( $args, $url );
        $response = wp_remote_get( $request_url );

        if ( is_wp_error( $response ) ) {
            error_log( 'Keyword Linker: שגיאה בבקשה ל-Google API - ' . $response->get_error_message() );
            return false;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( isset( $data['items'] ) && ! empty( $data['items'] ) ) {
            return $data['items'][0]['link'];
        }

        return false;
    }

    public function validate_credentials() {
        $test_keyword = 'test';
        $result = $this->search( $test_keyword );
        return $result !== false;
    }
}