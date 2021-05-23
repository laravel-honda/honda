<?php

namespace App\Http\Controllers;

use App\Models\OnlineMailable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ViewOnlineMailableController
{
    public function __invoke(Request $request, OnlineMailable $onlineMailable): Response
    {
        abort_unless($request->hasValidSignature(), 404);

        return response($onlineMailable->content)->header('Content-Type', 'text/html');
    }
}
