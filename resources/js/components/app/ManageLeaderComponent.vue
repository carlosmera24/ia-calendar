<template>
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
                        @input="onSelectParticipantChanged"
                    >
                        <div slot="no-options">{{ text_no_options }}</div>
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
                <b-button
                    :disabled="participantSelected ? false : true"
                    v-on:click.prevent="clickAssociateLeader"
                    >
                    <span class="is-size-5">&#9688;</span>
                </b-button>
                <div class="columns is-multiline" >
                    <div class="field column is-12">
                        <div class="field-label">
                            <label class="label label_associate_lader">
                                {{ text_associate_leader }}
                            </label>
                        </div>
                    </div>
                    <div class="content_permissions column is-12">
                        <div class="field column is-12 is-horizontal"
                            v-for="(permission, index) in permissions" :key="'permission.'+ index">
                            <b-switch v-model="permission.value"
                                :disabled="participantSelected ? false : true"
                                type="is-success">
                                {{ permission.label }}
                            </b-switch>
                        </div>
                    </div>
                </div>
                <div class="content_categories">
                    <v-select v-model="categoriesSelected"
                        multiple
                        :disabled="participantSelected ? false : true"
                        :options="categories"
                        :reduce="categorie => categorie.meta"
                        :placeholder="text_filter_categories"
                        label="categorie"
                        >
                        <div slot="no-options">{{ text_no_options }}</div>
                    </v-select>
                </div>
            </section>
            <div class="btn-actions has-text-centered">
                <b-button  class="btn-cancel is-capitalized" v-on:click.prevent="clickCancel">{{ text_cancel }}</b-button>
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
import { procesarErroresRequest, capitalize } from '../../functions.js';
var validate = require('validate.js');
//Import vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
//Import PNotify
import { success } from '@pnotify/core';
import '@pnotify/core/dist/PNotify.css';
import '@pnotify/core/dist/BrightTheme.css';

export default {
    props: [
        'text_breadcrumbs_init',
        'text_admin_leaders',
        'programmer_json',
        'user_id',
        'text_search_participant',
        'text_participant_fields_json',
        'text_associate_leader',
        'text_consult_categories_events',
        'text_create_events',
        'text_modify_events',
        'text_share_events',
        'text_delete_events',
        'text_create_categorie',
        'text_modify_categorie',
        'text_delete_categorie',
        'text_filter_categories',
        'text_apply',
        'text_cancel',
        'text_success',
        'text_no_options',
        'text_updated_participant',
        'url_participants_programmer',
        'url_categories_programmer',
        'url_permissions_participant',
        'url_participant_categories',
        'url_store_permissions_participant',
        'url_store_participants_categories',
        'url_participant_update'
    ],
    data() {
        return {
            isLoading: false,
            hasErrors: false,
            errors: {},
            participanError: false,
            participants:[],
            participantSelected: null,
            permissions: {
                            1: {
                                    value: false,
                                    label: this.text_consult_categories_events,
                                    permission: [ 'categories.index', 'events.index' ],
                                    id: [
                                            1, //categories.index
                                            6, //events.index
                                        ]
                                },
                            2: {
                                    value: false,
                                    label: this.text_create_categorie,
                                    permission: 'categories.create',
                                    id: 2
                                },
                            3: {
                                    value: false,
                                    label: this.text_modify_categorie,
                                    permission: 'categories.edit',
                                    id: 3
                                },
                            4: {
                                    value: false,
                                    label: this.text_delete_categorie,
                                    permission: 'categories.delete',
                                    id: 4
                                },
                            7: {
                                    value: false,
                                    label: this.text_create_events,
                                    permission: 'events.create',
                                    id: 7
                                },
                            8: {
                                    value: false,
                                    label: this.text_modify_events,
                                    permission: 'events.edit',
                                    id: 8
                                },
                            10: {
                                    value: false,
                                    label: this.text_share_events,
                                    permission: 'events.share',
                                    id: 10
                                },
                            9: {
                                    value: false,
                                    label: this.text_delete_events,
                                    permission: 'events.delete',
                                    id: 9
                                },
                        },
            categories: [],
            categoriesSelected: [],
            associate_leader: false,
            isAssociatedLeader: false,
            programmer: {},
            fields: [],
            PROFILE_LEADER: 2, //ID Profile leader
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
        clickAssociateLeader(){
            this.associate_leader = !this.associate_leader;
            Object.keys(this.permissions).forEach( (k,index) => {
                this.permissions[k].value = this.associate_leader;
            });
        },
        getParticipants(){
            this.isLoading = true;
            axios.post(this.url_participants_programmer, { programmers_id : this.programmer.id, users_id: this.user_id })
                .then( response => {
                    this.showErrors({});
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
                        //Get categories
                        this.getCategories();
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
                        response.data.categories.forEach( element => {
                            const name = element.name;
                            const categorie = capitalize( name.toLocaleLowerCase() );
                            const tmp = {
                                categorie: categorie,
                                meta: element
                            }
                            this.categories.push( tmp );
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
        onSelectParticipantChanged(){
            this.resetPermissions();
            this.categoriesSelected = [];
            if( this.participantSelected !== null)
            {
                this.getPermissions( this.participantSelected.id );
            }
        },
        resetPermissions(){
            Object.keys(this.permissions).forEach( (k,index) => {
                this.permissions[k].value = false;
            });
        },
        getPermissions( id_participant ){
            this.isLoading = true;
            axios.post(this.url_permissions_participant, { participants_id : id_participant })
                .then( response => {
                    this.showErrors({});
                    if( response.data.status === 200 )
                    {
                        const permissions = response.data.permissions;
                        if( !validate.isEmpty(permissions) )
                        {
                            //Load permissions
                            permissions.forEach( permi => {
                                if( permi.permissions_id !== 6 )
                                {
                                    this.permissions[ permi.permissions_id ].value = true;
                                }
                            });
                            //load categories
                            this.getCategoriesParticipant( id_participant );
                        }else{
                            this.resetPermissions();
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
            this.isAssociatedLeader = this.associate_leader;
            var permissions_ids = [];
            Object.keys( this.permissions ).forEach( k => {
                const permi = this.permissions[k];
                this.isAssociatedLeader = permi.value ? permi.value : this.isAssociatedLeader;
                if( validate.isArray( permi.id ) )
                {
                    permi.id.forEach( id => {
                        permissions_ids.push( { id: id, value: permi.value } );
                    });
                }else{
                    permissions_ids.push( { id: permi.id, value: permi.value } );
                }
            } );
            //Save permissions as leader
            this.isLoading = true;
            axios.post(this.url_store_permissions_participant, { participants_id: this.participantSelected.id, permissions_ids: permissions_ids })
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
        },
        setCategories(){
            var categories_ids = [];
            this.categoriesSelected.forEach( categorie => {
                categories_ids.push( categorie.id );
            });
            this.isLoading = true;
            axios.post(this.url_store_participants_categories, { participants_id: this.participantSelected.id, categories_ids: categories_ids })
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            //Change profile to Leader
                            this.setProfileAsLeader();
                        }
                    },
                    error => {
                        this.showErrors(error);
                    } )
                .then( () => {
                    this.isLoading = false;
                });
        },
        setProfileAsLeader(){
            if( this.isAssociatedLeader && this.participantSelected.profiles_participants_id !== this.PROFILE_LEADER )
            {
                const param = {
                    profiles_participants_id: this.PROFILE_LEADER,
                    id: this.participantSelected.id
                };
                axios.post( this.url_participant_update, param )
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
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
