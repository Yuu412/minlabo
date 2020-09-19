<template>
  <header class="top-header">
    <logged-in-nav
      v-if="isLogin"
      :route-post="routePost"
      :route-my-page="routeMyPage"
      :route-log-out="routePost"
      :endpoint-logout="endpointLogout"
      :csrf="csrf"
    />
    <not-logged-in-nav v-else :route-register="routeRegister" :route-login="routeLogin" :route-post="routePost" />
  </header>
</template>

<script>
import LoggedInNav from './LoggedInNav'
import NotLoggedInNav from './NotLoggedInNav'

export default {
  name: 'TopHeader',
  components: { LoggedInNav, NotLoggedInNav },
  props: {
    routeRegister: {
      type: String,
      default: '',
    },
    routeLogin: {
      type: String,
      default: '',
    },
    routePost: {
      type: String,
      default: '',
    },
    routeMyPage: {
      type: String,
      default: '',
    },
    endpointLogout: {
      type: String,
      default: '',
    },
    csrf: {
      type: String,
      default: '',
    },
    isLogin: {
      type: Boolean,
      default: false,
    },
  },
}
</script>

<style scoped></style>
