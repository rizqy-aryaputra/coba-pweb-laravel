<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function save(Request $request)
    {
        return response()->json([

            'message' =>
                'Preferences saved successfully',

            'theme' =>
                $request->theme,

            'font_size' =>
                $request->font_size

        ])->cookie(
            'theme',
            $request->theme,
            60 * 24 * 30
        )->cookie(
            'font_size',
            $request->font_size,
            60 * 24 * 30
        );
    }
}
