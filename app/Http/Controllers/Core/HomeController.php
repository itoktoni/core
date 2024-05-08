<?php

namespace App\Http\Controllers\Core;

use Alkhachatryan\LaravelWebConsole\LaravelWebConsole;
use App\Charts\Dashboard;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(auth()->check()){
            return redirect()->route('login');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Dashboard $chart)
    {
        if(auth()->check() && auth()->user()->active == false){
            return redirect()->route('login');
        }

        return view('core.home.dashboard', [
            'chart' => $chart->build(),
        ]);
    }

    public function console()
    {
        return LaravelWebConsole::show();
    }

    public function doc(){
        return view('doc');
    }

    public function error402(){
        return view('errors.402');
    }
}
