<template>
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>

        <breadcrumb-to-main
            v-on:clickCancel="clickCancelToHome"
            v-bind:text_breacrumbs="text_breadcrumbs_init"/>
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
                    <!-- Entity Name -->
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="column is-10">
                                <div class="columns">
                                    <div class="columns column is-12" v-if="programmer.entity_name.editing">
                                        <div class="column is-6">
                                            <b-field horizontal
                                                class="label_not-show"
                                                v-bind:type="{ 'is-danger' : fieldsProgrammer.entity_name.error }"
                                                :message="fieldsProgrammer.entity_name.error ? fieldsProgrammer.entity_name.msg : ''">
                                                <b-input
                                                    ref="entity_name"
                                                    name="entity_name"
                                                    v-model="programmer.entity_name.value"
                                                    maxlength="120"
                                                    expanded>
                                                </b-input>
                                            </b-field>

                                        </div>
                                        <div class="column is-6 content-buttons">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="save"
                                                v-on:click.prevent="clickUpdate( 'entity_name' )"
                                            />
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancel('entity_name')"
                                            />
                                        </div>
                                    </div>
                                    <div class="columns column is-12" v-else>
                                        <div class="column is-6">
                                            <span>{{ programmer.entity_name.value ? programmer.entity_name.value : fieldsProgrammer.entity_name.label }}</span>
                                        </div>
                                        <div class="column is-6">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="pen"
                                                v-on:click.prevent="clickEdit('entity_name')"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Entity Name -->
                    <!-- Identification -->
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2">
                                <div class="field-identification-type control has-icons-left has-icons-right" v-if="programmer.identification.editing">
                                    <v-select
                                        v-model="identificationTypeSelected"
                                        :options="identificationsTypes"
                                        :reduce="identification_type => identification_type.meta"
                                        :placeholder="fieldsProgrammer.identifications_types_id.placeholder"
                                        :class="{ 'is-danger' : fieldsProgrammer.identifications_types_id.error }"
                                        label="identification_type"
                                    >
                                        <div slot="no-options">{{ text_no_options }}</div>
                                    </v-select>
                                    <span v-if="fieldsProgrammer.identifications_types_id.error" class="icon is-right has-text-danger"><i class="fas fa-exclamation-circle"></i></span>
                                    <p v-if="fieldsProgrammer.identifications_types_id.error" class="help is-danger">{{ fieldsProgrammer.identifications_types_id.msg }}</p>
                                </div>
                                <span v-else>{{ programmer.identifications_types_id.value ? identificationsTypesIdName[programmer.identifications_types_id.value] : fieldsProgrammer.identifications_types_id.placeholder }}</span>
                            </div>
                            <div class="column is-10">
                                <div class="columns">
                                    <div class="columns column is-12" v-if="programmer.identification.editing">
                                        <div class="column is-6">
                                            <b-field horizontal
                                                class="label_not-show"
                                                v-bind:type="{ 'is-danger' : fieldsProgrammer.identification.error }"
                                                :message="fieldsProgrammer.identification.error ? fieldsProgrammer.identification.msg : ''">
                                                <b-input
                                                    ref="identification"
                                                    name="identification"
                                                    v-model="programmer.identification.value"
                                                    maxlength="100"
                                                    v-on:keyup.native="onlyNumber($event, programmer.identification)"
                                                    expanded>
                                                </b-input>
                                            </b-field>

                                        </div>
                                        <div class="column is-6 content-buttons">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="save"
                                                v-on:click.prevent="clickUpdate( 'identification' )"
                                            />
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancel('identification')"
                                            />
                                        </div>
                                    </div>
                                    <div class="columns column is-12" v-else>
                                        <div class="column is-6">
                                            <span>{{ programmer.identification.value ? programmer.identification.value : fieldsProgrammer.identification.label }}</span>
                                        </div>
                                        <div class="column is-6">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="pen"
                                                v-on:click.prevent="clickEdit('identification')"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Identification -->
                    <!-- Logo company -->
                    <div class="column is-12">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="column is-10">
                                <span>{{ programmer.logo.value ? programmer.logo.value : fieldsProgrammer.logo.placeholder }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /Logo company -->
                </div>
                <p><b>selected:</b> {{ identificationTypeSelected }}</p>
                <p><b>selectedCopy:</b> {{ identificationTypeSelectedOriginal }}</p>
                <p><b>fieldsProgrammer:</b> {{ fieldsProgrammer }}</p>
                <p><b>programmer:</b> {{ programmer }}</p>
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
        props: {
            profile_participant: {
                type: String,
                require: true,
            },
            text_breadcrumbs_init: {
                type: String,
                require: true,
            },
            programmer_json: {
                type: String,
                require: true,
            },
            texts_general_settings_json: {
                type: String,
                require: true,
            },
            fields_programmer_json: {
                type: String,
                require: true,
            },
            text_updated_programmer: {
                type: String,
                require: true,
            },
            text_no_options: {
                type: String,
                require: true,
            },
            text_success: {
                type: String,
                require: true

            },
            url_identifications_types: {
                type: String,
                require: true,
            },
            url_update_programmer: {
                type: String,
                require: true,
            },
        },
        data() {
            return {
                isLoading: false,
                hasErrors: false,
                errors: {},
                programmer: new Object(),
                programmerCopy: new Object(),
                textsGeneralSettings: [],
                fieldsProgrammer: [],
                identificationTypeSelected: null,
                identificationTypeSelectedOriginal: null,
                identificationsTypes: [],
                identificationsTypesIdName: {}, // ID => name
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
                Vue.set(this.programmer,key,val); //Reactive objects and values
                //Crete programmer copy
                this.programmerCopy[key] = Object.assign({}, val); //Non-reactive copy
            });
            this.textsGeneralSettings = JSON.parse(this.texts_general_settings_json);
            this.fieldsProgrammer = JSON.parse(this.fields_programmer_json);
        },
        mounted(){
            this.getIdentificationsTypes();
        },
        methods: {
            clickCancelToHome(){
                this.$emit('activeMainSection','main')
            },
            onlyNumber(event, obj){
                const regex = new RegExp(/[^\d]/g);
                const val = event.target.value.replace(regex,"");
                if( obj.value !== val )
                {
                    obj.value = val;
                }
            },
            clickEdit( key ){
                this.programmer[ key].editing = !this.programmer[ key].editing;
                //wait for the input to load
                this.$nextTick(() => {
                    if( (this.$refs[ key ]) )
                    {
                        this.$refs[ key ].focus();
                    }
                });
            },
            clickCancel( key ){
                //Clean error, change "editing" and restore values
                this.programmer[ key ].value = this.programmerCopy[ key ].value;
                this.programmer[ key ].editing = false;
                this.fieldsProgrammer[ key ].error = false;
                if( key === "identification" )
                {
                    this.programmer.identifications_types_id.value = this.programmerCopy.identifications_types_id.value;
                    this.identificationTypeSelected = this.identificationTypeSelectedOriginal;
                    this.programmer.identifications_types_id.editing = false;
                    this.fieldsProgrammer.identifications_types_id.error = false;
                }
            },
            clickUpdate( key ){
                //cleans errors
                this.fieldsProgrammer[ key ].error = false;
                if( key === "identification" ) //Is Identification, clean identifications types
                {
                    this.fieldsProgrammer.identifications_types_id.error = false;
                }

                //Compare values
                if( this.programmer[ key ].value !== this.programmerCopy[ key ].value
                    || ( key === "identification" && this.identificationTypeSelected !== this.identificationTypeSelectedOriginal) )//Edited
                {
                    this.programmer[ key ].edited = true;

                    //validation
                    var valid = true;
                    const value = this.programmer[key].value;
                    const constraints = {
                        presence: {
                            allowEmpty: false,
                        }
                    };

                    if( validate.single(value, constraints ) !== undefined )
                    {
                        this.fieldsProgrammer[ key ].error = true;
                        valid = false;
                    }
                    if( key === "identification" && this.identificationTypeSelected === null )
                    {
                        this.fieldsProgrammer.identifications_types_id.error = true;
                        valid = false;
                    }

                    if( valid ) //Not errors
                    {
                        //update
                        this.updateProgrammer( key );
                    }
                }
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
                                this.identificationsTypesIdName[ element.id ] = name;
                                this.identificationsTypes.push( tmp );
                                //selected
                                if( this.programmer.identifications_types_id.value === element.id )
                                {
                                    this.identificationTypeSelected = element;
                                    this.identificationTypeSelectedOriginal = element;
                                }
                            });
                        }
                    },
                    error => {
                        this.showErrors(error);
                    })
                    .then( () => {
                        this.isLoading = false;
                    });
            },
            updateProgrammer( key )
            {
                const obj = this.programmer[ key ];
                if( obj.edited )
                {
                    this.isLoading = true;
                    const params = {
                        id: this.programmer.id.value,
                    };
                    params[key] = obj.value;
                    if( key === "identification" && this.identificationTypeSelected !== this.identificationTypeSelectedOriginal )
                    {
                        params['identifications_types_id'] = this.identificationTypeSelected.id;
                    }
                    axios.post(this.url_update_programmer, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                this.programmerCopy[ key ].value = obj.value;
                                obj.edited = false; //restore
                                obj.editing = false; //restore
                                if( key === "identification" && this.identificationTypeSelected !== this.identificationTypeSelectedOriginal )
                                {
                                    this.identificationTypeSelectedOriginal = this.identificationTypeSelected;//restore
                                }

                                success({
                                    title: this.text_success,
                                    text: this.text_updated_programmer
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
    }
</script>
