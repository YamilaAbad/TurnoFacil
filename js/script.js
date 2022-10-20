var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#datepickerDesde').datepicker({
        format: "yyyy-mm-dd",
        beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true

    });

    var checkout = $('#datepickerHasta').datepicker({
        format: "yyyy-mm-dd",
        beforeShowDay: function(date) {
        return date.valueOf() >= now.valueOf();
    },
    autoclose: true

    });