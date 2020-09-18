<template>
  <div :class="'area-count ' + color">
    <p class="name">{{ name }}</p>
    <p class="count">
      <span>{{ count }}</span>
      件
    </p>
    <gradation-round-bar class="gradation-round-bar" />
  </div>
</template>

<script>
import GradationRoundBar from './GradationRoundBar'

export default {
  name: 'AreaCount',
  components: { GradationRoundBar },
  props: {
    name: {
      type: String,
      default: '',
    },
    count: {
      type: String,
      default: '',
    },
    // todo: 引き数のcolorによってborder, text-colorを変える
    color: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.area-count {
  position: relative;
  width: 15%;
  padding: 20px;
  border: 2px solid #aaa;
  border-radius: 1em;
  text-align: center;

  .name {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 70%;
    background-color: $body-bg;
    font-size: 20px;
    font-weight: bold;
  }

  .count {
    margin-bottom: 0;
    font-weight: bold;
    font-size: 16px;

    span {
      font-size: 42px;
    }
  }

  .gradation-round-bar {
    width: 80%;
    height: 10px;
    margin: 0 auto;
  }
}
</style>
