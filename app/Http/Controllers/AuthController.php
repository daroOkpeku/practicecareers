<?php

namespace App\Http\Controllers;

use App\Events\Newusersevent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//AuthController is an extention of the first Controller
// Controller.php all other controller is under or an extention of  the controller.php
class AuthController extends Controller
{
  /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }else{
          $user =   User::where(['id'=>auth()->user()->id])->first();

          $response = [
            'user'=>[
             'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'lastname'=>$user->lastname,
             'phonenumber'=>$user->phonenumber,
             "picture_url"=>$user->picture_url,
             'Is_disabled'=>$user->Is_disabled
            ],
             'token'=>$this->respondWithToken($token)
        ];
        return response($response, 201);

        }
    }



    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => 'required|alpha',
            "middlename"=>'required|alpha',
            "lastname"=>'required|alpha',
            "phonenumber"=>'required|min:11',
            "email" => 'required|email|unique:users',
            'password'=>'required|confirmed|min:8',
           ]);

           if($validator->fails()){
            $errors = $validator->errors()->getMessages();
            return  ['code'=>'1500', 'error'=>$errors];
           }

           $user = new User();
           $user->name = $request->name;
           $user->middlename = $request->middlename;
           $user->lastname =$request->lastname;
           $user->email = $request->email;
           $user->phonenumber = $request->phonenumber;
           $file_name =  $request->picture_url->getClientOriginalName();
           $request->picture_url->storeAs('images', $file_name, 'public');
           $user->picture_url = $file_name;
           $user->password = Hash::make($request->password);
           $user->Is_disabled = false;
           $user->save();
           if($user){
              event(new Newusersevent($user->email));
            return response()->json(['success'=>"your account has been saved"]);
           }

     }

    public function joker(){
      $user = auth()->user();
      $other = 'mr peter';

      $array = ['user'=>$user, 'other'=>$other];
      return response()->json($array);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    ///https://jwt-auth.readthedocs.io/en/develop/laravel-installation/
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
