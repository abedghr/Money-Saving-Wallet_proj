<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categories;
use App\Models\CategoryType;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    

    public function index(){
        $users = User::select()->with('transactions')->get();
        $total_incomes = 0;
        $total_expenses = 0;
        $users_inc_expenses = array();
        foreach($users as $user){
            $i=0;
            foreach($user->transactions as $trans){
                $cat = Categories::where('id',$trans->category_id)->get();
                $check = CategoryType::where('id',$cat[0]->cat_type)->get();
                if($check[0]->type == "incomes"){
                    $total_incomes+= $trans->amount; 
                }else{
                    $total_expenses += $trans->amount;
                }
                $i++;
            }
            $users_inc_expenses[$user->id]['id']=$user->id;
            $users_inc_expenses[$user->id]['total_incomes']=$total_incomes;
            $users_inc_expenses[$user->id]['total_expenses']=$total_expenses;
            $total_incomes=0;
            $total_expenses=0;
        }
        return view('Admin_side.admin-home',[
            'users'=>$users,
            'users_inc_expenses'=>$users_inc_expenses
        ]);
    }
}
