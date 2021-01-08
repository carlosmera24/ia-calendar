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
        <section class="alert-section mt-4">
            <b-notification v-model="hasErrors" type="is-danger" hasIcon role="alert">
                <h4 class="has-text-white">{{ errors.text }}</h4>
                <ul>
                    <li v-for="(error, index) in errors.errors" v-bind:key="index">{{ error }}</li>
                </ul>
            </b-notification>
        </section>
        <form action="" class="form_general_settings">
            <section class="programer_data">
                <h3><span class="numerator">1</span>{{ textsGeneralSettings.programmer_data }}</h3>
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="column is-10">
                                <span>{{ programmer.entity_name.value ? programmer.entity_name.value : fieldsProgrammer.entity_name.label }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2">
                                <v-select v-model="identificationTypeSelected"
                                    :options="identificationsTypes"
                                    :reduce="identification_type => identification_type.meta"
                                    :placeholder="fieldsProgrammer.identifications_types_id.placeholder"
                                    label="identification_type"
                                >
                                    <div slot="no-options">{{ text_no_options }}</div>
                                </v-select>
                            </div>
                            <div class="column is-10">
                                <span>{{ programmer.identification.value ? programmer.identification.value : fieldsProgrammer.identification.label }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="column is-10">
                                <span>{{ programmer.logo.value ? programmer.logo.value : fieldsProgrammer.logo.placeholder }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p>{{ fieldsProgrammer }}</p>
                <p>{{ programmer }}</p>
            </section>
        </form>
    </div>
</template>
<script>
    import { procesarErroresRequest, capitalize } from '../../../functions.js';
    var validate = require('validate.js');
    //Import vue-select
    import vSelect from 'vue-select';
    Vue.component('v-select', vSelect);
    //Import PNotify
    import { success } from '@pnotify/core';
    import '@pnotify/core/dist/PNotify.css';
    import '@pnotify/core/dist/BrightTheme.css';
    export default {
        props: [
            'profile_participant',
            'text_breadcrumbs_init',
            'programmer_json',
            'texts_general_settings_json',
            'fields_programmer_json',
            'text_no_options',
            'url_identifications_types',
        ],
        data() {
            return {
                isLoading: false,
                hasErrors: false,
                errors: {},
                programmer: new Object(),
                textsGeneralSettings: [],
                fieldsProgrammer: [],
                identificationTypeSelected: null,
                identificationsTypes: [],
            }
        },
        created(){
            //Create/load programmer data
            const initProgrammer = JSON.parse(this.programmer_json);
            Object.keys(initProgrammer).forEach( key => {
               const val = {
                                'value':    initProgrammer[key],
                                'edited':   false,
                                'editing':  false,
                            };
                this.programmer[key] = val;
            });
            this.textsGeneralSettings = JSON.parse(this.texts_general_settings_json);
            this.fieldsProgrammer = JSON.parse(this.fields_programmer_json);
        },
        mounted(){
            this.getIdentificationsTypes();
        },
        methods: {
            clickCancel(){
                this.$emit('activeMainSection','main')
            },
            showErrors(resError){
                this.errors = procesarErroresRequest( resError );
                this.hasErrors = this.errors.errors.length > 0;
            },
            getIdentificationsTypes(){
                this.isLoading = true;
                axios.post(this.url_identifications_types)
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            response.data.identifications_types.forEach( element => {
                                const name = element.abrevation + (element.translation ? '-'+element.translation.name : '');
                                const tmp = {
                                    identification_type: name,
                                    meta: element
                                }
                                this.identificationsTypes.push( tmp );
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
