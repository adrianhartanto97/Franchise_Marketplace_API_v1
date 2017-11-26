<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Franchise;
use App\Franchisor;
use App\Legal_Doc;
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
                /*
                $logo = $request->file('logo');
                $logo_fileName= $request->name."_logo".".".$logo->getClientOriginalExtension();
                $request->file('logo')->move("assets/franchise_logo/", $logo_fileName);
                $franchise->logo = $logo_fileName;*/
                $franchise->logo = $request->file('logo')->storeAs('franchise_logo', $request->name."_logo.".$request->file('logo')->getClientOriginalExtension() , 'public');
                
                /*
                $banner = $request->file('banner');
                $banner_fileName= $request->name."_banner".".".$banner->getClientOriginalExtension();
                $request->file('banner')->move("assets/franchise_banner/", $banner_fileName);
                $franchise->banner = $banner_fileName;*/              
                $franchise->banner = $request->file('banner')->storeAs('franchise_banner', $request->name."_banner.".$request->file('banner')->getClientOriginalExtension() , 'public');
                
                $franchise->status = 'pending';
                
                $franchise->save();
                
                $franchisor = new Franchisor;
                $user = JWTAuth::authenticate();
                $franchisor->user_id = $user->id;
                $franchisor->franchise_id = $franchise->id;
            
                $franchisor->save();
                
                $legal_doc = new Legal_Doc;
                $legal_doc->franchise_id = $franchise->id;
                
                $legal_doc->save();
                
                DB::commit();
            }
            catch (Exception $e) {
                DB::rollback();
                return response()->json(['error'=>'something went wrong, try again later','message'=>$e],500);
            }
        }
        return response()->json(['status'=>true,'message'=>'Franchise registered successfully','data'=>$franchise],200);
    }
    
    public function upload_legal_doc(Request $request)
    {
        
            DB::beginTransaction();
            
            try {
                $temp = Legal_Doc::where('franchise_id', $request->franchise_id)->first();
                if ($temp) {
                    $legal_doc = Legal_Doc::where('franchise_id', $request->franchise_id)->first();
                }
                else {
                    $legal_doc = new Legal_Doc;
                }
                
                $legal_doc->franchise_id = $request->franchise_id;
                
                if ($request->file('tdp')) {
                    $legal_doc->tdp = $request->file('tdp')->storeAs('Legal_doc/tdp', $request->franchise_id."_tdp.".$request->file('tdp')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('siup') != null) {
                    $legal_doc->siup = $request->file('siup')->storeAs('Legal_doc/siup', $request->franchise_id."_siup.".$request->file('siup')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('suratperjanjian')) {
                    $legal_doc->suratperjanjian = $request->file('suratperjanjian')->storeAs('Legal_doc/suratperjanjian', $request->franchise_id."_suratperjanjian.".$request->file('suratperjanjian')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('stpw')) {
                    $legal_doc->stpw = $request->file('stpw')->storeAs('Legal_doc/stpw', $request->franchise_id."_stpw.".$request->file('stpw')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('ktpfranchisor')) {
                    $legal_doc->ktpfranchisor = $request->file('ktpfranchisor')->storeAs('Legal_doc/ktpfranchisor', $request->franchise_id."_ktpfranchisor.".$request->file('ktpfranchisor')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('companyprofile')) {
                    $legal_doc->companyprofile = $request->file('companyprofile')->storeAs('Legal_doc/companyprofile', $request->franchise_id."_companyprofile.".$request->file('companyprofile')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('laporankeuangan2tahunterakhir')) {
                    $legal_doc->laporankeuangan2tahunterakhir = $request->file('laporankeuangan2tahunterakhir')->storeAs('Legal_doc/laporankeuangan2tahunterakhir', $request->franchise_id."_laporankeuangan2tahunterakhir.".$request->file('laporankeuangan2tahunterakhir')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('suratizinteknis')) {
                    $legal_doc->suratizinteknis = $request->file('suratizinteknis')->storeAs('Legal_doc/suratizinteknis', $request->franchise_id."_suratizinteknis.".$request->file('suratizinteknis')->getClientOriginalExtension() , 'public');
                }
                
                if ($request->file('tandabuktipendaftaran')) {
                    $legal_doc->tandabuktipendaftaran = $request->file('tandabuktipendaftaran')->storeAs('Legal_doc/tandabuktipendaftaran', $request->franchise_id."_tandabuktipendaftaran.".$request->file('tandabuktipendaftaran')->getClientOriginalExtension() , 'public');
                }
                
                $legal_doc->save();
                
                DB::commit();
            }
            
            catch (Exception $e) {
                DB::rollback();
                return response()->json(['error'=>'something went wrong, try again later','message'=>$e],500);
            }
        
        return response()->json(['status'=>true,'message'=>'Document uploaded successfully','data'=>$legal_doc],200);
    }
    
    public function document_status (Request $request)
    {
        $franchise_id = $request->franchise_id;
        $status = DB::table('legal_doc')->where('franchise_id',$franchise_id)->first();
        
        return response()->json(['document_status'=>$status],200);
    }
}