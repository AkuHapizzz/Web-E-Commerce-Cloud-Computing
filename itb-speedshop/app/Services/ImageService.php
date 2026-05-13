<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        // Use GD driver by default for compatibility
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Convert an uploaded image to WebP and store it.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param int $quality
     * @param string $disk
     * @return string
     */
    public function uploadAndConvert(UploadedFile $file, string $directory, int $quality = 80, string $disk = 'public'): string
    {
        // Read image from uploaded file
        $image = $this->manager->read($file);

        // Generate a unique filename with .webp extension
        // Using hashName() to keep Laravel's default unique naming convention but changing extension
        $filename = pathinfo($file->hashName(), PATHINFO_FILENAME) . '.webp';
        $path = $directory . '/' . $filename;

        // Encode image to WebP
        $encoded = $image->toWebp($quality);

        // Store the encoded binary on the specified disk
        Storage::disk($disk)->put($path, $encoded->toString());

        return $path;
    }
}
