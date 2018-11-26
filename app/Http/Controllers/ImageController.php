<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Filesystem\FileNotFoundException;
use League\Glide\Signatures\SignatureException;

class ImageController extends Controller
{
    /**
	 * Upload image.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function upload(Request $request)
	{
        $request->validate([
            'image' => 'required|image'
        ]);

		$image = $request->file('image');

		$storagePath = Storage::put('images', $image, 'public');

		return response()->json([
			'path' => $storagePath,
		]);
	}

    /**
	 * Return image.
	 *
	 * @param  \Illuminate\Contracts\Filesystem\  $filesystem
	 * @param  string  $path
	 * @return \Illuminate\Http\Response
	 */
	public function render(Filesystem $filesystem, $path)
	{
		try {
            $server = ServerFactory::create([
                // Response factory
                'response' => new LaravelResponseFactory(app('request')),
                // Source filesystem
                'source' => $filesystem->getDriver(),
				// Source filesystem path prefix
				'source_path_prefix' => 'public/images',
                // Cache filesystem
                'cache' => $filesystem->getDriver(),
                // Cache filesystem path prefix
                'cache_path_prefix' => '.cache',
            ]);

            return $server->getImageResponse($path, request()->all());
		} catch (FileNotFoundException $e) {
			// File Not Found
			abort(404);
		}
	}
}
