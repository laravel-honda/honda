<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowManagerController
{
    public function __invoke(Request $request)
    {
        return view('admin.home');
    }
}
