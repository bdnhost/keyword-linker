(function( $ ) {
    'use strict';

    $(function() {
        $('#check-google-api').on('click', function(e) {
            e.preventDefault();
            var $button = $(this);
            var originalText = $button.text();
            $button.text('בודק...').prop('disabled', true);

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'check_google_api',
                    nonce: keyword_linker_admin.nonce
                },
                success: function(response) {
                    if (response.success) {
                        alert('הגדרות ה-API תקינות!');
                    } else {
                        alert('שגיאה בהגדרות ה-API: ' + response.data.message);
                    }
                },
                error: function() {
                    alert('אירעה שגיאה בבדיקת ה-API. אנא נסה שוב.');
                },
                complete: function() {
                    $button.text(originalText).prop('disabled', false);
                }
            });
        });
    });

})( jQuery );