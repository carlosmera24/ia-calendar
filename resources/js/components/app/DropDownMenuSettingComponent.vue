<template>
    <div class="dropdown-setting dropdown" :class="{ 'is-active' : isActiveDropdown }">
        <div class="dropdown-trigger">
            <button class="btn is-size-5"
                :class="{ 'is-active' : isActiveDropdown }"
                aria-haspopup="true"
                aria-controls="dropdown-menu"
                v-on:click="clickDropdown">
                <i class="fas fa-cog" aria-hidden="true"></i>
            </button>
        </div>
        <div class="dropdown-menu" id="dropdown-menu" role="menu">
            <div class="dropdown-content has-text-left">
                <a href="#" class="dropdown-item">
                    {{ text_menu_dark }}
                </a>
                <!-- If profiles is Admin or Secondary/Alternate Admin  -->
                <a class="dropdown-item"
                    v-if="profile === '1'"
                    v-on:click="clickItem('adminLeaders')">
                    {{ text_admin_leaders }}
                </a>
                <a href="#" class="dropdown-item" v-on:click="clickItem(settingGeneral)">
                    {{ text_general_setting }}
                </a>
                <a href="#" class="dropdown-item">
                    {{ text_frequent_questions }}
                </a>
                <a href="#" class="dropdown-item" v-on:click="clickCerrarSesion">
                    {{ text_logout }}
                </a>
                <a href="#" class="dropdown-item" v-on:click="clickDropdown">
                    <strong>{{ text_close }}</strong>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isActiveDropdown: false,
            settingGeneral: 'settingAdmin',
        }
    },
    props: [
        'profile',
        'url_logout',
        'url_home',
        'text_company_name',
        'text_menu_dark',
        'text_admin_leaders',
        'text_general_setting',
        'text_frequent_questions',
        'text_logout',
        'text_close'
    ],
    created(){
        //Set general settings from profile
        switch(this.profile)
        {
            case '1': //Admin
                this.settingGeneral = 'settingAdmin';
                break;
            case '2': //Líder
                this.settingGeneral = 'settingLeader';
                break;
            case '3': //Invitado
                this.settingGeneral = 'settingGest';
                break;
            default:
                break;
        }
    },
    methods: {
        clickDropdown(){
            this.isActiveDropdown = !this.isActiveDropdown;
        },
        clickItem(item){
            this.isActiveDropdown = false;
            this.$root.setActiveContent(item);
        },
        clickCerrarSesion(){
            axios.post( this.url_logout )
                .then( res => {
                    if( res.data.status === 200 ){
                        window.location.href = this.url_home;
                    }
                });
        }
    },
}
</script>
