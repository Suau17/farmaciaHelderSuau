<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prod_Prov;

class Prod_ProvController extends Controller
{
    //
    public function index(){
    $Prod_Prov= Prod_Prov::Paginate(10);
    return view('Prod_Prov.index',compact('prod_prov'));
    }
}
