<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $check = CategoryType::count();
        if($check == 0 ){
            $data = [
                ['type' => 'incomes'], // record 1
                ['type' => 'expenses'] // record 2
             ];
            CategoryType::insert($data);
        }
        $cat_type = CategoryType::all();
        $categories = Categories::where('user_id',Auth::user()->id)->get();
        return view('home',[
            'category_type'=>$cat_type,
            'categories'=>$categories
        ]);
    }
}
