<?php


namespace App\Http\Services\AccountServices;


class UploadServices
{
    public static function uploadFile($file, $type, $path) {
        $name_rand = rand(0 , 100000);
        $extension  = $file->getClientOriginalExtension();
        $file->move(public_path($type . '/' .  $path), 'image_' . time() . $name_rand .'.' . $extension);
        $name = $type . '_' . time() . $name_rand .  '.' . $extension;
        return $type . '/' .  $path . '/' . $name;
    }
}
