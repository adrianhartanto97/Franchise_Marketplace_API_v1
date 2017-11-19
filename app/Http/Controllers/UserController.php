<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
class UserController extends Controller
{   
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        $user_dbase = DB::table('users')->where('email',$request->email)->count();
        if ($user_dbase > 0) {
            return response()->json(['message'=>'Email sudah digunakan']);
        }
        
        else {
            $user = $this->user->create([
              'name' => $request->get('name'),
              'email' => $request->get('email'),
              'password' => bcrypt($request->get('password')),
                'image' => $request->get('image'),
                'address' => $request->get('address'),
                'phone_number' => $request->get('phone_number')
            ]);
        }
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }
    
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message'=>'invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['message'=>'failed_to_create_token'], 500);
        }
        return response()->json(compact('token'), 200);
    }
    
    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user], 200);
    }
    
    public function logout (Request $request)
    {
        JWTAuth::invalidate($request->token);
        return response()->json(['message'=>'Logout successfully']);
    }
} 