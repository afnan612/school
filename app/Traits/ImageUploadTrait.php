<?php

namespace App\Traits;


trait ImageUploadTrait
{
//    public function saveImages($image, $folder)
//    {
//            $fileExtension = $image->getClientOriginalExtension();
//            $fileName = time (). '.' . $fileExtension;
//            $image->move($folder, $fileName);
//            return $folder.'/'.$fileName;
//    }

    public function saveImages($image, $folder)
    {
        $fileExtension = $image->getClientOriginalExtension();
        $randomChars = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5); // توليد 5 حروف/أرقام عشوائية
        $fileName = $randomChars . '_' . time() . '.' . $fileExtension;
        $image->move($folder, $fileName);
        return $folder.'/'.$fileName;
    }
}
