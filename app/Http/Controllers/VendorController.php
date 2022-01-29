<?php

namespace App\Http\Controllers;

use App\Events\Vendorevent;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//vendorController is an extention of the first Controller
// Controller.php all other controller is under or an extention of  the controller.php
class VendorController extends Controller
{

    public function vendor(Request $request){
       $user = $this->getusers();

        $validator = Validator::make($request->all(), [
            'Name'=>'required|alpha',
            'category'=>'required|alpha',

            ]);


            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

           $ven = Vendor::create([
                   "Name"=>$user->name,
                   "Category"=>$request->category,
               ]);
           if($ven){
               event(new Vendorevent($request->Name));
            return response()->json(['success'=>' a vendor has been created']);
           }
    }
}
