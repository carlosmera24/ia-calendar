<template>
    <div class="new-participant" name="fade">
        <p>
            <button class="btn-close button" v-on:click.prevent="clickClose">
                <span class="icon is-small">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </p>
        <h2 class="has-text-white">Partícipe nuevo</h2>
    </div>
</template>
<script>
export default{
    methods: {
        clickClose(){
            this.$root.setActiveMenu( "wall" );
        }
    }
}
</script>
