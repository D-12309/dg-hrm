@extends('backend.layouts.app')
@section('title', @$data['title'])
@section('content')
    <div class="content-wrapper dashboard-wrapper mt-30">
        <!-- Main content -->
        <section class="content p-0">
            @include('backend.partials.staff_navbar')
            <div class="container-fluid table-filter-container border-radius-5 p-imp-30">
                <div class="main-panel">
                    <div class="vertical-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 pr-md-3 tab-menu">
                                <div class="card card-with-shadow border-0">

                                    {{-- @dd($data['show']->original['data']) --}}
                                    <div class="px-primary py-primary">
                                        <div role="tablist" aria-orientation="vertical"
                                             class="nav flex-column nav-pills">
                                             <div class="card-body box-profile">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                         src="{{ $data['show']->original['data']['avatar'] }}"
                                                         alt="User profile picture">
                                                </div>

                                                <h3 class="profile-username text-center">{{ @$data['show']->name }}</h3>

                                            </div>
                                            {{-- Vertical Tab start here --}}
                                            <a href="{{ route('staff.profile','official') }}"
                                               class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('staff.profile','official') ? 'active' : '' }}"><span>{{ _trans('common.Official') }}</span>
                                                <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                               width="24"
                                                                               height="24" viewBox="0 0 24 24"
                                                                               fill="none" stroke="currentColor"
                                                                               stroke-width="2" stroke-linecap="round"
                                                                               stroke-linejoin="round"
                                                                               class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg></span></a>

                                            <a href="{{ route('staff.profile', 'personal') }}"
                                               class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('staff.profile', 'personal') ? 'active' : '' }}"><span>{{ _trans('common.Personal') }}</span>
                                                <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                               width="24"
                                                                               height="24" viewBox="0 0 24 24"
                                                                               fill="none" stroke="currentColor"
                                                                               stroke-width="2" stroke-linecap="round"
                                                                               stroke-linejoin="round"
                                                                               class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg></span>
                                            </a>
                                            @if(auth()->user()->role_id != 1)
                                                <a href="{{ route('staff.profile', 'financial') }}"
                                                class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('staff.profile', 'financial') ? 'active' : '' }}"><span>{{ _trans('common.Financial') }}</span>
                                                    <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg></span></a>

                                                

                                                <a href="{{ route('staff.profile', 'emergency') }}"
                                                class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('user.profile', [$data['id'], 'emergency']) ? 'active' : '' }}"><span>{{ _trans('common.Emergency') }}</span>
                                                    <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg></span>
                                                </a>
                                            @endif
                                            @if(auth()->user()->is_admin == 1) <a href="{{ route('staff.profile', 'company') }}"
                                                class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('user.profile', [$data['id'], 'company']) ? 'active' : '' }}"><span>{{ _trans('common.Company') }}</span>
                                                    <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24"
                                                                                height="24" viewBox="0 0 24 24"
                                                                                fill="none" stroke="currentColor"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="feather feather-chevron-right">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg></span>
                                                </a>
                                            @endif
                                            {{-- <a href="{{ route('user.profile', [$data['id'], 'security']) }}"
                                               class="text-capitalize tab-item-link d-flex justify-content-between my-2 my-sm-3 {{ url()->current() === route('user.profile', [$data['id'], 'security']) ? 'active' : '' }}"><span>Security</span>
                                                <span class="active-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                                               width="24"
                                                                               height="24" viewBox="0 0 24 24"
                                                                               fill="none" stroke="currentColor"
                                                                               stroke-width="2" stroke-linecap="round"
                                                                               stroke-linejoin="round"
                                                                               class="feather feather-chevron-right">
                                                    <polyline points="9 18 15 12 9 6"></polyline>
                                                </svg></span>
                                            </a> --}}

                                            {{-- Vertical Tab end here --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 pl-md-3 pt-md-0 pt-sm-4 pt-4">
                                <div class="card card-with-shadow border-0">
                                    <div class="tab-content px-primary">
                                        @if (url()->current() === route('staff.profile','official'))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5
                                                            class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                                        Official</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Name') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['name'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Email') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['email'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Department') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['department'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Designation') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['designation'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Joining date')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['joining_date'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Employee type')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{-- {{ $data['show']->original['data']['employee_type'] ?? 'N/A' }} --}}
                                                                                {{  $data['show']->original['data']['employee_type'] ? _trans('settings.'.$data['show']->original['data']['employee_type']): 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Employee id')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['employee_id'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Manager') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['manager'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Grade') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['grade'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (url()->current() === route('staff.profile', 'personal'))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5
                                                            class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                                        {{ _trans('user.Personal') }}</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Gender') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['gender'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Phone') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['phone'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Date of birth')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['birth_date'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Address') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['address'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Nationality') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['nationality'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.NID card number')}}</label>
                                                                        <div class="col-sm-7">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['nid_card_number'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            @if($data['show']->original['data']['nid_card_id'] != null)
                                                                                <a href="{{ uploaded_asset($data['show']->original['data']['nid_card_id']) }}"
                                                                                    target="_blank">
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>

                                                                            @endif

                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Passport') }}</label>
                                                                        <div class="col-sm-7">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['passport_number'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            @if($data['show']->original['data']['passport_file'] != null)
                                                                                <a href="{{ uploaded_asset($data['show']->original['data']['passport_file']) }}"
                                                                                target="_blank">
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Blood group')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['blood_group'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Social media')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                @if ($data['show']->original['data']['facebook_link'])
                                                                                    <a href="{{ $data['show']->original['data']['facebook_link'] ?? 'N/A' }}"
                                                                                       target="_blank">
                                                                                        <img src="{{ asset('public/images/facebook.svg') }}"
                                                                                             alt="">
                                                                                    </a>
                                                                                @endif
                                                                                @if ($data['show']->original['data']['linkedin_link'])
                                                                                    <a href="{{ $data['show']->original['data']['linkedin_link'] ?? 'N/A' }}"
                                                                                       target="_blank">
                                                                                        <img src="{{ asset('public/images/linkedin.svg') }}"
                                                                                             alt="">
                                                                                    </a>
                                                                                @endif
                                                                                @if ($data['show']->original['data']['instagram_link'])
                                                                                    <a href="{{ $data['show']->original['data']['instagram_link'] ?? 'N/A' }}"
                                                                                       target="_blank">
                                                                                        <img src="{{ asset('public/images/instagram.svg') }}"
                                                                                             alt="">
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (url()->current() === route('staff.profile', 'financial'))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5
                                                            class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                                        {{ _trans('user.Financial') }}</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.TIN') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['tin'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Bank name')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['bank_name'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Bank account')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['bank_account'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (url()->current() === route('staff.profile', 'emergency'))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5
                                                            class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                                        {{ _trans('common.Emergency') }}</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Name') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['emergency_name'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{_trans('user.Mobile number')}}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['emergency_mobile_number'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('user.Relationship') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['emergency_mobile_relationship'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (url()->current() === route('user.profile', [$data['id'], 'security']))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">{{ _trans('user.Security Info') }}</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label for="old_password" class="col-sm-2 col-form-label">{{_trans('common.Old Password')}}</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="password" class="form-control" name="old_password"
                                                                                   id="old_password" placeholder="********">
                                                                            <small class="text-danger __old_password"></small>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputSkills" class="col-sm-2 col-form-label">{{ _trans('common.New Password') }}</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="password" class="form-control" name="password"
                                                                                   id="inputSkills" placeholder="********">
                                                                            <small class="text-danger __password"></small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="password_confirmation" class="col-sm-2 col-form-label">{{ _trans('common.Confirm Password') }}</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="password" class="form-control"
                                                                                   id="password_confirmation"
                                                                                   name="password_confirmation" placeholder="********">
                                                                            <small class="text-danger __password_confirmation"></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (url()->current() === route('staff.profile', 'company'))
                                            <div id="Official" class="tab-pane active">
                                                <div class="d-flex justify-content-between">
                                                    <h5
                                                            class="d-flex align-items-center text-capitalize mb-0 title tab-content-header">
                                                        {{ _trans('common.Company Info') }}</h5>
                                                </div>
                                                <div class="content py-primary">
                                                    <div id="General-0">
                                                        <fieldset class="form-group mb-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Name') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ $data['show']->original['data']['company_info']['name'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Email') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['company_info']['email'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Phone') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['company_info']['phone'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Total employee') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['company_info']['total_employee'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Business Type') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['company_info']['business_type'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="form-group row">
                                                                        <label
                                                                                class="col-sm-3 col-form-label text-capitalize">{{ _trans('common.Trade licence number') }}</label>
                                                                        <div class="col-sm-9">
                                                                            <div>
                                                                                {{ @$data['show']->original['data']['company_info']['trade_licence_number'] ?? 'N/A' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('staff.staffProfileEditView', $data['slug']) }}"
                                                                   class="btn btn-primary float-right"><span>
                                                                </span> {{ _trans('common.Edit') }}
                                                                </a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



