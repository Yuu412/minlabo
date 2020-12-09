<template>
  <b-navbar toggleable="lg" type="dark" class="logged-in-nav py-3">
    <b-navbar-brand href="/" class="ml-5">
      <img src="/img/minlabo_logo/logo_2.png" width="200px" alt="みんラボ" />
    </b-navbar-brand>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav class="ml-auto mr-5">
        <b-nav-text class="mr-5"><a :href="routePost">口コミ投稿</a></b-nav-text>
        <b-nav-text class="mr-5"><a :href="routeMyPage">マイページ</a></b-nav-text>
        <b-nav-text class="mr-5"><a :href="endpointLogout" @click="logout">ログアウト</a></b-nav-text>
        <form ref="form" :action="endpointLogout" method="POST">
          <input type="hidden" name="_token" :value="csrf" />
        </form>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  name: 'LoggedInNav',
  props: {
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
  },
  methods: {
    logout(event) {
      event.preventDefault()
      this.$refs.form.submit()
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.logged-in-nav {
  background-color: $sky-blue;
}
</style>
