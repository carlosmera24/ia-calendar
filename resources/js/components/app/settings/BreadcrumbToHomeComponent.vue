<template>
    <div class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li>
                <a href="#" v-on:click.prevent="clickCancel">
                    <span class="icon is-small">
                        <i class="fas fa-home" aria-hidden="true"></i>
                    </span>
                    <span>{{ text_breacrumbs }}</span>
                </a>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        text_breacrumbs: {
            type: String,
            require: true,
        }
    },
    methods: {
        /**
         * Required for back action
         */
        clickCancel(){
                this.$emit('clickCancel','main')
            },
    },
}
</script>
