<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', 'public');

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset($path)
                ]
            ]);
        }

        return response()->json(['success' => 0, 'message' => 'No file uploaded']);
    }

    /**
     * Handle image upload from external URL.
     */
    public function uploadByUrl(Request $request)
    {
        $url = $request->input('url');
        if (!$url) {
            return response()->json(['success' => 0, 'message' => 'No URL provided']);
        }

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
                if (!$extension) {
                    $extension = 'jpg';
                }

                $filename = Str::random(10) . '.' . $extension;
                Storage::disk('public')->put('uploads/' . $filename, $response->body());

                return response()->json([
                    'success' => 1,
                    'file' => [
                        'url' => asset('uploads/' . $filename)
                    ]
                ]);
            }

            return response()->json(['success' => 0, 'message' => 'Failed to fetch image']);
        } catch (\Exception $e) {
            return response()->json(['success' => 0, 'message' => $e->getMessage()]);
        }
    }
}
