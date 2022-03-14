<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Http\Traits\FavouriteTrait;
use Illuminate\Http\Request;
use App\Models\Ilrfolder;
use DB;
class ClientFavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:clientlogin');
    }
    use FavouriteTrait;
    public function index(Request $request)
    { 
        $favourite =   DB::table('favourites')->where('client_id',auth()->user()->client_id)
        ->where('clientuserid',auth()->user()->id)->where('type','!=','question')->pluck('typeid')->toarray();
//dd($favourite);
$favouriteq =   DB::table('favourites')->where('client_id',auth()->user()->client_id)
        ->where('clientuserid',auth()->user()->id)->where('type','question')->pluck('typeid')->toarray();
     //dd($favouriteq);
        $ilrfolder = Ilrfolder::with('ilr','ilrsubfolder')->where('client_id',auth()->user()->client_id)->wherein('id',$favourite)->get();
        $informationresourcesDatas = DB::table('informationresources')
        ->leftjoin('favourites','favourites.typeid','informationresources.id')
        ->leftjoin('teammembers','teammembers.id','informationresources.uploadedby')->
        where('favourites.client_id',auth()->user()->client_id)
        ->where('favourites.type','question')
        ->select('informationresources.*','teammembers.team_member')->get();
      //    dd($informationresourcesDatas);
        $permission = DB::table('staffpermission')
        ->where('clientlogin_id',auth()->user()->id)->where('client_id',auth()->user()->client_id)
        ->first();  
        return view('client.favourite.index',compact('ilrfolder','informationresourcesDatas','ilrfolder','permission'));
    }

    public function questionilr(Request $request)
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
                'clientuserid'         =>    auth()->user()->id, 
                'client_id'         =>    auth()->user()->client_id, 
                'typeid'         =>     $request->user_id, 
               'type'         =>     'question', 	
               'created_at'			    =>	   date('y-m-d'),
               'updated_at'              =>    date('y-m-d'),
                 ]);
        }
       
return response()->json($favourites);
    }
    public function subfolder(Request $request)
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
                'clientuserid'         =>    auth()->user()->id, 
                'client_id'         =>    auth()->user()->client_id, 
                'typeid'         =>     $request->user_id, 
               'type'         =>     'subfolder', 	
               'created_at'			    =>	   date('y-m-d'),
               'updated_at'              =>    date('y-m-d'),
                 ]);
        }
       
return response()->json($favourites);
    }
    public function subfavourite(Request $request)
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
