<template>
    <div>
        <form
            :action="url_login"
            @submit="clickLogin"
            method="POST">
            <input type="hidden" name="_token" v-model="csrf_token">
            <b-field
                v-bind:type="{ 'is-danger' : fields.user.error }"
                :message="fields.user.error ? fields.user.msg : ''">
                <b-input name="user" size="is-large" type="text" :placeholder="fields.user.placeholder" autofocus="" v-model="user" />
            </b-field>
            <b-field
                v-bind:type="{ 'is-danger' : fields.password.error }"
                :message="fields.password.error ? fields.password.msg : ''">
                <b-input size="is-large" type="password" :placeholder="fields.password.placeholder" autofocus="" v-model="password" />
            </b-field>
            <b-button name="password" class="is-block is-info" size="is-large is-fullwidth" native-type="submit">
                {{ fields.login.placeholder }} <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
            </b-button>
        </form>
    </div>
</template>
<script>
export default {
    props:{
        url_login: {
            type: String,
            require: true
        },
        url_home: {
            type: String,
            require: true
        },
        csrf_token: {
            type: String,
            require: true
        },
        fields_json: {
            type: String,
            require: true
        }
    },
    data() {
        return {
            user: '',
            password: '',
            fields: [],
            copy_msg_user: ''
        }
    },
    created(){
        this.fields = JSON.parse(this.fields_json);
        this.copy_msg_user = this.fields.user.msg;
    },
    methods:{
        clickLogin(e){
            this.fields.user.msg = this.copy_msg_user;
            this.fields.user.error = this.user === '';
            this.fields.password.error = this.password === '';

            if(  this.user !== '' || this.password !== '' )
            {
                // return true;
                const data = {
                    _token: this.csrf_token,
                    user: this.user,
                    password: this.password
                }
                axios.post( this.url_login, data)
                .then( res => {
                    if( res.data.status === 204 )
                    {
                        this.fields.user.msg = res.data.data[0];
                        this.fields.user.error = true;
                    }else if( res.data.status === 200 ){
                        window.location.href = this.url_home;
                    }
                });
            }

            e.preventDefault();
        },
    }
}
</script>
