<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\AdminitrController;
use App\Http\Controllers\StaffassignController;
use App\Http\Controllers\Client\SummaryController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\ClientuserloginController;
use App\Http\Controllers\CreditnoteController;
use App\Http\Controllers\OutstationconveyanceController;
use App\Http\Controllers\TabController;
use App\Http\Controllers\LocalconveyancesController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PbdController;
use App\Http\Controllers\FullandfinalController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ReimbursementclaimController;
use App\Http\Controllers\HbrController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TeammemberController;
use App\Http\Controllers\LetterheadController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TeamloginController;
use App\Http\Controllers\EmployeereferralController;
use App\Http\Controllers\AppointmentletterController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\OutstandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TeamprofileController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\KnowledgebaseController;
use App\Http\Controllers\AssignmentbudgetingController;
use App\Http\Controllers\Client\MisController;
use App\Http\Controllers\AdminmisController;
use App\Http\Controllers\AssignmentmappingController;
use App\Http\Controllers\TeamlevelController;
use App\Http\Controllers\CompanydetailController;
use App\Http\Controllers\GnattchartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\AssetasignController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\AssetticketController;
use App\Http\Controllers\AssignmentconfirmController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChecklistanswerController;
use App\Http\Controllers\StaffrequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\Client\ClienthomeController;
use App\Http\Controllers\Client\ClientTaskController;
use App\Http\Controllers\Client\ClientstaffloginController;
use App\Http\Controllers\InformationresourceController;
use App\Http\Controllers\Client\InformationController;
use App\Http\Controllers\Client\InternalauditController;
use App\Http\Controllers\Client\ClientFavouriteController;
use App\Http\Controllers\Client\ItrController;
use App\Http\Controllers\Client\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Auth\ClientLoginController::class, 'showloginForm']);
Route::get('/forgetpassword', [App\Http\Controllers\Auth\ClientLoginController::class, 'forgetPassword']);
Route::post('/forgetpassword/store', [App\Http\Controllers\Auth\ClientLoginController::class, 'forgetpasswordStore']);
Route::get('/reset/newpassword/{id}', [App\Http\Controllers\Auth\ClientLoginController::class, 'newPassword']);
Route::post('/newpassowrd/store/{id}', [App\Http\Controllers\Auth\ClientLoginController::class, 'passwordStore']);
Route::get('/privacypolicy', function () {
   return view('privacypolicy');
});
Route::get('/targetapplication', [App\Http\Controllers\TargetController::class, 'showtargetForm']);
Route::post('/target/store',[App\Http\Controllers\TargetController::class, 'login']);
Route::get('/database', [HomeController::class, 'cron']);
Route::get('/cron', [HomeController::class, 'scheduler']);
Route::get('/invoicereminder', [HomeController::class, 'invoiceReminder']);
//Route::get('/', [LoginController::class, 'index']);
 Auth::routes();
 Route::get('/adminlogin', [App\Http\Controllers\Auth\AdminLoginController::class, 'showloginForm']);
 Route::post('/admin/loginstore',[App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user'], function () {

    Route::get('/home', [UserController::class, 'index'])->name('home');

 });


Route::get('/clientlogin', [App\Http\Controllers\Auth\ClientLoginController::class, 'showloginForm']);
 Route::post('/client/loginstore',[App\Http\Controllers\Auth\ClientLoginController::class, 'login'])->name('client.login');
 Route::post('client/logout', [App\Http\Controllers\Auth\ClientLoginController::class, 'logout'])->name('client.logout');
 Route::get('/loginotp/{id}', [ClientLoginController::class, 'loginOtp']);
 Route::post('/otp/store', [ClientLoginController::class, 'otpStore']);
 Route::get('/otp/resend/{id?}',  [ClientLoginController::class,'otpResend']);
 
Route::group(['prefix' => 'client'], function () {
Route::get('/home', [ClienthomeController::class, 'index'])->name('client.home');
	Route::get('/switchaccount/{id}', [ClienthomeController::class, 'switchaccount']);
Route::get('/clientfilelist', [ClienthomeController::class, 'clientFile']);
Route::post('/clientfile/upload', [ClienthomeController::class, 'store']);
Route::get('/clientfile/{id}', [ClienthomeController::class, 'getFile']);
Route::post('/clientfolder/store', [ClienthomeController::class, 'folderStore']);
Route::get('/folderlist/{id}', [ClienthomeController::class, 'folderList']);
Route::get('/folderlist/destroy/{id}', [ClienthomeController::class, 'folderListDelete']);
Route::get('/folderlist/requestdelete/{id}', [ClienthomeController::class, 'folderListRequest']);
Route::get('/filelist', [ClienthomeController::class, 'fileList']);
	Route::get('/resetpassword/{id}', [ClienthomeController::class, 'resetPassword']);
Route::post('/password/update/{id}', [ClienthomeController::class, 'passwordUpdate']);
Route::get('/information', [InformationController::class, 'index']);
	Route::get('/informationlist/{id}', [InformationController::class, 'indexlist']);
Route::get('/information/create/{id}', [InformationController::class, 'informationCreate']);
Route::post('/information/store', [InformationController::class, 'informationStore']);
	Route::post('/information/updatestatus', [InformationController::class, 'updateStatus']);
	  Route::get('/information/status',  [InformationController::class, 'informationstatusUpdate']);
	 Route::get('/ilr/download/{id}', [InformationController::class, 'ilrDownload']);
	 Route::get('ilrbank', [InformationController::class, 'ilrbank']);
		 Route::get('/ilr/download/{id}', [InformationController::class, 'ilrDownload']);
	 Route::get('ilrhouse', [InformationController::class, 'ilrhouse']);
	 Route::get('ilrsalary', [InformationController::class, 'ilrsalary']);
	 Route::get('ilraddinformation', [InformationController::class, 'ilraddinformation']);
	 Route::post('ilrsalary/store', [InformationController::class, 'ilrsalaryStore']);
	 Route::post('/ilraddinformation/store', [InformationController::class, 'ilraddStore']);
	 Route::post('ilrhouse/store', [InformationController::class, 'ilrhouseStore']);
	 Route::post('ilrbank/store', [InformationController::class, 'ilrbankStore']);
  
	
	 Route::get('/ilrlist', [InformationController::class, 'ilrlist']);
 Route::post('/summary/store', [InformationController::class, 'ilrtStore']);
	Route::post('/summary/storeloctaion', [InformationController::class, 'ilrtStoreloctaion']);
	     Route::resource('/summary', SummaryController::class);
	  Route::get('/information/first',  [InformationController::class, 'informationFirst']);
   Route::get('/information/firstt',  [InformationController::class, 'informationFirstt']);
	 Route::get('/ilralllist', [InformationController::class, 'ilralllist']);
	
	Route::post('/informationfolder/store', [InformationController::class, 'folderStore']);
	 Route::post('/information/upload', [InformationController::class, 'informationUpload']);
	 Route::get('/information/edit/question',  [InformationController::class, 'editrecords']);
	Route::post('/edit/question', [InformationController::class, 'editQuestion']);
Route::get('/informationq/destroy', [InformationController::class, 'questionDelete']);
Route::get('/informationquestion/destroy/{id}', [InformationController::class, 'answerDelete']);
	Route::get('/informationquestion/particular/{id}', [InformationController::class, 'particular']);
	Route::post('/info/update', [InformationController::class, 'infoUpdate']);
	
	Route::get('/particularindex', [ReportController::class, 'particularIndex']);
	
	 Route::post('ilraddinformationsecond/store', [ItrController::class, 'ilraddinformationsecondStore']);
	 Route::post('ilraddinformationfirst/store', [ItrController::class, 'ilraddinformationfirstStore']);
	 Route::post('ilraddinformationthird/store', [ItrController::class, 'ilraddinformationthirdStore']);
	  Route::get('ilrdeduction', [ItrController::class, 'ilrdeduction']);
	 Route::post('ilrdeduction/store', [ItrController::class, 'ilrdeductionStore']);
    Route::get('ilrbp', [ItrController::class, 'ilrbp']);
	 Route::post('ilrbp/store', [ItrController::class, 'ilrbpStore']);
    Route::get('incomefromcapitalgains', [ItrController::class, 'income']);
	 Route::post('incomefromcapitalgains/store', [ItrController::class, 'incomefromcapitalgainsStore']);
    Route::get('incomefromsources', [ItrController::class, 'incomefromsources']);
	 Route::post('incomefromsources/store', [ItrController::class, 'incomefromsourcesStore']);
    Route::get('ilrpersonal', [ItrController::class, 'ilrpersonal']);
    Route::post('/ilrpersonalinformation/store', [ItrController::class, 'ilrperStore']);
	
	  Route::get('ilrbank/edit', [ItrController::class, 'ilrbankEdit']);
	 Route::post('ilrbank/update', [ItrController::class, 'ilrbankUpdate']);
	 Route::get('ilrhouse/edit', [ItrController::class, 'ilrhouseEdit']);
     Route::post('ilrhouse/update', [ItrController::class, 'ilrhouseUpdate']);
	  Route::get('ilrsalary/edit', [ItrController::class, 'ilrsalaryEdit']);
     Route::post('ilrsalary/update', [ItrController::class, 'ilrsalaryUpdate']);
	Route::get('incomefromcapitalgains/edit', [ItrController::class, 'incomefromcapitalgainsEdit']);
     Route::post('incomefromcapitalgains/update', [ItrController::class, 'incomefromcapitalgainsUpdate']);
	
	  Route::get('clfavourite',  [ClientFavouriteController::class, 'favourite']);
     Route::get('folderfavourite',  [ClientFavouriteController::class, 'folderfavourite']);
     Route::get('subfavourite',  [ClientFavouriteController::class, 'subfavourite']);
     Route::get('subfolder',  [ClientFavouriteController::class, 'subfolder']);
     Route::get('questionilr',  [ClientFavouriteController::class, 'questionilr']);
     Route::get('favourite',  [ClientFavouriteController::class, 'index']);
	
		// Mis routes
      Route::resource('/mis', MisController::class);
	 Route::get('/misimage',  [MisController::class, 'imageModal']);
	  Route::get('/mis/details/{id}', [MisController::class, 'viewUpdate']);
           Route::post('/misclient/update', [MisController::class, 'misUpdate']);
	    Route::get('/mis/destroy/{id}', [MisController::class, 'delete']);
	
	// Internalaudit routes
        Route::resource('/internalaudit', InternalauditController::class);
        Route::get('/actiontracker/index', [InternalauditController::class, 'actionTracker']);
	   Route::get('/actionitem/index', [InternalauditController::class, 'actionItem']);
	 Route::post('/actionitem/change/{id}', [InternalauditController::class, 'actionItemChange']);
     Route::post('/actiontracker/change/{id}', [InternalauditController::class, 'actionTrackerChange']);
	
	          // ClientstaffloginController routes
       // Route::resource('/clientuserlogin', ClientuserloginController::class);
       Route::get('/clientuserlogin', [ClientstaffloginController::class, 'indexview']);
       Route::post('/clientuserlogin/upload', [ClientstaffloginController::class, 'informationUpload']);
       Route::get('/clientuserlogin/create', [ClientstaffloginController::class, 'clientCreate']);
       Route::post('/clientuserlogin/store', [ClientstaffloginController::class, 'clientStore']);
       Route::get('/clientuserlogin/resetpassword/{id}', [ClientstaffloginController::class, 'resetPassword']);
       Route::post('/clientuserlogin/password/update/{id}', [ClientstaffloginController::class, 'passwordUpdate']);
       Route::get('changeclientloginStatus',  [ClientstaffloginController::class, 'changeclientloginStatus']);
       Route::get('/client/loginid',  [ClientstaffloginController::class, 'clientlogin']);
   Route::post('/client/assign',  [ClientstaffloginController::class, 'clientassign']);
	
	   Route::resource('/clienttask', ClientTaskController::class);
   Route::get('/view/clienttask/{id}', [ClientTaskController::class, 'viewTask']);
   Route::post('/clienttask/complete', [ClientTaskController::class, 'taskComplete']);
   Route::get('clienttask/delete/{id}', [ClientTaskController::class, 'destroy']);
   Route::post('/clienttask/reminder',  [ClientTaskController::class, 'taskMail']);
   Route::post('/tasktrail/update', [ClientTaskController::class, 'taskUpdate']);
	
});

  /*
|--------------------------------------------------------------------------
| Admin controller Routes
|--------------------------------------------------------------------------
|
| This section contains all admin Routes
| 
|
*/ 
Route::get('/home', [BackEndController::class, 'index'])->name('home');
     //   Route::get('/home', [AdminController::class, 'index'])->name('admin.dashboard');
      Route::get('/userprofile/{id}', [BackEndController::class, 'userProfile']);
   Route::get('/userlog', [BackEndController::class, 'userLog']);
               Route::post('/userprofile/update', [BackEndController::class, 'update']);
                 Route::get('/activitylog', [BackEndController::class, 'activityLog']);
  Route::get('/traininglist', [BackEndController::class, 'traininglist']);
Route::get('/training/list/{id}', [BackEndController::class, 'traininglistshow']);
                 Route::post('/training', [BackEndController::class, 'training']);
 Route::post('/training/reminder', [BackEndController::class, 'trainingMail']);
  Route::get('/training/reminderall', [BackEndController::class, 'trainingreminderMail']);
 Route::get('/training/create', [BackEndController::class, 'create']);
                  Route::post('/clientfolder/folderstore', [ClientController::class, 'folderStore']);
               Route::get('/folderlist/{id}', [ClientController::class, 'folderList']);  
   Route::get('/clientfolderlist/destroy/{id}', [ClientController::class, 'folderDestroy']);
        //Tab routes
        Route::resource('/tab', TabController::class);
        
  //Travel routes
        Route::resource('/travel', TravelController::class);

        //Group routes
        Route::resource('/group', GroupController::class);
        
 //AppointmentletterController routes
        Route::resource('/appointmentletter', AppointmentletterController::class);
        //Assignment routes
        Route::resource('/assignment', AssignmentController::class);
        
       
//Template
Route::resource('/template',  TemplateController::class);

//Route::resource('/mis', AdminmisController::class);
Route::get('/viewmis/{id}', [AdminmisController::class, 'viewMis']);
Route::get('/viewmislist/{id}', [AdminmisController::class, 'viewUpdate']);
Route::post('/mis/update', [AdminmisController::class, 'misUpdate']);
  Route::get('/misstatus/destroy/{id}', [AdminmisController::class, 'delete']);

//ConfirmationController routes
 Route::get('/confirmation/{id}', [ConfirmationController::class, 'indexview']);
       Route::post('/confirmation/mail', [ConfirmationController::class, 'mail']);
       Route::get('/confirmationtem',  [ConfirmationController::class, 'template']);
Route::get('/viewconfirmation/{id}', [ConfirmationController::class, 'view']);

	//clientasset
Route::get('clientassetregister/{id}', [ClientController::class, 'clientAssetsRegister']);
Route::post('clientassets/store', [ClientController::class, 'assetStore']);
Route::post('clientassetregister/store', [ClientController::class, 'assetRegisterStore']);
Route::get('clientassetregistermerge/{id}', [ClientController::class, 'assetRegisterMerge']);
Route::get('clientassetregisterpv', [ClientController::class, 'assetregisterpv']);
Route::post('clientassetregisterpvsearch/{id}', [ClientController::class, 'assetRegisterSearch']);
Route::get('clientassetregistersearchinput/{id}', [ClientController::class, 'assetRegisterInput']);
Route::post('clientassetregisterpvupdate/{id}', [ClientController::class, 'update_asset']);

Route::get('staff_vs_store/{id}', [ClientController::class, 'staff_vs_store']);
Route::post('staff_vs_store_add/{id}', [ClientController::class, 'staff_vs_store_add']);

         //Assignmentbudgeting routes
        Route::resource('/assignmentbudgeting', AssignmentbudgetingController::class);
        
         //Assignmentmapping routes
       Route::get('/clientassignmentlist/{id}', [AssignmentmappingController::class, 'clientassignmentList']);
        Route::get('/yearwise', [AssignmentmappingController::class, 'yearWise']);
        Route::resource('/assignmentmapping', AssignmentmappingController::class);
        Route::get('/assignmentmapping/edit/{id}',  [AssignmentmappingController::class, 'assignmentmappingEdit']);
  Route::get('/teamconfirm/',  [AssignmentconfirmController::class, 'teamConfirm']);
        Route::get('/debtorconfirm/',  [AssignmentconfirmController::class, 'debtorconfirm']);
  Route::post('confirmation/confirm',   [AssignmentconfirmController::class, 'confirmationConfirm']);

   // Policy routes
      Route::resource('/policy', PolicyController::class);
      Route::get('/policy/list/{id}', [PolicyController::class, 'policylist']);
      Route::get('/policyupdate',  [PolicyController::class, 'policy']);
      Route::get('/policy/acknowledgelist/{id}',  [PolicyController::class, 'acknowledgelist']);
      Route::post('/policy/statusupdate', [PolicyController::class, 'policyAcknowledge']);
      Route::get('/policy/reminder/{id}', [PolicyController::class, 'show']);

//target
Route::resource('/target', TargetController::class);
Route::get('/view/target/{id}', [TargetController::class, 'viewTarget']);

//Invoice
Route::resource('/invoice',  InvoiceController::class);
Route::get('/invoiceajax/create',  [InvoiceController::class, 'clientList']);
Route::get('/invoicecompany/create',  [InvoiceController::class, 'companyList']);
Route::get('/companycode/create',  [InvoiceController::class, 'companyCode']);
Route::get('/invoiceview/{id}',  [InvoiceController::class, 'invoiceView']);
Route::get('/downloadpdf/{id}',  [InvoiceController::class, 'downloadpdf']);
Route::post('invoiceupdate/{id}',   [InvoiceController::class, 'invoiceUpdate']);
Route::get('/search',  [InvoiceController::class, 'search']);
Route::get('/invoicereport',  [InvoiceController::class, 'invoicereport']);

           //Teammember routes
        Route::resource('/teammember', TeammemberController::class);
 Route::get('/resetpassword/{id}', [TeammemberController::class, 'resetPassword']);
        Route::post('/password/update/{id}', [TeammemberController::class, 'passwordUpdate']);
   Route::get('changeteamStatus',  [TeammemberController::class, 'changeteamStatus']);

//Companydetail route
        Route::resource('/companydetail', CompanydetailController::class);
        Route::get('/view/companydetail/{id}', [CompanydetailController::class, 'viewinvoice']);

//lead Controller
   Route::resource('/lead', LeadController::class);
   Route::post('/lead/observer', [LeadController::class, 'leadreplyDone']);
   Route::get('/lead/view/{id}', [LeadController::class, 'show']);

//Pbd
Route::resource('/pbd',  PbdController::class);


//fullandfinal
Route::resource('/fullandfinal',  FullandfinalController::class);
Route::post('/fullandfinal/reminder', [FullandfinalController::class, 'fullandfinalReminder']);

 Route::get('ilrpersonal', [AdminitrController::class, 'ilrpersonal']);
   Route::get('ilrbp', [AdminitrController::class, 'ilrbp']);
   Route::get('incomefromcapitalgains', [AdminitrController::class, 'income']);
   Route::get('incomefromsources', [AdminitrController::class, 'incomefromsources']);
   Route::get('ilrdeduction', [AdminitrController::class, 'ilrdeduction']);

//letterhead Controller
   Route::resource('/letterhead', LetterheadController::class);
   Route::get('/letterhead/{id}', [LetterheadController::class, 'show']);  


 //Teamlevel routes
         Route::get('/teamlevel',  [TeamlevelController::class, 'index']);
        Route::post('/teamlevel/store',  [TeamlevelController::class, 'store']);
        Route::get('/teamlevel/create',  [TeamlevelController::class, 'create']);
        Route::get('/teamlevel/edit/{id}', [TeamlevelController::class, 'edit']);
        Route::post('/teamlevel/update/{id}', [TeamlevelController::class, 'update']);
        
        // Notification routes
        Route::resource('/notification', NotificationController::class);
       
        // Feed routes
      Route::get('/feed', [FeedController::class, 'feed']);
       
       // ILR routes
  Route::post('/adminstaff/summary/store', [InformationresourceController::class, 'ilrtStore']);
 Route::get('/ilr/download/{id}', [InformationresourceController::class, 'ilrDownload']);
    Route::get('/informations/delete/{id}', [InformationresourceController::class, 'informationDelete']);
Route::get('/ilr/delete/{id}', [InformationresourceController::class, 'questionDelete']);
Route::get('/ilrfolder/delete/{id}', [InformationresourceController::class, 'folderDelete']);
Route::get('/ilrsubfolder/delete/{id}', [InformationresourceController::class, 'subfolderDelete']);
        Route::resource('/informationresources', InformationresourceController::class);
  Route::get('/informationlist/{id}', [InformationresourceController::class, 'indexview']);
        Route::get('/information/{id}', [InformationresourceController::class, 'ilrfolder'])->name('ilrid');
        Route::post('informationresourceaddstore/{id}', [InformationresourceController::class, 'iaddstore']);
Route::post('update/information', [InformationresourceController::class, 'updatelocation']);
        Route::post('/information/upload', [InformationresourceController::class, 'informationUpload']);
  Route::post('/ilr/question', [InformationresourceController::class, 'questionUpload']);
        Route::get('/information/create/{id}', [InformationresourceController::class, 'informationCreate']);
        Route::post('/informations/store', [InformationresourceController::class, 'informationStore']);
           Route::post('/informationfolder/store', [InformationresourceController::class, 'folderStore']);
 Route::post('/edit/question', [InformationresourceController::class, 'editQuestion']);
           Route::get('/information/edit/question',  [InformationresourceController::class, 'editrecords']);
  Route::post('assign/folder', [InformationresourceController::class, 'assignfolderStore']);
 Route::get('ilrbank', [InformationresourceController::class, 'ilrbank']);
  Route::get('ilrhouse', [InformationresourceController::class, 'ilrhouse']);
  Route::get('ilrsalary', [InformationresourceController::class, 'ilrsalary']);
  Route::get('ilraddinformation', [InformationresourceController::class, 'ilraddinformation']);

          // ClientuserloginController routes
       // Route::resource('/clientuserlogin', ClientuserloginController::class);
        Route::get('/clientuserlogin/{id}', [ClientuserloginController::class, 'indexview']);
        Route::post('/clientuserlogin/upload', [ClientuserloginController::class, 'informationUpload']);
        Route::get('/clientuserlogin/create/{id}', [ClientuserloginController::class, 'clientCreate']);
        Route::post('/clientuserlogin/store', [ClientuserloginController::class, 'clientStore']);
        Route::get('/clientuserlogin/resetpassword/{id}', [ClientuserloginController::class, 'resetPassword']);
        Route::post('/clientuserlogin/password/update/{id}', [ClientuserloginController::class, 'passwordUpdate']);
        Route::get('changeclientloginStatus',  [ClientuserloginController::class, 'changeclientloginStatus']);
        Route::get('/client/loginid',  [ClientuserloginController::class, 'clientlogin']);
 Route::get('/client/staffpermission',  [ClientuserloginController::class, 'staffpermission']);
    Route::post('/client/assign',  [ClientuserloginController::class, 'clientassign']);
    Route::post('/client/permissionstore',  [ClientuserloginController::class, 'permissionStore']);

          // Profile routes
       Route::resource('/profile', ProfileController::class);
       

         //hrb Controller
   Route::resource('/hbrtools', HbrController::class);

// Outstanding route
     Route::resource('/outstanding', OutstandingController::class);
     Route::get('/reminder/sendmail',  [OutstandingController::class, 'sendMail']);
     Route::post('/outstanding/reminder',  [OutstandingController::class, 'oustandingMail']);
    Route::get('/reminder/mailshow',  [OutstandingController::class, 'mailshow']);


        // Finance routes
       Route::resource('/assetassign', AssetasignController::class);
        Route::get('/assetassigned/view/{id}', [AssetasignController::class, 'financeView']);
        Route::get('/assetassign/viewit/{id}', [AssetasignController::class, 'financeViewit']);
        Route::post('/account/update', [AssetasignController::class, 'accountUpdate']);
        Route::post('/it/update', [AssetasignController::class, 'itUpdate']);
        Route::post('/assetassign/upload', [AssetasignController::class, 'financeUpload']);
        
      //Knowledgebase routes
        Route::resource('/knowledgebase', KnowledgebaseController::class);
        Route::get('/knowledgebase/create/{id}',  [KnowledgebaseController::class, 'knowledgebaseCreate']);

         //Knowledgebase routes
         Route::resource('/article',ArticleController::class);
          Route::get('/knowledgebase/article/{id}',  [ArticleController::class, 'articleIndex']);
          Route::get('/article-view/{id}', [ArticleController::class, 'articleView']);
          Route::get('/article/create/{id}', [ArticleController::class, 'articleCreate']);
        
// employeereferral routes
     Route::resource('/employeereferral', EmployeereferralController::class);

        // Generate ticket route
        Route::get('/generateticket/{id}', [BackEndController::class, 'ticketIndex']);
        
     // clientstaffassign routes
  Route::get('/clientstaffassign/{id}', [StaffassignController::class, 'index']);
  Route::post('staff/assign', [StaffassignController::class, 'staffassignStore']);
	
 // Payment route
        Route::resource('/payment', PaymentController::class);
     Route::get('/paymentlist/{id}', [PaymentController::class, 'paymentList']);
        Route::get('/payment/create/{id}', [PaymentController::class, 'paymentCreate']);
        Route::post('payments/store/{id}', [PaymentController::class, 'paymentsStore']);

         // Staffrequest route
    Route::get('/staffrequest/list/{id}', [StaffrequestController::class, 'viewList']);
        Route::resource('/staffrequest', StaffrequestController::class);
        Route::get('/viewstaff/{id}', [StaffrequestController::class, 'viewStaff']);
        Route::post('staffrequest/complete', [StaffrequestController::class, 'staffRequest']);
          Route::get('staffrequest/delete/{id}', [StaffrequestController::class, 'destroy']);

 // outstationconveyance routes

    Route::resource('/outstationconveyance', OutstationconveyanceController::class);

          // Gnatt route
             Route::get('/gnattchart', [GnattchartController::class, 'index']);
              Route::get('/gnattchart/assignlist', [GnattchartController::class, 'gnattchartAssignlist']);
                 Route::get('/gnattchart/editassign/{id}', [GnattchartController::class, 'editAssign']);
              Route::post('/gnattchart/assign/update/{id}', [GnattchartController::class, 'updateAssign']);
        Route::post('/gnattchart/store', [GnattchartController::class, 'gnattStore']);
           Route::post('/ganttchart/upload', [GnattchartController::class, 'ganttUpload']);
        Route::post('/ganttchart/client/store', [GnattchartController::class, 'ganttchartClientStore']);
        
       //Step routes
        Route::resource('/step', StepController::class);
         Route::get('/step/check/{id}', [StepController::class, 'checkList']);
         Route::post('/checklist/store', [StepController::class, 'checklistStore']);
           Route::post('/modify/excel', [StepController::class, 'excelStore']);
           Route::get('/viewassignment/{id}', [StepController::class, 'viewAssignment']);
         Route::get('/auditchecklist', [StepController::class, 'auditChecklist']);
                 Route::get('/auditchecklistanswer', [StepController::class, 'auditchecklistAnswer']);
                      Route::get('/deleteassignmentchecklist/{id}', [StepController::class, 'deleteassignmentChecklist']);
        // Teamlogin routes
        Route::resource('/teamlogin', TeamloginController::class);
        
 // Teamprofile routes
            Route::resource('/teamprofile', TeamprofileController::class);

 

 //  Connection routes
         Route::resource('/connection', ConnectionController::class);
         Route::get('/view/connection/{id}', [ConnectionController::class, 'viewConnection']);
  Route::get('/connectioncompanies/destroy/{id}', [ConnectionController::class, 'connectionDestroy']);
 Route::get('/connection/list/destroy/{id}', [ConnectionController::class, 'destroy']);

        //Auditchecklistanswer routes
Route::post('/auditchecklistanswer/store', [ChecklistanswerController::class, 'checklistAnswer']);
Route::get('/criticalnotes', [ChecklistanswerController::class, 'criticalNotesview']);
Route::post('/criticalnotes/store', [ChecklistanswerController::class, 'criticalNotes']);
Route::get('/assignmentlist/{id}', [ChecklistanswerController::class, 'assignmentList']);
Route::post('/teammapping/update', [ChecklistanswerController::class, 'teammappingUpdate']);

Route::get('/assigned/userlist',  [InformationresourceController::class, 'assignedUserlist']);
         // Client routes
       Route::resource('/client', ClientController::class);
  Route::get('/client/contactedit/{id}', [ClientController::class, 'editContact']);
        Route::post('/client/contactupdate/{id}', [ClientController::class, 'contactUpdate']);
        Route::get('/client/destroy/{id}', [ClientController::class, 'destroyClient']);
        Route::get('/clientdocument/destroy/{id}', [ClientController::class, 'destroyClientdocument']);
         Route::get('/debtor/pdf/{id}', [ClientController::class, 'debtorPdf']);
			Route::get('/clientcontact', [ClientController::class, 'clientContact']);
			Route::get('/clientfile', [ClientController::class, 'clientFile']);
			Route::get('/clientfile/create', [ClientController::class, 'clientCreate']);
			Route::post('/clientfile/store', [ClientController::class, 'clientfileStore']);
			Route::post('/clientcontact/upload', [ClientController::class, 'clientcontactUpload']);
			Route::get('/clientdocument/open/{id}', [ClientController::class, 'clientdocumentOpen']);
			Route::post('/viewassignment/contactupdate', [ClientController::class, 'assignmentContactUpdate']);
			Route::get('/viewclient/{id}', [ClientController::class, 'viewClient']);
			Route::get('clientassets/{id}', [ClientController::class, 'clientAssets']);
			Route::post('clientassets/store', [ClientController::class, 'assetStore']);

           Route::get('changeStatus',  [ClientController::class, 'changeStatus']);
             Route::post('/debtor/excel', [ClientController::class, 'debtorExcel']);
                Route::post('/admin/file', [ClientController::class, 'adminFile']);
                     Route::get('/viewclientlist/{client_name}', [ClientController::class, 'viewclientlist']);
             Route::get('/client/add/{clientid?}', [ClientController::class,'add']);
                
        // Service routes
        Route::resource('/service', ServiceController::class);

// Creditnote routes
         Route::resource('/creditnote', CreditnoteController::class);
         Route::get('/creditnoteinvoice',  [CreditnoteController::class, 'invoiceList']);
         Route::get('/creditnoteinvoice/create',  [CreditnoteController::class, 'companyList']);
Route::get('/creditnoteinvoices/create',  [CreditnoteController::class, 'companyCode']);

 // localconveyance routes
         Route::resource('/localconveyance', LocalconveyancesController::class);

 // claim routes
        Route::resource('/reimbursementclaim', ReimbursementclaimController::class);

// Asset routes
        Route::resource('/asset', AssetController::class);
          Route::post('/assetconfirm',  [AssetController::class, 'assetConfirm']);

// Conversion routes
        Route::resource('/conversion', ConversionController::class);
        Route::get('/conversionupdate',  [ConversionController::class, 'conversion']);
        Route::post('/connection/statusupdate',  [ConversionController::class, 'conversionUpdate']);

        // Task routes

        Route::resource('/task', TaskController::class);
        Route::get('/view/task/{id}', [TaskController::class, 'viewTask']);
        Route::post('/task/complete', [TaskController::class, 'taskComplete']);
        Route::get('task/delete/{id}', [TaskController::class, 'destroy']);
 Route::post('/task/reminder',  [TaskController::class, 'taskMail']);

        // Assetticket routes
         Route::post('/generateticket/store', [AssetticketController::class, 'ticketStore']);
  Route::post('/ticket/reply', [AssetticketController::class, 'ticketreplyDone']);
         Route::get('/ticket/{id}', [AssetticketController::class, 'ticketReply']);
           Route::get('/ticketsupport', [AssetticketController::class, 'index']);
           Route::get('/createticket', [AssetticketController::class, 'createTicket']);
        
           
        // databasebackup routes
        Route::resource('/backup', BackupController::class);
        Route::get('/dbbackup', [BackupController::class, 'dbBackup']);
        Route::get('download/{file}', [BackupController::class, 'getFiles']);
        
         //Tender routes
         Route::resource('/tender', TenderController::class);
            Route::get('/tender/list/{id}', [TenderController::class, 'List']);
        Route::get('/tender/view/{id}',  [TenderController::class, 'tenderView']);
        Route::post('tender/assigned',  [TenderController::class, 'tenderAssigned']);
        Route::post('tenderssigned/store',  [TenderController::class, 'tenderssignedStore']);
        Route::post('tendercreatedby/store',  [TenderController::class, 'tendercreatedBystore']);
   Route::get('tenderexpirelist',  [TenderController::class, 'tenderexpireList']);
   Route::post('clientassetregister/storecode', [ClientController::class, 'barcode_generator']);
   Route::post('clientassetregister/downloadasset', [ClientController::class, 'downloadasset']);