@extends('layouts.main',['active'=>'gp']) 
@section('content')

<!-- section main -->
<section>

    <!-- Jumbotron -->
    <div class="mt-4">

        <!-- section heading -->
        <h3 class="card-title text-center h3 h3-responsive pb-3 font-bold"><strong>Gold Prices (Daily) - Currency <span id="curr">USD</span></strong></h2>

            <!-- visual data -->
            <div class="col-lg-12">

                <div class="jumbotron" style="height:425px;">
                    <div class="loading"></div>
                    <div id="gpchart"></div>

                </div>

            </div>
            <!-- visual data -->

            <!-- gold price - multiple markets -->
            <div class="col-lg-12 mb-3">

                <div class="jumbotron" style="padding:16px 12px;">


                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="_USD" class="currency btn btn-primary btn-sm btn-block">USD</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="_GBP" class="currency btn btn-primary btn-sm btn-block">GBP</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="_CAD" class="currency btn btn-primary btn-sm btn-block">CAD</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="IND_AED" class="currency btn btn-primary btn-sm btn-block">AED</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="_ZAR" class="currency btn btn-primary btn-sm btn-block">ZAR</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="_AUD" class="currency btn btn-primary btn-sm btn-block">AUD</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="IND_EGP" class="currency btn btn-primary btn-sm btn-block">EGP</button>
                                </div>
                                <div class="col-lg-3 col-md-3 pb-1 pt-1">
                                    <button type="button" ticker="IND_RUB" class="currency btn btn-primary btn-sm btn-block">RUB</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- gold price - multiple markets -->
    </div>
    <!-- Jumbotron -->
</section>
<!-- section main -->
@endsection
 
@section('content-js')
<script>
    jQuery(document).ready(function () {

            url = "https://www.quandl.com/api/v3/datasets/WGC/GOLD_DAILY_USD.json";

            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();

            var end_date = d.getFullYear() + '-' +
                                        ((''+month).length<2 ? '0' : '') + month + '-' +
                                        ((''+day).length<2 ? '0' : '') + day;

            // calling at the beginning
            generateChart(url, end_date);

            // calling at the click of button
            $(".currency").click(function(){
               var ticker =  $(this).attr("ticker");
                url = "https://www.quandl.com/api/v3/datasets/WGC/GOLD_DAILY"+ticker+".json";
                
                $("#curr").text($(this).text());
                $(".loading").show();

               generateChart(url,end_date); 

            });
            
        });

        function generateChart(url,end_date){
            
            var gold_data = null;

            var date = [];
            var value = [];
            $.ajax({
                dataType: "json",
                url: url,
                type: 'GET',
                data: {
                    api_key: "eagJ9Lmxk-iAPhYBXqvz",
                    start_date: "2019-01-15",
                    end_date: end_date
                },
                success: function (response) {
                    gold_data =response["dataset"]["data"];
                    date.push("x");
                    value.push("Values");
                    for (var key in gold_data) {
                        var x = gold_data[key][0]
                        var y = gold_data[key][1]

                        date.push(x);
                        value.push(y);
                    }
                
                    chartview(date,value);

                    $(".loading").hide();

                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    
        function chartview(date, value)
        {
            var chart = c3.generate({
            bindto: '#gpchart',
            data: {
                x: 'x',
                xFormat: '%Y-%m-%d',
                columns: [
                    date,
                    value,
                ]
            },
            axis: {
                x: {
                    type: 'timeseries',
                    // if true, treat x value as localtime (Default)
                    // if false, convert to UTC internally
                    localtime: true,
                    tick: {
                        format: '%Y-%m-%d'
                    }
                }
            }
        });
    }

</script>
@endsection