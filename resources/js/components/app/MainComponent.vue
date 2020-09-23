<template>
    <div>
        <h4 class="title has-text-weight-bold is-size-5 mx-6 mb-3" v-if="visibleTitle">Personaliza tu muro</h4>
        <section class="content px-6 py-6">
            <div class="events-expire">
                <div class="columns my-0">
                    <div class="column add-more mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                    <div class="column mr-5"></div>
                    <div class="column mr-5"></div>
                    <div class="column mr-5"></div>
                </div>
                <p class="is-size-6 has-text-white my-4">
                    <span class="is-size-7">&#9688;</span> Activar eventos pronto a vencerse (30 días) <i class="fas fa-lg fa-caret-down"></i>
                </p>
            </div>
            <div class="categories-favorites pt-6">
                <div class="columns my-0">
                    <div class="column add-more is-2 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                    <div class="column add-more is-2 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                    <div class="column is-2 mr-5"></div>
                </div>
                <p class="is-size-6 has-text-white my-4"><span class="is-size-7">&#9688;</span> Agregar categorías</p>
            </div>
            <div class="notes pt-6">
                <div class="columns my-0">
                    <div class="column add-more is-3 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                    <div class="column add-more is-3 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                    <div class="column is-3 mr-5"><span>llamar al diseñador al medio día</span></div>
                </div>
                <p class="is-size-6 has-text-white my-4"><span class="is-size-7">&#9688;</span> Agregar notas</p>
            </div>
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
