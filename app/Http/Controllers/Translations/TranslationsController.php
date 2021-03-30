<?php

namespace App\Http\Controllers\Translations;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Services\Translation\TranslationFileManager;
use Illuminate\Http\Request;

class TranslationsController
{
    public function index()
    {
        return view('admin.translation.index', [
            'translations' => Translation::all()
        ]);
    }

    public function missing(Request $request)
    {
        $request->validate([
            'language' => 'required|string|in:' . app(TranslationFileManager::class)->languages()->implode(','),
            'reference' => 'required|string|in:' . app(TranslationFileManager::class)->languages()->implode(',')
        ]);

        return view('admin.translation.missing', [
            'language' => $request->language,
            'reference' => $request->reference,
            'missing' => app(TranslationFileManager::class)->missing(
                $request->language,
                $request->reference
            )
        ]);
    }
}
