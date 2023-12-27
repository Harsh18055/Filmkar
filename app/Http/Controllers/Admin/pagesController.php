<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class pagesController extends Controller
{
    public function index(){

      $result['pages'] =  DB::table('pages')->where('id', '1')->first();

        return view('admin/pages',$result);
    }

    public function pages_process(Request $request){


        $privacypolicy = $request->post('privacypolicy');
        $aboutus = $request->post('aboutus');
        $terms_and_conditions = $request->post('tandc');

        DB::table('pages')->where('id', '1')
        ->update(['privacypolicy' => $privacypolicy,'aboutus' => $aboutus,'terms_and_conditions' => $terms_and_conditions]);
        
        return redirect('admin/pages');

    }

    public function privacypolicy(){

        return view('front/pages/privacypolicy');

    }

    public function aboutus(){

        return view('front/pages/aboutus');

    }

    public function terms_and_conditions(){

        return view('front/pages/terms_and_conditions');

    }
}
