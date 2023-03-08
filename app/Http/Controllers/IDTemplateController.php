<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IDTemplateController extends Controller
{
    //
    public function getIDTemplate()
    {
        return view('id-template');
    }
}
