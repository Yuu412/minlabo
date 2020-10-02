<template>
  <b-link :href="link" class="area-card">
    <b-card no-body class="overflow-hidden">
      <b-row no-gutters>
        <b-col md="6">
          <b-card-img :src="src" :alt="prefectureName"></b-card-img>
        </b-col>
        <b-col md="6">
          <b-card-body class="card-body">
            <b-card-text class="card-text">{{ prefectureName }}</b-card-text>
          </b-card-body>
        </b-col>
      </b-row>
    </b-card>
  </b-link>
</template>

<script>
export default {
  name: 'AreaCard',
  props: {
    prefectureImage: {
      type: String,
      default: '',
    },
    prefectureName: {
      type: String,
      default: '',
    },
  },
  computed: {
    src() {
      return '/img/prefecture_image/' + this.prefectureImage
    },
    link() {
      return '/area/' + this.prefectureName
    },
  },
}
</script>

<style lang="scss" scoped>
.area-card {
  &:hover {
    opacity: 0.8;

    .card-body {
      background-color: darken(#fff, 30%);
    }
  }

  .card-body {
    position: relative;
    height: 100%;
    padding: 0;

    .card-text {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      color: #444;
      font-size: 18px;
      font-weight: bold;
    }
  }
}
</style>
