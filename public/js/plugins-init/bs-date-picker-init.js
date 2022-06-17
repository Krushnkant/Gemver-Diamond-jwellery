(function($) {
    "use strict"

    jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('.custom_date_picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
})(jQuery);
