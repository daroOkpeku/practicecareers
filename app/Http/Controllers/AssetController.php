<?php

namespace App\Http\Controllers;

use App\Events\Assetevent;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//AssetController is an extention of the first Controller
// Controller.php all other controller is under or an extention of  the controller.php
class AssetController extends Controller
{


    public function insertasset(Request $request){
        $validator = Validator::make($request->all(), [
        'Type'=>'required',
        'SerialNumber'=>'required|alpha_num',
        'Description' => 'required',
        'FixedorMovable' => 'required|alpha',
        'Picture_path' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'Purchasedate' => 'required|date_format:d/m/Y',
        'Start_use_date'  => 'required|date_format:d/m/Y',
        'Purchaseprice' => 'required',
        'WarrantyExpirydate' => 'required',
        'Degradationinyears' => 'required',
        'CurrentValueinnaira' => 'required',
        'Location' => 'required|alpha',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file_name =  $request->Picture_path->getClientOriginalName();
        $request->Picture_path->storeAs('images', $file_name, 'public');
         $user = $this->getusers();
      $asset =  Asset::create([
        'Type'=>$request->Type,
        'SerialNumber'=>$request->SerialNumber,
        'Description'=>$request->Description,
        'FixedorMovable'=>$request->FixedorMovable,
        'Picture_path'=>$file_name,
        'Purchasedate'=>$request->Purchasedate,
        "user_id"=>$user->id,
        'Start_use_date'=>$request->Start_use_date,
        'Purchaseprice'=>$request->Purchaseprice,
        'WarrantyExpirydate'=>$request->WarrantyExpirydate,
        'Degradationinyears'=>$request->Degradationinyears,
        'CurrentValueinnaira'=>$request->CurrentValueinnaira,
        'Location'=>$request->Location
        ]);
        if($asset){
           event(new Assetevent($asset->Type));
           return response()->json(['success'=>'you data has been saved']);
        }
    }
}
