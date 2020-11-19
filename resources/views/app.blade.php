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
                            <dropdown-menu
                                v-bind:url_logout="'{{ route('logout') }}'"
                                v-bind:url_home="'{{ route('home') }}'"
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
            <main-section
                v-bind:text_title='" {{ __('app.wall.title') }} "'
                v-bind:text_trigger_events_soon_expire='" {{ __('app.wall.trigger_events_soon_expire') }} "'
                v-bind:text_add_categories='" {{ __('app.wall.add_categories') }} "'
                v-bind:text_add_notes='" {{ __('app.wall.add_notes') }} "' />
        </section>
        {{-- /Main Section --}}

    </div>
@endsection
@section('class-footer','application')
