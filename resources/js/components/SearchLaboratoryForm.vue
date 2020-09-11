<template>
  <b-form class="search-laboratory-form " @submit="handleSubmit">
    <b-form-group class="form-input-group mb-0">
      <b-form-input
        v-model="form.keyword"
        type="search"
        required
        placeholder="キーワードで検索する （〇〇研究室、東京都、工学部）"
        class="d-inline-block input"
      ></b-form-input>
    </b-form-group>
    <b-button type="submit" class="search-button px-4">
      <b-icon icon="search" variant="primary" />
    </b-button>
  </b-form>
</template>

<script>
export default {
  name: 'SearchLaboratoryForm',
  props: {
    endpoint: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      form: {
        keyword: '',
      },
    }
  },
  methods: {
    async handleSubmit() {
      const params = new URLSearchParams()
      params.append('keyword', this.keyword)

      await window.axios.post(this.endpoint, params)
    },
  },
}
</script>

<style lang="scss" scoped>
.search-laboratory-form {
  position: relative;

  .form-input-group {
    .input {
      height: 5em;
      border-radius: 1em;
    }
  }
  .search-button {
    position: absolute;
    top: 0;
    right: 0;
    height: 100%;
    border: none;
    border-radius: 0.7em;
    background-color: #cfcfcf;
    font-size: 1.5em;

    &:hover {
      background-color: rgb(84, 91, 98);
    }
  }
}
</style>
