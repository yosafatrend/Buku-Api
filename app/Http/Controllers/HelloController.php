<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function hello(Request $request){
        $name = $request->get('name');
        return 'hello ' .$name;
    }
}
