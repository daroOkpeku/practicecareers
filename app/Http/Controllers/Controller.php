<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
//AssetController is an extention of the first Controller
// Controller.php all other controller is under or an extention of  the controller.php
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

     public static function getusers(){
         //this auth user can be call from any controller and the function cn be call back on
      return auth()->user();
     }

}
