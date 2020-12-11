<template>
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <h2>{{ text_admin_leaders }}</h2>
        <section class="alert-section mt-4">
            <b-notification v-model="hasErrors" type="is-danger" hasIcon role="alert">
                <h4 class="has-text-white">{{ errors.text }}</h4>
                <ul>
                    <li v-for="(error, index) in errors.errors" v-bind:key="index">{{ error }}</li>
                </ul>
            </b-notification>
        </section>
        <form class="form_manage_leader" action="">
            <div class="field">
                <div class="control has-icons-left">
                    <v-select v-model="participanIdSelect"
                        :options="participants"
                        :reduce="participant => participant.meta.id"
                        label="participant"
                    />
                    <div class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { procesarErroresRequest, capitalize } from '../../functions.js';

//Import vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

export default {
    data() {
        return {
            isLoading: false,
            hasErrors: false,
            errors: {},
            participanError: false,
            participants:[],
            participanIdSelect: null,
            programmer: {}
        }
    },
    props: [
        'text_admin_leaders',
        'programmer_json',
        'user_id',
        'url_participants_programmer'
    ],
    created(){
        this.programmer = JSON.parse(this.programmer_json);
    },
    mounted(){
        this.getParticipants();
    },
    methods: {
        showErrors(resError){
            this.errors = procesarErroresRequest( resError );
            this.hasErrors = this.errors.errors.length > 0;
        },
        getParticipants(){
            this.isLoading = true;
            axios.post(this.url_participants_programmer, { programmers_id : this.programmer.id, users_id: this.user_id })
                .then( response => {
                    if( response.data.status === 200 )
                    {
                        response.data.participants.forEach( element => {
                            const name = element.first_name +" "+ element.last_name;
                            const participant = capitalize( name.toLocaleLowerCase() );
                            const tmp = {
                                participant: participant,
                                meta: element
                            }
                            this.participants.push( tmp );
                        });
                    }
                },
                error => {
                    this.showErrors(error);
                })
                .then( () => {
                    this.isLoading = false;
                });
        }
    }
}
</script>
