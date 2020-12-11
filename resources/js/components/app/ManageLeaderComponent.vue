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
                    <v-select v-model="participantSelected"
                        :options="participants"
                        :reduce="participant => participant.meta"
                        :placeholder="text_search_participant"
                        label="participant"
                    />
                    <div class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <section class="data_participant">
                <div class="columns is-multiline">
                    <b-field horizontal class="column is-12"
                        :label="fields.first_name.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.first_name : '' }}</span>
                    </b-field>
                    <b-field horizontal class="column is-12"
                        :label="fields.last_name.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.last_name : '' }}</span>
                    </b-field>
                    <!-- Emails group -->
                    <div class="column is-12" v-if="participantSelected !== null">
                        <div class="columns is-multiline" >
                            <b-field horizontal class="column is-12"
                                v-for="(email, index) in participantSelected.emails" :key="'email.'+index"
                                :label="fields.email.label">
                                <span>{{ email.email }}</span>
                            </b-field>
                        </div>
                    </div>
                    <b-field horizontal class="column is-12"
                        v-else
                        :label="fields.email.label">
                        <span></span>
                    </b-field>
                    <!-- /Emails group -->
                    <!-- Cellphones group -->
                    <div class="column is-12" v-if="participantSelected !== null">
                        <div class="columns is-multiline" >
                            <b-field horizontal class="column is-12"
                                v-for="(mobile, index) in participantSelected.cellphones" :key="'mobile.'+index"
                                :label="fields.mobile.label">
                                <span>{{ mobile.cellphone_number }}</span>
                            </b-field>
                        </div>
                    </div>
                    <b-field horizontal class="column is-12"
                        v-else
                        :label="fields.mobile.label">
                        <span></span>
                    </b-field>
                    <!-- /Cellphones group -->
                    <b-field horizontal class="column is-12"
                        :label="fields.position.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.position_company : '' }}</span>
                    </b-field>
                </div>
            </section>
            <section class="data_permissions">
                <b-button><span class="is-size-5">&#9688;</span></b-button>
                <div class="columns is-multiline" >
                    <b-field horizontal class="column is-12"
                        :label="text_associate_leader">
                        <span></span>
                    </b-field>
                     <div class="field column is-12 is-horizontal">
                        <b-switch :value="false"
                            type="is-success">
                            Consultar Categorías y Eventos
                        </b-switch>
                    </div>
                     <div class="field column is-12 is-horizontal">
                        <b-switch :value="false"
                            type="is-success">
                            Crear Eventos
                        </b-switch>
                    </div>
                     <div class="field column is-12 is-horizontal">
                        <b-switch :value="false"
                            type="is-success">
                            Modificar Eventos
                        </b-switch>
                    </div>
                    <div class="field column is-12 is-horizontal">
                        <b-switch :value="false"
                            type="is-success">
                            Compartir Eventos
                        </b-switch>
                    </div>
                    <div class="field column is-12 is-horizontal">
                        <b-switch :value="false"
                            type="is-success">
                            Eliminar Eventos
                        </b-switch>
                    </div>
                </div>
            </section>
            <div class="btn-actions has-text-centered">
                <b-button  class="btn-cancel is-capitalized" v-on:click.prevent="clickCancel">{{ text_cancel }}</b-button>
                <b-button class="btn-accept is-capitalized" v-on:click.prevent="save">{{ text_apply }}</b-button>
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
    props: [
        'text_admin_leaders',
        'programmer_json',
        'user_id',
        'text_search_participant',
        'text_participant_fields_json',
        'text_associate_leader',
        'text_apply',
        'text_cancel',
        'url_participants_programmer'
    ],
    data() {
        return {
            isLoading: false,
            hasErrors: false,
            errors: {},
            participanError: false,
            participants:[],
            participantSelected: null,
            programmer: {},
            fields: [],
        }
    },
    created(){
        this.programmer = JSON.parse(this.programmer_json);
        this.fields = JSON.parse(this.text_participant_fields_json);
    },
    mounted(){
        this.getParticipants();
    },
    methods: {
        clickCancel(){
            this.$emit('activeMainSection','main')
        },
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
