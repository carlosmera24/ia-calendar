<template>
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
                <a href="#" class="dropdown-item" v-on:click="clickCerrarSesion">
                    Cerrar sesión
                </a>
                <a href="#" class="dropdown-item" v-on:click="clickDropdown">
                    <strong>Cerrar</strong>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isActiveDropdown: false,
        }
    },
    props: [
        'url_logout',
        'url_home'
    ],
    methods: {
        clickDropdown(){
            this.isActiveDropdown = !this.isActiveDropdown;
        },
        clickCerrarSesion(){
            axios.post( this.url_logout )
                .then( res => {
                    if( res.data.status === 200 ){
                        window.location.href = this.url_home;
                    }
                });
        }
    },
}
</script>
