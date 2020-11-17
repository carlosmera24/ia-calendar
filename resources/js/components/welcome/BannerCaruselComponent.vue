<template>
    <b-carousel
        :autoplay="true"
        :pause-hover="true"
        :interval="5000"
        :indicator="false">
        <b-carousel-item v-for="(item, i) in banners" :key="i">
            <div class="hero-body pb-4">
                <div class="container ">
                    <h1 class="title has-text-white pb-6" v-html="item.titulo">
                    </h1>
                    <h2 class="subtitle has-text-white">
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
                    { titulo: "MÁS QUE UN PROGRAMADOR,<br>TU VIDA SANA", subtitulo: "IA CALENDARS" },
                    { titulo: "PROGRAMA TU VIDA,<br>DE LA MEJOR MANERA", subtitulo: "IA CALENDARS" },
                    { titulo: "TU CALENDARIO SIEMPRE,<br>AL ALCANCE DE TU MANO", subtitulo: "IA CALENDARS" }
                ]
            }
        },

    }
</script>
