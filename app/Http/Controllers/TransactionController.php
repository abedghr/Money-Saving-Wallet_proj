<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryType;
use App\Models\Transactions;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'category'=>'required',
            'amount'=>'required|numeric'
        ]);

        $check_cat_type = Categories::where('id',$request->category)->with('category_type')->get();
        
        if($check_cat_type[0]->category_type->type == 'expenses'){
            
            $transactions = Transactions::select()->with('cate')->get();
            $total_incomes = 0;
            $total_expenses = 0;
            foreach($transactions as $trans){
                $check = CategoryType::where('id',$trans->cate->cat_type)->get();
                if($check[0]->type == 'incomes'){
                    $total_incomes += $trans->amount;
                }else{
                    $total_expenses += $trans->amount;
                }
            }
            $total  = $total_incomes - $total_expenses;
            
            if($total >= $request->amount){
                $trans = new Transactions();
                $trans->category_id = $request->category;
                $trans->amount = $request->amount;
                $trans->note = $request->note;
                $trans->user_id = Auth::user()->id;
                $trans->save();
                
                return redirect()->route('home')->with(['success_trans'=>'Transaction success']);
            }else{
                return redirect()->route('home')->with(['failed_trans'=>'Your balance is not enough']);
            }

        }else{
            $trans = new Transactions();
            $trans->category_id = $request->category;
            $trans->amount = $request->amount;
            $trans->note = $request->note;
            $trans->user_id = Auth::user()->id;
            $trans->save();
            
            return redirect()->route('home')->with(['success_trans'=>'Transaction success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        $transactions = Transactions::where('user_id',Auth::user()->id)->select()->with('cate')->get();
        $total_incomes = 0;
        $total_expenses = 0;
        $inc_countD = 0;
        $inc_countM = 0;
        $inc_countY = 0;
        $exp_countD = 0;
        $exp_countM = 0;
        $exp_countY = 0;
        $date = new DateTime(date("Y-m-d H:i:s"), new DateTimeZone('Asia/Amman')); 
        $current_date = $date->format('Y-m-d');
        $current_month = $date->format('m');
        $current_year = $date->format('y');
        foreach($transactions as $trans){
            $check = CategoryType::where('id',$trans->cate->cat_type)->get();
            if($check[0]->type == 'incomes'){
                $total_incomes += $trans->amount;
                if($trans->created_at->toDateString() == $current_date){
                    $inc_countD++;
                }
                if($trans->created_at->format('m') == $current_month){
                    $inc_countM++;
                }
                if($trans->created_at->format('y') == $current_year){
                    $inc_countY++;
                }
            }else{
                $total_expenses += $trans->amount;
                if($trans->created_at->toDateString() == $current_date){
                    $exp_countD++;
                }
                if($trans->created_at->format('m') == $current_month){
                    $exp_countM++;
                }
                if($trans->created_at->format('y') == $current_year){
                    $exp_countY++;
                }
            }
        }
        $wallet_balance = $total_incomes - $total_expenses;
        

        $incomes = $inc_countD;
    
        $expenses = $exp_countD;
    
    
        return view('summary',[
            'transactions'=>$transactions,
            'total_incomes'=>$total_incomes,
            'total_expenses'=>$total_expenses,
            'wallet_balance'=>$wallet_balance
        ])->with('incomes',json_encode($incomes,JSON_NUMERIC_CHECK))
        ->with('expenses',json_encode($expenses,JSON_NUMERIC_CHECK))
        ->with('incomesMonth',json_encode($inc_countM,JSON_NUMERIC_CHECK))
        ->with('expensesMonth',json_encode($exp_countM,JSON_NUMERIC_CHECK))
        ->with('incomesYear',json_encode($inc_countY,JSON_NUMERIC_CHECK))
        ->with('expensesYear',json_encode($exp_countY,JSON_NUMERIC_CHECK));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
