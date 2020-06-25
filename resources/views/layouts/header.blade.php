<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark custom-bg">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('home.index')}}">
            <strong>Stockify</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">

                <!-- home -->
                <li class="nav-item {{$active=='index'?'active':''}}">
                    <a class="nav-link" href="{{ route('home.index') }}">Home
                        @if($active=='welcome')<span class="sr-only">(current)</span>@endif
                    </a>
                </li>
                <!-- home -->

                <!-- refresh data -->
                <li class="nav-item ">
                    <a class="nav-link" id="btn_refresh" href="{{route('refresh')}}">Refresh Data
                    </a>
                </li>
                <!-- refresh data -->

                <!-- gold price -->
                <li class="nav-item {{$active=='gp'?'active':''}}">
                    <a class="nav-link" href="{{ route('stocks.gold.show') }}">Gold Prices</a>
                </li>
                <!-- gold price -->

                <!-- sp -->
                <li class="nav-item {{$active=='sp'?'active':''}}">
                    <a class="nav-link" href="{{ route('stocks.sp.show') }}">S&P 500</a>
                </li>
                <!-- sp -->

            </ul>

        </div>

    </div>
</nav>
<!-- navbar -->