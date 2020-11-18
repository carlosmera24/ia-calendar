@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="welcome">
        {{-- Header --}}
        <div class="header level is-mobile has-text-white is-size-7 mb-0">
            <div class="level-left">
                <img class="image is-32x32" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar's">
            </div>
            <div class="level-right">
                <a href="{{ route('home') }}" class="has-text-white">
                    @lang('welcome.start') <i class="fa fa-user is-size-4"></i>
                </a>
            </div>
        </div>
        {{-- /Header --}}
        <div class="header-separator"></div>

        <section class="banner hero  is-bold has-text-centered">
            <banner-carusel />
        </section>

        <section class="banner-service is-size-5 has-text-white has-text-centered my-3">
            <p>@lang('welcome.service')</p>
            <img src="logo.png" alt="INFRACOUNTER">
        </section>
        <div class="banner-service-separator"></div>

        <section class="banner-suscritor has-text-white has-text-centered my-4">
            <p class="has-text-weight-bold is-size-3">@lang('welcome.suscribe') <span class="is-size-5">&#9688;</span></p>
            <p class="is-size-4">@lang('welcome.suscribe_price')</p>
        </section>

        <section class="banner-info">
            <banner-info
                v-bind:text_more="'{{ __('welcome.more_information') }}'"
                v-bind:text_explore="'{{ __('welcome.explore') }}'">
            </banner-info>
        </section>

        <section class="banner-donation has-text-centered py-6">
            <h2 class="has-text-white has-text-weight-bold is-size-3">@lang('welcome.donation')</h2>
        </section>
    </div>
@endsection
