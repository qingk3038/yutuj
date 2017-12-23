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
            $url = base64_decode(strtr($url, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($url)) % 4));
            if (!URL::isValidUrl($url)) {
                $url = storage_path('app/public/' . $url);
            }
            return Image::cache(function ($image) use ($url, $width, $height) {
                $image->make($url)->fit($width, $height);
            }, 5, true)->response();
        } catch (Exception $e) {
            return Image::canvas($width, $height, '#EEEEEE')->text('Image Not Found.', $width / 2 - 40, $height / 2)->response();
        }
    }
}
