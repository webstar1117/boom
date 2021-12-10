$(document).ready(function() {
    if ($('select').length) {
        $('select').each(function() {
            if ($(this).val() === "" || $(this).val() === null) {
                $(this).addClass('placeholder');
                $(this).children().css('color','black')
            } else {
                $(this).removeClass('placeholder');
                $(this).children().css('color','black')
            }
        });

        $('select').on('change', function(e) {
            if ($(this).val() === "" || $(this).val() === null) {
                $(this).addClass('placeholder');
                $(this).children().css('color','black')
            } else {
                $(this).removeClass('placeholder');
                $(this).children().css('color','black')
            }
        });
    }
})