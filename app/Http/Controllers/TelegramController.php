<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TelegramController extends Controller
{
    public function init(Request $request){
        $req = $request->toArray();


    }
}
