<template>
    <div class="content px-5 py-5">
        <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>

        <breadcrumb-to-main
            v-on:clickCancel="clickCancelToHome"
            v-bind:text_breacrumbs="text_breadcrumbs_init"/>
        <h2>{{ textsGeneralSettings.text_general_setting }} {{ textsGeneralSettings.names_profiles_participants[ this.participant.profiles_participants_id.value] }}</h2>
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
                            <div class="columns column is-10">
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
                                                v-on:blur="setTrim('entity_name', OPTIONS.PROGRAMMER)"
                                                maxlength="120"
                                                expanded>
                                            </b-input>
                                        </b-field>

                                    </div>
                                    <div class="column is-6 content-buttons">
                                        <b-button
                                            size="is-small"
                                            icon-left="save"
                                            v-on:click.prevent="clickUpdateProgrammer( 'entity_name' )"
                                        />
                                        <b-button
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
                            <div class="columns column is-10">
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
                                            size="is-small"
                                            icon-left="save"
                                            v-on:click.prevent="clickUpdateProgrammer( 'identification' )"
                                        />
                                        <b-button
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
                    <!-- /Identification -->
                    <!-- Logo company -->
                    <div class="column is-12 is-row-data">
                        <div class="columns">
                            <div class="column is-2"></div>
                            <div class="columns column is-10">
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
                                            size="is-small"
                                            icon-left="save"
                                            :disabled="!enabledUploadLogo"
                                            v-on:click.prevent="clickUpdateProgrammer( 'logo' )"
                                        />
                                        <b-button
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
                            <div class="column is-10">
                                <div class="columns is-multiline">
                                    <!-- Mail main admin-->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-6 is-row-data">
                                            <span class="column is-8">{{ participant.person.initial_register_email ? participant.person.initial_register_email.value.email : firstCapitalize(fieldsParticipant.email.label) }}</span>
                                            <span class="column is-4 label-info">{{ textsGeneralSettings.predetermined }}</span>
                                        </div>
                                        <div class="column is-6">
                                        </div>
                                    </div>
                                    <!-- /Mail main admin-->
                                    <!-- Mail used for events admin-->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-12 row-used_events_email" v-if="participant.person.used_events_email !== undefined && participant.person.used_events_email.editing">
                                            <div class="column is-6">
                                                <b-field horizontal
                                                    class="label_not-show"
                                                    v-bind:type="{ 'is-danger' : fieldsParticipant.email.error }"
                                                    :message="fieldsParticipant.email.error ? emailError : ''">
                                                    <b-input
                                                        ref="person.used_events_email"
                                                        name="person.used_events_email"
                                                        v-model="participant.person.used_events_email.value.email"
                                                        v-on:blur="setTrim('person.used_events_email.value.email', OPTIONS.PARTICIPANT)"
                                                        maxlength="120"
                                                        expanded>
                                                    </b-input>
                                                </b-field>

                                            </div>
                                            <div class="column is-6 content-buttons">
                                                <b-button
                                                    size="is-small"
                                                    icon-left="save"
                                                    v-on:click.prevent="clickUpdateParticipant( 'person.used_events_email' )"
                                                />
                                                <b-button
                                                    size="is-small"
                                                    icon-left="window-close"
                                                    v-on:click.prevent="clickCancelParticipant('person.used_events_email')"
                                                />
                                            </div>
                                        </div>
                                        <div class="columns column is-12 row-used_events_email" v-else-if="participant.person.used_events_email !== undefined">
                                            <div class="columns column is-6 is-row-data">
                                                <span class="column is-8">{{ participant.person.used_events_email.value.email ? participant.person.used_events_email.value.email : firstCapitalize(fieldsParticipant.email.label) }}</span>
                                                <span class="column is-4 label-info">{{ textsGeneralSettings.use_for_events }}</span>
                                            </div>
                                            <div class="column is-6">
                                                <b-button
                                                    class="btn-edit"
                                                    size="is-small"
                                                    icon-left="pen"
                                                    v-on:click.prevent="clickEditParticipant('person.used_events_email')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Mail used for events admin-->
                                    <!-- Cellphones -->
                                    <div class="columns column is-12 is-row-data"
                                        v-for="(mobile, index) in participant.person.cellphones" :key="'mobile.'+index">
                                            <div class="columns column is-12" v-if="mobile.editing">
                                                <div class="column is-6">
                                                    <b-field horizontal
                                                        class="label_not-show"
                                                        v-bind:type="{ 'is-danger' : mobile.error }"
                                                        :message="mobile.error ? mobile.msg : ''">
                                                        <b-input
                                                            :ref="'person.cellphones_'+index"
                                                            :name="'person.cellphones_'+index"
                                                            v-model="mobile.value.cellphone_number"
                                                            v-on:blur="setTrim('person.cellphones.value.cellphone_number', OPTIONS.PARTICIPANT, index)"
                                                            v-on:keyup.native="onlyPhoneNumber($event, index)"
                                                            maxlength="17"
                                                            expanded>
                                                        </b-input>
                                                    </b-field>

                                                </div>
                                                <div class="column is-6 content-buttons">
                                                    <b-button
                                                        size="is-small"
                                                        icon-left="save"
                                                        v-on:click.prevent="clickUpdateParticipant( 'person.cellphones', index )"
                                                    />
                                                    <b-button
                                                        size="is-small"
                                                        icon-left="window-close"
                                                        v-on:click.prevent="clickCancelParticipant('person.cellphones', index)"
                                                    />
                                                </div>
                                            </div>
                                            <div class="columns column is-12" v-else>
                                                <div class="column is-6 is-row-data">
                                                    <span>{{ mobile.value.cellphone_number ? mobile.value.cellphone_number : fieldsParticipant.mobile.placeholder }}</span>
                                                </div>
                                                <div class="column is-6">
                                                    <b-button
                                                        class="btn-edit"
                                                        size="is-small"
                                                        icon-left="pen"
                                                        v-on:click.prevent="clickEditParticipant('person.cellphones', index)"
                                                    />
                                                </div>
                                            </div>
                                    </div>
                                    <!-- /Cellphones -->
                                    <!-- First Name -->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-12" v-if="participant.person.first_name.editing">
                                            <div class="column is-6">
                                                <b-field horizontal
                                                    class="label_not-show"
                                                    v-bind:type="{ 'is-danger' : fieldsParticipant.first_name.error }"
                                                    :message="fieldsParticipant.first_name.error ? fieldsParticipant.first_name.msg : ''">
                                                    <b-input
                                                        ref="person.first_name"
                                                        name="person.first_name"
                                                        v-model="participant.person.first_name.value"
                                                        v-on:keyup.native="capitalizeText($event, 'person.first_name', OPTIONS.PARTICIPANT)"
                                                        v-on:blur="setTrim('person.first_name', OPTIONS.PARTICIPANT)"
                                                        maxlength="100"
                                                        expanded>
                                                    </b-input>
                                                </b-field>

                                            </div>
                                            <div class="column is-6 content-buttons">
                                                <b-button
                                                    size="is-small"
                                                    icon-left="save"
                                                    v-on:click.prevent="clickUpdateParticipant( 'person.first_name' )"
                                                />
                                                <b-button
                                                    size="is-small"
                                                    icon-left="window-close"
                                                    v-on:click.prevent="clickCancelParticipant('person.first_name')"
                                                />
                                            </div>
                                        </div>
                                        <div class="columns column is-12" v-else>
                                            <div class="column is-6 is-row-data">
                                                <span>{{ participant.person.first_name ? participant.person.first_name.value : firstCapitalize(fieldsParticipant.first_name.label) }}</span>
                                            </div>
                                            <div class="column is-6">
                                                <b-button
                                                    class="btn-edit"
                                                    size="is-small"
                                                    icon-left="pen"
                                                    v-on:click.prevent="clickEditParticipant('person.first_name')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /First Name -->
                                    <!-- Last Name -->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-12" v-if="participant.person.last_name.editing">
                                            <div class="column is-6">
                                                <b-field horizontal
                                                    class="label_not-show"
                                                    v-bind:type="{ 'is-danger' : fieldsParticipant.last_name.error }"
                                                    :message="fieldsParticipant.last_name.error ? fieldsParticipant.last_name.msg : ''">
                                                    <b-input
                                                        ref="person.last_name"
                                                        name="person.last_name"
                                                        v-model="participant.person.last_name.value"
                                                        v-on:keyup.native="capitalizeText($event, 'person.last_name', OPTIONS.PARTICIPANT)"
                                                        v-on:blur="setTrim('person.last_name', OPTIONS.PARTICIPANT)"
                                                        maxlength="100"
                                                        expanded>
                                                    </b-input>
                                                </b-field>

                                            </div>
                                            <div class="column is-6 content-buttons">
                                                <b-button
                                                    size="is-small"
                                                    icon-left="save"
                                                    v-on:click.prevent="clickUpdateParticipant( 'person.last_name' )"
                                                />
                                                <b-button
                                                    size="is-small"
                                                    icon-left="window-close"
                                                    v-on:click.prevent="clickCancelParticipant('person.last_name')"
                                                />
                                            </div>
                                        </div>
                                        <div class="columns column is-12" v-else>
                                            <div class="column is-6 is-row-data">
                                                <span>{{ participant.person.last_name ? participant.person.last_name.value : firstCapitalize(fieldsParticipant.last_name.label) }}</span>
                                            </div>
                                            <div class="column is-6">
                                                <b-button
                                                    class="btn-edit"
                                                    size="is-small"
                                                    icon-left="pen"
                                                    v-on:click.prevent="clickEditParticipant('person.last_name')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Last Name -->
                                    <!-- Position company -->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-12" v-if="participant.person.position_company.editing">
                                            <div class="column is-6">
                                                <b-field horizontal
                                                    class="label_not-show"
                                                    v-bind:type="{ 'is-danger' : fieldsParticipant.position_company.error }"
                                                    :message="fieldsParticipant.position_company.error ? fieldsParticipant.position_company.msg : ''">
                                                    <b-input
                                                        ref="person.position_company"
                                                        name="person.position_company"
                                                        v-model="participant.person.position_company.value"
                                                        v-on:blur="setTrim('person.position_company', OPTIONS.PARTICIPANT)"
                                                        maxlength="60"
                                                        expanded>
                                                    </b-input>
                                                </b-field>

                                            </div>
                                            <div class="column is-6 content-buttons">
                                                <b-button
                                                    size="is-small"
                                                    icon-left="save"
                                                    v-on:click.prevent="clickUpdateParticipant( 'person.position_company' )"
                                                />
                                                <b-button
                                                    size="is-small"
                                                    icon-left="window-close"
                                                    v-on:click.prevent="clickCancelParticipant('person.position_company')"
                                                />
                                            </div>
                                        </div>
                                        <div class="columns column is-12" v-else>
                                            <div class="column is-6 is-row-data">
                                                <span>{{ participant.person.position_company ? participant.person.position_company.value : firstCapitalize(fieldsParticipant.position_company.label) }}</span>
                                            </div>
                                            <div class="column is-6">
                                                <b-button
                                                    class="btn-edit"
                                                    size="is-small"
                                                    icon-left="pen"
                                                    v-on:click.prevent="clickEditParticipant('person.position_company')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Position company -->
                                    <!-- Birth date -->
                                    <div class="columns column is-12 is-row-data">
                                        <div class="columns column is-12" v-if="participant.person.birth_date.editing">
                                            <div class="column is-6">
                                                <b-field horizontal
                                                    class="label_not-show"
                                                    v-bind:type="{ 'is-danger' : fieldsParticipant.birth_date.error }"
                                                    :message="fieldsParticipant.birth_date.error ? fieldsParticipant.birth_date.msg : ''">
                                                    <b-datepicker
                                                        ref="person.birth_date"
                                                        name="person.birth_date"
                                                        v-model="birth_date"
                                                        :show-week-number="false"
                                                        :open-on-focus="true"
                                                        :locale="locale"
                                                        :date-formatter="dateFormat"
                                                        :max-date="maxBirthDate"
                                                        :inline="true"
                                                        @input="onChangedBirthDate"
                                                        trap-focus expanded>
                                                    </b-datepicker>
                                                </b-field>

                                            </div>
                                            <div class="column is-6 content-buttons">
                                                <b-button
                                                    size="is-small"
                                                    icon-left="save"
                                                    v-on:click.prevent="clickUpdateParticipant( 'person.birth_date' )"
                                                />
                                                <b-button
                                                    size="is-small"
                                                    icon-left="window-close"
                                                    v-on:click.prevent="clickCancelParticipant('person.birth_date')"
                                                />
                                            </div>
                                        </div>
                                        <div class="columns column is-12" v-else>
                                            <div class="column is-6 is-row-data">
                                                <span>{{ participant.person.birth_date ? participant.person.birth_date.value : firstCapitalize(fieldsParticipant.birth_date.label) }}</span>
                                            </div>
                                            <div class="column is-6">
                                                <b-button
                                                    class="btn-edit"
                                                    size="is-small"
                                                    icon-left="pen"
                                                    v-on:click.prevent="clickEditParticipant('person.birth_date')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Birth date -->
                                </div>
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
    //Import moment
    var moment = require('moment');

    export default {
        props: {
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
            url_person_emails_admin: {
                type: String,
                require: true
            },
            url_person_email_exist: {
                type: String,
                require: true
            },
            url_person_data: {
                type: String,
                require: true
            },
            url_persons_emails_store: {
                type: String,
                require: true
            },
            url_persons_emails_update: {
                type: String,
                require: true
            },
            url_persons_cellphones_for_person: {
                type: String,
                require: true
            },
            url_person_cellphone_exist: {
                type: String,
                require: true
            },
            url_persons_cellphone_store: {
                type: String,
                require: true
            },
            url_person_cellphone_update: {
                type: String,
                require: true
            },
            url_person_update: {
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
                            PROFILE_PARTICPANT: {
                                                    ADMIN: 1,
                                                    LEADER: 2,
                                                    PARTICIPANT: 3,
                                                    SUPLE_ADMIN: 4,
                                                },
                            STATUS_PERSONS_EMAILS:  {
                                                        ACTIVE: 1,
                                                        PENDING: 2,
                                                        CONFIRMING: 3,
                                                        INACTIVE: 4
                                                    }
                        },
                fieldsParticipant: [],
                fileAvatar: null,
                enabledUploadAvatar: false,
                aceptAvatar: ".jpg,.png,.gif",
                emailError: null,
                locale: undefined, //Set browser language
                maxBirthDate: new Date(moment().subtract(18, 'years')),
                birth_date: null,
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

            /**
             * Create/load participant data
             */
            const initParticipant = JSON.parse(this.participant_json);
            Object.keys(initParticipant).forEach( key => {
                if( _.isObject(initParticipant[key]) )//Add date for items
                {
                    let val = new Object();
                    let valCopy = new Object();
                    const itemObject = initParticipant[key];
                    Object.keys( itemObject ).forEach( keyObj => {
                        Vue.set( val, keyObj, {
                                        'value':    itemObject[keyObj],
                                        'edited':   false,
                                        'editing':  false,
                                    } );
                        Vue.set( valCopy, keyObj, {
                                        'value':    itemObject[keyObj],
                                        'edited':   false,
                                        'editing':  false,
                                    } );
                    });
                    Vue.set(this.participant,key,val); //Reactive objects and values
                    //Crete participant copy
                    this.participantCopy[key] = Object.assign({}, valCopy); //Non-reactive copy
                }else//Single data
                {
                    Vue.set(this.participant,key,{
                            'value':    initParticipant[key],
                            'edited':   false,
                            'editing':  false,
                        }); //Reactive objects and values
                    //Crete participant copy
                    this.participantCopy[key] = Object.assign({}, {
                            'value':    initParticipant[key],
                            'edited':   false,
                            'editing':  false,
                        }); //Non-reactive copy
                }
            });
            //add default value for used events with not-reactive copy
            Vue.set(this.participant.person, 'used_events_email', {
                            'value':    { email: null },
                            'edited':   false,
                            'editing':  false,
                        });
            Vue.set(this.participantCopy.person, 'used_events_email', {
                            'value':    { email: null },
                            'edited':   false,
                            'editing':  false,
                        });
            /** ./Create/load participant data  */
        },
        async mounted(){
            await this.getPersonData();
            await this.getIdentificationsTypes();
            await this.getImg64Base(this.OPTIONS.PROGRAMMER, this.programmer.logo.value );//Get logo programmer
            await this.getImgAvatar();
            if( this.participant.profiles_participants_id.value === this.OPTIONS.PROFILE_PARTICPANT.ADMIN )//Administrador
            {
                await this.getEmailsAdmin();
            }
            //Get cellphones for Admin/Suple admin
            if( this.participant.profiles_participants_id.value === this.OPTIONS.PROFILE_PARTICPANT.ADMIN
                || this.participant.profiles_participants_id.value === this.OPTIONS.PROFILE_PARTICPANT.SUPLE_ADMIN )
            {
                await this.getCellphones();
            }
        },
        methods: {
            showErrors(resError){
                this.errors = procesarErroresRequest( resError );
                this.hasErrors = this.errors.errors.length > 0;
            },
            firstCapitalize( word ){
                return _.capitalize( word );
            },
            getStringWithTrim( word ){
                if( !word )
                {
                    return;
                }else{
                    return word.trim();
                }
            },
            setTrim( key, option, index = null ){
                let obj = new Object();
                if( option === this.OPTIONS.PROGRAMMER )
                {
                    obj = this.programmer;
                }else if( option === this.OPTIONS.PARTICIPANT )
                {
                    obj = this.participant;
                }

                switch(key) {
                    case "entity_name":
                        obj.entity_name.value = this.getStringWithTrim(obj.entity_name.value);
                        break;
                    case "person.used_events_email.value.email":
                        obj.person.used_events_email.value.email = this.getStringWithTrim(obj.person.used_events_email.value.email);
                        break;
                    case "person.cellphones.value.cellphone_number":
                        if( index != null ){
                            obj.person.cellphones[index].value.cellphone_number = this.getStringWithTrim(obj.person.cellphones[index].value.cellphone_number);
                        }
                        break;
                    default:
                        //Get keys, for exaple: person.emails
                        const keys = key.split(".");
                        keys.forEach( k => {
                            obj = obj[k];
                        });
                        obj.value = this.getStringWithTrim(obj.value);
                        break;
                }
            },
            capitalizeText( event, key, option ){
                if( event.keyCode >= 65 && event.keyCode <= 90 ) //A-Z
                {
                    var phrase = event.target.value.trimStart();
                    const phrasesArray = phrase.split(" ");
                    var txtEnd = "";
                    if( phrasesArray.length > 1 )
                    {
                        phrasesArray.forEach( item => {
                            txtEnd += capitalize( item ) +" ";
                        });
                    }else{
                        txtEnd = capitalize( phrase );
                    }
                    //Model
                    let obj = new Object();
                    if( option === this.OPTIONS.PROGRAMMER )
                    {
                        obj = this.programmer;
                    }else if( option === this.OPTIONS.PARTICIPANT )
                    {
                        obj = this.participant;
                    }
                    switch( key )
                    {
                        case "entity_name":
                            obj.entity_name.value = txtEnd.trim();
                            break;
                        default:
                            //Get keys, for exaple: person.emails
                            const keys = key.split(".");
                            keys.forEach( k => {
                                obj = obj[k];
                            });
                            obj.value = txtEnd.trim();
                            break;
                    }
                }
            },
            dateFormat(d){
                return moment(d).format('YYYY-MM-DD');
            },
            async getPersonData(){
                this.isLoading = true;
                await axios.post(this.url_person_data,{ id : this.participant.persons_id.value })
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            Object.keys( response.data.data ).forEach( keyObj => {
                                Vue.set( this.participant.person, keyObj, {
                                                'value':    response.data.data[keyObj],
                                                'edited':   false,
                                                'editing':  false,
                                            } );
                                Vue.set( this.participantCopy.person, keyObj, {
                                                'value':    response.data.data [keyObj],
                                                'edited':   false,
                                                'editing':  false,
                                            } );
                            });
                            //Set birth date
                            this.initBirthDate( this.participant.person.birth_date.value );
                        }
                    },
                    error => {
                        this.showErrors(error);
                    })
                    .then( () => {
                        this.isLoading = false;
                    });
            },
            async getIdentificationsTypes(){
                this.isLoading = true;
                await axios.post(this.url_identifications_types)
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
            async getImgAvatar(){
                if( this.participant.profile_image.value )
                {
                    await this.getImg64Base(this.OPTIONS.PARTICIPANT, this.participant.profile_image.value );
                }else{
                    await this.getAvatarString();
                }
            },
            async getImg64Base(option, name){
                if( name )
                {
                    this.isLoading = true;
                    const params = {
                        name: name,
                        option: option
                    };
                    await axios.get(this.url_image_base, { params: params})
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
            async getAvatarString(){
                const fname = this.participant.person.first_name.value.trim();
                const lname = this.participant.person.last_name.value.trim();
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
                    await axios.post( this.url_person_ui_avatar, { name: name } )
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
            async getEmailsAdmin(){
                this.isLoading = true;
                const params = {
                    persons_id: this.participant.persons_id.value,
                };
                await axios.post(this.url_person_emails_admin, params)
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            response.data.emails.forEach( element => {
                                if( element.initial_register === 1 )
                                {
                                    //Set with no-reactive values
                                    Vue.set(this.participant.person, 'initial_register_email', {
                                                'value':    Object.assign({},element),
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                                    Vue.set(this.participantCopy.person, 'initial_register_email', {
                                                'value':    Object.assign({},element),
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                                }else if( element.used_events === 1 ){
                                    //Set with no-reactive values
                                    Vue.set(this.participant.person, 'used_events_email', {
                                                'value':    Object.assign({},element),
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                                    Vue.set(this.participantCopy.person, 'used_events_email', {
                                                'value':    Object.assign({},element),
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
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
            async getCellphones(){
                this.isLoading = true;
                const params = {
                    persons_id: this.participant.person.id.value,
                };
                await axios.post(this.url_persons_cellphones_for_person, params)
                    .then( response => {
                        this.showErrors({});
                        if( response.data.status === 200 )
                        {
                            let cellphones = [];
                            let cellphonesCopy = [];
                            response.data.cellphones.forEach( element => {
                                cellphones.push({
                                                'value':    Object.assign({},element),
                                                'error':   false,
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                                cellphonesCopy.push({
                                                'value':    Object.assign({},element),
                                                'error':   false,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                            });

                            //Empty cellphones
                            if( _.isEmpty(cellphones) )
                            {
                                cellphones.push({
                                                'value':    { cellphone_number : null },
                                                'error':   false,
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                                cellphonesCopy.push({
                                                'value':    { cellphone_number : null },
                                                'error':   false,
                                                'msg':   this.fieldsParticipant.mobile.msg,
                                                'edited':   false,
                                                'editing':  false,
                                            });
                            }

                            //Set with no-reactive values
                            Vue.set(this.participant.person, 'cellphones', cellphones);
                            Vue.set(this.participantCopy.person, 'cellphones', cellphonesCopy);
                        }
                    },
                    error => {
                        this.showErrors(error);
                    })
                    .then( () => {
                        this.isLoading = false;
                    });
            },
            clickCancelToHome(){
                this.$emit('activeMainSection','main')
            },
            async emailsExist( emails = []){
                this.isLoading = true;
                let data = null;
                if( emails && _.isArray( emails ) && !_.isEmpty( emails ) )
                {
                    await axios.post(this.url_person_email_exist, { emails: emails} )
                        .then( response => {
                                this.showErrors({});
                                if( response.data.status === 200 )
                                {
                                    data =  response.data;
                                }
                            },
                            error => {
                                this.showErrors( error );
                            }
                        )
                        .then( () => {
                            this.isLoading = false;
                        });
                }else{
                    this.isLoading = false;
                }
                return data;
            },
            onlyNumber(event, obj){
                const regex = new RegExp(/[^\d]/g);
                const val = event.target.value.replace(regex,"");
                if( obj.value !== val )
                {
                    obj.value = val;
                }
            },
            onlyPhoneNumber(event, index){
                const regex = new RegExp(/[^\+|\d]$/g);
                const val = event.target.value.replace(regex,"");
                if( this.participant.person.cellphones[index].value.cellphone_number !== val )
                {
                    this.participant.person.cellphones[index].value.cellphone_number = val;
                }
            },
            isCellphoneDuplicate( index )
            {
                if( this.participant.person.cellphones.length > 1 )
                {
                    const value = this.participant.person.cellphones[ index ].value.cellphone_number;
                    for( let i = 0; i < this.participant.person.cellphones.length; i++ )
                    {
                        if( i !== index && this.participant.person.cellphones[ i ].value.cellphone_number === value )
                        {
                            return true;
                        }
                    }
                }

                return false;
            },
            async cellphoneExists( mobile ){
                this.isLoading = true;
                let data = null;
                if( mobile && !_.isEmpty( mobile ) )
                {
                    await axios.post(this.url_person_cellphone_exist, { mobile: mobile} )
                        .then( response => {
                                this.showErrors({});
                                if( response.data.status === 200 )
                                {
                                    data =  response.data;
                                }
                            },
                            error => {
                                this.showErrors( error );
                            }
                        )
                        .then( () => {
                            this.isLoading = false;
                        });
                }else{
                    this.isLoading = false;
                }
                return data;
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
                }else{
                    this.isLoading = false
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
                                    text: this.textsGeneralSettings.text_updated_programmer
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
            setErrorParticipant( key, errValue, index = null, singleKey = false){
                switch(key) {
                    case "person.used_events_email":
                        this.fieldsParticipant.email.error = errValue;
                        break;
                    default:
                        if( index !== null )
                        {
                            let obj = this.participant;
                            const keys = key.split(".");
                            keys.forEach( k => {
                                obj = obj[k];
                            });
                            if( _.isArray(obj) )//Arrays, asign object from Array position
                            {
                                obj[ index ].error = errValue;
                            }
                        }else
                        {
                            if( singleKey )
                            {
                                this.fieldsParticipant[ key ].error = errValue;
                            }else{
                                const keys = key.split(".");
                                this.fieldsParticipant[ keys[ keys.length - 1] ].error = errValue;
                            }
                        }
                        break;
                }
            },
            initBirthDate( stringDate ){
                this.birth_date = moment( stringDate, "YYYY-MM-DD" ).toDate();
            },
            onChangedBirthDate(){
                this.participant.person.birth_date.value = this.dateFormat(this.birth_date);
            },
            clickEditParticipant( key, index = null ){
                //Get keys, for exaple: person.emails
                const keys = key.split(".");
                let obj = this.participant;
                keys.forEach( k => {
                    obj = obj[k];
                });

                let keyRef = key;
                if( index !== null && _.isArray(obj) )//Arrays
                {
                    keyRef = keyRef +'_'+ index;

                    obj[ index ].editing = !obj[ index ].editing;
                }else{
                    obj.editing = !obj.editing;
                }

                //wait for the input to load
                this.$nextTick(() => {
                    if( (this.$refs[ keyRef ]) )
                    {
                        if( _.isArray(this.$refs[ keyRef ] ) )
                        {
                            this.$refs[ keyRef ][0].focus();

                        }else{
                            if( key === "person.birth_date" )
                            {
                                this.$refs[ keyRef ].toggle();
                            }else{
                                this.$refs[ keyRef ].focus();
                            }
                        }
                    }
                });
            },
            clickCancelParticipant( key, index = null ){
                //Get keys, for exaple: person.emails
                const keys = key.split(".");
                let obj = this.participant;
                let objCopy = this.participantCopy;
                keys.forEach( k => {
                    obj = obj[k];
                    objCopy = objCopy[k];
                });

                if( index !== null && _.isArray(obj) )//Arrays, asign object from Array position
                {
                    obj = obj[ index ];
                    objCopy = objCopy[ index ];
                }

                //Clean error, change "editing" and restore values
                obj.value = _.isObject( objCopy.value ) ? Object.assign({},objCopy.value) : objCopy.value;
                obj.editing = false;
                obj.edited = false;
                this.setErrorParticipant( key, false, index );

                switch (key)
                {
                    case "profile_image":
                        this.fileAvatar = null;
                        this.avatarAdmin = this.avatarAdminCopy;
                        this.enabledUploadAvatar = false;
                        break;
                    case "person.birth_date":
                        this.initBirthDate( objCopy.value );
                        break;
                    default:
                        break;
                }
            },
            async clickUpdateParticipant( key, index = null ){
                this.isLoading = true;
                //cleans errors
                this.setErrorParticipant( key, false, index );

                if( key === "profile_image" )
                {
                    //Value for save in DDBB
                    this.participant[ key ].value = this.avatarAdmin;
                }

                //Get keys, for exaple: person.emails
                const keys = key.split(".");
                let obj = this.participant;
                let objCopy = this.participantCopy;
                keys.forEach( k => {
                    obj = obj[k];
                    objCopy = objCopy[k];
                });

                if( index !== null && _.isArray(obj) )//Arrays, asign object from Array position
                {
                    obj = obj[ index ];
                    objCopy = objCopy[ index ];
                }

                //compare values
                let different = false;
                switch(key)
                {
                    case "profile_image":
                        different = this.avatarAdmin !== this.avatarAdminCopy;
                        break;
                    case "person.used_events_email":
                        different = obj.value.email !== objCopy.value.email;
                        break;
                    case "person.cellphones":
                        different = obj.value.cellphone_number !== objCopy.value.cellphone_number;
                        break;
                    default:
                        different = obj.value !== objCopy.value;
                        break;
                }


                if( different )//Edited
                {
                    obj.edited = true;

                    //validation
                    let valid = true;
                    const value = obj.value;
                    const constraints = {
                        presence: {
                            allowEmpty: false,
                        }
                    };

                    if( validate.single(value, constraints ) !== undefined )
                    {
                        this.setErrorParticipant(key, true);
                        valid = false;
                    }
                    if( key === "person.used_events_email" )
                    {
                        const constrEmail = Object.assign({ email: true }, constraints );
                        if( validate.single(obj.value.email, constraints ) !== undefined )
                        {
                            this.emailError = this.fieldsParticipant.email.msg;
                            this.setErrorParticipant(key, true);
                            valid = false;
                        }else if( validate.single(obj.value.email, constrEmail ) !== undefined )
                        {
                            this.emailError = this.fieldsParticipant.email.msg_validate;
                            this.setErrorParticipant(key, true);
                            valid = false;
                        }else if( obj.value.email === this.participant.person.initial_register_email.value.email )//Equal to initial register email
                        {
                            this.emailError = this.fieldsParticipant.email.msg_validate;
                            this.setErrorParticipant(key, true);
                            valid = false;
                        }else //Validate exists
                        {
                            const data = await this.emailsExist( [obj.value.email] );
                            if( data.exists )
                            {
                                this.emailError = this.fieldsParticipant.email.msg_exist;
                                this.setErrorParticipant(key, true);
                                valid = false;
                            }
                        }
                    }
                    if( key === "person.cellphones")
                    {
                        if( validate.single(obj.value.cellphone_number, constraints) !== undefined )//Empty
                        {
                            obj.msg = this.fieldsParticipant.mobile.msg;
                            this.setErrorParticipant(key, true, index);
                            valid = false;
                        }else{
                            const regex = new RegExp(/^\+?[1-9]{1,2}[0-9]{3,14}$/g);
                            const constrMobile = Object.assign({ format: regex }, constraints );
                            if( validate.single(obj.value.cellphone_number, constrMobile ) !== undefined )//Format
                            {
                                obj.msg = this.fieldsParticipant.mobile.msg_validate;
                                this.setErrorParticipant(key, true, index);
                                valid = false;
                            }else if( this.isCellphoneDuplicate( index ) ) //validate duplicate
                            {
                                obj.msg = this.fieldsParticipant.mobile.msg_exist;
                                this.setErrorParticipant(key, true, index);
                                valid = false;
                            }else //validate exists
                            {
                                const data = await this.cellphoneExists( obj.value.cellphone_number );
                                if( data.exists )
                                {
                                    obj.msg = this.fieldsParticipant.mobile.msg_exist;
                                    this.setErrorParticipant(key, true, index);
                                    valid = false;
                                }
                            }
                        }
                    }
                    if( key === "profile_image" && this.fileAvatar.size > this.sizeFieleUploadAllow )
                    {
                        this.setErrorParticipant(key, true);
                        valid = false;
                    }

                    this.isLoading = false;

                    if( valid ) //Not errors
                    {
                        //update
                        this.updateParticipant( key, index );
                    }
                }else{
                    this.isLoading = false
                }
            },
            async updateDBParticipant(key, obj, objCopy){
                this.isLoading = true;
                const params = {
                    id: this.participant.id.value,
                };
                params[key] = obj.value;

                await axios.post(this.url_participant_update, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                if( key === "profile_image" && response.data.data.extra )//Update avatar info
                                {
                                    obj.value = response.data.data.extra;
                                    objCopy.value = Object.assign({}, response.data.data.extra) ;//Non-reactive copy
                                    this.fileAvatar = null;
                                    this.enabledUploadAvatar = false;
                                    this.getImg64Base(this.OPTIONS.PARTICIPANT, this.participant.profile_image.value );
                                }else//Update copy
                                {
                                    objCopy.value = Object.assign({}, obj.value);//Non-reactive copy
                                }
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async createDBPersonEmailUsedEvents(obj, objCopy){
                this.isLoading = true;
                const params = {
                    email: obj.value.email,
                    persons_id: this.participant.persons_id.value,
                    used_events: 1,
                    status_persons_emails_id : this.OPTIONS.STATUS_PERSONS_EMAILS.PENDING,
                };

                await axios.post(this.url_persons_emails_store, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 201 )
                            {
                                //update/restore value copy
                                obj.value = response.data.data;
                                objCopy.value = Object.assign({}, response.data.data);//Non-reactive copy
                                objCopy.edited = false; //restore
                                objCopy.editing = false; //restore
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async updateDBPersonEmailUsedEvents(obj, objCopy){
                this.isLoading = true;
                const params = {
                    email: obj.value.email,
                    id: obj.value.id,
                    used_events: 1,
                    status_persons_emails_id : this.OPTIONS.STATUS_PERSONS_EMAILS.PENDING,
                };

                await axios.post(this.url_persons_emails_update, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                obj.value = response.data.data;
                                objCopy.value = Object.assign({}, response.data.data);//Non-reactive copy
                                objCopy.edited = false; //restore
                                objCopy.editing = false; //restore
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async createDBPersonCellhpone(obj, objCopy){
                this.isLoading = true;
                const params = {
                    mobile: obj.value.cellphone_number,
                    persons_id: this.participant.persons_id.value,
                };

                await axios.post(this.url_persons_cellphone_store, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 201 )
                            {
                                //update/restore value copy
                                obj.value = response.data.data;
                                objCopy.value = Object.assign({}, response.data.data);//Non-reactive copy
                                objCopy.edited = false; //restore
                                objCopy.editing = false; //restore
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async updateDBPersonCellhpone(obj, objCopy){
                this.isLoading = true;
                const params = {
                    mobile: obj.value.cellphone_number,
                    id: obj.value.id,
                };

                await axios.post(this.url_person_cellphone_update, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                obj.value = response.data.data;
                                objCopy.value = Object.assign({}, response.data.data);//Non-reactive copy
                                objCopy.edited = false; //restore
                                objCopy.editing = false; //restore
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async updatedDBPerson( keyParamenter, obj, objCopy ){
                this.isLoading = true;
                let params = {
                    id: this.participant.person.id.value,
                };
                params[ keyParamenter ] = obj.value,

                await axios.post(this.url_person_update, params)
                        .then( response => {
                            this.showErrors({});
                            if( response.data.status === 200 )
                            {
                                //update/restore value copy
                                obj.value = response.data.data[ keyParamenter ];
                                objCopy.value = response.data.data[ keyParamenter ];
                                objCopy.edited = false; //restore
                                objCopy.editing = false; //restore
                                obj.edited = false; //restore
                                obj.editing = false; //restore

                                success({
                                    title: this.text_success,
                                    text: this.textsGeneralSettings.text_updated_participant
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
            async updateParticipant( key, index = null ){
                //Get keys, for exaple: person.emails
                const keys = key.split(".");
                let obj = this.participant;
                let objCopy = this.participantCopy;
                keys.forEach( k => {
                    obj = obj[k];
                    objCopy = objCopy[k];
                });

                if( index !== null && _.isArray(obj) )//Arrays, asign object from Array position
                {
                    obj = obj[ index ];
                    objCopy = objCopy[ index ];
                }

                if( obj.edited )
                {
                    switch( key )
                    {
                        case "person.used_events_email":
                            //Update or create email
                            if( !objCopy.value.email )//Copy is null, create new email
                            {
                                await this.createDBPersonEmailUsedEvents(obj, objCopy);
                            }else //Copy exist update
                            {
                                await this.updateDBPersonEmailUsedEvents(obj, objCopy);
                            }
                            break;
                        case "person.cellphones":
                            //Update or create cellphone
                            if( !objCopy.value.cellphone_number )//Copy is null, create new cellphone
                            {
                                await this.createDBPersonCellhpone(obj, objCopy);
                            }else //Copy existe update
                            {
                                await this.updateDBPersonCellhpone(obj, objCopy);
                            }
                            break;
                        case "person.first_name":
                        case "person.last_name":
                        case "person.position_company":
                        case "person.birth_date":
                            await this.updatedDBPerson( keys[ keys.length - 1 ], obj, objCopy );
                            break;
                        default://Participant
                            await this.updateDBParticipant(key, obj, objCopy);
                            break;
                    }
                }
            }
        }
    }
</script>
