<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Franchise;
use App\Franchisor;
use JWTAuth;
use JWTAuthException;
use Exception;

class FranchiseController extends Controller
{
    public function register_franchise(Request $request)
    {
        $franchise_dbase = DB::table('franchise_list')->where('name',$request->name)->count();
        if ($franchise_dbase > 0) {
            return response()->json(['message'=>'Nama Franchise sudah didaftarkan']);
        }
        else {
            DB::beginTransaction();
            
            try {
                $franchise = new Franchise;
                $franchise->name = $request->name;
                $franchise->category = $request->category;
                $franchise->type = $request->type;
                $franchise->establishSince = $request->establishSince;
                $franchise->investment = $request->investment;
                $franchise->franchiseFee = $request->franchiseFee;
                $franchise->website = $request->website;
                $franchise->address = $request->address;
                $franchise->location = $request->location;
                $franchise->phoneNumber = $request->phoneNumber;
                $franchise->email = $request->email;
                $franchise->detail = $request->detail;
                $logo = $request->file('logo');
                $logo_fileName= $request->name."_logo".".".$logo->getClientOriginalExtension();
                $request->file('logo')->move("assets/franchise_logo/", $logo_fileName);
                $franchise->logo = $logo_fileName;
                
                $banner = $request->file('banner');
                $banner_fileName= $request->name."_banner".".".$banner->getClientOriginalExtension();
                $request->file('banner')->move("assets/franchise_banner/", $banner_fileName);
                $franchise->banner = $banner_fileName;
                
                $franchise->save();
                
                $franchisor = new Franchisor;
                $user = JWTAuth::authenticate();
                $franchisor->user_id = $user->id;
                $franchisor->franchise_id = $franchise->id;
            
                $franchisor->save();
                
                DB::commit();
            }
            catch (Exception $e) {
                DB::rollback();
                return response()->json(['error'=>'something went wrong, try again later','message'=>$e],500);
            }
        }
        return response()->json(['status'=>true,'message'=>'Franchise registered successfully','data'=>$franchise],200);
    }
}
