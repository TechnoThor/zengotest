<?php

namespace App\Http\Controllers;

use App\County;
use App\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data=[
            "counties"=>County::all(),
            "cities"=>City::all(),
        ];
        return view("welcome")->with($data);
    }

    public function addCity(Request $request){
        if($request->name!='' && intval($request->countyId)!=0){
            try {
                $city=City::create([
                    'name'=>$request->name,
                    'county_id'=>intval($request->countyId)
                ]);
                return ['alert'=>'Sikeres tárolás','id'=>$city->id];
            } catch (Exception $e) {
                return ['alert'=>$e->getMessage()];
            }
        }else{
            return ['alert'=>'Kötelező megadni a város nevét, valamint a kategóriát!'];
        }
    }
    public function editCity(Request $request){
        if($request->name!='' && intval($request->id)!=0){
            try {
                City::find(intval($request->id))->update([
                    'name'=>$request->name,
                ]);
                return ['alert'=>'Sikeres mentés'];
            } catch (Exception $e) {
                return ['alert'=>$e->getMessage()];
            }
        }else{
            return ['alert'=>'Sikertelen tárolás, a név mezőt közelező megadni!'];
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
