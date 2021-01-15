@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="application">
        @php
            $user = Auth::user();
            $programmer = null;
            $profile_participant = null;
            if(  $user->participants() != null )
            {
                $participant = $user->participants()->get()[0];
                $profile_participant = isset( $participant ) ? $participant->profiles_participants_id : null;
                if( $participant->programmer() != null )
                {
                    $programmer = $participant->programmer()->get()[0];
                }
            }
            //TODO -> Get memberships
            $numMailes = 3;
            $numMobiles = 3;

            $fields_participant =   [
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
                                                                'label'             =>  __('validation.attributes.email'),
                                                                'error'             => false,
                                                                'msg'               =>  __('validation.required', ['attribute' => '']),
                                                                'msg_validate'      =>  __('validation.email', ['attribute' => '']),
                                                                'msg_exist'         =>  __('validation.custom.email.unique', ['attribute' => __('validation.attributes.email')])
                                                            ],
                                        'mobile'        =>  [
                                                                'label' =>  __('validation.attributes.mobile'),
                                                                'error' => false,
                                                                'msg'   =>  __('validation.required', ['attribute' => '']),
                                                                'msg_validate'   =>  __('validation.mobile', ['attribute' => '']),
                                                                'msg_exist'   =>  __('validation.custom.mobile.unique', ['attribute' => __('validation.attributes.mobile')])
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
                                        'state'         =>  [
                                                                'label'         =>  __('validation.attributes.state'),
                                                                'error'         => false,
                                                                'msg'           =>  __('validation.required', ['attribute' => ''])
                                                            ],
                                        'reason_change_state'   =>  [
                                                                        'label'         =>  __('validation.attributes.reason_change_state'),
                                                                        'placeholder'   =>  __('app.participant_new.description_placeholder'),
                                                                        'error'         => false,
                                                                        'msg'           =>  __('validation.required', ['attribute' => ''])
                                                                    ],
                                    ];
            $fields_programmer =    [
                                        'entity_name'               =>  [
                                                                            'label'     =>  __('validation.attributes.entity_name'),
                                                                            'error'     => false,
                                                                            'msg'       =>  __('validation.required', ['attribute' => ''])
                                                                        ],
                                        'identifications_types_id'  =>  [
                                                                            'label'         =>  __('validation.attributes.identification_type'),
                                                                            'placeholder'   =>  __('app.general_settings.filter_identification'),
                                                                            'error'         => false,
                                                                            'msg'           =>  __('validation.required', ['attribute' => ''])
                                                                        ],
                                        'identification'            =>  [
                                                                            'label'     =>  __('validation.attributes.identification'),
                                                                            'error'     => false,
                                                                            'msg'       =>  __('validation.required', ['attribute' => ''])
                                                                        ],
                                        'logo'                      =>  [
                                                                            'label'         =>  __('validation.attributes.logo'),
                                                                            'placeholder'   =>  __('app.general_settings.logo_placeholder'),
                                                                            'error'         => false,
                                                                            'msg'           =>  __('validation.required', ['attribute' => ''])
                                                                        ],
                                    ];

            $texts_main =  [
                                'create_participant'    =>  __('app.create_participant'),
                                'create_category'       =>  __('app.create_category'),
                                'see_calendar'          =>  __('app.see_calendar'),
                                'annual_fiscal'         =>  __('app.annual_fiscal'),
                                'create_your_event' => __('app.create_your_event'),
                                'programmer'        => __('app.programmer'),
                                'category'          => __('app.category'),
                                'event'             => __('app.event'),
                            ];
            $text_general_setting = __('app.menu.general_setting');
            //Text/name for prifles ID => Name
            $names_profiles_participants = [
                                                1 => __('app.profiles_participants.administrator'),
                                                2 => __('app.profiles_participants.leader'),
                                                3 => __('app.profiles_participants.guest'),
                                                4 => __('app.profiles_participants.alternate_administrator'),
                                            ];
            //Text/name for status participants ID => Name
            $names_status_participants =    [
                                                1 => __('app.states_participants.active'),
                                                2 => __('app.states_participants.disable'),
                                                3 => __('app.states_participants.blocked'),
                                                4 => __('app.states_participants.discontinued'),
                                            ];
            //Texts for manage leader
            $texts_manage_leader = __('app.manage_leader');
            $texts_manage_leader['empty_categories_required'] = __('messages.empty_categories_required');
            $texts_manage_leader['back_to_participant_confirm'] = __('messages.back_to_participant_confirm');
            $texts_manage_leader['back_to_participant_warning'] = __('messages.back_to_participant_warning');
            $texts_manage_leader['names_status_participants'] = $names_status_participants;
            //Texts for general settings
            $texts_general_settings = __('app.general_settings');
            $texts_general_settings['text_general_setting'] = $text_general_setting;
            $texts_general_settings['names_profiles_participants'] = $names_profiles_participants;
        @endphp
        {{-- Header --}}
        <div class="header level is-mobile has-text-white is-size-7 mb-0 px-5 py-4">
            <div class="level-left">
                <img class="image is-64x64" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar's">
            </div>
            <div class="level-right">
                <div class="columns is-mobile  is-vcentered">
                    <div class="column has-text-right">
                        <p class="company_name is-size-6 mb-5">{{ isset($programmer) ? $programmer->entity_name : "" }}</p>
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
                            <div class="column is-full py-1 px-1">
                                {{-- DropDown --}}
                                    <dropdown-menu-setting
                                        v-bind:profile_participant="'{{ $profile_participant }}'"
                                        v-bind:url_logout="'{{ route('logout') }}'"
                                        v-bind:url_home="'{{ route('home') }}'"
                                        v-bind:text_menu_dark="'{{ __('app.menu.activate_dark_mode') }}'"
                                        v-bind:text_admin_leaders="'{{ __('app.menu.admin_leaders') }}'"
                                        v-bind:text_general_setting="'{{ $text_general_setting }}'"
                                        v-bind:text_frequent_questions="'{{ __('app.menu.frequent_questions') }}'"
                                        v-bind:text_logout="'{{ __('app.menu.logout') }}'"
                                        v-bind:text_close="'{{ __('app.menu.close') }}'"
                                    />
                                {{-- /DropDown --}}
                            </div>
                            <div class="column is-full py-1 px-1"><i class="fas fa-search"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Header --}}
        {{-- Content Main --}}
        <content-main
            v-bind:texts_main_json="'{{ json_encode($texts_main) }}'"
            v-bind:text_breadcrumbs_init='"{{ __('app.breadcrumbs_init') }}"'
            v-bind:numbers_emailes="'{{ $numMailes }}'"
            v-bind:numbers_mobiles="'{{ $numMobiles }}'"
            v-bind:programmer_json="'{{ str_replace("'", "\'",json_encode($programmer)) }}'"
            v-bind:text_field_required='"{{ __('validation.required', ['attribute' => '']) }} "'
            v-bind:text_success='"{{ __('messages.success') }} "'
            v-bind:text_no_options='"{{ __('messages.no_options') }} "'
            v-bind:text_loading='"{{ __('messages.loading') }} "'
            v-bind:text_wall_title='"{{ __('app.wall.title') }} "'
            v-bind:text_wall_trigger_events_soon_expire='"{{ __('app.wall.trigger_events_soon_expire') }}"'
            v-bind:text_wall_add_categories='"{{ __('app.wall.add_categories') }}"'
            v-bind:text_wall_add_notes='"{{ __('app.wall.add_notes') }} "'
            v-bind:text_participant_title='" {{ __('app.participant_new.title') }}"'
            v-bind:text_created_participant='" {{ __('messages.created_participant') }}"'
            v-bind:text_updated_participant='" {{ __('messages.updated_participant') }}"'
            v-bind:text_accept='"{{ __('validation.attributes.accept') }}"'
            v-bind:text_apply='"{{ __('validation.attributes.apply') }}"'
            v-bind:text_cancel='"{{ __('validation.attributes.cancel') }}"'
            v-bind:text_not='"{{ __('validation.attributes.not') }}"'
            v-bind:text_participant_fields_json="' {{ json_encode($fields_participant) }} '"
            v-bind:text_admin_leaders="'{{ __('app.menu.admin_leaders') }}'"
            v-bind:user_id="'{{ $user->id }}'"
            v-bind:profile_participant="'{{ $profile_participant }}'"
            v-bind:texts_manage_leader_json="'{{ json_encode($texts_manage_leader) }}'"
            v-bind:texts_general_settings_json="'{{ json_encode($texts_general_settings) }}'"
            v-bind:profiles_participants_names_json="'{{ json_encode($names_profiles_participants) }}'"
            v-bind:fields_programmer_json="'{{ json_encode($fields_programmer) }}'"
            v-bind:url_person_ui_avatar='"{{ route('participant_generate_avatar') }}"'
            v-bind:url_person_store='"{{ route('person_store') }}"'
            v-bind:url_participant_store='"{{ route('participant_store') }}"'
            v-bind:url_participant_update='"{{ route('participant_update') }}"'
            v-bind:urls_emails_store='"{{ route('persons_emails_store_array') }}"'
            v-bind:urls_mobiles_store='"{{ route('persons_mobiles_store_array') }}"'
            v-bind:url_person_email_exist='"{{ route('persons_emails_exists') }}"'
            v-bind:url_person_cellphone_exist='"{{ route('persons_cellphones_exists') }}"'
            v-bind:url_participants_programmer='"{{ route('participants_list_programmer') }}"'
            v-bind:url_categories_programmer='"{{ route('list_categories_from_programmer') }}"'
            v-bind:url_permissions_participant='"{{ route('list_permissions') }}"'
            v-bind:url_store_permissions_participant='"{{ route('permissions_participants_store') }}"'
            v-bind:url_participant_categories='"{{ route('list_participant_categories') }}"'
            v-bind:url_store_participants_categories='"{{ route('participants_categories_store') }}"'
            v-bind:url_identifications_types='"{{ route('list_identifications_types') }}"'
        />
        {{-- /Content Main --}}
    </div>
@endsection
@section('class-footer','application')
