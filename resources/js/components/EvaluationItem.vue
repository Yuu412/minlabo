<template>
  <div class="evaluation-item my-3">
    <p class="mb-0">{{ japaneseTitle }}</p>
    <stars :value="value"></stars>
  </div>
</template>

<script>
import Stars from './Stars'

export default {
  name: 'EvaluationItem',
  components: { Stars },
  props: {
    title: {
      type: String,
      default: '',
    },
    value: {
      type: Number,
      default: -1,
    },
  },
  computed: {
    japaneseTitle() {
      const titles = {
        professor: '教授',
        job: '就活',
        atmosphere: '雰囲気',
        other: 'その他',
      }

      return titles[this.title]
    },
  },
}
</script>

<style lang="scss" scoped>
.evaluation-item {
  display: flex;
  justify-content: space-evenly;
  align-items: center;

  p {
    flex: 0 20%;
    font-weight: bold;
  }
}
</style>
