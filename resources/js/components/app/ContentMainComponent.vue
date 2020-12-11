<template>
    <div class="content-main">
        <main-section v-if="contentActive.main"
            v-bind:text_create_participant='text_create_participant'
            v-bind:text_create_category='text_create_category'
            v-bind:text_see_calendar='text_see_calendar'
            v-bind:text_anual_fiscal='text_anual_fiscal'
            v-bind:text_create_your_event='text_create_your_event'
            v-bind:text_programmer='text_programmer'
            v-bind:text_category='text_category'
            v-bind:text_event='text_event'
            v-bind:numbers_emailes="numbers_emailes"
            v-bind:numbers_mobiles="numbers_mobiles"
            v-bind:programmer_json="programmer_json"
            v-bind:text_success='text_success'
            v-bind:text_wall_title='text_wall_title'
            v-bind:text_wall_trigger_events_soon_expire='text_wall_trigger_events_soon_expire'
            v-bind:text_wall_add_categories='text_wall_add_categories'
            v-bind:text_wall_add_notes='text_wall_add_notes'
            v-bind:text_participant_title='text_participant_title'
            v-bind:text_created_participant='text_created_participant'
            v-bind:text_accept='text_accept'
            v-bind:text_cancel='text_cancel'
            v-bind:text_participant_fields_json="text_participant_fields_json"
            v-bind:url_person_ui_avatar='url_person_ui_avatar'
            v-bind:url_person_store='url_person_store'
            v-bind:url_participant_store='url_participant_store'
            v-bind:urls_emails_store='urls_emails_store'
            v-bind:urls_mobiles_store='urls_mobiles_store'
            v-bind:url_person_email_exist='url_person_email_exist'
            v-bind:url_person_cellphone_exist='url_person_cellphone_exist'
        />
        <manage-leader v-else-if="contentActive.adminLeaders"
            v-bind:text_admin_leaders='text_admin_leaders'
            v-bind:programmer_json="programmer_json"
            v-bind:user_id="user_id"
            v-bind:url_participants_programmer="url_participants_programmer"
         />
    </div>
</template>
<script>
export default {
    props: [
        'text_create_participant',
        'text_create_category',
        'text_see_calendar',
        'text_anual_fiscal',
        'text_create_your_event',
        'text_programmer',
        'text_category',
        'text_event',
        'numbers_emailes',
        'numbers_mobiles',
        'programmer_json',
        'text_success',
        'text_wall_title',
        'text_wall_trigger_events_soon_expire',
        'text_wall_add_categories',
        'text_wall_add_notes',
        'text_participant_title',
        'text_created_participant',
        'text_accept',
        'text_cancel',
        'text_participant_fields_json',
        'url_person_ui_avatar',
        'url_person_store',
        'url_participant_store',
        'urls_emails_store',
        'urls_mobiles_store',
        'url_person_email_exist',
        'url_person_cellphone_exist',
        'url_participants_programmer',
        'text_admin_leaders',
        'user_id',
    ],
    data() {
        return {
            contentActive: {}
        }
    },
    created(){
        this.contentActive = this.$root.contentActive;
    }
}
</script>
