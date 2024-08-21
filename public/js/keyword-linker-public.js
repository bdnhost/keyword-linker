(function( $ ) {
    'use strict';

    $(function() {
        // כאן ניתן להוסיף פונקציונליות JavaScript לחזית האתר אם נדרש
        // לדוגמה, ניתן להוסיף אירוע לחיצה על הקישורים שנוצרו
        $('a[data-keyword-link]').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            // כאן ניתן להוסיף לוגיקה נוספת, כמו פתיחת החלון בטאב חדש או הצגת אזהרה
            window.open(url, '_blank');
        });
    });

})( jQuery );