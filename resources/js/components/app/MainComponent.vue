<template>
    <div>
        <!-- Menu Section -->
        <section class="action-section px-5 py-5">
            <main-menu-section
                v-on:activeMenu="setActiveMenu"
                v-bind:texts_main_json='texts_main_json'
            />
        </section>
        <!-- /Menu Section -->
        <!-- Banner Section -->
        <section class="banner py-4">
            <banner-app-carusel />
        </section>
        <!-- /Banner Section -->
        <!-- Main Section -->
        <section class="main">
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
                        v-on:activeMenu="setActiveMenu"
                        v-bind:programmer_json="programmer_json"
                        v-bind:numbers_emailes="numbers_emailes"
                        v-bind:numbers_mobiles="numbers_mobiles"
                        v-bind:text_title="text_participant_title"
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
                        v-bind:url_person_cellphones_array_exist="url_person_cellphones_array_exist" />
                </transition-group>
            </section>
        </section>
         <!-- /Main Section  -->
    </div>
</template>
<script>
export default {
    props:{
        texts_main_json: {
            type: String,
            require: true
        },
        showTitle: {
            type: String,
            require: true
        },
        text_success: {
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
        text_created_participant: {
            type: String,
            require: true
        },
        text_participant_title: {
            type: String,
            require: true
        },
        text_participant_fields_json: {
            type: String,
            require: true
        },
        text_accept: {
            type: String,
            require: true
        },
        text_cancel: {
            type: String,
            require: true
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
        url_person_cellphones_array_exist: {
            type: String,
            require: true
        },
        programmer_json: {
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
    },
    data() {
        return {
            activeMenu: {
                wall: true,
                create_participant: false,
            }
        }
    },
    methods: {
        setActiveMenu(item){
            Object.entries(this.activeMenu).forEach((v) => {
                if (v[0] === item) {
                    this.activeMenu[item] = true;
                } else {
                    this.activeMenu[v[0]] = false;
                }
            });
        }
    }
}
</script>
