import Vue from 'vue'
import App from './App.vue'
import router from './router'


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap'

import Toasted from 'vue-toasted';
Vue.use(Toasted)

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')