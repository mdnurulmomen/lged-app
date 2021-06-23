<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ajaxLoadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTemplate()
    {
        return view('pages.ajaxLoadPage');
    }
}
