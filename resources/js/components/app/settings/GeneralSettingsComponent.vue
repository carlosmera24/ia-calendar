<template lang="">
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <div class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li>
                    <a href="#" v-on:click.prevent="clickCancel">
                        <span class="icon is-small">
                            <i class="fas fa-home" aria-hidden="true"></i>
                        </span>
                        <span>{{ text_breadcrumbs_init }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <h2>{{ textsGeneralSettings.text_general_setting }} {{ textsGeneralSettings.names_profiles_participants[profile_participant] }}</h2>
        <form action="" class="form_general_settings">
            <section class="programer_data">
                <h3><span class="numerator">1</span>{{ textsGeneralSettings.programmer_data }}</h3>
            </section>
        </form>
    </div>
</template>
<script>
    export default {
        props: [
            'profile_participant',
            'text_breadcrumbs_init',
            'texts_general_settings_json',
        ],
        data() {
            return {
                isLoading: false,
                textsGeneralSettings: []
            }
        },
        created(){
            this.textsGeneralSettings = JSON.parse(this.texts_general_settings_json);
        },
        methods: {
            clickCancel(){
                this.$emit('activeMainSection','main')
            },
        }
    }
</script>
