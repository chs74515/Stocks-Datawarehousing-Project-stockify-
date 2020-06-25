<?php

namespace App\Http\Controllers;

use App\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * @param string Query
     * @return array
     */
    public function getDataByRange()
    {

        $from = request('min_date');
        $to = request('max_date');

        $stocks = Stock::whereBetween('date', array($from, $to))
            ->orderBy('date', 'DESC')
            ->get();

        $data['high'] = round($stocks->avg('high'), 2);
        $data['low'] = round($stocks->avg('low'), 2);
        $data['open'] = round($stocks->avg('open'), 2);
        $data['close'] = round($stocks->avg('close'), 2);
        $data['stocks'] = $stocks;
        return $data;
    }

    public function getDataByFilters()
    {
        $companies = request('companies');
        $years = request('years');
        $months = request('months');
        $quarters = request('quarter');

        if (isset($quarters)) {
            if (!isset($months)) $months = [];
            foreach ($quarters as $q) {
                array_push($months, (($q - 1) * 3) + 1);
                array_push($months, (($q - 1) * 3) + 2);
                array_push($months, (($q - 1) * 3) + 3);
            }
            $months = array_unique($months);
        }

        $query = Stock::query();
        if (isset($companies))
            $query = $query->whereIn('name', $companies);
        if (isset($years))
            $query = $query->WhereIn(DB::raw('YEAR(date)'), $years);
        if (isset($months))
            $query = $query->WhereIn(DB::raw('MONTH(date)'), $months);
        $stocks = $query->get();

        $data['high'] = round($stocks->avg('high'), 2);
        $data['low'] = round($stocks->avg('low'), 2);
        $data['open'] = round($stocks->avg('open'), 2);
        $data['close'] = round($stocks->avg('close'), 2);
        $data['stocks'] = $stocks;

        return $data;
    }

    function refresh()
    {
        Stock::query()->delete();
        // $start_date = Carbon::today()->addDays(-10)->format("Y-m-d");
        $start_date="2015-12-01";
        $names = ["DIS", "MSFT", "MMM", "NKE", "JNJ", "MCD", "INTC", "GS", "JPM", "AXP", "KO", "GE","PG", "IBM"];
        
        foreach ($names as $name) {
            $response = file_get_contents('https://www.quandl.com/api/v3/datasets/EOD/' . $name . '.json?api_key=eagJ9Lmxk-iAPhYBXqvz&start_date=' . $start_date.'&end_date=2015-12-31');
        
            $filename = $name . date('YmdHis') . '.csv';
            $file = file_get_contents("https://www.quandl.com/api/v3/datasets/EOD/" . $name . ".csv?api_key=eagJ9Lmxk-iAPhYBXqvz&start_date=" . $start_date);
            file_put_contents(public_path($filename), $file);

            $data = json_decode($response);

            $records = $data->dataset->data;

            foreach ($records as $record) {
                $values = [
                    'name' => $name,
                    'date' => $record[0],
                    'open' => $record[1],
                    'high' => $record[2],
                    'low' => $record[3],
                    'close' => $record[4],
                    'volume' => $record[5],                    
                    'dividend' => $record[6],
                    'split' => $record[7],
                    'Adj_Open'=>$record[8],
                    'Adj_High'=>$record[9],
                    'Adj_Low'=>$record[10],
                    'Adj_Close'=>$record[11],
                    'Adj_Volume'=>$record[12]
                ];
                DB::table('stocks')->insert($values);
            }
        }
        return redirect('/');
    }


    /**
     * @param null
     * @return view
     */

    public function gold()
    {
        return view("home.gold");
    }


    public function sp()
    {
        return view("home.sp");
    }

}
