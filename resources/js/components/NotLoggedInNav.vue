<template>
  <b-navbar toggleable="lg" type="dark" class=" not-logged-in-nav mb-3">
    <b-navbar-brand href="/" class="ml-5">
      <img src="" alt="みんラボ" />
    </b-navbar-brand>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="ml-auto mr-5">
        <b-nav-text class="mr-5"><a :href="routeRegister">ユーザー登録(無料)</a></b-nav-text>
        <b-nav-text class="mr-5"><a :href="routeLogin">ログイン</a></b-nav-text>
        <b-nav-text class="mr-5"><a :href="routePost">口コミ投稿</a></b-nav-text>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: 'NotLoggedInNav',
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

<style lang="scss" scoped>
@import 'resources/sass/app';

.not-logged-in-nav {
  background-color: $sky-blue;
}
</style>
