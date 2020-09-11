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

import 'buefy/dist/buefy.css'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
