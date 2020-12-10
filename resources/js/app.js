window._ = require('lodash');
try {
    window.Popper = require('popper.js').default;
} catch (e) { }

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

//Import fonts fontawesome
import '@fortawesome/fontawesome-free/css/all.css'

// Import Buefy
import Buefy from 'buefy'
// Vue.config.productionTip = false
Vue.use(Buefy, {
    defaultIconPack: 'fas',
});

// Welcome components
Vue.component('banner-info', require('./components/welcome/BannerInfoComponent.vue').default);
Vue.component('banner-carusel', require('./components/welcome/BannerCaruselComponent.vue').default);
// App components
Vue.component('content-main', require('./components/app/ContentMainComponent.vue').default);
Vue.component('manage-leader', require('./components/app/ManageLeaderComponent.vue').default);
Vue.component('main-section', require('./components/app/MainComponent.vue').default);
Vue.component('login-form', require('./components/app/LoginFormComponent.vue').default);
Vue.component('dropdown-menu-setting', require('./components/app/DropDownMenuSettingComponent.vue').default);
Vue.component('banner-app-carusel', require('./components/app/BannerCaruselComponent.vue').default);
Vue.component('main-menu-section', require('./components/app/MainMenuComponent.vue').default);
Vue.component('wall-section', require('./components/app/WallComponent.vue').default);
Vue.component('participant-section', require('./components/app/NewParticipantComponent.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            contentActive: {
                main: true,
                adminLeaders: false,
                settingAdmin: false,
                settingLeader: false,
                settingGest: false,
            }
        }
    },
    methods: {
        setActiveContent(item){
            Object.entries(this.contentActive).forEach((v) => {
                if (v[0] === item) {
                    this.contentActive[item] = true;
                } else {
                    this.contentActive[v[0]] = false;
                }
            });
        }
    },
});
