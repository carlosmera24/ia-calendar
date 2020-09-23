<template>
    <b-carousel
        :autoplay="true"
        :pause-hover="true"
        :interval="5000"
        :indicator="false">
        <b-carousel-item v-for="(item, i) in banners" :key="i">
            <div class="hero-body pb-4">
                <div class="container has-text-centered">
                    <h1 class="title pb-2 is-size-2 has-text-weight-bold" v-html="item.titulo">
                    </h1>
                    <h2 class="subtitle has-text-weight-bold is-size-4">
                        {{ item.subtitulo }}
                    </h2>
                </div>
            </div>
        </b-carousel-item>
    </b-carousel>
</template>
<script>
    export default {
        data() {
            return {
                banners: [
                    { titulo: "LLEVA TU VIDA EN ORDEN", subtitulo: "sincroniza el tiempo en el menor orden" },
                    { titulo: "MÁS QUE UN PROGRAMADOR,<br>TU VIDA SANA", subtitulo: "IA CALENDAR" },
                    { titulo: "TU CALENDARIO SIEMPRE,<br>AL ALCANCE DE TU MANO", subtitulo: "IA CALENDAR" }
                ]
            }
        },

    }
</script>
