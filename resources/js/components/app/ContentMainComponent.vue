<template>
    <div class="content-main">
        <transition-group class="action-main"
                    enter-active-class="animate__animated animate__backInLeft animated_delay"
                    leave-active-class="animate__animated animate__backOutRight">
            <main-section v-if="contentActive.main"
                v-bind:key="1"
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
                v-bind:key="2"
                v-on:activeMainSection="setActiveSection"
                v-bind:text_breadcrumbs_init='text_breadcrumbs_init'
                v-bind:text_admin_leaders='text_admin_leaders'
                v-bind:programmer_json="programmer_json"
                v-bind:user_id="user_id"
                v-bind:text_success='text_success'
                v-bind:text_no_options='text_no_options'
                v-bind:text_updated_participant='text_updated_participant'
                v-bind:text_search_participant="text_search_participant"
                v-bind:text_participant_fields_json="text_participant_fields_json"
                v-bind:text_associate_leader="text_associate_leader"
                v-bind:text_consult_categories_events="text_consult_categories_events"
                v-bind:text_create_events="text_create_events"
                v-bind:text_modify_events="text_modify_events"
                v-bind:text_share_events="text_share_events"
                v-bind:text_delete_events="text_delete_events"
                v-bind:text_create_categorie="text_create_categorie"
                v-bind:text_modify_categorie="text_modify_categorie"
                v-bind:text_delete_categorie="text_delete_categorie"
                v-bind:text_filter_categories="text_filter_categories"
                v-bind:text_give_admin_categories_events="text_give_admin_categories_events"
                v-bind:text_back_to_participant="text_back_to_participant"
                v-bind:text_apply='text_apply'
                v-bind:text_cancel='text_cancel'
                v-bind:url_participants_programmer="url_participants_programmer"
                v-bind:url_categories_programmer="url_categories_programmer"
                v-bind:url_permissions_participant="url_permissions_participant"
                v-bind:url_participant_categories="url_participant_categories"
                v-bind:url_store_permissions_participant="url_store_permissions_participant"
                v-bind:url_store_participants_categories="url_store_participants_categories"
                v-bind:url_participant_update="url_participant_update"
            />
        </transition-group>
    </div>
</template>
<script>
export default {
    props: [
        'text_breadcrumbs_init',
        'text_create_participant',
        'text_create_category',
        'text_see_calendar',
        'text_anual_fiscal',
        'text_create_your_event',
        'text_programmer',
        'text_category',
        'text_event',
        'text_filter_categories',
        'text_give_admin_categories_events',
        'text_back_to_participant',
        'numbers_emailes',
        'numbers_mobiles',
        'programmer_json',
        'text_success',
        'text_no_options',
        'text_wall_title',
        'text_wall_trigger_events_soon_expire',
        'text_wall_add_categories',
        'text_wall_add_notes',
        'text_participant_title',
        'text_created_participant',
        'text_updated_participant',
        'text_accept',
        'text_apply',
        'text_cancel',
        'text_participant_fields_json',
        'text_admin_leaders',
        'user_id',
        'text_search_participant',
        'text_associate_leader',
        'text_consult_categories_events',
        'text_create_events',
        'text_modify_events',
        'text_share_events',
        'text_delete_events',
        'text_create_categorie',
        'text_modify_categorie',
        'text_delete_categorie',
        'url_person_ui_avatar',
        'url_person_store',
        'url_participant_store',
        'url_participant_update',
        'urls_emails_store',
        'urls_mobiles_store',
        'url_person_email_exist',
        'url_person_cellphone_exist',
        'url_participants_programmer',
        'url_categories_programmer',
        'url_permissions_participant',
        'url_participant_categories',
        'url_store_permissions_participant',
        'url_store_participants_categories',
    ],
    data() {
        return {
            contentActive: {}
        }
    },
    created(){
        this.contentActive = this.$root.contentActive;
    },
    methods: {
        setActiveSection(item){
            this.$root.setActiveContent( item );
        }
    }
}
</script>
