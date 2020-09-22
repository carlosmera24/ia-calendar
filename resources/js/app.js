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

Vue.component('banner-info', require('./components/welcome/BannerInfoComponent.vue').default);
Vue.component('banner-carusel', require('./components/welcome/BannerCaruselComponent.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            isActiveDropdown: false,
        }
    },
    methods: {
        clickDropdown(){
            this.isActiveDropdown = !this.isActiveDropdown;
        }
    },
});
