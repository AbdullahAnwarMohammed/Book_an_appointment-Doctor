<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait Upload
{
    public function uploadImage(Request $request, $inputName, $directory = 'uploads', $fileName = null)
    {
        if ($request->hasFile($inputName) && $request->file($inputName)->isValid())
        {
            if ($fileName === null)
            {
                $originalName = pathinfo($request->file($inputName)->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $originalName . '_' . time() . '.' . $request->file($inputName)->getClientOriginalExtension();
            }
            return $request->file($inputName)->storeAs($directory, $fileName, 'public');
        }
        return null;
    }
}
