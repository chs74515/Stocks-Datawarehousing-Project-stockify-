    $(document).ready(function () {

    // multi selector initialization
    $('#company').materialSelect();
    $('#year').materialSelect();
    $('#quarter').materialSelect();
    $('#month').materialSelect();


    var min_year = $("#year option:eq(1)").val();
    var max_year = $("#year option:last").val();
    var stocks;

    $("#dateslider").dateRangeSlider({

        bounds: {
            min: new Date(min_year, 0, 1),
            max: new Date(max_year, 11, 31)
        },
        defaultValues: {
            min: new Date(min_year, 0, 1),
            max: new Date(max_year, 11, 31)
        },
        formatter: function (val) {
            var days = val.getDate(),
                month = val.getMonth() + 1,
                year = val.getFullYear();
            return year + "-" + month + "-" + days;
        },
        step: {
            days: 1
        }

    });

    $("#dateslider").bind("userValuesChanged", function (e, data) {
        var min = data.values.min;
        var max = data.values.max;

        minDate = min.getFullYear() + '-' + (min.getMonth() + 1) + '-' + min.getDate();
        maxDate = max.getFullYear() + '-' + (max.getMonth() + 1) + '-' + max.getDate();

        var url = 'getDataByRange';
        var dates = {};
        dates["min_date"] = minDate;
        dates["max_date"] = maxDate;

        $('#company,#year,#quarter,#month option:selected').prop("selected", false);
        $('#company').materialSelect();
        $('#year').materialSelect();
        $('#quarter').materialSelect();
        $('#month').materialSelect();

        executeAjax(dates, url);
    });

    /*
     *
     * - default gradient
     * - listening to circle-animation-progress` event and display the animation progress: from 0 to 100%
     */
    $('.first.circle').circleProgress({
        value: 1,
        fill: {gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4}
    }).on('circle-animation-progress', function (event, progress) {
    });

    $('.second.circle').circleProgress({
        value: 1,
        fill: {gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4}
    }).on('circle-animation-progress', function (event, progress) {
    });

    $('.third.circle').circleProgress({
        value: 1,
        fill: {gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4}
    }).on('circle-animation-progress', function (event, progress) {
    });

    $('.fourth.circle').circleProgress({
        value: 1,
        fill: {gradient: [['#0681c4', .5], ['#4ac5f8', .5]], gradientAngle: Math.PI / 4}
    }).on('circle-animation-progress', function (event, progress) {
    });

    $table = $('#dtstock').DataTable({
        "order": [[0, "desc"]],
        drawCallback: function () {
            $('.paginate_button').on('click', function () {
                const info = $table.page.info();
                if (info.pages - info.page <= 2) {
                    populateTable(info.recordsTotal);
                }
            });
        }
    });

    $('#dtstock_wrapper').find('label').each(function () {
        $(this).parent().append($(this).children());
    });

    $('#dtstock_wrapper .dataTables_filter').find('input').each(function () {
        $('input').attr("placeholder", "Search");
        $('input').removeClass('form-control-sm');
    });


    $('#dtstock_wrapper .dataTables_length').addClass('d-flex flex-row');
    $('#dtstock_wrapper .dataTables_filter').addClass('md-form');
    $('#dtstock_wrapper select').removeClass(
        'custom-select custom-select-sm form-control form-control-sm');
    $('#dtstock_wrapper select').addClass('mdb-select');
    $('#dtstock_wrapper .mdb-select').materialSelect();
    $('#dtstock_wrapper .dataTables_filter').find('label').remove();

    $('#dtstock_length').addClass('mt-4');

    $('#dtstock_length').find('label').text('Show Records').addClass('pr-3').addClass('mt-1');


    function executeAjax(data, url) {
        $(".loading").show();

        $.ajaxSetup({
            headers:
                {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            cache: false,
            type: 'POST',
            success: function (response) {
                populateDataTable(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    $("#fetch_records").on('click', function () {

        var companies = $('#company').val();
        var years = $('#year').val();
        var quarter = $('#quarter').val();
        var months = $('#month').val();
        url = "getDataByFilters";
        var data = {};

        data["companies"] = companies;
        data["years"] = years;
        data["quarter"] = quarter;
        data["months"] = months;
        executeAjax(data, url);
    });


    function populateDataTable(data) {

        let high = data['high'];
        let low = data['low'];
        let open = data['open'];
        let close = data['close'];
        $("#high").text(high);
        $("#low").text(low);
        $("#open").text(open);
        $("#close").text(close);

        stocks = data['stocks'];
        $("#dtstock").DataTable().clear().draw();
        populateTable(0);
    }

    function populateTable(start) {
        var length = stocks.length;
        // clear the table before populating it with more data
        for (var i = start; i < length && i < start + 200; i++) {
            const stock = stocks[i];
            // You could also use an ajax property on the data table initialization
            $('#dtstock').dataTable().fnAddData([
                stock.date,
                stock.name,
                stock.open,
                stock.high,
                stock.low,
                stock.close,
                stock.volume,
                stock.dividend,
                stock.split,
                stock.Adj_Open,
                stock.Adj_High,
                stock.Adj_Low,
                stock.Adj_Close,
                stock.Adj_Volume
            ]);
        }
        $(".loading").hide();
    }

    stocks = JSON.parse(stockData);
    console.log(stocks);
    populateTable(0);
});
