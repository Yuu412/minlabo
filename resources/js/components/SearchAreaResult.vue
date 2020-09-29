<template>
  <div class="search-area-result">
    <div class="total-evaluation">
      <div class="top">
        <h3>
          <a :href="routeToUniversity">{{ universityName }}</a>
        </h3>
        <evaluation
          :category-name="averageTotalEvaluation.category"
          :evaluation-value="averageTotalEvaluation.value"
          class="evaluation"
        />
      </div>
      <div class="detail">
        <evaluation
          v-for="averageEvaluation in averageEvaluations"
          :key="averageEvaluation.category"
          :category-name="averageEvaluation.category"
          :evaluation-value="averageEvaluation.value"
          class="evaluation"
        />
      </div>
    </div>
    <div class="new-evaluation">
      <p>最新口コミ</p>
      <div class="flex">
        <p class="laboratory-name">
          <a :href="routeToLaboratory">{{ latestEvaluation.laboratoryName }}（{{ latestEvaluation.facultyName }}）</a>
        </p>
        <div class="evaluations">
          <evaluation
            v-for="evaluationValue in latestEvaluation.evaluationValues"
            :key="evaluationValue.category"
            :category-name="evaluationValue.category"
            :evaluation-value="evaluationValue.value"
            class="evaluation"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Evaluation from './Evaluation'

export default {
  name: 'SearchAreaResult',
  components: { Evaluation },
  props: {
    universityName: {
      type: String,
      default: '',
    },
    averageTotalEvaluation: {
      type: Object,
      default: () => ({
        category: '',
        value: -1,
      }),
    },
    averageEvaluations: {
      type: Array,
      default: () => [
        {
          category: '',
          value: -1,
        },
      ],
    },
    latestEvaluation: {
      type: Object,
      default: () => ({
        laboratoryName: '',
        facultyName: '',
        evaluationValues: [
          {
            category: '',
            value: -1,
          },
        ],
      }),
    },
  },
  computed: {
    routeToUniversity() {
      return '/univ/' + this.universityName
    },
    routeToLaboratory() {
      return `/lab/${this.universityName}/${this.latestEvaluation.laboratoryName}`
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.search-area-result {
  .total-evaluation {
    padding: 30px 30px 10px 30px;
    background-color: $white;

    .top {
      display: flex;
      margin-bottom: 30px;

      h3 {
        margin: 0 50px 0 0;

        a {
          color: $dark-blue;
          font-weight: bold;
        }
      }

      .evaluation {
        font-size: 16px;
      }
    }

    .detail {
      display: flex;
      flex-wrap: wrap;

      .evaluation {
        margin-bottom: 29px;

        &:not(:last-of-type) {
          margin-right: 50px;
        }
      }
    }
  }

  .new-evaluation {
    padding: 30px 30px 10px 30px;

    > p {
      font-size: 18px;
    }

    .flex {
      display: flex;

      .laboratory-name {
        margin: 0 50px 20px 0;

        a {
          color: $black;
          font-size: 16px;
          font-weight: bold;
        }
      }

      .evaluations {
        flex: 1;
        display: flex;
        flex-wrap: wrap;

        .evaluation {
          margin-bottom: 29px;

          &:not(:last-of-type) {
            margin-right: 50px;
          }
        }
      }
    }
  }
}
</style>
