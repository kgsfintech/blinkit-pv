  <!-- Sidebar  -->
  @php
  $getuser=DB::table('teammembers')
    ->join('roles','roles.id','teammembers.role_id')
    ->where('teammembers.id',auth()->user()->teammember_id)
    ->select('roles.rolename',
    'teammembers.team_member','teammembers.profilepic'
  )->first();
      @endphp
  <nav class="sidebar sidebar-bunker">

	   <div style=" background:#F4F4F5;    flex-shrink: 0;
    height: 70px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0 50px;font-size: 32px;">
        <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
        <a href="{{url('client/home')}}" style="margin:0px;text-align:center;font-weight: 600;" class="logo">CapITall<br>
      </a>
      
    </div>
	  <!--/.sidebar header-->
    <a href="{{url('userprofile/'.Auth::user()->id)}}" class="profile-element d-flex align-items-center flex-shrink-0">
      
        <div class="avatar online">
            <img src="{{ asset('backEnd/image/teammember/profilepic/'.$getuser->profilepic ??'') }}" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ $getuser->team_member ??'' }}</h6>
            <span>{{ $getuser->rolename ??''}}</span>
        </div>
    </a><!--/.profile element-->
    <div class="sidebar-body">
        <nav class="sidebar-nav">
            <ul class="metismenu">
                <li class="nav-label">Main Menu</li>
                <li class="mm-active">
                    <a class="material-ripple" href="{{url('home')}}">
                        <i class="typcn typcn-home-outline mr-2"></i>
                        Dashboard
                    </a>
                   
                </li>
                 @foreach($getrole as $getroledata)
                @if ( $getroledata->page_id == 1)
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-group-outline d-block mr-2"></i>
                        Client
                    </a>
                    <ul class="nav-second-level">
						  @if(auth()->user()->role_id != 15)
                        <li><a href="{{url('client/create')}}">Create Client</a></li>
						@endif
                        <li><a href="{{url('client')}}">Client List</a></li>
                    </ul>
                </li>
                @elseif ( $getroledata->page_id == 2)
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-document-text outline mr-2"></i>
                        Assignment
                    </a>
                    <ul class="nav-second-level">
                       @if(auth()->user()->role_id != 15)
                        <li><a href="{{url('assignmentbudgeting')}}">Assignment Budgeting</a></li>
                        <li><a href="{{url('assignmentmapping/create')}}">Assignment Mapping</a></li>
                        @endif
                        <li><a href="{{url('assignmentmapping')}}">Assignment List</a></li>
                       <!-- <li><a href="#">Close Assignment</a></li>-->
                    </ul>
                </li>
                @elseif ( $getroledata->page_id == 3)
              
               
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-cog-outline mr-2"></i>
                        Configuration
                    </a>
                    <ul class="nav-second-level">
                         <li><a href="{{url('assignment')}}">Assignment Name</a></li>
                        <!--  <li><a href="{{url('tab')}}">Tabs</a></li>
                        <li><a href="{{url('group')}}">Group</a></li>
                        <li><a href="{{url('service')}}">Services</a></li>-->
                        <li><a href="{{url('step/create')}}">Add Checklist</a></li>
                      <!--  <li><a href="#">Sub Steps</a></li>-->
                    </ul>
                </li>
                @elseif ( $getroledata->page_id == 4)
              
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-user-add-outline mr-2"></i>
                        Team
                    </a>
                    <ul class="nav-second-level">
                        <li><a href="{{url('teammember')}}">Team</a></li>
                  <!--   @if(auth()->user()->role_id == 11 or auth()->user()->role_id == 12)
                    <li><a href="{{url('teamlevel')}}">Team Role</a></li>
                    @endif -->
                        <li><a href="{{url('teamlogin/create')}}">Team Login</a></li>
                    </ul>
                </li>
               
                  @elseif ( $getroledata->page_id == 6)
              
                <li><a href="{{url('notification')}}"><i class="typcn typcn-bell mr-2"></i> Notification</a></li>
                @elseif ( $getroledata->page_id == 7)
              
              
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-document mr-2"></i>
                        Finance
                    </a>
                    <ul class="nav-second-level">
                         <li><a href="{{url('invoice')}}">Invoice Raised</a></li>
                        <li><a  href="{{url('outstanding')}}">Outstanding  Pending</a></li>
                        @if(Auth::user()->role_id == 11 || Auth::user()->role_id == 17 || Auth::user()->teammember_id == 99)
                        <li><a  href="{{url('payment')}}">Outstanding Received</a></li>
                        @endif
						  @if(Auth::user()->role_id == 11 || Auth::user()->role_id == 17)
                          <li><a  href="{{url('creditnote')}}">Credit Note</a></li>
                        @endif
                    </ul>
                </li>
                  @elseif ( $getroledata->page_id == 8)
              
                <li><a href="{{url('tender')}}"><i class="typcn typcn-pen mr-2"></i> Tender</a></li>
                  @elseif ( $getroledata->page_id == 9)
              
                <li><a href="{{url('assetassign')}}"><i class="typcn typcn-document-text mr-2"></i> Assign Asset</a></li>
                 @elseif ( $getroledata->page_id == 10)
               <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-calendar-outline mr-2"></i>
                        Calendar
                    </a>
                    <ul class="nav-second-level">
                        <li><a href="{{url('gnattchart')}}">Assign Calendar</a></li>
                          @if(Auth::user()->role_id == 11 || Auth::user()->role_id == 12 || Auth::user()->teammember_id == 23)
    <li><a href="{{url('gnattchart/assignlist')}}">Assigned List</a></li>
    @endif
                    </ul>
               
                 @elseif ( $getroledata->page_id == 11)
              
                   <li><a href="{{url('task')}}"><i class="fas fa-tasks mr-2"></i> Task</a></li>
                   @elseif ( $getroledata->page_id == 12)
                <li><a href="{{url('staffrequest')}}"><i class="fas fa-user-friends mr-2"></i> Staff Request</a></li>
                   @elseif ( $getroledata->page_id == 13)
                          @if(auth()->user()->role_id == 11)  
                <li><a href="{{url('profile')}}"><i class="fas fa-user mr-2"></i> Profile</a></li>
                @else
                 <li><a href="{{url('profile')}}"><i class="fas fa-user mr-2"></i> Profile</a></li>
                @endif
                   @elseif ( $getroledata->page_id == 14)
              
                   <li><a href="{{url('asset')}}"><i class="typcn typcn-shopping-bag mr-2"></i>Asset</a></li>
                 @elseif ( $getroledata->page_id == 15)
              
                   <li><a href="{{url('teamprofile')}}"><i class="typcn typcn-document-delete outline mr-2"></i>Team Profile</a></li>
                @elseif ( $getroledata->page_id == 16)
      
                 <li><a href="{{url('ticketsupport')}}"><i class="typcn typcn-ticket mr-2"></i>Ticket Support</a></li>
               @elseif ( $getroledata->page_id == 17)
      
                     <li><a href="{{url('appointmentletter')}}"><i class="typcn typcn-edit d-block mr-2"></i> Appointment letter</a></li>
				   @elseif ( $getroledata->page_id == 18)
      
                     <li><a href="{{url('conversion')}}"><i class="typcn typcn-document-delete outline mr-2"></i> Conversion List</a></li>
				 @elseif ( $getroledata->page_id == 19)
      
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-group-outline d-block mr-2"></i>
                        Human Resources
                    </a>
                    <ul class="nav-second-level">
                       <li><a href="{{url('travel')}}"> Travel</a></li>
						  <li><a href="{{url('fullandfinal')}}">Full and Final</a></li>
						  <li><a href="{{url('employeereferral')}}">Employeereferral</a></li>
						 <li><a href="{{url('reimbursementclaim')}}">Reimbursement Claim</a></li>
						 <li><a href="{{url('localconveyance')}}">localconveyance Form</a></li>
							 <li><a href="{{url('outstationconveyance')}}">Outstationconveyance Form</a></li>
						 <li><a href="{{url('policy')}}">Policy</a></li>
                    </ul>
                </li>
                     
              @elseif ( $getroledata->page_id == 20)
                <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-group-outline d-block mr-2"></i>
                        Lead
                    </a>
                    <ul class="nav-second-level">
                        <li><a href="{{url('lead')}}">Lead Raised</a></li>
                        <li><a href="{{url('pbd')}}">Minutes of Meeting</a></li>
                    </ul>
                </li>
				 
              @if(auth()->user()->role_id == 11)   
              <li><a href="{{url('clientcontact')}}"><i class="typcn typcn-phone mr-2"></i> Phone Directory</a></li>
              <li><a href="{{url('clientfile')}}"><i class="typcn typcn-folder mr-2"></i> File Directory</a></li>
                <li><a href="{{url('backup')}}"><i class="typcn typcn-download mr-2"></i> Database Backup</a></li>
          
                 <li><a href="{{url('activitylog')}}"><i class="typcn typcn-time d-block mr-2"></i>Activity Log</a></li>
				 <li><a href="{{url('userlog')}}"><i class="typcn typcn-watch d-block mr-2"></i>User Log</a></li>
            <li><a href="{{url('connection')}}"><i class="typcn typcn-edit d-block mr-2"></i>Connection</a></li>
				  <li><a href="{{url('traininglist')}}"><i class="typcn typcn-group-outline d-block mr-2"></i>Training List</a></li>
          @endif
               
               @endif
              
                @endforeach
					  @if(auth()->user()->teammember_id == 99)   
				 <li><a href="{{url('teammember')}}"><i class="typcn typcn-user-add-outline mr-2"></i>Team</a></li>
				@endif
				  @if(auth()->user()->teammember_id == 156)   
				 <li><a href="{{url('connection')}}"><i class="typcn typcn-edit d-block mr-2"></i>Connection</a></li>
				@endif
					  @if(auth()->user()->teammember_id == 343)   
				 <li><a href="{{url('appointmentletter')}}"><i class="typcn typcn-edit d-block mr-2"></i> Appointment letter</a></li>
				@endif
				
				  @if(auth()->user()->teammember_id == 23)   
				  <li>
                    <a class="has-arrow material-ripple" href="#">
                        <i class="typcn typcn-group-outline d-block mr-2"></i>
                        Human Resources
                    </a>
                    <ul class="nav-second-level">
                       <li><a href="{{url('travel')}}"> Travel</a></li>
						  <li><a href="{{url('fullandfinal')}}">Full and Final</a></li>
						  <li><a href="{{url('employeereferral')}}">Employee Referral</a></li>
						 <li><a href="{{url('reimbursementclaim')}}">Reimbursement Claim</a></li>
						 <li><a href="{{url('localconveyance')}}">local Conveyance Form</a></li>
						 <li><a href="{{url('outstationconveyance')}}">Outstation Conveyance Form</a></li>
                    </ul>
                </li>
				@endif
				
                
                  <li><a href="{{url('userprofile/'.Auth::user()->id)}}"><i class="typcn typcn-user-outline mr-2"></i> My Profile</a></li>
            @if(auth()->user()->teammember_id != 6)   
				@php 
 $training = App\Models\Training::where('teammember_id', auth()->user()->teammember_id ??'')->first();
 @endphp
					@endif 
            </ul>
        </nav>
    </div><!-- sidebar-body -->
</nav>