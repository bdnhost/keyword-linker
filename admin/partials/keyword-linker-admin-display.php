<div class="wrap keyword-linker-admin-wrapper">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
        <?php
            settings_fields('keyword_linker_options');
            do_settings_sections('keyword_linker_options');
            $options = get_option('keyword_linker_options', array(
                'google_api_key' => '',
                'search_engine_id' => '',
                'min_rank_to_update' => 10,
                'max_keywords' => 5
            ));
        ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="google_api_key"><?php echo __('Google API Key', 'keyword-linker'); ?></label></th>
                <td>
                    <input type="text" id="google_api_key" name="keyword_linker_options[google_api_key]" value="<?php echo esc_attr($options['google_api_key']); ?>" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="search_engine_id"><?php echo __('Search Engine ID', 'keyword-linker'); ?></label></th>
                <td>
                    <input type="text" id="search_engine_id" name="keyword_linker_options[search_engine_id]" value="<?php echo esc_attr($options['search_engine_id']); ?>" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="min_rank_to_update"><?php echo __('Minimum Rank to Update', 'keyword-linker'); ?></label></th>
                <td>
                    <input type="number" id="min_rank_to_update" name="keyword_linker_options[min_rank_to_update]" value="<?php echo esc_attr($options['min_rank_to_update']); ?>" min="1" max="100" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="max_keywords"><?php echo __('Maximum Number of Keywords', 'keyword-linker'); ?></label></th>
                <td>
                    <input type="number" id="max_keywords" name="keyword_linker_options[max_keywords]" value="<?php echo esc_attr($options['max_keywords']); ?>" min="1" max="20" />
                </td>
            </tr>
        </table>
        <?php submit_button(__('Save Settings', 'keyword-linker')); ?>
    </form>
    <button id="check-google-api" class="button button-secondary"><?php echo __('Check API Settings', 'keyword-linker'); ?></button>
</div>