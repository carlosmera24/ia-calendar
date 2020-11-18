@extends('layouts.main')
@section('title','Iniciar sesión')
@section('class-footer','is-hidden')
@section('content')
<div class="login">

    <section class="hero is-dark is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-white">IA Calendar's</h3>
                    <hr class="login-hr">
                    <div class="box">
                        <figure class="avatar">
                            <img class="is-128x128" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar's">
                        </figure>
                        @php
                            $fields = array(
                                'user'  =>  array(
                                    'placeholder'   => __('validation.attributes.username'),
                                    'error' => false,
                                    'msg'   =>  __('validation.required', ['attribute' => ''])
                                ),
                                'password'  =>  array(
                                    'placeholder'   => __('validation.attributes.password'),
                                    'error' => false,
                                    'msg'   =>  __('validation.required', ['attribute' => ''])
                                ),
                                'login' => array(
                                    'placeholder' =>  __('login.login')
                                )
                            );
                        @endphp
                        <login-form
                            v-bind:csrf_token="'{{ csrf_token() }}'"
                            v-bind:url_home="'{{ route('home') }}'"
                            v-bind:url_login="'{{ route('start_login') }}'"
                            v-bind:fields_json="'{{ json_encode($fields) }}'">
                        </login-form>
                    </div>
                    <p class="has-text-grey">
                        <a href="../">{{ ucfirst( __('login.sign_up') ) }}</a> &nbsp;·&nbsp;
                        <a href="../">{{ ucfirst( __('login.forgot_password') ) }}</a> &nbsp;·&nbsp;
                        <a href="../">{{ ucfirst( __('login.need_help') ) }}</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
