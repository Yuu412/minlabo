<template>
  <header class="top-header">
    <not-logged-in-nav :route-register="routeRegister" :route-login="routeLogin" :route-post="routePost" />
  </header>
</template>

<script>
import NotLoggedInNav from './NotLoggedInNav'

export default {
  name: 'TopHeader',
  components: { NotLoggedInNav },
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
  },
}
</script>

<style scoped></style>
