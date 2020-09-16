<template>
    <div>
        <div v-for="(obj, index) in info"
            :key="index">
            <div class="tile-info is-ancestor my-0 mx-0">
                <div class="tile is-parent mb-0 py-0 px-0">
                    <article v-for="(item, objIndex) in obj"
                        :key="objIndex"
                        class="tile is-child is-6 py-6 px-6">
                        <div class="container is-pulled-right has-text-black has-text-centered">
                            <p class="title has-text-black">{{ item.titulo }}</p>
                            <p class="subtitle has-text-black is-size-4">{{ item.subtitulo }}</p>
                            <div class="button-info">
                                <a href="" class="button-info-content">Explorar <i class="fas fa-caret-right"></i></a></div>
                            <p class="more-info is-size-6">Más información <i class="fas fa-caret-square-down is-size-7"></i></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                info: [
                        [
                            {
                                titulo: 'TITULO1',
                                subtitulo: "Información1"
                            },
                            {
                                titulo: 'TITULO2',
                                subtitulo: "Información2"
                            }
                        ],
                        [
                            {
                                titulo: 'TITULO3',
                                subtitulo: "Información3"
                            },
                            {
                                titulo: 'TITULO4',
                                subtitulo: "Información4"
                            },
                        ]
                ]
            }
        },
    }
</script>
