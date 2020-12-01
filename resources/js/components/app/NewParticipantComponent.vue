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
                    <b-input name="first_name" v-model="fname" v-on:blur="getAvatar" maxlength="100" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.last_name.label"
                    v-bind:type="{ 'is-danger' : fields.last_name.error }"
                    :message="fields.last_name.error ? fields.last_name.msg : ''">
                    <b-input name="last_name" v-model="lname" v-on:blur="getAvatar" maxlength="100" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.position.label"
                    v-bind:type="{ 'is-danger' : fields.position.error }"
                    :message="fields.position.error ? fields.position.msg : ''">
                    <b-input name="position" v-model="position" maxlength="60" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    v-for="(inputEmail, index) in emails" :key="index"
                    :label="fields.email.label"
                    v-bind:type="{ 'is-danger' : inputEmail.error }"
                    :message="inputEmail.error ? emailMsg : ''">
                    <b-input name="email" v-model="inputEmail.value" maxlength="45" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    v-for="(inputMobile, index) in mobiles" :key="'mobile.'+index"
                    :label="fields.mobile.label"
                    v-bind:type="{ 'is-danger' : inputMobile.error }"
                    :message="inputMobile.error ? mobileMsg : ''">
                    <b-input name="mobile" v-on:keyup.native="onlyNumber($event, index)" v-model="inputMobile.value" maxlength="12" expanded></b-input>
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
                    <div class="contol"
                        v-bind:class="{ 'is-danger' : fields.profile_image.error }">
                        <div class="avatar is-flex" v-on:click="selectFile">
                            <span class="text-avatar" v-if="avatar == null">{{ fields.profile_image.label }}</span>
                            <img :src="avatar" v-else>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-actions">
                <b-button  class="btn-cancel" v-on:click.prevent="clickClose">{{ text_cancel }}</b-button>
                <b-button class="btn-accept" v-on:click.prevent="save">{{ text_accept }}</b-button>
            </div>
        </form>
    </div>
</template>
<script>
import { procesarErroresRequest } from '../../functions.js';
var moment = require('moment');
var validate = require('validate.js');

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
        'url_person_ui_avatar',
        'url_person_store',
        'url_participant_store',
        'urls_emails_store',
        'urls_mobiles_store',
        'programmer_json',
    ],
    data() {
        return {
            isLoading: false,
            fields: [],
            programmer: {},
            hasErrors: false,
            errors: {},
            fname: '',
            lname: '',
            position: '',
            emails: [],
            mobiles: [],
            email: '',
            emailMsg: '',
            mobile: '',
            mobileMsg: '',
            date_join: null,
            birth_date: null,
            description: null,
            avatar: null,
            id_profile: 3, //Set default "Invitado"
            locale: undefined, //Set browser language
            numMail: 3,
            numCell: 3,
        }
    },
    created(){
        this.fields = JSON.parse(this.text_fields_json);
        this.programmer = JSON.parse(this.programmer_json);
        this.createArraysInputs();
    },
    methods: {
        createArraysInputs(){
            //create inputs for e-mails
            for( var i=0;  i < this.numMail; i++ )
            {
                this.emails.push({
                    value: '',
                    error: false
                });
            }
            //create inputs for mobiles
            for( var i=0;  i < this.numCell; i++ )
            {
                this.mobiles.push({
                    value: '',
                    error: false
                });
            }
        },
        clickClose(){
            this.$root.setActiveMenu( "wall" );
        },
        selectFile(){
            this.$refs.fileAvatar.click()
        },
        getAvatar(e){
            const name = this.fname +" "+ this.lname;
            const params = {
                params:{
                name: name,}
            };
            if( name !== "" )
            {
                this.avatar = this.url_person_ui_avatar +"?name="+ name +'&size=128';
            }
        },
        save(){
            this.fields.first_name.error = this.fname === '';
            this.fields.last_name.error = this.lname === '';
            this.fields.position.error = this.position === '';
            this.fields.date_join.error = this.date_join === null;
            this.fields.birth_date.error = this.birth_date === null;
            var errors_others = false;
            this.emails.forEach( (element, index) => {
                element.error = false;
                if( index === 0 )
                {
                    element.error = element.value === '';
                    this.emailMsg = this.fields.email.msg;
                    errors_others = true;
                }
                if( element.value !== "" )
                {
                    const res = validate.single(element.value, { presence: true, email: true } );
                    element.error = !(res === undefined);
                    errors_others = element.error;
                    this.emailMsg = this.fields.email.msg_validate;
                }
            });
            this.mobiles.forEach( (element, index) => {
                element.error = false;
                if( index === 0 )
                {
                    element.error = element.value === "";
                    this.mobileMsg = this.fields.mobile.msg;
                    errors_others = true;
                }
                if( element.value !== "" )
                {
                    const res = validate.single(element.value, { length: { minimum: 10 } } );
                    element.error = !(res === undefined);
                    errors_others = element.error;
                    this.mobileMsg = this.fields.mobile.msg_validate;
                }
            });

            if( !this.fields.first_name.error &&  !this.fields.last_name.error  && !this.fields.position.error
                && !this.fields.date_join.error && !this.birth_date.error && !errors_others)
            {
                const person = {
                    first_name: this.fname,
                    last_name: this.lname,
                    birth_date: this.dateFormat(this.birth_date),
                    position_company: this.position,
                    date_join_company: this.dateFormat(this.date_join),
                };
                this.isLoading = true;

                // Create person
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
                                            // Create emails
                                            const emails = [];
                                            this.emails.forEach( element => {
                                                if( element.value !== "" ){
                                                    emails.push( element.value );
                                                }
                                            });
                                            axios.post( this.urls_emails_store, { emails: emails, persons_id: id_person } )
                                                .then( response => {
                                                    if( response.data.status === 201 )
                                                    {
                                                        //Create cellphones
                                                        const mobiles = [];
                                                        this.mobiles.forEach( element => {
                                                            if( element.value !== "" ){
                                                                mobiles.push( element.value );
                                                            }
                                                        });
                                                        axios.post( this.urls_mobiles_store, { mobiles: mobiles, persons_id: id_person } )
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
                                                );
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
        onlyNumber(e, index){
            const regex = new RegExp(/[^\d]/g);
            const val = e.target.value.replace(regex,"");
            const obj = this.mobiles[index];
            if( obj.value !== val )
            {
                this.mobiles.splice( index, 1, { error: obj.error, value: val });
            }
        },
        cleanForm(){
            this.hasErrors = false;
            this.errors = {};
            this.fname = '';
            this.lname = '';
            this.position = '';
            this.emails= [];
            this.mobiles= [];
            this.email = '';
            this.mobile = '';
            this.date_join= null;
            this.birth_date = null;
            this.description = null;
            this.avatar = null;
            this.createArraysInputs();
        }
    }
}
</script>
