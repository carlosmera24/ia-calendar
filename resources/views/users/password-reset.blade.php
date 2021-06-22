@extends('layouts.main')
@section('title','Email confirmación')
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
         <section class="hero is-large {{ isset($fails) ? 'is-danger' : '' }}">
            <div class="hero-body">
                @if( isset($fails) )
                    <div class="title">{{ $fails['error']}}</div>
                    <div class="subtilte">{{ $fails['data']}}</div>
                @elseif( isset($exists) )
                    @if( !$exists )
                        <div class="title has-text-white">
                            {{ __('messages.emails.password_reset.not_found') }}
                        </div>
                    @else
                    {{-- TODO --}}
                    {{ $password_change_request }}
                        {{-- @if( isset($actived) && $actived )
                            <div class="title has-text-white">
                            {!! __('messages.emails.confirmation.previous_confirmed', [ 'email' => $person_email->email ] ) !!}
                            </div>
                        @elseif( isset($actived) && !$actived )
                            <div class="title has-text-white">
                                {!! __('messages.emails.confirmation.success', [ 'email' => $person_email->email ] ) !!}
                            </div>
                            <div class="subtitle has-text-white">
                                {{ __('messages.emails.confirmation.success_subtitle') }}
                            </div>
                        @endif --}}
                    @endif
                @endif
            </div>
        </section>
  </div>
@endsection
