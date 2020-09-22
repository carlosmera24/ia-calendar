<template>
    <div>
        <h4 class="title has-text-weight-bold is-size-5 mx-6 mb-3" v-if="visibleTitle">Personaliza tu muro</h4>
        <section class="content px-6 py-4">
            Sección para contenido del muro o acciones de la aplicación
        </section>
    </div>
</template>
<script>
export default {
    props:[
        'showTitle'
    ],
    data() {
        return {
            visibleTitle: this.showTitle != null ? this.showTitle : true,
        }
    },
}
</script>
