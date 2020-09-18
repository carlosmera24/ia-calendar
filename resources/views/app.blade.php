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
                        <p class="is-size-6">Nombre Administrador</p>
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
            <aside class="menu">
                <ul class="menu-list">
                    <li>
                        <span class="icon is-small"><i class="fas fa-plus"></i></span> Crear Partícipe</li>
                    <li><span class="icon is-small"><i class="fas fa-plus"></i></span> Crear Categoría</li>
                    <li>Ver calendario</li>
                    <li>Anuario Fiscal</li>
                </ul>
            </aside>
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
