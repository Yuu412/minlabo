<template>
  <div class="evaluation">
    <p class="category-name">{{ categoryName }}</p>
    <stars :value="evaluationValue" />
    <p class="evaluation-value">{{ evaluationValue }}</p>
  </div>
</template>

<script>
import Stars from './Stars'
export default {
  name: 'Evaluation',
  components: { Stars },
  props: {
    categoryName: {
      type: String,
      default: '',
    },
    evaluationValue: {
      type: Number,
      default: -1,
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.evaluation {
  display: flex;
  align-items: center;

  p {
    margin-bottom: 0;
  }

  .category-name {
    flex: 0 4em;
    margin-right: 15px;
    text-align: right;
    font-weight: bold;
  }

  .evaluation-value {
    margin-left: 15px;
    color: $sky-blue;
    font-weight: bold;
  }
}
</style>
