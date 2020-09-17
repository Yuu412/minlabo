<template>
  <header class="pt-3 pb-5">
    <b-navbar toggleable="lg" type="dark" class=" mb-3">
      <b-navbar-brand href="/" class="ml-5">
        <img src="" alt="みんラボ" />
      </b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav class="ml-auto mr-5">
          <b-nav-text class="mr-5"><a :href="linkRegist">ユーザー登録(無料)</a></b-nav-text>
          <b-nav-text class="mr-5"><a :href="linkLogin">ログイン</a></b-nav-text>
          <b-nav-text class="mr-5"><a :href="linkPost">口コミ投稿</a></b-nav-text>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <h1 class="py-5">「研究室・ゼミ」選びの不安を、ゼロに。</h1>
    <section id="search" class="mx-auto mb-5 pt-5 pb-4">
      <h2 class="caption mx-auto mb-3 px-4 pb-2">研究室・ゼミを探す</h2>
      <search-laboratory-form :endpoint="endpointSearch" class="mx-auto"></search-laboratory-form>
    </section>
  </header>
</template>

<script>
import SearchLaboratoryForm from './SearchLaboratoryForm'

export default {
  name: 'LaboratoryHeader',
  components: { SearchLaboratoryForm },
  props: {
    endpointSearch: {
      type: String,
      default: '',
    },
    linkRegist: {
      type: String,
      default: '',
    },
    linkLogin: {
      type: String,
      default: '',
    },
    linkPost: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
header {
  background-color: #1d93e9;
  color: #eee;

  h1 {
    text-align: center;
    font-weight: bold;
  }

  #search {
    width: 80%;
    background-color: #65b3fc;
    border-radius: 1.5em;

    > * {
      width: 90%;
    }

    .caption {
      border-bottom: 1px solid #eee;
      font-size: 18px;
    }
  }
}
</style>
