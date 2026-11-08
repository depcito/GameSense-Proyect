<?php

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): void
    {
        if ($request->hasFile('image')) {

            $imagePath = $request->input('image_path');

            if (!$imagePath) {
                throw new \InvalidArgumentException(
                    'The image path must be specified.'
                );
            }

            Storage::disk('public')->put(
                $imagePath,
                file_get_contents(
                    $request->file('image')->getRealPath()
                )
            );
        }
    }
}