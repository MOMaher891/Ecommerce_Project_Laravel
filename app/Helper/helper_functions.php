<?php

use App\Models\Language;
use Illuminate\Support\Facades\Config;

/**
 * Language Functions
 */
function getActiveLanguages(){
    return Language::active()->Selection()->get();
}

function get_default_lang(){
    return Config::get('app.locale');
}

/**
 * Main Categories Functions
 */

/**
 * Image Functions (Upload , Update)
 */
function uploadImage($image,$filePath){
    try{
        $imageName =  $image->hashName();
        $image->move(public_path($filePath), $imageName);
        return $imageName;
    }
    catch(\Exception $ex){
        throw new Exception("Error in uploading image");
    }
}

function updateImage($oldImage, $newImage = null,$filePath)
{
    if($oldImage)
    {
        unlink($filePath.'/'.$oldImage);
    }

    if($newImage != null)
    {
        return uploadImage($newImage,$filePath);
    }
}


