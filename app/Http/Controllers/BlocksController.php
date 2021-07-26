<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Rules\CronExpressionOrNullRule;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlocksController
{
    public function index()
    {
    }

    public function create()
    {
        return view('admin.blocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'cron'  => new CronExpressionOrNullRule(),
        ]);

        $startsAt = Carbon::parse(trim($request->starts_at_date . ' ' . $request->starts_at_time));
        $endsAt   = Carbon::parse(trim($request->ends_at_date . ' ' . $request->ends_at_time));

        $block = Block::create([
            'title'     => $request->title,
            'starts_at' => $startsAt,
            'ends_at'   => $endsAt,
            'cron'      => $request->cron,
            'user_id'   => Auth::id(),
        ]);

        dd($block);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
