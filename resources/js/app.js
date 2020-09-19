import './bootstrap'
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faInstagram, faTwitter, faFacebookF } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import LaboratoryHeader from './components/LaboratoryHeader'
import Footer from './components/MyFooter'
import Laboratories from './views/Laboratories'
import Login from './views/Login'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

library.add(faInstagram)
library.add(faTwitter)
library.add(faFacebookF)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('laboratory-header', LaboratoryHeader)
Vue.component('my-footer', Footer)
Vue.component('laboratories', Laboratories)
Vue.component('login', Login)

Vue.config.productionTip = false

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app',
})
