<template>
  <section id="search-area">
    <h2>"{{ prefectureName }}"にある大学一覧</h2>
    <div class="sort-type">
      <input id="sort-type" type="radio" value="new-arrival" checked />
      <label for="sort-type">新着順</label>
    </div>
    <section id="results">
      <p>
        大学検索結果<span>（該当件数：{{ universities.length }}件）</span>
      </p>
      <!--        todo: ページングを実装する。-->
      <search-area-result
        v-for="university in universities"
        :key="university.name"
        :university-name="university.name"
        :average-total-evaluation="university.averageTotalEvaluation"
        :average-evaluations="university.averageEvaluations"
        :latest-evaluation="university.latestEvaluation"
        class="search-area-result"
      />
    </section>
  </section>
</template>

<script>
import SearchAreaResult from '../components/SearchAreaResult'

export default {
  name: 'SearchArea',
  components: { SearchAreaResult },
  props: {
    prefectureName: {
      type: String,
      default: '',
    },
    universities: {
      type: Array,
      default: () => [
        {
          name: '',
          averageTotalEvaluation: {
            category: '',
            value: -1,
          },
          averageEvaluations: [
            {
              category: '',
              value: -1,
            },
          ],
          latestEvaluation: {
            laboratoryName: '',
            facultyName: '',
            evaluationValues: [
              {
                category: '',
                value: -1,
              },
            ],
          },
        },
      ],
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

#search-area {
  background-color: $white;

  > *:not(section) {
    width: 90%;
    max-width: $main-max-width;
    margin: 0 auto;
  }

  h2 {
    padding: 50px 0;
    font-weight: bold;
  }

  .sort-type {
    input {
      display: none;
    }

    label {
      margin-bottom: 0;
      padding: 5px 30px;
      background-color: #fff;
      font-size: 16px;
    }
  }

  #results {
    padding-top: 70px;
    background-color: #fff;

    > * {
      width: 90%;
      max-width: $main-max-width;
      margin-right: auto;
      margin-left: auto;
    }

    > p {
      margin-bottom: 50px;
      font-size: 20px;

      span {
        font-size: 16px;
      }
    }

    .search-area-result {
      margin-bottom: 50px;
      border: 1px solid $gray;
    }
  }
}
</style>
