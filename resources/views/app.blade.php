@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="application">
        {{-- Header --}}
        <div class="header level is-mobile has-text-white is-size-7 mb-0 px-5 py-4">
            <div class="level-left">
                <img class="image is-24x24" src="falta-image.png" alt="">
            </div>
            <div class="level-right">
                <div class="columns is-mobile  is-vcentered">
                    <div class="column has-text-right">
                        NOMBRE DE LA EMPRESA
                    </div>
                    <div class="column has-text-centered is-3">
                        <div class="content-icon-user">
                            <i class="fa fa-user is-size-3 has-text-black"></i>
                        </div>
                    </div>
                    <div class="column is-1 has-text-right">
                        <div class="columns is-multiline">
                            <div class="column is-full">IC</div>
                            <div class="column is-full">IC</div>
                            <div class="column is-full">IC</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /Header --}}

        {{-- Menu Section --}}
        <section class="menu">
            Aquí va el menu principal de la aplicación
        </section>
        {{-- /Menu Section --}}

        {{-- Banner Section --}}
        <section class="banner">
            Aqui se cargara el slide/banner con transacción de imágenes, etc....
        </section>
        {{-- /Banner Section --}}

        {{-- Main Section --}}
        <section class="main">
            Aquí va la interación o zona de trabajo principal, donde se cargará todo el trabajo.
        </section>
        {{-- /Main Section --}}

    </div>
@endsection
@section('class-footer','application')
