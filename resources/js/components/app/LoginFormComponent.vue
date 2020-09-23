<template>
    <div>
        <form
            :action="url_login"
            @submit="clickLogin"
            method="POST">
            <input type="hidden" name="_token" v-model="csrf_token">
            <b-field
                v-bind:type="{ 'is-danger' : validation.user.error }"
                :message="validation.user.error ? validation.user.msg : ''">
                <b-input name="user" size="is-large" type="text" placeholder="Usuario" autofocus="" v-model="user" />
            </b-field>
            <b-field
                v-bind:type="{ 'is-danger' : validation.password.error }"
                :message="validation.password.error ? validation.password.msg : ''">
                <b-input size="is-large" type="password" placeholder="Contraseña" autofocus="" v-model="password" />
            </b-field>
            <b-button name="password" class="is-block is-info" size="is-large is-fullwidth" native-type="submit">
                Login <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
            </b-button>
        </form>
    </div>
</template>
<script>
export default {
    props:[
        'url_login',
        'url_home',
        'csrf_token'
    ],
    data() {
        return {
            user: '',
            password: '',
            validation: {
                user: {
                    error: false,
                    msg: "Campo requerido"
                },
                password: {
                    error: false,
                    msg: "Campo requerido"
                }
            }
        }
    },
    methods:{
        clickLogin(e){
            this.validation.user.msg = "Campo requerido";
            this.validation.user.error = this.user === '';
            this.validation.password.error = this.password === '';

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
                        this.validation.user.msg = res.data.data[0];
                        this.validation.user.error = true;
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
