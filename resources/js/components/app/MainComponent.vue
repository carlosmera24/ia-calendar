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
                    v-bind:programmer_json="programmer_json"
                    v-bind:numbers_emailes="numbers_emailes"
                    v-bind:numbers_mobiles="numbers_mobiles"
                    v-bind:text_success="text_success"
                    v-bind:text_created_participant="text_created_participant"
                    v-bind:text_fields_json="text_participant_fields_json"
                    v-bind:text_accept="text_accept"
                    v-bind:text_cancel="text_cancel"
                    v-bind:url_person_ui_avatar="url_person_ui_avatar"
                    v-bind:url_person_store="url_person_store"
                    v-bind:url_participant_store="url_participant_store"
                    v-bind:url_person_email_exist="url_person_email_exist"
                    v-bind:urls_mobiles_store="urls_mobiles_store"
                    v-bind:urls_emails_store="urls_emails_store"
                    v-bind:url_person_cellphone_exist="url_person_cellphone_exist" />
            </transition-group>
        </section>
    </div>
</template>
<script>
export default {
    props:[
        'showTitle',
        'text_success',
        'text_wall_title',
        'text_wall_trigger_events_soon_expire',
        'text_wall_add_categories',
        'text_wall_add_notes',
        'text_created_participant',
        'text_participant_title',
        'text_participant_fields_json',
        'text_accept',
        'text_cancel',
        'url_person_ui_avatar',
        'url_person_store',
        'url_participant_store',
        'urls_emails_store',
        'urls_mobiles_store',
        'url_person_email_exist',
        'url_person_cellphone_exist',
        'programmer_json',
        'numbers_emailes',
        'numbers_mobiles',
    ],
    data() {
        return {
            activeMenu: [],
            programmer: {}
        }
    },
    created(){
        this.activeMenu = this.$root.activeMenu;
    }
}
</script>
