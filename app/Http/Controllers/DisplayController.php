<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Spending;
use App\Income;
use App\Type;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index(){
        $time = new Carbon;
        $now = $time->now()->format('Y-m');
        $month = $time->now()->month;

        $spends = Auth::user()->spending()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendSum = Auth::user()->spending()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomeSum = Auth::user()->income()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomAll = Auth::user()->income()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendTypeSum = Auth::user()->spending()
                            ->join('types', 'type_id', '=', 'types.id')
                            ->selectRaw('SUM(amount) as sum')
                            ->selectRaw('name')
                            ->where('del_flg','=','0')->whereMonth('date','=', $month)
                            ->groupBy('type_id')->orderBy('sum', 'desc')
                            ->take(3)
                            ->get();
        return view('home',[
            'now' => $now,
            'spends' => $spends,
            'incomes' => $incomAll,
            'spendSum' => $spendSum,
            'incomeSum' => $incomeSum,
            'spendTypeSums' => $spendTypeSum
        ]);
    }

    public function spendDetail(Spending $spending) {
        $type = Type::where('id','=',$spending['type_id'])->get()->toArray();
        // dd($type);
        return view('Spend_detail',[
            'spends' => $spending,
            'types' => $type
        ]);
    }

    public function incomeDetail(Income $income){
        // $income = new Income;
        // $incomeFetch = $income->with('type')->find($incomeId)->toArray();
        $type = Type::where('id','=',$income['type_id'])->get()->toArray();
        return view('Income_detail',[
            'incomes' => $income,
            'types' => $type
        ]);
    }

    public function layoutIndex(){

        $date = config('ini.map_turn');
        // dd($date);

        return view('spends.spend_form',[
           'date' => $date
        ]);
    }

    public function createIncome(Request $request) {

        $income = new Income;

        $columns = ['amount','date','type_id','comment'];
        foreach($columns as $column) {
            $income->$column = $request->$column;
        }

        Auth::user()->income()->save($income);
    }

    public function formDateAdd($now) {
        $time = new Carbon;
        $month = $time->create($now)->addMonth()->format('m');
        $now = $time->create($now)->addMonth()->format('Y-m');

        $spends = Auth::user()->spending()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendSum = Auth::user()->spending()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomeSum = Auth::user()->income()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomAll = Auth::user()->income()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendTypeSum = Auth::user()->spending()
                            ->join('types', 'type_id', '=', 'types.id')
                            ->selectRaw('SUM(amount) as sum')
                            ->selectRaw('name')
                            ->where('del_flg','=','0')->whereMonth('date','=', $month)
                            ->groupBy('type_id')->orderBy('sum', 'desc')
                            ->take(3)
                            ->get();
        return view('home',[
            'now' => $now,
            'spends' => $spends,
            'incomes' => $incomAll,
            'spendSum' => $spendSum,
            'incomeSum' => $incomeSum,
            'spendTypeSums' => $spendTypeSum
        ]);
    }

    public function formDateSub($now) {
        $time = new Carbon;
        $month = $time->create($now)->subMonth()->format('m');
        $now = $time->create($now)->subMonth()->format('Y-m');

        // dd($now);

        $spends = Auth::user()->spending()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendSum = Auth::user()->spending()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomeSum = Auth::user()->income()->selectRaw('SUM(amount) as sum')->whereMonth('date','=', $month)->get();
        $incomAll = Auth::user()->income()->where('del_flg','=','0')->whereMonth('date','=', $month)->simplePaginate(4);
        $spendTypeSum = Auth::user()->spending()->with('type')
                            ->join('types', 'type_id', '=', 'types.id')
                            ->selectRaw('SUM(amount) as sum')
                            ->selectRaw('name')
                            ->where('del_flg','=','0')->whereMonth('date','=', $month)
                            ->groupBy('type_id')->orderBy('sum', 'desc')
                            ->take(3)
                            ->get();
        return view('home',[
            'now' => $now,
            'spends' => $spends,
            'incomes' => $incomAll,
            'spendSum' => $spendSum,
            'incomeSum' => $incomeSum,
            'spendTypeSums' => $spendTypeSum
        ]);
    }

    public function Map() {
        return view('Maps.map');
    }
}
