<?php

use App\Stock;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $stocks = Stock::select('*')->orderBy('date', 'DESC')->get();

    $companies = Stock::select('name')->distinct()->get();

    $years = Stock::selectRaw('YEAR(date) as year')->distinct()->orderBy('year', 'asc')->get();

    // dd($companies);

    return view('home.index')
        ->with('stocks', $stocks)
        ->with('companies', $companies)
        ->with('years', $years)
        ->with('high', round($stocks->avg('high'), 2))
        ->with('low', round($stocks->avg('low'), 2))
        ->with('open', round($stocks->avg('open'), 2))
        ->with('close', round($stocks->avg('close'), 2));

})->name('home.index');

Route::any('getDataByRange', 'StockController@getDataByRange')->name('getDataByRange');
Route::any('getDataByFilters', 'StockController@getDataByFilters')->name('getDataByFilters');
Route::get('refreshData', 'StockController@refresh')->name('refresh');

Route::get('/gold-prices','StockController@gold')->name('stocks.gold.show');

Route::get('/SandP_500','StockController@sp')->name('stocks.sp.show');


