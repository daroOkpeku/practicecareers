<?php

namespace App\Http\Controllers;

use App\Events\AssetassEvent;
use App\Events\Assetevent;
use App\Models\Asset;
use App\Models\Assetass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Assetassignment extends Controller
{
    public function Assetassign(Request $request){

        $validator = Validator::make($request->all(), [
            'AssetId'=>'required|alpha',
            'Assignment_date'=>'required|alpha',
            'Status'=>'required|alpha',
            'Is_due'=>'required|alpha',
            'Due_date'=>'required|alpha',
            'Assigned_user_id'=>'required|alpha',
            'Assigned_by'=>'required|alpha',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
             $user = $this->getusers();
             $assetid =   $user->Assetfind;

          $Assetassign = Assetass::create([
            'AssetId'=>$assetid->id,
            'Assignment_date'=>date("l jS \of F Y h:i:s A"),
            'Status'=>$request->status,
            'Is_due'=>$request->is_due,
            'Due_date'=>$request->due_date,
            'Assigned_user_id'=>$user->id,
            'Assigned_by'=>$user->name,
          ]);

          if($Assetassign){
            return response()->json(["success"=>"it has been saved "]);
            event( new AssetassEvent($Assetassign->id));
          }


    }

}
