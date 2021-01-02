<template>
  <header class="pb-5">
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
  name: 'LaboratoriesHeader',
  components: { LoggedInNav, NotLoggedInNav },
  props: {
    endpointSearch: {
      type: String,
      default: '',
    },
    csrf: {
      type: String,
      default: '',
    },
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
    isLogin: {
      type: Boolean,
      default: false,
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

header {
  background-color: $sky-blue;

  h1 {
    text-align: center;
    font-weight: bold;
    color: $white;
  }

  #search {
    width: 80%;
    background-color: $light-blue;
    border-radius: 1.5em;

    > * {
      width: 90%;
    }

    .caption {
      border-bottom: 1px solid #eee;
      font-size: 18px;
      color: $white;
    }
  }
}
</style>
