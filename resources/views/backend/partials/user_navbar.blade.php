<nav class="vertical-menu navbar navbar-expand-lg navbar-light bg-light"
    style="background-color: #fff !important; margin-bottom:25px">
    <button class="navbar-toggler ml-3 ml-md-3" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ml-sm-4 ml-md-4 ml-lg-1 ml-xl-1" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link {{ menu_active_by_route('userProfile') }}"
                    href="{{ url('dashboard/user/show/' . $data['id'] . '/official') }}">
                    {{ _trans('common.Profile') }}
                </a>
            </li>
            {{-- @dd($data) --}}
            @if(auth()->user()->role_id != 1)
            
            <li class="nav-item dropdown">
                <a class="nav-link  {{ menu_active_by_route('user.attendance') }}"
                    href="{{ route('user.attendance', $data['id']) }}">
                    {{ _trans('common.Attendance') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_route('user.notice') }}" href="{{ route('user.notice', $data['id']) }}">
                    {{ _trans('common.Notices') }}
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link  {{ menu_active_by_route('user.leaveRequest') }}"
                    href="{{ route('user.leaveRequest', $data['id']) }}">
                    {{ _trans('common.Leaves') }}
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ menu_active_by_route('user.visit') }} {{ menu_active_by_route('user.visitHistory') }}  dropdown-toggle"
                    href="#" id="navbarDropdown5" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ _trans('common.Visit') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown5">
                    <a class="dropdown-item" href="{{ route('visit.user', $data['id']) }}">{{ _trans('common.Schedule') }}</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ menu_active_by_route('user.phonebook') }}"
                    href="{{ route('user.phonebook', $data['id']) }}">{{ _trans('common.Phonebook') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ menu_active_by_route('user.appointment') }}"
                    href="{{ route('user.appointment', $data['id']) }}">{{ _trans('appointment.Appointment') }}</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{menu_active_by_route('user.supportTicket')}}" href="{{ route('user.supportTicket') }}">Support
                    Ticket</a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'support'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'support']) }}">
                    {{ _trans('common.Support Ticket') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'advance'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'advance']) }}">
                    {{ _trans('common.Advance') }}
                </a>
            </li>
            {{-- {{dd(route('userProfile.info',['user_id'=>$data['id'],'type'=>'salary'])) }} --}}
            {{-- Route with multiple parameters --}}
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'commission'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'commission']) }}">
                    {{ _trans('common.Commission') }}
                </a>
            </li>
            {{-- @dd($data) --}}
           



            
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'salary'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'salary']) }}">
                    {{ _trans('common.Salary') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'project'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'project']) }}">
                    {{ _trans('common.Project') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'tasks'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'tasks']) }}">
                    {{ _trans('common.Tasks') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'award'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'award']) }}">
                    {{ _trans('common.Awards') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ menu_active_by_url(route('userProfile.info',['user_id'=>$data['id'],'type'=>'travel'])) }}"
                    href="{{ route('userProfile.info',['user_id'=>$data['id'],'type'=>'travel']) }}">
                    {{ _trans('common.Travels') }}
                </a>
            </li>
            @endif
      </ul>
    </div>
</nav>
