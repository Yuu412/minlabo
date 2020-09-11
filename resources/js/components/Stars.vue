<template>
  <div>
    <filled-star v-for="n of numberOfFilledStar" :key="'filled-' + n"></filled-star>
    <half-filled-star v-for="n of numberOfHalfFilledStar" :key="'half' + n"></half-filled-star>
    <stroke-star v-for="n of numberOfStrokeStar" :key="'stroke' + n"></stroke-star>
  </div>
</template>

<script>
import FilledStar from './FilledStar'
import HalfFilledStar from './HalfFilledStar'
import StrokeStar from './StrokeStar'

export default {
  name: 'Stars',
  components: { FilledStar, HalfFilledStar, StrokeStar },
  props: {
    value: {
      type: Number,
      default: -1,
    },
  },
  computed: {
    numberOfFilledStar() {
      return Math.floor(this.value)
    },
    numberOfHalfFilledStar() {
      const decimal = this.value - Math.floor(this.value)
      if (decimal === 0) return 0
      else return 1
    },
    numberOfStrokeStar() {
      return Math.floor(5 - this.value)
    },
  },
}
</script>

<style scoped></style>
