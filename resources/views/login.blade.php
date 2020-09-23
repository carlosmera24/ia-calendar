@extends('layouts.main')
@section('title','Iniciar sesión')
@section('content')
<div class="login">

    <section class="hero is-dark is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-white">IA Calendar</h3>
                    <hr class="login-hr">
                    <div class="box">
                        <figure class="avatar">
                            <img class="is-128x128" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar">
                        </figure>
                        <login-form
                            v-bind:csrf_token="'{{ csrf_token() }}'"
                            v-bind:url_home="'{{ route('home') }}'"
                            v-bind:url_login="'{{ route('start_login') }}'"></login-form>
                    </div>
                    <p class="has-text-grey">
                        <a href="../">Sign Up</a> &nbsp;·&nbsp;
                        <a href="../">Forgot Password</a> &nbsp;·&nbsp;
                        <a href="../">Need Help?</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
