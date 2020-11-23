@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="application">
        {{-- Header --}}
        <div class="header level is-mobile has-text-white is-size-7 mb-0 px-5 py-4">
            <div class="level-left">
                <img class="image is-64x64" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar's">
            </div>
            <div class="level-right">
                <div class="columns is-mobile  is-vcentered">
                    <div class="column has-text-right">
                        {{-- DropDown --}}
                            @php
                                $user = Auth::user();
                                $programmer = null;
                                if(  $user->participants() != null )
                                {
                                    $participant = $user->participants()->get()[0];
                                    if( $participant->programmer() != null )
                                    {
                                        $programmer = $participant->programmer()->get()[0];
                                    }
                                }
                            @endphp
                            <dropdown-menu
                                v-bind:url_logout="'{{ route('logout') }}'"
                                v-bind:url_home="'{{ route('home') }}'"
                                v-bind:text_company_name='"{{ isset($programmer) ? $programmer->entity_name : "" }}"'
                                v-bind:text_menu_dark="'{{ __('app.menu.activate_dark_mode') }}'"
                                v-bind:text_admin_leaders="'{{ __('app.menu.admin_leaders') }}'"
                                v-bind:text_general_setting="'{{ __('app.menu.general_setting') }}'"
                                v-bind:text_frequent_questions="'{{ __('app.menu.frequent_questions') }}'"
                                v-bind:text_logout="'{{ __('app.menu.logout') }}'"
                                v-bind:text_close="'{{ __('app.menu.close') }}'">
                            </dropdown-menu>
                        {{-- /DropDown --}}
                        <p class="is-size-6">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="column has-text-centered is-3 py-0 px-0">
                        <div class="content-icon-user">
                            <i class="fa fa-user icon has-text-black"></i>
                        </div>
                    </div>
                    <div class="column is-2 has-text-right tools">
                        <div class="columns is-multiline is-0 is-variable is-size-5">
                            <div class="column is-full py-1 px-1"><i class="fas fa-bell"></i></div>
                            <div class="column is-full py-1 px-1"><i class="fas fa-cog"></i></div>
                            <div class="column is-full py-1 px-1"><i class="fas fa-search"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Header --}}

        {{-- Menu Section --}}
        <section class="action-section px-5 py-5">
            <main-menu-section
                v-bind:text_create_participant='" {{ __('app.create_participant') }}"'
                v-bind:text_create_category='" {{ __('app.create_category') }}"'
                v-bind:text_see_calendar='" {{ __('app.see_calendar') }}"'
                v-bind:text_anual_fiscal='" {{ __('app.annual_fiscal') }}"'
                v-bind:text_create_your_event='" {{ __('app.create_your_event') }}"'
                v-bind:text_programmer='" {{ __('app.programmer') }}"'
                v-bind:text_category='" {{ __('app.category') }}"'
                v-bind:text_event='" {{ __('app.event') }}"' />
        </section>
        {{-- /Menu Section --}}

        {{-- Banner Section --}}
        <section class="banner py-4">
            <banner-app-carusel />
        </section>
        {{-- /Banner Section --}}

        {{-- Main Section --}}
        <section class="main">
            @php
                $fields_participant = [
                    'first_name'    =>  [
                                            'label' =>  __('validation.attributes.first_name'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'last_name'     =>  [
                                            'label' =>  __('validation.attributes.last_name'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'email'         =>  [
                                            'label' =>  __('validation.attributes.email'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'mobile'        =>  [
                                            'label' =>  __('validation.attributes.mobile'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'position'      =>  [
                                            'label' =>  __('validation.attributes.position_company'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'date_join'     =>  [
                                            'label' =>  __('validation.attributes.date_join_company'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'birth_date'    =>  [
                                            'label' =>  __('validation.attributes.birth_date'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'profile_image' =>  [
                                            'label' =>  __('validation.attributes.profile_image'),
                                            'error' => false,
                                            'msg'   =>  __('validation.required', ['attribute' => ''])
                                        ],
                    'description'   =>  [
                                            'label'         =>  __('validation.attributes.description'),
                                            'placeholder'   =>  __('app.participant_new.description_placeholder'),
                                            'error'         => false,
                                            'msg'           =>  __('validation.required', ['attribute' => ''])
                                        ],
                ];
            @endphp
            <main-section
                v-bind:text_wall_title='" {{ __('app.wall.title') }} "'
                v-bind:text_wall_trigger_events_soon_expire='" {{ __('app.wall.trigger_events_soon_expire') }} "'
                v-bind:text_wall_add_categories='" {{ __('app.wall.add_categories') }} "'
                v-bind:text_wall_add_notes='" {{ __('app.wall.add_notes') }} "'
                v-bind:text_participant_title='" {{ __('app.participant_new.title') }} "'
                v-bind:text_accept='" {{ __('validation.attributes.accept') }} "'
                v-bind:text_cancel='" {{ __('validation.attributes.cancel') }} "'
                v-bind:text_participant_fields_json="' {{ json_encode($fields_participant) }} '"
            />
        </section>
        {{-- /Main Section --}}

    </div>
@endsection
@section('class-footer','application')
