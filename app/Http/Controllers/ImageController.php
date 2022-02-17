<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $dir = 'images')
    {
        request()->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);
        if ($request->file('file')) {
            $file = $request->file('file')->store($dir, ['disk' => 'public']);  
            response()->json(['filePath' => "/storage/" . $file], 200);
        }
    }
}
