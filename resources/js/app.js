import './bootstrap'
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faInstagram, faTwitter, faFacebookF } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import TopHeader from './components/TopHeader'
import LaboratoriesHeader from './components/LaboratoriesHeader'
import LoggedInNav from './components/LoggedInNav'
import NotLoggedInNav from './components/NotLoggedInNav'
import Footer from './components/MyFooter'
import Laboratories from './views/Laboratories'
import Top from './views/Top'
import Registered from './views/Registered'
import RegisterPreCheck from './views/RegisterPreCheck'
import Login from './views/Login'
import Register from './views/Register'
import MainRegistered from './views/auth/main/MainRegistered'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

library.add(faInstagram)
library.add(faTwitter)
library.add(faFacebookF)

Vue.component('top-header', TopHeader)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('logged-in-nav', LoggedInNav)
Vue.component('not-logged-in-nav', NotLoggedInNav)
Vue.component('laboratories-header', LaboratoriesHeader)
Vue.component('my-footer', Footer)
Vue.component('laboratories', Laboratories)
Vue.component('register', Register)
Vue.component('top', Top)
Vue.component('registered', Registered)
Vue.component('register-pre-check', RegisterPreCheck)
Vue.component('login', Login)
Vue.component('main-registered', MainRegistered)

Vue.config.productionTip = false

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app',
})
