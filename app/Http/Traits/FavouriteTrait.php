<?php

namespace App\Http\Traits;
use App\Models\Student;
use DB;
use Illuminate\Http\Request;
trait FavouriteTrait {
    public function favourite(Request $request)
    { 
      //  dd($request);
        // $user = Teammember::find($request->user_id);
        // $user->status = $request->status;
        // $user->save();
        $favourites =  DB::table('favourites')
        ->where('typeid',$request->user_id)->where('type','folder')->where('userid',auth()->user()->teammember_id)->count();
       // dd($favourites);
        if($favourites == 1){
            DB::table('favourites')->where('typeid',$request->user_id)->where('userid',auth()->user()->teammember_id)->delete();
        }
        else{
            DB::table('favourites')->insert([	
                'userid'         =>    auth()->user()->teammember_id,
                 
                'clientuserid'         =>    auth()->user()->id, 
                'client_id'         =>    auth()->user()->client_id, 
                'typeid'         =>     $request->user_id, 
               'type'         =>     'folder', 	
               'created_at'			    =>	   date('y-m-d'),
               'updated_at'              =>    date('y-m-d'),
                 ]);
        }
       
return response()->json($favourites);
    }
}