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
            <section class="programmer_data">
                <h3 class="title-section"><span class="numerator">1</span>{{ textsGeneralSettings.programmer_data }}</h3>
                <div class="columns is-multiline">
                    <!-- Entity Name -->
                    <div class="column is-12 is-row-data">
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
                                                v-on:click.prevent="clickUpdateProgrammer( 'entity_name' )"
                                            />
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancelProgrammer('entity_name')"
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
                                                v-on:click.prevent="clickEditProgrammer('entity_name')"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Entity Name -->
                    <!-- Identification -->
                    <div class="column is-12 is-row-data">
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
                                            <span class="dv-content">- {{ nitDV }}</span>
                                        </div>
                                        <div class="column is-6 content-buttons">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="save"
                                                v-on:click.prevent="clickUpdateProgrammer( 'identification' )"
                                            />
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancelProgrammer('identification')"
                                            />
                                        </div>
                                    </div>
                                    <div class="columns column is-12" v-else>
                                        <div class="column is-6">
                                            <span>{{ programmer.identification.value ? programmer.identification.value : fieldsProgrammer.identification.label }}</span>
                                            <span>- {{ nitDV }}</span>
                                        </div>
                                        <div class="column is-6">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="pen"
                                                v-on:click.prevent="clickEditProgrammer('identification')"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Identification -->
                    <!-- Logo company -->
                    <div class="column is-12 is-row-data">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="column is-10">
                                <div class="columns">
                                    <div class="columns column is-12" v-if="programmer.logo.editing">
                                        <div class="column is-6">
                                            <b-field class="file is-primary"
                                                :class="classFileLogo"
                                                v-bind:type="{ 'is-danger' : fieldsProgrammer.logo.error }"
                                                :message="fieldsProgrammer.logo.error ? fieldsProgrammer.logo.msg_limit_size : ''">
                                                <b-upload v-model="fileLogo"
                                                    class="file-label"
                                                    ref="inputFileLogo"
                                                    :accept="aceptLogo"
                                                    @input="onFileLogoSelected()"
                                                    >
                                                    <span class="file-cta">
                                                        <b-icon class="file-icon" icon="upload"></b-icon>
                                                        <span class="file-label">{{ fieldsProgrammer.logo.action_button }}</span>
                                                    </span>
                                                    <span class="file-name" v-if="fileLogo">
                                                        {{ fileLogo.name }}
                                                    </span>
                                                </b-upload>
                                            </b-field>
                                            <figure v-if="logoBase64" class="image logo-upload is-fullwith">
                                                <img :src="logoBase64">
                                            </figure>
                                        </div>
                                        <div class="column is-6 content-buttons">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="save"
                                                :disabled="!enabledUploadLogo"
                                                v-on:click.prevent="clickUpdateProgrammer( 'logo' )"
                                            />
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancelProgrammer('logo')"
                                            />
                                        </div>
                                    </div>
                                    <div class="columns column is-12" v-else>
                                        <div class="column is-6">
                                            <figure v-if="programmer.logo.value && img64Base" class="image logo">
                                                <img :src="img64Base">
                                            </figure>
                                            <span v-else>{{ fieldsProgrammer.logo.placeholder }}</span>
                                        </div>
                                        <div class="column is-6">
                                            <b-button
                                                class="btn-edit"
                                                size="is-small"
                                                icon-left="pen"
                                                v-on:click.prevent="clickEditProgrammer('logo')"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Logo company -->
                </div>
            </section>
            <section class="adminitrator_data">
                <h3 class="title-section"><span class="numerator">2</span>{{ textsGeneralSettings.administrator_data }}</h3>
                <div class="colums is-multiline">
                    <div class="colum is-12">
                        <div class="columns">
                            <div class="column is-2 is-row-data">
                                <!-- Profile image -->
                                <div class="avatar">
                                    <figure v-if="avatarAdmin" class="image">
                                        <img :src="avatarAdmin">
                                        <b-button
                                            v-if="!participant.profile_image.editing"
                                            class="btn-edit"
                                            size="is-small"
                                            icon-left="pen"
                                            v-on:click.prevent="clickEditParticipant('profile_image')"
                                        />
                                        <div v-else
                                            class="content-buttons">
                                            <b-button
                                                class="btn-save"
                                                size="is-small"
                                                icon-left="save"
                                                :disabled="!enabledUploadAvatar"
                                                v-on:click.prevent="clickUpdateParticipant( 'profile_image' )"
                                            />
                                            <b-button
                                                class="btn-cancel"
                                                size="is-small"
                                                icon-left="window-close"
                                                v-on:click.prevent="clickCancelParticipant('profile_image')"
                                            />
                                        </div>
                                    </figure>
                                    <b-field class="file is-primary" v-show="participant.profile_image.editing"
                                        :class="classFileAvatar"
                                        v-bind:type="{ 'is-danger' : fieldsParticipant.profile_image.error }"
                                        :message="fieldsParticipant.profile_image.error ? fieldsParticipant.profile_image.msg_limit_size : ''">
                                        <b-upload v-model="fileAvatar"
                                            class="file-label"
                                            ref="inputFileAvatar"
                                            :accept="aceptAvatar"
                                            @input="onFileAvatarSelected()"
                                            >
                                            <span class="file-cta">
                                                <b-icon class="file-icon" icon="upload"></b-icon>
                                            </span>
                                            <span class="file-name" v-if="fileAvatar">
                                                {{ fileAvatar.name }}
                                            </span>
                                        </b-upload>
                                    </b-field>
                                </div>
                                <!-- /Profile image -->
                            </div>
                            <div class="column is-10 is-row-data">
                                Otros campos
                            </div>
                        </div>
                    </div>
                </div>
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
            participant_fields_json: {
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
            participant_json: {
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
            url_image_base: {
                type: String,
                require: true
            },
            url_person_ui_avatar: {
                type: String,
                require: true
            },
            url_participant_update: {
                type: String,
                require: true
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
                fileLogo: null,
                logoBase64: null,
                enabledUploadLogo: false,
                aceptLogo: ".jpg,.png",
                sizeFieleUploadAllow: (1024 * 1024 ) * 5, //5MB
                img64Base: null,
                participant: new Object(),
                participantCopy: new Object(),
                avatarAdmin: null,
                avatarAdminCopy: null,
                OPTIONS:{
                            PROGRAMMER : 1,
                            PARTICIPANT: 2,
                        },
                fieldsParticipant: [],
                fileAvatar: null,
                enabledUploadAvatar: false,
                aceptAvatar: ".jpg,.png,.gif",
            }
        },
        computed: {
            nitDV(){
                return this.generateDV(this.programmer.identification.value);
            },
            classFileLogo(){
                return {
                    'has-name': !!this.fileLogo,
                    'is-danger': this.fieldsProgrammer.logo.error,
                    'is-primary': !this.fieldsProgrammer.logo.error
                }
            },
            classFileAvatar(){
                return {
                    'has-name': !!this.fileAvatar,
                    'is-danger': this.fieldsParticipant.profile_image.error,
                    'is-primary': !this.fieldsParticipant.profile_image.error
                }
            },
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
            this.fieldsParticipant = JSON.parse(this.participant_fields_json);
            //Create/load participant data
            const initParticipant = JSON.parse(this.participant_json);
            Object.keys(initParticipant).forEach( key => {
               const val = {
                                'value':    initParticipant[key],
                                'edited':   false,
                                'editing':  false,
                            };
                Vue.set(this.participant,key,val); //Reactive objects and values
                //Crete participant copy
                this.participantCopy[key] = Object.assign({}, val); //Non-reactive copy
            });
        },
        mounted(){
            this.getIdentificationsTypes();
            this.getImg64Base(this.OPTIONS.PROGRAMMER, this.programmer.logo.value );//Get logo programmer
            this.getImgAvatar();
        },
        methods: {
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
            getImgAvatar(){
                if( this.participant.profile_image.value )
                {
                    this.getImg64Base(this.OPTIONS.PARTICIPANT, this.participant.profile_image.value );
                }else{
                    this.getAvatarString();
                }
            },
            getImg64Base(option, name){
                if( name )
                {
                    this.isLoading = true;
                    const params = {
                        name: name,
                        option: option
                    };
                    axios.get(this.url_image_base, { params: params})
                        .then( response => {
                            if( response.status === 200 )
                            {
                                if( option === this.OPTIONS.PROGRAMMER )
                                {
                                    this.img64Base = response.data;
                                }else if( option === this.OPTIONS.PARTICIPANT ){
                                    this.avatarAdmin = response.data;
                                    this.avatarAdminCopy = response.data;
                                }
                            }
                        },
                        error => {
                            this.showErrors(error);
                        })
                        .then( () => {
                            this.isLoading = false;
                        });
                }
            },
            getAvatarString(){
                const fname = this.participant.person.value.first_name.trim();
                const lname = this.participant.person.value.last_name.trim();
                var name = "";
                //Only one first name
                if( fname !== "" )
                {
                    name = fname.split(" ",1)[0];
                }
                //Only one last name
                if( lname !== "" )
                {
                    name += " " + lname.split(" ",1)[0];
                }
                name = name.trim();
                if( name !== "" )
                {
                    this.isLoading = true;
                    axios.post( this.url_person_ui_avatar, { name: name } )
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                this.avatarAdmin = response.data.avatar.encoded;
                                this.avatarAdminCopy = response.data.avatar.encoded;
                            }
                        },
                        error => {
                            this.showErrors( error );
                        } )
                        .then( () => {
                            this.isLoading = false;
                        });
                }else{
                    this.avatarAdmin = null;
                    this.avatarAdminCopy = null;
                }
            },
            generateDV(num)
            {
                const serie = [71,67,59,53,47,43,41,37,29,23,19,17,13,7,3];
                const numArray = Array.from( num.toString().replace(/\D/g, '').trim() );

                //Equality numArray with serie
                const diff = serie.length - numArray.length;
                //Add 0
                if( diff > 0 )
                {
                    for(var n=0; n < diff; n++ )
                    {
                        numArray.unshift(0);
                    }
                }

                //Generate DV
                var sum = 0;
                serie.forEach( (num, i) =>{
                    sum += num * parseInt(numArray[i]);
                });

                const arg11 = sum % 11;
                const dv = ( arg11 === 0 || arg11 === 1) ? arg11 : 11 - arg11;

                return dv;
            },
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
            async imageToBase64(file){
                return await new Promise( (resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = error => reject(error);
                });
            },
            async onFileLogoSelected(){
                //validate format
                if( this.fileLogo )
                {
                    this.isLoading = true;
                    this.fieldsProgrammer.logo.error = false;
                    this.enabledUploadLogo = true;
                    const result = await this.imageToBase64(this.fileLogo).catch(e => Error(e));
                    if(result instanceof Error) {
                        this.showErrors( result.message )
                        console.log('Error: ', result.message);
                        return;
                    }
                    this.logoBase64 = result;
                    this.isLoading = false;
                }else{
                    this.enabledUploadLogo = false;
                }
            },
            async onFileAvatarSelected(){
                //validate format
                if( this.fileAvatar )
                {
                    this.isLoading = true;
                    this.fieldsParticipant.profile_image.error = false;
                    this.enabledUploadAvatar = true;
                    const result = await this.imageToBase64(this.fileAvatar).catch(e => Error(e));
                    if(result instanceof Error) {
                        this.showErrors( result.message )
                        console.log('Error: ', result.message);
                        return;
                    }
                    this.avatarAdmin = result;
                    this.isLoading = false;
                }else{
                    this.enabledUploadAvatar = false;
                }
            },
            clickEditProgrammer( key ){
                this.programmer[ key].editing = !this.programmer[ key].editing;
                //wait for the input to load
                this.$nextTick(() => {
                    if( (this.$refs[ key ]) )
                    {
                        this.$refs[ key ].focus();
                    }
                });
            },
            clickCancelProgrammer( key ){
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
                if( key === "logo" )
                {
                    this.fileLogo = null;
                    this.logoBase64 = null;
                    this.enabledUploadLogo= null;
                }
            },
            clickUpdateProgrammer( key ){
                this.isLoading = true;
                //cleans errors
                this.fieldsProgrammer[ key ].error = false;
                if( key === "identification" ) //Is Identification, clean identifications types
                {
                    this.fieldsProgrammer.identifications_types_id.error = false;
                }
                if( key === "logo" )
                {
                    //Value for save in DDBB
                    this.programmer.logo.value = this.logoBase64;
                }

                //Compare values
                if( this.programmer[ key ].value !== this.programmerCopy[ key ].value
                    || ( key === "identification" && this.identificationTypeSelected !== this.identificationTypeSelectedOriginal)
                    || ( key === "logo" && this.logoBase64) )//Edited
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

                    if( key === "logo" && this.fileLogo.size > this.sizeFieleUploadAllow )
                    {
                        this.fieldsProgrammer.logo.error = true;
                        valid = false;
                    }

                    this.isLoading = false;

                    if( valid ) //Not errors
                    {
                        //update
                        this.updateProgrammer( key );
                    }
                }
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
                                if( key === "logo" && response.data.data.extra )//Update logo info
                                {
                                    this.programmer[ key ].value = response.data.data.extra;
                                    this.programmerCopy[ key ].value = response.data.data.extra;
                                    this.fileLogo = null;
                                    this.logoBase64 = null;
                                    this.enabledUploadLogo = false;
                                    this.getImg64Base(this.OPTIONS.PROGRAMMER, this.programmer.logo.value );
                                }else//Update copy
                                {
                                    this.programmerCopy[ key ].value = obj.value;
                                }
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
            },
            clickEditParticipant( key ){
                this.participant[ key].editing = !this.participant[ key].editing;
                //wait for the input to load
                this.$nextTick(() => {
                    if( (this.$refs[ key ]) )
                    {
                        this.$refs[ key ].focus();
                    }
                });
            },
            clickCancelParticipant( key ){
                //Clean error, change "editing" and restore values
                this.participant[ key ].value = this.participantCopy[ key ].value;
                this.participant[ key ].editing = false;
                this.fieldsParticipant[ key ].error = false;

                if( key === "profile_image" )
                {
                    this.fileAvatar = null;
                    this.avatarAdmin = this.avatarAdminCopy;
                    this.enabledUploadAvatar = false;
                }
            },
            clickUpdateParticipant( key ){
                this.isLoading = true;
                //cleans errors
                this.fieldsParticipant[ key ].error = false;

                if( key === "profile_image" )
                {
                    //Value for save in DDBB
                    this.participant[ key ].value = this.avatarAdmin;
                }

                //compare values
                if( this.participant[ key ].value !== this.participant[ key ].value
                    || (key === "profile_image" && this.avatarAdmin !== this.avatarAdminCopy) )//Edited
                {
                    this.participant[ key ].edited = true;

                    //validation
                    let valid = true;
                    const value = this.participant[key].value;
                    const constraints = {
                        presence: {
                            allowEmpty: false,
                        }
                    };

                    if( validate.single(value, constraints ) !== undefined )
                    {
                        this.fieldsParticipant[ key ].error = true;
                        valid = false;
                    }

                    if( key === "profile_image" && this.fileAvatar.size > this.sizeFieleUploadAllow )
                    {
                        this.fieldsParticipant[ key ].error = true;
                        valid = false;
                    }

                    this.isLoading = false;

                    if( valid ) //Not errors
                    {
                        //update
                        this.updateParticipant( key );
                    }
                }
            },
            updateParticipant( key ){
                const obj = this.participant[ key ];
                if( obj.edited )
                {
                    this.isLoading = true;
                    const params = {
                        id: this.participant.id.value,
                    };
                    params[key] = obj.value;

                    axios.post(this.url_participant_update, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                if( key === "profile_image" && response.data.data.extra )//Update avatar info
                                {
                                    this.participant[ key ].value = response.data.data.extra;
                                    this.participantCopy[ key ].value = response.data.data.extra;
                                    this.fileAvatar = null;
                                    this.enabledUploadAvatar = false;
                                    this.getImg64Base(this.OPTIONS.PARTICIPANT, this.participant.profile_image.value );
                                }else//Update copy
                                {
                                    this.participantCopy[ key ].value = obj.value;
                                }
                                obj.edited = false; //restore
                                obj.editing = false; //restore

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
