<template>
  <b-link :href="link" class="evaluation-card">
    <b-card no-body>
      <b-card overlay :img-src="src" :img-alt="laboratoryName" text-variant="white" class="header">
        <b-card-text>{{ universityName }}</b-card-text>
        <b-card-text>{{ facultyName }}</b-card-text>
        <b-card-text>{{ laboratoryName }}</b-card-text>
      </b-card>
      <div class="evaluation-items">
        <evaluation-item v-for="(value, key) in evaluationItems" :key="key" :title="key" :value="value">
        </evaluation-item>
      </div>
    </b-card>
  </b-link>
</template>

<script>
import EvaluationItem from './EvaluationItem'

export default {
  name: 'EvaluationCard',
  components: { EvaluationItem },
  props: {
    evaluationId: {
      type: Number,
      default: -1,
    },
    prefectureImage: {
      type: String,
      default: '',
    },
    universityName: {
      type: String,
      default: '',
    },
    facultyName: {
      type: String,
      default: '',
    },
    laboratoryName: {
      type: String,
      default: '',
    },
    evaluationItems: {
      type: Object,
      default: null,
    },
  },
  computed: {
    src() {
      return '/img/pre_image/' + this.prefectureImage
    },
    link() {
      return 'lab-evaluation/' + this.evaluationId
    },
  },
}
</script>

<style lang="scss" scoped>
.evaluation-card {
  color: #444;

  &:hover {
    opacity: 0.8;
    text-decoration: none;

    .evaluation-items {
      background-color: darken(#fff, 30%);
    }
  }

  .header {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-shadow: 2px 2px 0 #000;
  }
}
</style>
