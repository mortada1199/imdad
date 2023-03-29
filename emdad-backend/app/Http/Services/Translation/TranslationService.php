<?php

namespace App\Http\Services\Translation;

use App\Models\Translation;

class TranslationService
{
    public function Create($request)
    {

        $translate = Translation::create([
            'key' => $request->key,

            'en_value' => $request->en_value,

            'ar_value' => $request->ar_value,
        ]);

        if ($translate) {
            return response()->json(['message' => 'created successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }


    public function Update($request)
    {
        $translate = Translation::where('id', $request->id)->first();
        $translate->update([
            'key' => $request->key ?? $translate->key,
            "en_value" => $request->en_value ?? $translate->en_value,
            "ar_value" => $request->ar_value ?? $translate->ar_value,
        ]);

        if ($translate) {
            return response()->json(['message' => 'updated successfully'], 200);
        }
        return response()->json(['error' => 'system error'], 500);
    }



public function Delete($request)
{
    $translate = Translation::find($request->id);
    $deleted = $translate->delete();
    if ($deleted) {
        return response()->json(['message' => 'deleted successfully'], 301);
    }
    return response()->json(['error' => 'system error'], 500);
}


public function Show($request)
{
    $translate = Translation::where('key', $request->key)->get();
        return response()->json(['data' => $translate], 200);
}




}
