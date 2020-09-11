@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="welcome">
        {{-- Header --}}
        <div class="header level has-text-white is-size-7 mb-0">
            <div class="level-left">
                <img class="image is-24x24" src="falta-image.png" alt="">
            </div>
            <div class="level-right">
                <a href="#" class="has-text-white">
                    Iniciar <i class="fa fa-user is-size-4"></i>
                </a>
            </div>
        </div>
        <div class="header-separator"></div>
        <section class="banner hero  is-bold has-text-centered">
            <div class="hero-body">
                <div class="container ">
                    <h1 class="title has-text-white">
                        MÁS QUE UN PROGRAMADOR,<br>TU VIDA SANA
                    </h1>
                    <h2 class="subtitle has-text-white">
                        IA CALENDAR
                    </h2>
                </div>
            </div>
        </section>
    </div>
@endsection
