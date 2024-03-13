<?php

namespace App\Traits;

use App\Models\Area;
use App\Models\District;
use App\Models\Thana;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\File;


class HelperTrait{

    /**
     * @param $img_name
     * @param null $attribute
     * @param int $width
     * @param string $file_extension
     * @return null|string
     */
    public static function getDistrictByDivition($request){
        $districts = District::where('division_id',$request->division_id)->orderby('name','asc')->get();
        $options = '<option value="">Select a District</option>';
        foreach ($districts as $district){
            $options .= "<option value='{$district->id}'>{$district->name}</option>";
        }
        return response()->json([
            'options' => $options
        ]);
    }

    public static function getAreaByDistrict($request){

        $areas = Area::where('district_id',$request->district_id)->orderby('name','asc')->get();
        $options = '<option value="">Select a Area</option>';
        foreach ($areas as $area){
            $options .= "<option value='{$area->id}'>{$area->name}</option>";
        }
        return response()->json([
            'options' => $options
        ]);
    }
    public static function getAreaByThana($request){
        $areas = Area::where('thana_id',$request->thana_id)->orderby('name','asc')->get();
        $options = '<option value="">Select a Area</option>';
        foreach ($areas as $area){
            $options .= "<option value='{$area->id}'>{$area->name}</option>";
        }
        return response()->json([
            'options' => $options
        ]);
    }
    public static function getAreaByThana_sameValue($request){
        $areas = Area::where('thana_id',$request->thana_id)->where('status', 'Active')->orderby('name','asc')->get();
        $options = '';
        foreach ($areas as $area){
            $options .= "<option>{$area->name}</option>";
        }
        return response()->json([
            'options' => $options
        ]);
    }
    public static function getAreaByThanaArray($request){
        $areas = Area::where('thana_id',$request->thana_id)->where('status', 'Active')->orderby('name','asc')->get();
        $options = '';
        foreach ($areas as $area){
            $options .= "<option value='{$area->name}'>{$area->name}</option>";
        }

        return response()->json([
            'options' => $options
        ]);
    }
    public static function getAreaByThanaArray2($request){
        $areas = Area::where('thana_id',$request->thana_id)->where('status', 'Active')->orderby('name','asc')->get();
        $options = '<ul class="area_ul_list">';
        foreach ($areas as $area){
            $options .= "<li class='area_name_li' data-value='{$area->name}'>{$area->name}</li>";
        }
        $options .= "</ul>";

        return response()->json([
            'options' => $options
        ]);
    }
    public static function getThanaByDistrict($request){
        $thanas = Thana::where('district_id',$request->district_id)->orderby('name','asc')->get();
        $options = '<option selected disabled>Select Thana</option>'.$request->district_id;
        foreach ($thanas as $thana){
            $options .= "<option value='{$thana->id}'>{$thana->name}</option>";
        }
        return response()->json([
            'options' => $options
        ]);
    }

}
