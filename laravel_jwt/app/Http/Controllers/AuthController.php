<?php

namespace App\Http\Controllers;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Models\User;
use JWT;
use Tymon\JWTAuth\Contracts\JWTSubject as JWTSubject;


class AuthController extends Controller
{
  public function signup( Request  $request){

    $data = $request->all();


    // echo "<pre>";
    // print_r( $request );
    // die;

                $this->validate($request ,[

                    'username' =>  'required|unique:users',
                    'email' => 'required|unique:users',
                    'password' => 'required',
                ]);

               return User::create([
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => bcrypt( $data['password'] ),
                   // 'password' => $data['password'],
                ]);

  }


        public function signin( Request $request ){

            $this->validate( $request, [

                'username' =>  'required',
                'password' => 'required',

            ]);

            $credentials = $request->only('username', 'password');

            $token = JWTAuth::attempt($credentials);

            // echo "token= ";
            // var_dump( $token );
            // die;



            try {
                // attempt to verify the credentials and create a token for the user
                if ( !$token ) {
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            // all good so return the token

            // dd( $request->user() );

                RETURN RESPONSE()->JSON([
                    'usere_id'=> $request->user()->id,
                    'token'=> $token,
                ]);



            // return response()->json(compact('token'));


        }

}
