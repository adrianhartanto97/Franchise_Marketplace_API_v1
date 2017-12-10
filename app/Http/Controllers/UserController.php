<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use JWTAuthException;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{   
    private $user;
    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        try 
        {
            $user_dbase = DB::table('users')->where('email',$request->email)->count();
            if ($user_dbase > 0) {
                return response()->json(['message'=>'Email sudah digunakan']);
            }

            else {
                
                $path = $request->file('image')->store('profile_image', 'public');
                $user = $this->user->create([
                  'name' => $request->get('name'),
                  'email' => $request->get('email'),
                  'password' => bcrypt($request->get('password')),
                    'image' => $path,
                    'address' => $request->get('address'),
                    'phone_number' => $request->get('phone_number')
                ]);
            }
        }
        catch(Exception $error)
        {
            return response()->json(['error'=>'something went wrong, try again later'],500);
        }
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user],200);
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
        try {
            $user = JWTAuth::toUser($request->token);
        }
        catch(Exception $error)
        {
            return response()->json(['error'=>'something went wrong, try again later'],500);
        }
        return response()->json(['result' => $user], 200);
    }
    
    public function logout (Request $request)
    {
        JWTAuth::invalidate($request->token);
        return response()->json(['message'=>'Logout successfully'],200);
    }
    
    public function edit_profile (Request $request)
    {
        $user = JWTAuth::authenticate();
        DB::beginTransaction();
        try {
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone_number = $request->phone_number;
            $path = $request->file('image')->store('profile_image', 'public');
            $user->image = $path;
                      
            $user->save();
            
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'something went wrong, try again later','message'=>$e],500);
        }
        return response()->json(['status'=>true,'message'=>'Edited successfully', 'data' => $user], 200);
    }
    
    public function change_password (Request $request)
    {
        $user = JWTAuth::authenticate();
        $pass_dbase = DB::table('users')
            ->where('id', $user->id)
            ->first();
        
        if(!Hash::check($request->old_password, $pass_dbase->password))
        {
            return response()->json(['message'=>'Old Password Mismatch'],401);
        }
        
        DB::beginTransaction();
        try {
            $user->password = bcrypt($request->new_password);                    
            $user->save();
            
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['error'=>'something went wrong, try again later','message'=>$e],500);
        }
        return response()->json(['status'=>true,'message'=>'Password changed successfully'], 200);
    }
} 