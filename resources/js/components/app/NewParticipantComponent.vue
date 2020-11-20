<template>
    <div class="new-participant" name="fade">
        <p>
            <button class="btn-close button" v-on:click.prevent="clickClose">
                <span class="icon is-small">
                    <i class="fas fa-times"></i>
                </span>
            </button>
        </p>
        <h2 class="has-text-white">{{ text_title }}</h2>
        <form class="form_new_participant" action="">
            <div class="columns is-multiline">
                <b-field horizontal class="column is-4"
                    :label="fields.first_name.label"
                    v-bind:type="{ 'is-danger' : fields.first_name.error }"
                    :message="fields.first_name.error ? fields.first_name.msg : ''">
                    <b-input name="first_name" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.last_name.label"
                    v-bind:type="{ 'is-danger' : fields.last_name.error }"
                    :message="fields.last_name.error ? fields.last_name.msg : ''">
                    <b-input name="last_name" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.position.label"
                    v-bind:type="{ 'is-danger' : fields.position.error }"
                    :message="fields.position.error ? fields.position.msg : ''">
                    <b-input name="position" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.email.label"
                    v-bind:type="{ 'is-danger' : fields.email.error }"
                    :message="fields.email.error ? fields.email.msg : ''">
                    <b-input name="email" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.mobile.label"
                    v-bind:type="{ 'is-danger' : fields.mobile.error }"
                    :message="fields.mobile.error ? fields.mobile.msg : ''">
                    <b-input name="mobile" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.date_join.label"
                    v-bind:type="{ 'is-danger' : fields.date_join.error }"
                    :message="fields.date_join.error ? fields.date_join.msg : ''">
                    <b-input name="date_join" expanded></b-input>
                </b-field>
                <b-field horizontal class="column is-4"
                    :label="fields.birth_date.label"
                    v-bind:type="{ 'is-danger' : fields.birth_date.error }"
                    :message="fields.birth_date.error ? fields.birth_date.msg : ''">
                    <b-input name="birth_date" expanded></b-input>
                </b-field>
            </div>
            <div class="columns">
                <b-field class="column is-half"
                    custom-class="label_description"
                    :label="fields.description.label"
                    v-bind:type="{ 'is-danger' : fields.description.error }"
                    :message="fields.description.error ? fields.description.msg : ''">
                    <b-input name="description" type="textarea" :placeholder="fields.description.placeholder" expanded></b-input>
                </b-field>
                <div class="field field_avatar">
                    <label class="label label_description">&nbsp;</label>
                    <div class="contol" v-bind:class="{ 'is-danger' : fields.profile_image.error }">
                        <div class="avatar is-flex">
                            <span v-if="avatar == null">{{ fields.profile_image.label }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default{
    props: [
        'text_title',
        'text_fields_json',
        'text_accept',
        'text_cancel'
    ],
    data() {
        return {
            fields: [],
            avatar: null,
        }
    },
    created(){
        this.fields = JSON.parse(this.text_fields_json);
    },
    methods: {
        clickClose(){
            this.$root.setActiveMenu( "wall" );
        }
    }
}
</script>
