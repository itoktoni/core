<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    public function homepage()
    {
        return view('public.pages.homepage', [

        ]);
    }

    public function delete($code){
        $navigation = session()->get('navigation');
        if(!empty($navigation) && array_key_exists($code, $navigation)){
            unset($navigation[$code]);
            session()->put('navigation', $navigation);
        }
        return redirect()->back();
    }

    public function doc(){
        return view('doc');
    }

    public function error402(){
        return view('errors.402');
    }
}
