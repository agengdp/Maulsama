<?php

namespace App\Http\Controllers\Images;

use Image;

class Resizer
{

    /**
     * Untuk resize image
     * @param  string $image Image Name
     * @param  string $type  jenis, vertical or horizontal
     * @return bool
     */
    public static function resize($image, $type = 'vertical')
    {
        $quality = 30;
        $extension        = $image->getClientOriginalExtension();
        $imageRealPath    = $image->getRealPath();
        $imageName        = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        switch ($type) {
            case 'vertical':

                try {
                    Image::make($image)->resize(250, 375, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-250x375.' . $extension, $quality);

                    Image::make($image)->resize(640, 960, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-640x960.' . $extension, $quality);

                    Image::make($image)->resize(64, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-nav.' . $extension, $quality);

                    return true;
                } catch (Exception $e) {
                    return false;
                }

                break;
            case 'horizontal':
                try {
                    Image::make($image)->resize(160, 90, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-160x90.' . $extension, $quality);

                    Image::make($image)->resize(496, 279, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-496x279.' . $extension, $quality);

                    Image::make($image)->resize(120, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('images') . '/' . $imageName . '-ongoing.' . $extension, $quality);

                    return true;
                } catch (Exception $e) {
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
    }
}
