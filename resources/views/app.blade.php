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
                        <div class="dropdown" :class="{ 'is-active' : isActiveDropdown }">
                            <div class="dropdown-trigger">
                                <button class="btn is-size-6 mb-5" aria-haspopup="true" aria-controls="dropdown-menu" v-on:click="clickDropdown">
                                    <span>Nombre empresa</span>
                                    <span class="icon is-small">
                                        <i class="fas fa-caret-down" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                <div class="dropdown-content has-text-left">
                                    <a href="#" class="dropdown-item">
                                        Activar modo noche
                                    </a>
                                    <a class="dropdown-item">
                                        Administrar lideres
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Configuración general
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Preguntas frecuentes
                                    </a>
                                    <a href="#" class="dropdown-item" v-on:click="clickDropdown">
                                        <strong>Cerrar</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
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
