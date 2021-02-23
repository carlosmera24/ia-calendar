<template>
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
        <breadcrumb-to-main
            v-on:clickCancel="clickCancel"
            v-bind:text_breacrumbs="text_breadcrumbs_init"/>
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
            <div class="field field-select-participant">
                <div class="control has-icons-left">
                    <v-select v-model="participantSelected"
                        :options="participants"
                        :placeholder="textsManageLeader.search_participant"
                        :filterable="false"
                        label="participant"
                        @open="onOpenParticipant"
                        @close="onCloseParticipant"
                        @input="onSelectParticipantChanged"
                        @search="onSearchParticipants"
                    >
                        <div slot="no-options">{{ text_no_options }}</div>
                        <template #list-footer>
                            <li ref="load" class="v-secelet-loading" v-show="hasNextPageParticipant">
                                <span><i class="fas fa-spinner fa-pulse"></i>{{ text_loading }}</span>
                            </li>
                        </template>
                    </v-select>
                    <div class="icon is-small is-left">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
            <section class="data_participant">
                <div class="columns is-multiline">
                    <b-field horizontal class="column is-12"
                        :label="fields.first_name.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.meta.first_name : '' }}</span>
                    </b-field>
                    <b-field horizontal class="column is-12"
                        :label="fields.last_name.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.meta.last_name : '' }}</span>
                    </b-field>
                    <!-- Emails group -->
                    <div class="column is-12" v-if="participantSelected !== null">
                        <div class="columns is-multiline" >
                            <b-field horizontal class="column is-12"
                                v-for="(email, index) in participantSelected.meta.emails" :key="'email.'+index"
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
                                v-for="(mobile, index) in participantSelected.meta.cellphones" :key="'mobile.'+index"
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
                        :label="fields.position_company.label">
                        <span class="is-capitalized">{{ participantSelected ? participantSelected.meta.position_company : '' }}</span>
                    </b-field>
                    <b-field horizontal class="column is-12"
                        :label="fields.state.label">
                        <span class="is-capitalized">{{ participantSelected ? textsManageLeader.names_status_participants[participantSelected.meta.status_participants_id] : '' }}</span>
                    </b-field>
                    <b-field v-if="participantSelected && participantSelected.meta.status_participants_id !== 1" horizontal class="column is-12"
                        :label="fields.reason_change_state.label">
                        <span class="is-capitalized">{{ participantSelected ? ( participantSelected.meta.log_status ? participantSelected.meta.log_status.description : '' ) : '' }}</span>
                    </b-field>
                </div>
            </section>
            <section class="data_permissions">
                <div class="is-grouped">
                    <div class="button btn-main">
                        <b-checkbox-button
                            v-model="permissionsAssociateLeader"
                            :disabled="isEnabledAssociateLeader ? false : true"
                            native-value="true"
                            @input="clickAssociateLeader"
                            type="is-success">
                            <span class="is-size-5">&#9688;</span>
                        </b-checkbox-button>
                    </div>
                </div>
                <div class="columns is-multiline" >
                    <div class="field column is-12 mb-3">
                        <div class="field-label">
                            <label class="label label_associate_lader">
                                {{ textsManageLeader.associate_leader }}
                            </label>
                        </div>
                    </div>
                    <div class="content_permissions column is-12">
                        <div class="field column is-12 is-horizontal"
                            v-for="(permission, index) in permissionsEvents" :key="'permission.'+ index">
                            <b-switch v-model="permission.value"
                                :disabled="isEnabledAssociateLeader ? false : true"
                                type="is-success">
                                {{ permission.label }}
                            </b-switch>
                        </div>
                    </div>
                </div>
                <div class="content_categories">
                    <div class="field-categories control has-icons-left has-icons-right">
                        <v-select v-model="categoriesSelected"
                            multiple
                            :disabled="participantSelected ? false : true"
                            :options="categories"
                            :reduce="categorie => categorie.meta"
                            :placeholder="textsManageLeader.filter_categories"
                            label="categorie"
                            :class="{ 'is-danger' : isCategoriesError }"
                            >
                            <template >
                                <div slot="no-options">{{ text_no_options }}</div>
                            </template>
                        </v-select>
                        <span v-if="isCategoriesError" class="icon is-right has-text-danger"><i class="fas fa-exclamation-circle"></i></span>
                        <p v-if="isCategoriesError" class="help is-danger">{{ text_field_required }}</p>
                    </div>
                </div>
            </section>
            <section class="content_given_admin_permissions">
                <div class="is-grouped">
                    <div class="button btn-main">
                        <b-checkbox-button
                            v-model="permissionsAdmin"
                            :disabled="participantSelected ? false : true"
                            native-value="true"
                            @input="clickPermissionsAdmin"
                            type="is-success">
                            <span class="is-size-5">&#9688;</span>
                        </b-checkbox-button>
                    </div>
                    <span class="control-label">{{ textsManageLeader.give_admin_categories_events }}</span>
                </div>
                <div v-if="isPermissionsAdmin" class="columns is-multiline">
                    <div class="content_permissions column is-12">
                        <div class="field column is-12 is-horizontal"
                            v-for="(permission, index) in permissionsCategories" :key="'permission_categorie.'+ index">
                            <b-switch v-model="permission.value"
                                :disabled="participantSelected ? false : true"
                                type="is-success">
                                {{ permission.label }}
                            </b-switch>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content_back_participant">
                <div class="is-grouped">
                    <div class="button btn-main">
                        <b-checkbox-button
                            v-model="backParticipant"
                            :disabled="participantSelected ? false : true"
                            native-value="true"
                            @input="clickBackToParticipant"
                            type="is-warning">
                            <span class="icon">
                                <i class="fas fa-retweet"></i>
                            </span>
                        </b-checkbox-button>
                    </div>
                    <span class="control-label">{{ textsManageLeader.back_to_participant }}</span>
                </div>
                 <section class="alert-section">
                    <b-notification v-model="isBackParticipant" type="is-warning" hasIcon role="alert">
                        <p v-html="textsManageLeader.back_to_participant_warning"></p>
                    </b-notification>
                </section>
            </section>
            <div class="btn-actions has-text-centered">
                <b-button  class="btn-cancel is-capitalized" v-on:click.prevent="onSelectParticipantChanged">{{ text_cancel }}</b-button>
                <b-button
                    class="btn-accept is-capitalized"
                    v-on:click.prevent="clickApply"
                    :disabled="participantSelected ? false : true">
                    {{ text_apply }}
                </b-button>
            </div>
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
        text_breadcrumbs_init: {
            type: String,
            require: true

        },
        texts_manage_leader_json: {
            type: String,
            require: true

        },
        text_admin_leaders: {
            type: String,
            require: true

        },
        programmer_json: {
            type: String,
            require: true

        },
        user_id: {
            type: String,
            require: true

        },
        text_participant_fields_json: {
            type: String,
            require: true

        },
        text_apply: {
            type: String,
            require: true

        },
        text_cancel: {
            type: String,
            require: true

        },
        text_not: {
            type: String,
            require: true

        },
        text_success: {
            type: String,
            require: true

        },
        text_loading: {
            type: String,
            require: true

        },
        text_field_required: {
            type: String,
            require: true

        },
        text_no_options: {
            type: String,
            require: true

        },
        text_updated_participant: {
            type: String,
            require: true

        },
        url_participants_programmer: {
            type: String,
            require: true

        },
        url_categories_programmer: {
            type: String,
            require: true

        },
        url_permissions_participant: {
            type: String,
            require: true

        },
        url_participant_categories: {
            type: String,
            require: true

        },
        url_store_permissions_participant: {
            type: String,
            require: true

        },
        url_store_participants_categories: {
            type: String,
            require: true

        },
        url_participant_update: {
            type: String,
            require: true

        }
    },
    data() {
        return {
            textsManageLeader: [],
            isLoading: false,
            hasErrors: false,
            errors: {},
            participanError: false,
            perPageParticipants: 10,
            currentPageParticipants: 1,
            observerParticipants: null,
            totalParticipants: 0,
            searchParticipant: null,
            participants:[],
            participantSelected: null,
            permissions: {},
            copyPermissions: [],
            permissionsEvents: {},
            permissionsCategories: {},
            categories: [],
            categoriesSelected: [],
            isEnabledAssociateLeader: false,
            permissionsAssociateLeader: [],
            isAssociatedLeader: false,
            permissionsAdmin: [],
            isPermissionsAdmin: false,
            backParticipant: [],
            isBackParticipant: false,
            programmer: {},
            fields: [],
            isCategoriesError: false,
            newProfile: null,
            OPTIONS: {
                        EVENTS: 1,
                        CATEGORIES: 2,
                        PROFILE_LEADER: 2,
                        PROFILE_PARTICIPANT: 3,
                        PROFILE_SUPLE_ADMIN: 4,
                    }
        }
    },
    computed: {
        numPagesParticipants(){
            return Math.ceil( this.participants.length / this.totalParticipants );
        },
        hasNextPageParticipant(){
            return this.participants.length < this.totalParticipants;
        }
    },
    created(){
        this.textsManageLeader = JSON.parse(this.texts_manage_leader_json);
        this.programmer = JSON.parse(this.programmer_json);
        this.fields = JSON.parse(this.text_participant_fields_json);
        //Init permissions
        this.permissions = {
                                2: {
                                        value: false,
                                        label: this.textsManageLeader.create_categorie,
                                        permission: 'categories.create',
                                        id: 2
                                    },
                                3: {
                                        value: false,
                                        label: this.textsManageLeader.modify_categorie,
                                        permission: 'categories.edit',
                                        id: 3
                                    },
                                4: {
                                        value: false,
                                        label: this.textsManageLeader.delete_categorie,
                                        permission: 'categories.delete',
                                        id: 4
                                    },
                                6: {
                                        value: false,
                                        label: this.textsManageLeader.consult_events,
                                        permission: 'events.index',
                                        id: 6
                                    },
                                7: {
                                        value: false,
                                        label: this.textsManageLeader.create_events,
                                        permission: 'events.create',
                                        id: 7
                                    },
                                8: {
                                        value: false,
                                        label: this.textsManageLeader.modify_events,
                                        permission: 'events.edit',
                                        id: 8
                                    },
                                10: {
                                        value: false,
                                        label: this.textsManageLeader.share_events,
                                        permission: 'events.share',
                                        id: 10
                                    },
                                9: {
                                        value: false,
                                        label: this.textsManageLeader.delete_events,
                                        permission: 'events.delete',
                                        id: 9
                                    },
                            },
        //create copy permission for events and categories with link to permissions (global)
        Object.keys( this.permissions ).forEach( k => {
            const permission = this.permissions[k];
            //Events
            if( permission.id >= 6 && permission.id <= 10 )
            {
                this.permissionsEvents[k] = permission;
            }
            //Categories
            if( permission.id < 6 )
            {
                this.permissionsCategories[k] = permission;
            }
        });
    },
    mounted(){
        this.observerParticipants = new IntersectionObserver(this.participantsInfinityScroll);
        this.getCategories();
    },
    methods: {
        clickCancel(){
            this.$emit('activeMainSection','main')
        },
        showErrors(resError){
            this.errors = procesarErroresRequest( resError );
            this.hasErrors = this.errors.errors.length > 0;
        },
        clickAssociateLeader(){
            this.isAssociatedLeader = !this.isAssociatedLeader;//Change associated with leader
            this.backParticipant = []; //Disabled back to participant
            this.isBackParticipant = false; //Disabled back to participant
            this.newProfile = this.isAssociatedLeader ? this.OPTIONS.PROFILE_LEADER : null; //Change new profile
            if( this.isAssociatedLeader )
            {
                //Disable permissions admin
                this.permissionsAdmin = [];
                this.isPermissionsAdmin = false;
                //Reset categories permissions
                this.resetPermissions( this.OPTIONS.CATEGORIES );
                //Enable all events permissions
                Object.keys(this.permissions).forEach( (k,index) => {
                    //Events
                    if( k >= 6 && k <= 10 )
                    {
                        this.permissions[k].value = this.isAssociatedLeader;
                    }
                });
                this.permissionsAssociateLeader = ['true'];
            }else //Back all events permissions
            {
                var hasPermissionsEvents = false;
                this.resetPermissions( this.OPTIONS.EVENTS );
                this.copyPermissions.forEach( permi => {
                    //Events
                    if( permi.permissions_id >= 6 && permi.permissions_id <= 10 )
                    {
                        if( this.permissions[ permi.permissions_id ] !== undefined )
                        {
                            this.permissions[ permi.permissions_id ].value = true;
                            hasPermissionsEvents = true;
                        }
                    }
                });
                this.permissionsAssociateLeader = hasPermissionsEvents ? ['true'] : []
            }
        },
        clickPermissionsAdmin(){
            this.isPermissionsAdmin = !this.isPermissionsAdmin; //change associated with admin
            this.isAssociatedLeader = !this.isPermissionsAdmin; //Change associated with leader
            this.isEnabledAssociateLeader = !this.isPermissionsAdmin; //Disable/Enable associate with leader
            this.permissionsAssociateLeader = this.isPermissionsAdmin ? [] : ['true']; //Disable/Enable associate with leader
            this.backParticipant = []; //Disabled back to participant
            this.isBackParticipant = false; //Disabled back to participant
            this.newProfile = this.isPermissionsAdmin ? this.OPTIONS.PROFILE_SUPLE_ADMIN : null; //Change new profile
            Object.keys( this.permissions ).forEach( k => {
                const permission = this.permissions[k];
                //Categories
                if( permission.id < 6 )
                {
                    this.permissionsCategories[k].value = this.isPermissionsAdmin;
                }
                //Events
                if( this.isPermissionsAdmin && permission.id >=6 && permission.id <= 10 )
                {
                    this.permissions[k].value = true;
                }
            });

            //Restore permissions
            if( !this.isPermissionsAdmin )
            {
                this.loadPermissions( true, false );
            }
        },
        clickBackToParticipant(){
            this.$buefy.dialog.confirm(
                                        {
                                            title: this.textsManageLeader.back_to_participant,
                                            message: this.textsManageLeader.back_to_participant_confirm,
                                            cancelText: this.text_not,
                                            confirmText: this.textsManageLeader.back_to_participant,
                                            type: 'is-warning',
                                            hasIcon: true,
                                            onCancel: () => {
                                                this.backParticipant = [ ];
                                                this.isBackParticipant = false;
                                                //Restore permissions
                                                this.onSelectParticipantChanged();
                                            },
                                            onConfirm: () => {
                                                this.backParticipant = [ 'true' ];
                                                this.isBackParticipant = true;
                                                this.resetPermissions();
                                                this.categoriesSelected = [];
                                                this.isCategoriesError = false;
                                                this.permissionsAdmin = []
                                                this.permissionsAssociateLeader = [];
                                                this.isAssociatedLeader = false;
                                                this.isPermissionsAdmin = false;
                                                this.newProfile = this.OPTIONS.PROFILE_PARTICIPANT;
                                            }
                                        }
                                    );
        },
        onSearchParticipants: _.debounce( async function(search, loading){
            //_.debounce is used to wait for the user to finish typing and thus send the query request
            loading(true);
            this.searchParticipant = search.length ? search : null;
            this.participants = [];
            this.currentPageParticipants = 1;
            await this.getParticipants(loading);
            if(this.hasNextPageParticipant)
            {
                await this.$nextTick();
                //When v-select is closed with search in empty
                //avoid adding observer
                if( this.$refs.load ){
                    this.observerParticipants.observe(this.$refs.load);
                }
            }
        }, 500),
        async onOpenParticipant(){
            if( this.participants.length === 0 ){
                await this.getParticipants();
            }
            if(this.hasNextPageParticipant)
            {
                await this.$nextTick();
                this.observerParticipants.observe(this.$refs.load);
            }
        },
        onCloseParticipant(){
            this.observerParticipants.disconnect();
        },
        async participantsInfinityScroll(){
            this.currentPageParticipants++;
            await this.$nextTick();
            await this.getParticipants();
        },
        async getParticipants(loading = null){
            this.isLoading = true;
            var params = {
                programmers_id : this.programmer.id,
                users_id: this.user_id,
                perPage: this.perPageParticipants,
                page: this.currentPageParticipants,
            };
            if( this.searchParticipant && this.searchParticipant.length )
            {
                params['search'] = this.searchParticipant;
            }
            await axios.post(this.url_participants_programmer, params)
                .then( response => {
                    this.showErrors({});
                    if( response.data.status === 200 )
                    {
                        this.totalParticipants = response.data.recordsTotal;
                        response.data.participants.forEach( element => {
                            const name = element.first_name +" "+ element.last_name;
                            const participant = capitalize( name.toLocaleLowerCase() );
                            const tmp = {
                                participant: participant,
                                meta: element
                            }
                            //search element
                            const pos = this.participants.indexOf( tmp );
                            if( pos > 0 )
                            {
                                this.participants.splice(pos, 1);
                            }
                            this.participants.push( tmp );
                        });
                        if( loading )
                        {
                            loading(false);
                        }
                    }
                },
                error => {
                    this.showErrors(error);
                })
                .then( () => {
                    this.isLoading = false;
                });
        },
        getCategories(){
            this.isLoading = true;
            axios.post(this.url_categories_programmer, { programmers_id : this.programmer.id })
                .then( response => {
                    this.showErrors({});
                    if( response.data.status === 200 )
                    {
                        if( response.data.categories.length > 0 )
                        {
                            response.data.categories.forEach( element => {
                                const name = element.name;
                                const categorie = capitalize( name.toLocaleLowerCase() );
                                const tmp = {
                                    categorie: categorie,
                                    meta: element
                                }
                                this.categories.push( tmp );
                            });
                        }else //Empty categories
                        {
                            this.showErrors( this.textsManageLeader.empty_categories_required );
                        }
                    }
                },
                error => {
                    this.showErrors(error);
                })
                .then( () => {
                    this.isLoading = false;
                });
        },
        onSelectParticipantChanged(){
            this.resetPermissions();
            this.categoriesSelected = [];
            this.isCategoriesError = false;
            this.permissionsAdmin = []
            this.permissionsAssociateLeader = [];
            this.isAssociatedLeader = false;
            this.isPermissionsAdmin = false;
            this.isEnabledAssociateLeader = false;
            this.backParticipant= [],
            this.isBackParticipant= false,
            this.newProfile = null;
            if( this.participantSelected !== null)
            {
                this.isEnabledAssociateLeader = true;
                this.getPermissions( this.participantSelected.meta.id );
                //Validate profile for show admin permissions
                if( this.participantSelected.meta.profiles_participants_id === this.OPTIONS.PROFILE_SUPLE_ADMIN )
                {
                    this.isPermissionsAdmin = true;
                    this.permissionsAdmin = [ 'true' ];
                    this.isEnabledAssociateLeader = false;
                }else if(  this.participantSelected.meta.profiles_participants_id === this.OPTIONS.PROFILE_LEADER )//Validate profile for leader
                {
                    this.permissionsAssociateLeader = ['true'];
                }

            }else{
                this.copyPermissions = [];
            }
        },
        resetPermissions( opc = 0 ){
            switch(opc) {
                case 1: //Events
                    Object.keys(this.permissions).forEach( (k,index) => {
                        if( k >= 6 && k <= 10 )
                        {
                            this.permissions[k].value = false;
                        }
                    });
                    break;
                case 2: //Categories
                    Object.keys(this.permissions).forEach( (k,index) => {
                        if( k < 6 )
                        {
                            this.permissions[k].value = false;
                        }
                    });
                    break;
                default: //All
                    Object.keys(this.permissions).forEach( (k,index) => {
                        this.permissions[k].value = false;
                    });
                    break;
            }

        },
        loadPermissions( disableCategories = false, disableEvents = false ){
            this.resetPermissions();
            if( !validate.isEmpty(this.copyPermissions) )
            {
                this.copyPermissions.forEach( permi => {
                    if( this.permissions[ permi.permissions_id ] !== undefined )
                    {
                        this.permissions[ permi.permissions_id ].value = true;
                    }
                });
            }
            if( disableCategories )
            {
               this.resetPermissions(2);
            }
            if( disableEvents )
            {
               this.resetPermissions(1);
            }
        },
        getPermissions( id_participant ){
            this.isLoading = true;
            axios.post(this.url_permissions_participant, { participants_id : id_participant })
                .then( response => {
                    this.showErrors({});
                    if( response.data.status === 200 )
                    {
                        this.copyPermissions = response.data.permissions;
                        //load permissions
                        this.loadPermissions();
                        //load categories
                        this.getCategoriesParticipant( id_participant );
                    }
                },
                error => {
                    this.showErrors(error);
                })
                .then( () => {
                    this.isLoading = false;
                });
        },
        getCategoriesParticipant(id_participant){
            this.isLoading = true;
            axios.post(this.url_participant_categories, { participants_id : id_participant })
                .then( response => {
                    this.showErrors({});
                    if( response.data.status === 200 )
                    {
                        const categories = response.data.categories;
                        if( !validate.isEmpty(categories) )
                        {
                            //Load categories
                            categories.forEach( cat => {
                                this.categories.forEach( categorie => {
                                    if( cat.categories_id === categorie.meta.id ){
                                        this.categoriesSelected.push( categorie.meta );
                                    }
                                });
                            });
                        }else{
                            this.categoriesSelected = [];
                        }
                    }
                },
                error => {
                    this.showErrors(error);
                })
                .then( () => {
                    this.isLoading = false;
                });
        },
        clickApply(){
            this.isCategoriesError = false;
            //empty categories
            if( this.categories.length === 0 && !this.isBackParticipant  )
            {
                this.showErrors( this.textsManageLeader.empty_categories_required );

            }else if( validate.isEmpty(this.categoriesSelected) && !this.isBackParticipant )
            {
                this.isCategoriesError = true;
            }else
            {
                var permissions_ids = [];
                Object.keys( this.permissions ).forEach( k => {
                    const permi = this.permissions[k];
                    //Associated with leader from events permission
                    if( permi.id >= 6 && permi.id <= 10 )
                    {
                        this.isAssociatedLeader = permi.value ? permi.value : this.isAssociatedLeader;
                    }
                    permissions_ids.push( { id: permi.id, value: permi.value } );
                } );
                //Change new profile from Associated with leader and your permissions
                this.newProfile = this.isAssociatedLeader && !this.isPermissionsAdmin ? this.OPTIONS.PROFILE_LEADER : this.newProfile;
                //Save permissions
                this.isLoading = true;
                axios.post(this.url_store_permissions_participant, { participants_id: this.participantSelected.meta.id, permissions_ids: permissions_ids })
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //Save categories
                                this.setCategories();
                            }
                        },
                        error => {
                            this.showErrors(error);
                        } )
                    .then( () => {
                        this.isLoading = false;
                    });
            }
        },
        setCategories(){
            var categories_ids = [];
            this.categoriesSelected.forEach( categorie => {
                categories_ids.push( categorie.id );
            });
            this.isLoading = true;
            axios.post(this.url_store_participants_categories, { participants_id: this.participantSelected.meta.id, categories_ids: categories_ids })
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            //Change profile to Leader
                            this.setProfile();
                        }
                    },
                    error => {
                        this.showErrors(error);
                    } )
                .then( () => {
                    this.isLoading = false;
                });
        },
        setProfile(){
            //Update the profile if there is a change or is different from the current one
            if( this.newProfile && this.participantSelected.meta.profiles_participants_id !== this.newProfile )
            {
                const param = {
                    profiles_participants_id: this.newProfile,
                    id: this.participantSelected.meta.id
                };
                axios.post( this.url_participant_update, param )
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            //change profile local for the selected participant
                            this.participantSelected.meta.profiles_participants_id = this.newProfile;

                            success({
                                title: this.text_success,
                                text: this.text_updated_participant
                            });

                        }else if( response.data.status === 204 )
                        {
                            this.showErrors( response.data.data );
                        }
                    },
                    error => {
                        this.showErrors(error);
                    } );
            }else{
                success({
                    title: this.text_success,
                    text: this.text_updated_participant
                });
            }
        }
    }
}
</script>
