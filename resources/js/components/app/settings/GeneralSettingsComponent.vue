<template lang="">
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <div class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li>
                    <a href="#" v-on:click.prevent="clickCancel">
                        <span class="icon is-small">
                            <i class="fas fa-home" aria-hidden="true"></i>
                        </span>
                        <span>{{ text_breadcrumbs_init }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <h2>{{ text_general_setting }} falta agregar el perfil</h2>
        <p>Agregar menú activo al menú de configuración</p>
    </div>
</template>
<script>
    export default {
        props: [
            'text_breadcrumbs_init',
            'text_general_setting',
        ],
        data() {
            return {
                isLoading: false,
            }
        },
        methods: {
            clickCancel(){
                this.$emit('activeMainSection','main')
            },
        }
    }
</script>
