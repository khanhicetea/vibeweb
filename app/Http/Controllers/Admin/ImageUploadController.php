<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $attributes = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'directory' => ['nullable', 'string', 'max:50', 'regex:/^[a-z0-9_-]+$/'],
        ]);

        $directory = $attributes['directory'] ?? 'uploads';
        $storedPath = $request->file('image')->store($directory, 'public');
        $publicPath = 'storage/'.$storedPath;

        return response()->json([
            'path' => $publicPath,
            'url' => Storage::disk('public')->url($storedPath),
        ]);
    }
}
