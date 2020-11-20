<template>
    <div>
        <h4 class="title has-text-weight-bold is-size-5 mx-6 mb-3" v-if="activeMenu.wall">{{ text_wall_title }}</h4>
        <section class="content px-6 py-6">
            <transition-group class="action-main"
                enter-active-class="animate__animated animate__fadeInDown animated_delay"
                leave-active-class="animate__animated animate__fadeOutDown">

                <wall-section v-if="activeMenu.wall"
                    v-bind:key="1"
                    v-bind:text_trigger_events_soon_expire="text_wall_trigger_events_soon_expire"
                    v-bind:text_add_categories="text_wall_add_categories"
                    v-bind:text_add_notes="text_wall_add_notes" />

                <participant-section v-if="activeMenu.create_participant"
                    v-bind:key="2"
                    v-bind:text_title="text_participant_title"
                    v-bind:text_fields_json="text_participant_fields_json"
                    v-bind:text_accept="text_accept"
                    v-bind:text_cancel="text_cancel" />
            </transition-group>
        </section>
    </div>
</template>
<script>
export default {
    props:[
        'showTitle',
        'text_wall_title',
        'text_wall_trigger_events_soon_expire',
        'text_wall_add_categories',
        'text_wall_add_notes',
        'text_participant_title',
        'text_participant_fields_json',
        'text_accept',
        'text_cancel',
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
