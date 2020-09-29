<template>
  <div class="simple-card">
    <!--     todo:  画像がないのでとりあえず適当な画像を配置している-->
    <img src="/img/fac_logo/other.png" alt="" />
    <p>{{ text }}</p>
  </div>
</template>

<script>
export default {
  name: 'SimpleCard',
  props: {
    text: {
      type: String,
      default: '',
    },
    imageName: {
      type: String,
      default: '',
    },
  },
  computed: {
    src() {
      return '/img/' + this.imageName
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.simple-card {
  @include card();

  img {
    height: 300px;
  }

  p {
    font-size: 20px;
    font-weight: bold;
  }
}
</style>
