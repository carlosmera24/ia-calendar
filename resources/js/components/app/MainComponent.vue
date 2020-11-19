<template>
    <div>
        <h4 class="title has-text-weight-bold is-size-5 mx-6 mb-3" v-if="activeMenu.wall">{{ text_title }}</h4>
        <section class="content px-6 py-6">
            <transition name="trans-wall"
                enter-active-class="animate__animated animate__fadeInDown"
                leave-active-class="animate__animated animate__fadeOutDown">
                <wall-section v-if="activeMenu.wall"
                    v-bind:text_trigger_events_soon_expire="text_trigger_events_soon_expire"
                    v-bind:text_add_categories="text_add_categories"
                    v-bind:text_add_notes="text_add_notes" />
            <!-- </transition>
            <transition name="trans-participant"
                enter-active-class="animate__animated animate__fadeInDown"
                leave-active-class="animate__animated animate__bounceOutDown"> -->
                <participant-section v-if="activeMenu.create_participant"/>
            </transition>
        </section>
    </div>
</template>
<script>
export default {
    props:[
        'showTitle',
        'text_title',
        'text_trigger_events_soon_expire',
        'text_add_categories',
        'text_add_notes'
    ],
    data() {
        return {
            activeMenu: [],
        }
    },
    created(){
        this.activeMenu = this.$root.activeMenu;
    }
}
</script>
