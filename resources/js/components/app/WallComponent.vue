<template>
    <div>
        <div class="events-expire">
            <div class="columns my-0">
                <div class="column add-more mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                <div class="column mr-5"></div>
                <div class="column mr-5"></div>
                <div class="column mr-5"></div>
            </div>
            <p class="is-size-6 has-text-white my-4">
                <span class="is-size-7">&#9688;</span> {{ text_trigger_events_soon_expire }} <i class="fas fa-lg fa-caret-down"></i>
            </p>
        </div>
        <div class="categories-favorites pt-6">
            <div class="columns my-0">
                <div class="column add-more is-2 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                <div class="column add-more is-2 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                <div class="column is-2 mr-5"></div>
            </div>
            <p class="is-size-6 has-text-white my-4"><span class="is-size-7">&#9688;</span> {{ text_add_categories }}</p>
        </div>
        <div class="notes pt-6">
            <div class="columns my-0">
                <div class="column add-more is-3 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                <div class="column add-more is-3 mr-5"><span class="icon icon-medium"><i class="fa fa-3x fa-plus"></i></span></div>
                <div class="column is-3 mr-5"><span>llamar al diseñador al medio día</span></div>
            </div>
            <p class="is-size-6 has-text-white my-4"><span class="is-size-7">&#9688;</span> {{ text_add_notes }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props:[
        'text_trigger_events_soon_expire',
        'text_add_categories',
        'text_add_notes'
    ],
}
</script>
