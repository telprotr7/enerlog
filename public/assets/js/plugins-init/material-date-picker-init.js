(function($) {
    "use strict"

    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
    $('#date-format').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm'
    });
    $('#date-format2').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm'
    });
    $('#date-format3').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    $('#date-format4').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    $('#date-format5').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    $('#date-format6').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });

})(jQuery);