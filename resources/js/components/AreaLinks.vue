<template>
  <div class="area-links">
    <h3 class="area-name">【{{ areaName }}】</h3>
    <div class="prefectures">
      <b-link v-for="prefecture in prefectures" :key="prefecture" :href="link(prefecture)" class="prefecture mr-3">{{
        prefecture
      }}</b-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AreaLinks',
  props: {
    areaName: {
      type: String,
      default: '',
    },
    prefectures: {
      type: Array,
      default: null,
    },
  },
  methods: {
    link(prefectureName) {
      return '/area/' + prefectureName
    },
  },
}
</script>

<style lang="scss" scoped>
.area-links {
  .area-name {
    font-size: 20px;
  }

  .prefectures {
    display: flex;

    .prefecture {
      color: #444;
    }
  }
}
</style>
