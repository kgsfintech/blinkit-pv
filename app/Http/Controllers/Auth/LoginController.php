<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Role;
use DB;
use Carbon\Carbon;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	function authenticated(Request $request, $user)
    {
          DB::table('userloginactiviteies')->insert([
    'teammember_id' => auth()->user()->teammember_id, 
    'ip_address' => $request->getClientIp(),
    'lastlogindateandtime' => Carbon::now()->toDateTimeString(),
    'created_at' => date('y-m-d'),     
    'updated_at' => date('y-m-d')       
]);
    }
	 public function maxAttempts()
{
    //Lock out on 5th Login Attempt
    return 4;
}

public function decayMinutes()
{
    //Lock for 1 minute
    return 1;
}
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
  //   public function index()
//    {
  //      return view('auth.login');
//    }
     public function index()
    {
        return view('auth.loginaccess');
    }
      protected function credentials(Request $request)
{        
    $role = Role::select('id')->get();
   return ['email' => $request->email, 'password' => $request->password, 'status' => 1,'role_id'  => $role ];

}
}
