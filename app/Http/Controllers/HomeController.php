<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Log;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function cron () {
        
        $exitCode = Artisan::call('migrate:fresh'); 
        
        
    return  redirect('/');
    
       //  dd($exitCode);
        // return what you want
    }
 public function scheduler () {
        
        $exitCode = Artisan::call('command:reminder')->daily(); 
        $exitCode = Artisan::call('command:taskreminder')->daily()->withoutOverlapping(); 
        
        
    return  redirect('/');
    
       //  dd($exitCode);
        // return what you want
    }
	 public function invoiceReminder () {
        
        $exitCode = Artisan::call('command:invoicereminder')->daily(); 
        
        
    return  redirect('/');
    
       //  dd($exitCode);
        // return what you want
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }
}
