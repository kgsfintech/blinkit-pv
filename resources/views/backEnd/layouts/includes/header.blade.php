<nav class="navbar-custom-menu navbar navbar-expand-lg m-0">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div>
    <!--/.sidebar toggle icon-->
    <div class="d-flex flex-grow-1">
        <ul class="navbar-nav flex-row align-items-center ml-auto">
            {{-- <li class="nav-item dropdown quick-actions">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-th-large-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="nav-grid-row row">
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-cog-outline d-block"></i>
                            <span>Settings</span>
                        </a>
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-group-outline d-block"></i>
                            <span>Users</span>
                        </a>
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-puzzle-outline d-block"></i>
                            <span>Components</span>
                        </a>
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-chart-bar-outline d-block"></i>
                            <span>Profits</span>
                        </a>
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-time d-block"></i>
                            <span>New Event</span>
                        </a>
                        <a href="#" class="icon-menu-item col-4">
                            <i class="typcn typcn-edit d-block"></i>
                            <span>Tasks</span>
                        </a>
                    </div>
                </div>
            </li> --}}
            <!--/.dropdown-->
     @php
       if(auth()->user()->role_id == 11){
           $clientnotification = App\Models\Client::where('status','0')->select('client_name','created_at')->get();
           // dd($getrole);
           }
                    else {
                        
                        $clientnotification = App\Models\Client::where('leadpartner',auth()->user()->teammember_id)->
                        where('status',0)
                        ->select('client_name','created_at')->get();
                    }
     @endphp
     @if(count($clientnotification) >0)
            <li class="nav-item dropdown notification">
                <a class="nav-link dropdown-toggle badge-dot" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <h6 class="notification-title">Notifications</h6>
                    <p class="notification-text">You have {{ count($clientnotification)}} unread notification</p>
                    <div class="notification-list">
                        @foreach($clientnotification as $clientnotificationdata)
                        <div class="media new">
                           <a href="{{ url('client')}}">
                            <div class="media-body">
                                <h6>{{ $clientnotificationdata->client_name}}</h6>
                                <span>{{ date('F d', strtotime($clientnotificationdata->created_at)) }} {{ date('h:ia', strtotime($clientnotificationdata->created_at)) }}</span>
                            </div>
                        </a>
                        </div>
                        <!--/.media -->
                        @endforeach
                    </div>
                    <!--/.notification -->
                    <div class="dropdown-footer"><a href="">View All Client</a></div>
                </div>
                <!--/.dropdown-menu -->
            </li>
            <!--/.dropdown-->
            @endif
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle" style="width: auto" href="#" data-toggle="dropdown">
                    <!--<img src="assets/dist/img/user2-160x160.png')}}" alt="">-->
                   <span style="font-weight: 500;">{{ $getuser->role->rolename ??''}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-left">
                    <div class="dropdown-header d-sm-none">
                        <a href="" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
             
                    <a href="{{url('userprofile/'.Auth::user()->id)}}" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
					 <a href="{{url('resetpassword/'.Auth::user()->teammember_id)}}" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Password Settings</a>
                   <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();" class="dropdown-item"><i class="typcn typcn-key-outline"></i> Sign
                        Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!--/.dropdown-menu -->
            </li>
        </ul>
        <!--/.navbar nav-->
        <div class="nav-clock">
            <div class="time">
                <span class="time-hours"></span>
                <span class="time-min"></span>
                <span class="time-sec"></span>
            </div>
        </div><!-- nav-clock -->
    </div>
</nav>
<!--/.navbar-->

