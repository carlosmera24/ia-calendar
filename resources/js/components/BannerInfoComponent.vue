<template>
    <div>
        <div v-for="(obj, index) in info"
            :key="index">
            <div class="tile-info is-ancestor my-0 mx-0">
                <div class="tile is-parent mb-0 py-0 px-0">
                    <article v-for="(item, objIndex) in obj"
                        :key="objIndex"
                        class="tile is-child is-6 py-5 px-5 ">
                        <div class="container is-pulled-right">
                            <p class="title has-text-weight-bold">{{ item.titulo }}</p>
                            <p class="subtitle">{{ item.subtitulo }}</p>
                            <p>Explorar</p>
                            <p>Más información</p>
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
