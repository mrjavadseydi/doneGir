<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TelegramController extends Controller
{
    public function init(Request $request){
        $update = $request->toArray();
        for ($i=1;$i<4;$i++){
            foreach(config('telegram-classes.classes.'.$i) as $class){
                $object = new $class($update);
                if ($object->class_status==true)
                    return true;
            }
        }

    }
}
