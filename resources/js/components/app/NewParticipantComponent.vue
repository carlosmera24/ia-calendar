<template>
    <div class="new-participant" name="fade">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <p>
            <button class="btn-close button" v-on:click.prevent="clickClose">
                <span class="icon is-small">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </p>
        <h2 class="has-text-white">{{ text_title }}</h2>
        <section class="alert-section mt-4">
            <b-notification v-model="hasErrors" type="is-danger" hasIcon role="alert">
                <h4 class="has-text-white">{{ errors.text }}</h4>
                <ul>
                    <li v-for="(error, index) in errors.errors" v-bind:key="index">{{ error }}</li>
                </ul>
            </b-notification>
        </section>
        <form class="form_new_participant" action="">
            <div class="columns is-multiline">
                <b-field horizontal class="column is-4"
                    :label="fields.first_name.label"
                    v-bind:type="{ 'is-danger' : fields.first_name.error }"
                    :message="fields.first_name.error ? fields.first_name.msg : ''">
                    <b-input name="first_name" v-model="fname" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.last_name.label"
                    v-bind:type="{ 'is-danger' : fields.last_name.error }"
                    :message="fields.last_name.error ? fields.last_name.msg : ''">
                    <b-input name="last_name" v-model="lname" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.position.label"
                    v-bind:type="{ 'is-danger' : fields.position.error }"
                    :message="fields.position.error ? fields.position.msg : ''">
                    <b-input name="position" v-model="position" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.email.label"
                    v-bind:type="{ 'is-danger' : fields.email.error }"
                    :message="fields.email.error ? fields.email.msg : ''">
                    <b-input name="email" v-model="email" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.mobile.label"
                    v-bind:type="{ 'is-danger' : fields.mobile.error }"
                    :message="fields.mobile.error ? fields.mobile.msg : ''">
                    <b-input name="mobile" v-model="mobile" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.date_join.label"
                    v-bind:type="{ 'is-danger' : fields.date_join.error }"
                    :message="fields.date_join.error ? fields.date_join.msg : ''">
                    <b-datepicker
                        v-model="date_join"
                        :show-week-number="false"
                        :open-on-focus="true"
                        :locale="locale"
                        :date-formatter="dateFormat"
                        trap-focus expanded>
                    </b-datepicker>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.birth_date.label"
                    v-bind:type="{ 'is-danger' : fields.birth_date.error }"
                    :message="fields.birth_date.error ? fields.birth_date.msg : ''">
                    <b-datepicker
                        v-model="birth_date"
                        :show-week-number="false"
                        :open-on-focus="true"
                        :locale="locale"
                        :date-formatter="dateFormat"
                        trap-focus expanded>
                    </b-datepicker>
                </b-field>
            </div>
            <div class="columns">
                <b-field class="column is-half"
                    custom-class="label_description"
                    :label="fields.description.label"
                    v-bind:type="{ 'is-danger' : fields.description.error }"
                    :message="fields.description.error ? fields.description.msg : ''">
                    <b-input name="description" type="textarea" v-model="description" :placeholder="fields.description.placeholder" expanded></b-input>
                </b-field>
                <div class="field column field_avatar">
                    <label class="label label_description">&nbsp;</label>
                    <input type="file" accept="image" name="avatar" ref="fileAvatar">
                    <div class="contol"
                        v-bind:class="{ 'is-danger' : fields.profile_image.error }">
                        <div class="avatar is-flex" v-on:click="selectFile">
                            <span class="text-avatar" v-if="avatar == null">{{ fields.profile_image.label }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-actions">
                <b-button  class="btn-cancel">{{ text_cancel }}</b-button>
                <b-button class="btn-accept" v-on:click.prevent="save">{{ text_accept }}</b-button>
            </div>
        </form>
    </div>
</template>
<script>
import { procesarErroresRequest } from '../../functions.js';
var moment = require('moment');

//Import PNotify
import { success } from '@pnotify/core';
import '@pnotify/core/dist/PNotify.css';
import '@pnotify/core/dist/BrightTheme.css';

export default{
    props: [
        'text_title',
        'text_fields_json',
        'text_accept',
        'text_cancel',
        'url_person_store',
        'url_participant_store',
        'programmer'
    ],
    data() {
        return {
            isLoading: false,
            fields: [],
            hasErrors: false,
            errors: {},
            fname: '',
            lname: '',
            position: '',
            email: '',
            mobile: '',
            date_join: null,
            birth_date: null,
            description: null,
            avatar: null,
            id_profile: 3, //Set default "Invitado"
            locale: undefined, //Set browser language
        }
    },
    created(){
        this.fields = JSON.parse(this.text_fields_json);
    },
    methods: {
        clickClose(){
            this.$root.setActiveMenu( "wall" );
        },
        selectFile(){
            this.$refs.fileAvatar.click()
        },
        save(){
            this.fields.first_name.error = this.fname === '';
            this.fields.last_name.error = this.lname === '';
            this.fields.position.error = this.position === '';
            this.fields.date_join.error = this.date_join === null;
            this.fields.birth_date.error = this.birth_date === null;

            if( !this.fields.first_name.error &&  !this.fields.last_name.error  && !this.fields.position.error
                && !this.fields.date_join.error && !this.birth_date.error)
            {
                const person = {
                    first_name: this.fname,
                    last_name: this.lname,
                    birth_date: this.dateFormat(this.birth_date),
                    position_company: this.position,
                    date_join_company: this.dateFormat(this.date_join),
                };
                this.isLoading = true;
                //Create person
                axios.post(this.url_person_store, person)
                    .then( response => {
                            this.showErrors({});
                            if( response.data.status === 201 )//created person
                            {
                                const id_person = response.data.data.id;
                                //create participant
                                const participant = {
                                    persons_id: id_person,
                                    programmers_id: this.programmer.id,
                                    profiles_participants_id: this.id_profile,
                                    description: this.description,
                                };
                                axios.post(this.url_participant_store, participant)
                                    .then( response => {
                                        if( response.data.status === 201 )
                                        {
                                            success({
                                                title: 'Success!',
                                                text: 'Partícipe creado satisfactoriamente.'
                                            });
                                            //Limpiar formulario
                                            this.cleanForm();
                                        }
                                    },
                                    error => {
                                        this.showErrors( error.response );
                                    }
                                );

                            }
                        },
                        error => {
                          this.showErrors( error.response );
                        }
                    )
                    .then( () => {
                        this.isLoading = false;
                    });
            }
        },
        showErrors(resError){
            this.errors = procesarErroresRequest( resError );
            this.hasErrors = this.errors.errors.length > 0;
        },
        dateFormat(d){
            return moment(d).format('YYYY-MM-DD');
        },
        cleanForm(){
            this.hasErrors = false;
            this.errors = {};
            this.fname = '';
            this.lname = '';
            this.position = '';
            this.email = '';
            this.mobile = '';
            this.date_join= null;
            this.birth_date = null;
            this.description = null;
            this.avatar = null;
        }
    }
}
</script>
