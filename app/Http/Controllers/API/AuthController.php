<?php
namespace App\Http\Controllers\API;
 
use App\Models\Customer; 
use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;
 
 
class AuthController extends Controller 
{
 
  public function login(Request $request){ 
 
//    $credentials = [
//        'email' => $request->email, 
//        'password' => $request->password
//    ];
// 
//    if( Auth::guard('customer')->attempt($credentials) ){ 
//      	$user = Auth::guard('customer')->user();
//   		$success['token'] =  $user->createToken('AppName')->accessToken; 
//		return response()->json(['success' => $success], 200);
//    } else { 
// 		return response()->json(['error'=>'Unauthorised'], 401);
//    } 
	
	
	
    	$loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!Auth::guard('customer')->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = Auth::guard('customer')->user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::guard('customer')->user(), 'access_token' => $accessToken]);
	
  }
    
  public function register(Request $request) 
  { 
  
		$validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:customers',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = Customer::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]); 
  }
    
  public function user_detail() 
  { 
	 $user = Auth::guard('customer')->user();
	 return response()->json(['success' => $user], 200); 
  } 
 
}
?>