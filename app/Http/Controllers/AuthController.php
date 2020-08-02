<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;

class AuthController extends Controller
{
    //
    
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);

      return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      return $this->respondWithToken($token);
    }

    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }

    public function gettotaltransactions(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      $customer = Customer::where('email', '=', $request->email)->get();

      if(!$customer->isEmpty()){
        return $customer;
      }
      else
      {
        return response()->json(['message'=>"No Transactions Found For This User"],200);
      }
    }

    public function getuserbalance(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      $customer = Customer::where('email', '=', $request->email)->latest()->first()->toArray();

        if($customer['balance']>0){
            return response()->json(['message'=>"Your Account Balance is Rs.".$customer['balance']],200);
        }
        else
        {
          return response()->json(['message'=>"Your Account Balance is Rs.0"],200);
        }  
    }
}
