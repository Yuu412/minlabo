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
    <h1 class="py-5">「研究室・ゼミ」選びの不安を、ゼロに。</h1>
    <section id="search" class="mx-auto mb-5 pt-5 pb-4">
      <h2 class="caption mx-auto mb-3 px-4 pb-2">研究室・ゼミを探す</h2>
      <search-laboratory-form :endpoint="endpointSearch" :csrf="csrf" class="mx-auto"></search-laboratory-form>
    </section>
  </header>
</template>

<script>
import SearchLaboratoryForm from './SearchLaboratoryForm'
import LoggedInNav from './LoggedInNav'

export default {
  name: 'LaboratoriesHeader',
  components: { SearchLaboratoryForm, LoggedInNav },
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
