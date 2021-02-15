<template>
    <div class="content-main">
        <transition-group class="action-main"
                    enter-active-class="animate__animated animate__backInLeft animated_delay"
                    leave-active-class="animate__animated animate__backOutRight">
            <main-section v-if="contentActive.main"
                v-bind:key="1"
                v-bind:texts_main_json='texts_main_json'
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
                v-bind:url_person_cellphones_array_exist='url_person_cellphones_array_exist'
            />
            <manage-leader v-else-if="contentActive.adminLeaders"
                v-bind:key="2"
                v-on:activeMainSection="setActiveSection"
                v-bind:text_breadcrumbs_init='text_breadcrumbs_init'
                v-bind:text_admin_leaders='text_admin_leaders'
                v-bind:programmer_json="programmer_json"
                v-bind:user_id="user_id"
                v-bind:text_field_required='text_field_required'
                v-bind:text_success='text_success'
                v-bind:text_loading='text_loading'
                v-bind:text_no_options='text_no_options'
                v-bind:text_updated_participant='text_updated_participant'
                v-bind:texts_manage_leader_json="texts_manage_leader_json"
                v-bind:text_participant_fields_json="text_participant_fields_json"
                v-bind:text_apply='text_apply'
                v-bind:text_cancel='text_cancel'
                v-bind:text_not='text_not'
                v-bind:url_participants_programmer="url_participants_programmer"
                v-bind:url_categories_programmer="url_categories_programmer"
                v-bind:url_permissions_participant="url_permissions_participant"
                v-bind:url_participant_categories="url_participant_categories"
                v-bind:url_store_permissions_participant="url_store_permissions_participant"
                v-bind:url_store_participants_categories="url_store_participants_categories"
                v-bind:url_participant_update="url_participant_update"
            />
            <general-settings v-else-if="contentActive.settingAdmin"
                v-bind:key="3"
                v-on:activeMainSection="setActiveSection"
                v-bind:programmer_json="programmer_json"
                v-bind:texts_general_settings_json='texts_general_settings_json'
                v-bind:text_success='text_success'
                v-bind:fields_programmer_json='fields_programmer_json'
                v-bind:participant_fields_json="text_participant_fields_json"
                v-bind:text_breadcrumbs_init='text_breadcrumbs_init'
                v-bind:text_no_options='text_no_options'
                v-bind:participant_json='participant_json'
                v-bind:url_identifications_types='url_identifications_types'
                v-bind:url_update_programmer='url_update_programmer'
                v-bind:url_image_base='url_image_base'
                v-bind:url_person_ui_avatar='url_person_ui_avatar'
                v-bind:url_participant_update="url_participant_update"
                v-bind:url_person_emails_admin="url_person_emails_admin"
                v-bind:url_person_email_exist='url_person_email_exist'
                v-bind:url_person_cellphone_exist='url_person_cellphone_exist'
                v-bind:url_persons_emails_store='url_persons_emails_store'
                v-bind:url_persons_emails_update='url_persons_emails_update'
                v-bind:url_persons_cellphones_for_person='url_persons_cellphones_for_person'
                v-bind:url_persons_cellphone_store='url_persons_cellphone_store'
                v-bind:url_person_cellphone_update='url_person_cellphone_update'
            />
        </transition-group>
    </div>
</template>
<script>
export default {
    props: {
        text_breadcrumbs_init: {
            type: String,
            require: true
        },
        texts_main_json: {
            type: String,
            require: true
        },
        numbers_emailes: {
            type: String,
            require: true
        },
        numbers_mobiles: {
            type: String,
            require: true
        },
        programmer_json: {
            type: String,
            require: true
        },
        text_success: {
            type: String,
            require: true
        },
        text_loading: {
            type: String,
            require: true
        },
        text_field_required: {
            type: String,
            require: true

        },
        text_no_options: {
            type: String,
            require: true
        },
        text_wall_title: {
            type: String,
            require: true
        },
        text_wall_trigger_events_soon_expire: {
            type: String,
            require: true
        },
        text_wall_add_categories: {
            type: String,
            require: true
        },
        text_wall_add_notes: {
            type: String,
            require: true
        },
        text_participant_title: {
            type: String,
            require: true
        },
        text_created_participant: {
            type: String,
            require: true
        },
        text_updated_participant: {
            type: String,
            require: true
        },
        text_accept: {
            type: String,
            require: true
        },
        text_apply: {
            type: String,
            require: true
        },
        text_cancel: {
            type: String,
            require: true
        },
        text_not: {
            type: String,
            require: true
        },
        text_participant_fields_json: {
            type: String,
            require: true
        },
        text_admin_leaders: {
            type: String,
            require: true
        },
        user_id: {
            type: String,
            require: true
        },
        profile_participant: {
            type: String,
            require: true
        },
        texts_manage_leader_json: {
            type: String,
            require: true
        },
        texts_general_settings_json: {
            type: String,
            require: true
        },
        fields_programmer_json: {
            type: String,
            require: true

        },
        participant_json: {
            type: String,
            require: true,
        },
        url_person_ui_avatar: {
            type: String,
            require: true
        },
        url_person_store: {
            type: String,
            require: true
        },
        url_participant_store: {
            type: String,
            require: true
        },
        url_participant_update: {
            type: String,
            require: true
        },
        urls_emails_store: {
            type: String,
            require: true
        },
        urls_mobiles_store: {
            type: String,
            require: true
        },
        url_person_email_exist: {
            type: String,
            require: true
        },
        url_persons_emails_store: {
            type: String,
            require: true
        },
        url_persons_emails_update: {
            type: String,
            require: true
        },
        url_person_cellphones_array_exist: {
            type: String,
            require: true
        },
        url_person_cellphone_exist: {
            type: String,
            require: true
        },
        url_persons_cellphone_store: {
            type: String,
            require: true
        },
        url_person_cellphone_update: {
            type: String,
            require: true
        },
        url_participants_programmer: {
            type: String,
            require: true
        },
        url_categories_programmer: {
            type: String,
            require: true
        },
        url_permissions_participant: {
            type: String,
            require: true

        },
        url_participant_categories: {
            type: String,
            require: true
        },
        url_store_permissions_participant: {
            type: String,
            require: true
        },
        url_store_participants_categories: {
            type: String,
            require: true
        },
        url_identifications_types: {
            type: String,
            require: true
        },
        url_update_programmer: {
            type: String,
            require: true
        },
        url_image_base: {
            type: String,
            require: true
        },
        url_person_emails_admin: {
            type: String,
            require: true
        },
        url_persons_cellphones_for_person: {
            type: String,
            require: true
        },
    },
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
