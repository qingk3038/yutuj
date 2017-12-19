<?php

namespace App\Http\Controllers;

use URL;
use Exception;
use Intervention\Image\Facades\Image;

class ThumbController extends Controller
{
    public function __invoke($width, $height, $url)
    {
        try {
            $url = base64_decode($url);
            if (!URL::isValidUrl($url)) {
                $url = storage_path('app/public/' . $url);
            }
            return Image::cache(function ($image) use ($url, $width, $height) {
                $image->make($url)->fit($width, $height);
            }, 5, true)->response();
        } catch (Exception $e) {
            return Image::canvas(150, 150, '#DDD')->text('Image Not Found.', 35, 80, function ($font) {
                $font->color('#666666');
            })->response();
        }
    }
}
