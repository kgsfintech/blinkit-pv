  <!-- Sidebar  -->
 
  <nav class="sidebar sidebar-bunker">
      <div style=" background:#37A000;    flex-shrink: 0;
    height: 70px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0 50px;font-size: 32px;">
        <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
        <a href="{{url('client/home')}}" style="margin:0px;text-align:center;font-weight: 600;color:white;" class="logo">CapITall<br>
      </a>
      
    </div><!--/.sidebar header-->
    <a href="{{url('client/summary')}}" class="profile-element d-flex align-items-center flex-shrink-0">
      
        <div class="avatar online">
            <img src="{{ asset('img/banner/default.png') }}" class="img-fluid rounded-circle" alt="">
        </div>
        <div class="profile-text">
            <h6 class="m-0">{{ DB::table('clientlogins')->select('name')->where('id',Auth::user()->id ??'')->first()->name ?? ''}}</h6>
            <span>{{ DB::table('clients')->select('client_name')->where('id',Auth::user()->client_id ??'')->first()->client_name ?? ''}}</span>
        </div>
    </a><!--/.profile element-->
    <div class="sidebar-body">
       <nav class="sidebar-nav">
              <ul class="metismenu">
                  <li class="nav-label">Main Menu</li>

                  <li class="mm-active">
                      <a class="material-ripple" href="{{url('client/home')}}">
                          <i class="typcn typcn-home-outline mr-2"></i>
                          Dashboard
                      </a>

                  </li>
               <!--   <li><a href="{{url('client/clienttask')}}"><i class="fas fa-tasks mr-2"></i> Task</a></li>
                  <li><a href="{{url('client/particularindex')}}"><i class="far fa-comments mr-2"></i>Particular</a>
                  </li> -->
                  @php
                  $permission = DB::table('staffpermission')
                  ->where('clientlogin_id',auth()->user()->id)
                  ->where('client_id',auth()->user()->client_id)
                  ->where('staffallocate',1)->first();

                  @endphp
                  @if ( $permission != null)
                  <li><a href="{{url('client/clientuserlogin')}}"><i class="fas fa-user-friends mr-2"></i>Add Staff</a>
                  </li>
                  @endif

                  @php
                  $login = DB::table('clientassignlogins')
                  ->leftjoin('clients','clients.id','clientassignlogins.client_id')
                  ->where('clientassignlogins.clientlogin_id',auth()->user()->id)->select('clients.id','clients.client_name')->get();
                  @endphp
                  @if(1<count($login)) <li>
                      <a class="has-arrow material-ripple" href="#">
                          <i class="typcn typcn-user-add-outline mr-2"></i>
                          Switch Account
                      </a>
                      <ul class="nav-second-level">
                          @foreach($login as $loginclient)
                          <li><a
                                  href="{{ url('client/switchaccount/'. $loginclient->id) }}">{{ $loginclient->client_name}}</a>
                          </li>
                          @endforeach
                      </ul>
                      </li>
                      @endif
              </ul>
          </nav>
    </div><!-- sidebar-body -->
</nav>