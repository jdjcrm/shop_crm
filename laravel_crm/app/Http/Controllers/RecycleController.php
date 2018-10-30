<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

#贾东杰做回收站
class RecycleController extends Controller
{
    #回收站首页
   public function recycle(Request $request){
       return view('crm.recyle');
   }
}
