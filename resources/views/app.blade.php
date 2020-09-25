@extends('layouts.main')
@section('title','Bienvenido')
@section('content')
    <div class="application">
        {{-- Header --}}
        <div class="header level is-mobile has-text-white is-size-7 mb-0 px-5 py-4">
            <div class="level-left">
                <img class="image is-64x64" src="{{ asset('img/logo-128.png') }}" alt="IA-Calendar">
            </div>
            <div class="level-right">
                <div class="columns is-mobile  is-vcentered">
                    <div class="column has-text-right">
                        {{-- DropDown --}}
                            <dropdown-menu
                                v-bind:url_logout="'{{ route('logout') }}'"
                                v-bind:url_home="'{{ route('home') }}'"></dropdown-menu>
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
            <div class="columns is-mobile">
                <aside class="menu column is-one-quarter">
                    <ul class="menu-list">
                        <li><i class="fas fa-plus is-size-7"></i> Crear Partícipe</li>
                        <li><i class="fas fa-plus is-size-7"></i> Crear Categoría</li>
                        <li>Ver calendario</li>
                        <li>Anuario Fiscal</li>
                    </ul>
                </aside>
                <div class="column">
                    <div class="columns columns-buttons my-0">
                        <div class="column is-half-desktop is-two-fifths-table vcentered">
                            <button class="btn-primary">Crear tu evento</button>
                        </div>
                        <div class="column">
                            <div class="columns columns-buttons-rotated is-mobile">
                                <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">Programador<br>Empresa</div></button>
                                <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">Categoría</div></button>
                                <button class="column is-3 btn-secundary mr-6"><div class="btn-rotated">Evento</div></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- /Menu Section --}}

        {{-- Banner Section --}}
        <section class="banner py-4">
            <banner-app-carusel />
        </section>
        {{-- /Banner Section --}}

        {{-- Main Section --}}
        <section class="main">
            <main-section />
        </section>
        {{-- /Main Section --}}

    </div>
@endsection
@section('class-footer','application')
