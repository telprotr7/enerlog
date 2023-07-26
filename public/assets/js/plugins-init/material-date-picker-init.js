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
        format: 'YYYY-MM-DD'
    });
    $('#date-format2').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    $('#date-format3').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    $('#date-format4').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        lang: 'id',
    });
    $('#date-format5').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        lang: 'id',
    });
    $('#date-format6').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        lang: 'id', // Set lokalisasi bahasa Indonesia
    });
    
    $('#date-format7').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        lang: 'id',
    });
    $('#date-format8').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm',
        lang: 'id',
    });
    $('#date-format9').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD HH:mm'
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });

})(jQuery);