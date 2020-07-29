<?php

namespace App\Http\Controllers;

use App\County;
use App\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function fetchCounties(){
        $data=[
            'counties'=>County::all()
        ];
        return $data;
    }

    public function fetchCities(Request $request){
        $cities=[];
        $county=County::find($request->countyid);
        if(!empty($county)){
            $cities=$county->cities()->get();
        }
        $data=[
            'cities'=>$cities,
            'county'=>!(empty($county))?$county:[],
        ];
        return $data;
    }

    public function addCity(Request $request){
        if($request->city!='' && intval($request->countyId)!=0){
            try {
                City::create([
                    'name'=>$request->city,
                    'county_id'=>intval($request->countyId)
                ]);
                return ['alert'=>'Sikeres tárolás'];
            } catch (Exception $e) {
                return ['alert'=>$e->getMessage()];
            }
        }else{
            return ['alert'=>'Kötelező megadni a nevet valamint a kategóriát!'];
        }
    }
    public function destroyCity(Request $request){
        if(!empty($request->id)){
            try {
                City::find(intval($request->id))->delete();
                return ['alert'=>'Sikeres törlés!'];
            } catch (Exception $e) {
                return ['alert'=>$e->getMessage()];
            }
        }else{
            return ['alert'=>'Hiba történt, kérem próbáljam ge később!'];
        }
    }
}
