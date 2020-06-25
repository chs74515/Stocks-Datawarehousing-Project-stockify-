@extends('layouts.main',['active'=>'index']) 
@section('content')
<!-- section main -->
<?php 
 $companyName=["Walt Disney Co","Microfost Corporation","3M","NIKE", "Johnson & Johnson","McDonald","Intel Corporation","Gold Sachs","JP Morgn","American Express",
        "Coca Cola","General Electric","Procter & Gamble","Int. Business Machine"];
?>
<script>
  window.stockData='<?php echo json_encode($stocks)?>'

</script>

<section>
  <!-- Jumbotron -->
  <div class="mt-3">
    <div class="loading">
    </div>
    <!-- section heading -->
    <h3 class="card-title text-center h3 h3-responsive pb-2 font-bold"><strong>EOD of USA Stocks</strong></h2>

      <!-- visual data -->
      <div class="col-lg-12">

        <div class="jumbotron">

          <div class="row text-center">
            <!-- High -->
            <div class="col-lg-3">

              <!-- Card -->
              <div class="card">

                <!-- Card image -->
                <div class="view overlay">
                  <div class="first circle">
                    <strong id="high">{{$high}}</strong>
                  </div>
                </div>

                <!-- Card content -->
                <div class="mt-1">
                  <!-- Title -->
                  <h4 class="card-title text-center">Avg. High</h4>
                </div>

              </div>
              <!-- Card -->

            </div>
            <!-- Low -->
            <div class="col-lg-3">

              <!-- Card -->
              <div class="card">

                <!-- Card image -->
                <div class="view overlay">
                  <div class="second circle">
                    <strong id="low">{{$low}}</strong>
                  </div>
                </div>

                <!-- Card content -->
                <div class="mt-1">
                  <!-- Title -->
                  <h4 class="card-title text-center">Avg. Low</h4>
                </div>

              </div>
              <!-- Card -->

            </div>
            <!-- Open -->
            <div class="col-lg-3">

              <!-- Card -->
              <div class="card">

                <!-- Card image -->
                <div class="view overlay">
                  <div class="third circle">
                    <strong id="open">{{$open}}</strong>
                  </div>
                </div>

                <!-- Card content -->
                <div class="mt-1">
                  <!-- Title -->
                  <h4 class="card-title text-center">Avg. Open</h4>
                </div>

              </div>
              <!-- Card -->

            </div>
            <!-- Close -->
            <div class="col-lg-3">


              <!-- Card -->
              <div class="card">

                <!-- Card image -->
                <div class="view overlay">
                  <div class="fourth circle">
                    <strong id="close">{{$close}}</strong>
                  </div>
                </div>

                <!-- Card content -->
                <div class="mt-1">
                  <!-- Title -->
                  <h4 class="card-title text-center">Avg. Close</h4>
                </div>

              </div>
              <!-- Card -->

            </div>
          </div>

        </div>

      </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- section main -->

<!-- section data table -->
<section class="mt-2">

  <!-- data table -->
  <div class="col-lg-12">

    <div class="row">

      <!-- filter column -->
      <div class="col-lg-3">
        <div class="">

          <!-- range filter -->
          <div id="dateslider"></div>

          <hr class="pt-1 pb-1">

          <!-- company filter -->
          <div id="company-outer">
            <label>Name</label>
            <select id="company" class="selectpicker" searchable="Search here.." multiple>
            <option value="" disabled selected>Choose company</option>
            @foreach ($companies as $i => $company)
            
            <option value="{{$company->name}}">{{$companyName[$i]}}</option>
            
            @endforeach
            
          </select>
            <!-- <button class="btn-save btn btn-primary btn-sm">Proceed</button> -->
          </div>

          <hr class="pt-1 pb-1">

          <!-- year filter -->
          <input type="hidden" value="{{$years[0]->year}}" id="min_date_start">

          <div id="year-outer">
            <label>Year</label>
            <select id="year" class="selectpicker" searchable="Search here.." multiple data-live-search="true">
              <option value="" disabled selected>Choose year</option>
              @foreach ($years as $year)
              
              <option value="{{$year->year}}">{{$year->year}}</option>
              
              @endforeach
              
            </select>

          </div>

          <hr class="pt-1 pb-1">

          <!-- quarter filter -->
          <div id="quater-outer">
            <label>Quarter Name</label>
            <select id="quarter" class="selectpicker" multiple data-live-search="true">
              <option value="" disabled selected>Choose quarter</option>
              <option value="1">First</option>  
              <option value="2">Second</option>  
              <option value="3">Third</option>  
              <option value="4">Fourth</option>  
            </select>
          </div>

          <hr class="pt-1 pb-1">

          <!-- month filter -->
          <div id="month-outer">
            <label>Month Name</label>
            <select id="month" class="selectpicker" searchable="Search here.." multiple data-live-search="true">
              <option value="" disabled selected>Choose month</option>
              <option value="1">January</option>  
              <option value="2">February</option>  
              <option value="3">March</option>  
              <option value="4">April</option>  
              <option value="5">May</option>  
              <option value="6">June</option>  
              <option value="7">July</option>
              <option value="8">August</option>  
              <option value="9">September</option>  
              <option value="10">October</option>  
              <option value="11">November</option>  
              <option value="12">December</option>  
            </select>
          </div>
          <div class="mb-5">
            <button class="btn btn-block btn-sm btn-primary " id="fetch_records">Fetch Records</button>
          </div>
        </div>
      </div>
      <!-- filter column -->

      <!-- data table column -->
      <div class="col-lg-9 mb-4">

        <table id="dtstock" class="table table-striped" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Date
              </th>
              <th class="th-sm">Name
              </th>
              <th class="th-sm">Open
              </th>
              <th class="th-sm">High
              </th>
              <th class="th-sm">Low
              </th>
              <th class="th-sm">Close
              </th>
              <th class="th-sm">Volume
              </th>
              <th class="th-sm">Dividend
              </th>
              <th class="th-sm">Split
              </th>
              <th class="th-sm">Adj_Open
              </th>
              <th class="th-sm">Adj_High
              </th>
              <th class="th-sm">Adj_Low
              </th>
              <th class="th-sm">Adj_Close
              </th>
              <th class="th-sm">Adj_Volume
              </th>
            </tr>
          </thead>
          <tbody>
            {{--@foreach ($stocks as $stock)--}} {{--
            <tr>--}} {{--
              <td>{{DateTime::createFromFormat('Y-m-d', $stock->date)->format('M d, Y')}}</td>--}} {{--
              <td>{{$stock->name}}</td>--}} {{--
              <td>{{$stock->open}}</td>--}} {{--
              <td>{{$stock->close}}</td>--}} {{--
              <td>{{$stock->high}}</td>--}} {{--
              <td>{{$stock->low}}</td>--}} {{--
              <td>{{$stock->dividend}}</td>--}} {{--
              <td>{{$stock->volume}}</td>--}} {{--
            </tr>--}} {{--@endforeach--}}

          </tbody>
        </table>

      </div>
      <!-- data table column -->

    </div>

  </div>
  <!-- data table -->

</section>

<!-- section data table -->
@endsection