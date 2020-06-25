@extends('layouts.main',['active'=>'sp']) 
@section('content')

<!-- section main -->
<section>

    <!-- Jumbotron -->
    <div class="mt-4">

        <!-- section heading -->
        <h3 class="card-title text-center h3 h3-responsive pb-3 font-bold"><strong>All S&P 500 Companies (Summary-Covid19) <span id="curr">USD</span></strong></h2>

            <!-- visual data -->
            <div class="col-lg-12">
            <p>List of companies in the S&P 500 (Standard and Poor’s 500). Basially the top 500 by market cap. <br>The dataset below includes a list of all the stocks contained therein and associated key financials such as price, market capitalization, earnings, price/earnings ratio, price to book etc.</p>

                <div class="jumbotron" style="height:625px;">
                <iframe src="https://datahub.io/core/s-and-p-500-companies-financials/r/1.html" width="100%" height="100%" frameborder="0"></iframe>

                </div>

            </div>
            <!-- visual data -->
    </div>
    <!-- Jumbotron -->
</section>
<!-- section main -->
@endsection
 
