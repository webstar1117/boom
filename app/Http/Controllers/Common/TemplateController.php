<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    //
    public static function getProfilePhoto($memorial_id){
        $gallery=  Gallery::where('memorial_id',$memorial_id)
        ->where('media_type','image')
        ->orderBy('created_at', 'asc')->first();
        return $gallery? $gallery->media->name:null;
      }
}
