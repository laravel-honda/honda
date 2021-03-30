<?php

namespace App\Http\Controllers;

use App\Models\OnlineMailable;
use Illuminate\Http\Request;

class ViewMailablesController
{
    public function __invoke()
    {
        return view('mail.index', [
            'mails' => OnlineMailable::all()
        ]);
    }
}
