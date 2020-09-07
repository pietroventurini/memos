<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LangController extends Controller
{
    public function setLanguage(Request $request, $language) {
        Session::put('language', $language);
        return redirect()->back();
    }
}
