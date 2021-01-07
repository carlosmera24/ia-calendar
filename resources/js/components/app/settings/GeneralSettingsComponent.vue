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
        <h2>{{ text_general_setting }} {{ profilesParticipants[profile_participant] }}</h2>
    </div>
</template>
<script>
    export default {
        props: [
            'profile_participant',
            'text_breadcrumbs_init',
            'text_general_setting',
            'profiles_participants_names_json',
        ],
        data() {
            return {
                isLoading: false,
                profilesParticipants: []
            }
        },
        created(){
            this.profilesParticipants = JSON.parse(this.profiles_participants_names_json);
            console.log(this.profilesParticipants);
        },
        methods: {
            clickCancel(){
                this.$emit('activeMainSection','main')
            },
        }
    }
</script>
