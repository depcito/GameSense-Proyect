<?php

namespace App\Utils;

use App\Interfaces\ImageStorage;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\Request;
use InvalidArgumentException;
use RuntimeException;

class ImageGCPStorage implements ImageStorage
{
    public function store(Request $request): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        $imagePath = $request->input('image_path');

        if (! $imagePath) {
            throw new InvalidArgumentException(
                'The image path must be specified.'
            );
        }

        $keyFilePath = env('GCP_KEY_FILE');
        $bucketName = config('services.gcp.bucket');

        if (! $keyFilePath || ! file_exists($keyFilePath)) {
            throw new RuntimeException(
                'The Google Cloud credentials file was not found.'
            );
        }

        if (! $bucketName) {
            throw new RuntimeException(
                'The Google Cloud bucket name is not configured.'
            );
        }

        $keyFile = json_decode(
            file_get_contents($keyFilePath),
            true
        );

        if (! $keyFile) {
            throw new RuntimeException(
                'The Google Cloud credentials file is invalid.'
            );
        }

        $storage = new StorageClient([
            'keyFile' => $keyFile,
        ]);

        $bucket = $storage->bucket($bucketName);

        $bucket->upload(
            fopen($request->file('image')->getRealPath(), 'r'),
            [
                'name' => $imagePath,
            ]
        );
    }
}
