<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateData;
use App\Http\Requests\CreateType;
use App\Income;
use App\Spending;
use Illuminate\Http\Request;
use App\Type;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function createSpendFrom() {
        $params = Auth::user()->type()->where('category','0')->get();

        if($params->isEmpty()) {
            return view('types/type_insert_spend');
        }else{
            return view('spends/spend_form',[
                'types' => $params,
            ]);
        }
    }

    public function createSpend(CreateData $request) {
        $spending = new Spending;

        $spending->amount = $request->amount;
        $spending->date = $request->date;
        $spending->type_id = $request->type_id;
        $spending->comment = $request->comment;

        Auth::user()->spending()->save($spending);
        return redirect('/');
    }

    public function createIncomeForm() {
        $params = Auth::user()->type()->where('category','1')->get();

        if($params->isEmpty()) {
            return view('types/type_insert');
        }else {
            return view('incomes/income_form',[
                'types' => $params,
            ]);
        }
    }

    public function createIncome(CreateData $request) {

        $income = new Income;

        $columns = ['amount','date','type_id','comment'];
        foreach($columns as $column) {
            $income->$column = $request->$column;
        }

        Auth::user()->income()->save($income);
        return redirect('/');
    }

    public function createTypeFormSpend() {
        return view('types/type_insert_spend');
    }

    public function createTypeSpend(CreateType $request) {
        $type = new Type;

        $type->name = $request->name;
        $type->category = $request->category;

        Auth::user()->type()->save($type);
        return redirect('/create.spend');
    }

    public function createTypeForm() {
        return view('types/type_insert');
    }

    public function createType(CreateType $request) {
        $type = new Type;

        $type->name = $request->name;
        $type->category = $request->category;

        Auth::user()->type()->save($type);
        return redirect('/create.income');
    }

    public function editSpendForm(int $id) {
        $spending = new Spending;
        $type = 0;
        $subject = '支出';

        $result = $spending->find($id);
        $types = Type::where('category',$type)->get();

        return view('forms/edit_form',[
            'id' => $id,
            'subject' => $subject,
            'result' => $result,
            'types' => $types,
        ]);
    }

    public function editSpend(int $id, CreateData $request) {
        $instance = new Spending;
        $record = $instance->find($id);

        $record->amount = $request->amount;
        $record->date = $request->date;
        $record->comment = $request->comment;
        $record->type_id = $request->type_id;

        Auth::user()->spending()->save($record);

        return redirect('/');
    }

    public function editIncomeForm(int $id) {
        $income = new Income;
        $type = 1;
        $subject = '収入';

        $result = $income->find($id);
        $types = Type::where('category',$type)->get();

        return view('forms.edit_income',[
            'id' => $id,
            'result' => $result,
            'types' => $types,
            'subject' => $subject
        ]);
    }

    public function editIncome(int $id,CreateData $request) {
        $instance = new Income;
        $record = $instance->find($id);

        $record->amount = $request->amount;
        $record->date = $request->date;
        $record->comment = $request->comment;
        $record->type_id = $request->type_id;

        Auth::user()->income()->save($record);

        return redirect('/');
    }

    public function deleteSpend(int $id) {
        $spending = new Spending;
        $record = $spending->find($id);

        $record->delete();

        return redirect('/');
    }

    public function ethicsDeletionSpend(int $id) {
        $spending = new Spending;
        $record = $spending->find($id);
        $del_flg = 1;

        $record->del_flg = $del_flg;

        Auth::user()->spending()->save($record);
        return redirect('/');
    }

    public function deleteIncome(int $id) {
        $income = new Income;

        $record = $income->find($id);

        $record->delete();
        return redirect('/');
    }

    public function ethicsDeletionIncome(int $id) {
        $income = new Income;

        $record = $income->find($id);
        $del_flg = 1;

        $record->del_flg = $del_flg;

        Auth::user()->income()->save($record);
        return redirect('/');
    }
}
