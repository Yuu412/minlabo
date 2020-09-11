<template>
  <div class="top">
    <section id="area">
      <h2>エリアから探す</h2>
      <div class="area-cards">
        <area-card
          v-for="mainPrefecture in mainPrefectures"
          :key="mainPrefecture.name"
          :prefecture-name="mainPrefecture.name"
          :prefecture-image="mainPrefecture.image"
          class="area-card my-3"
        ></area-card>
      </div>
      <div class="area-links-list">
        <area-links
          v-for="area in allPrefectures"
          :key="area.category"
          :area-name="area.category + 'エリア'"
          :prefectures="area.prefectures"
          class="area-links my-3"
        ></area-links>
      </div>
    </section>
    <section id="faculty">
      <h2>学部から探す</h2>
      <section v-for="faculty in faculties" :id="faculty.category" :key="faculty.category">
        <h3 class="faculty-category mt-4 mb-2">{{ faculty.category }}</h3>
        <div class="faculty-cards">
          <faculty-card
            v-for="facultyName in faculty.faculty_names"
            :key="facultyName.name"
            :faculty-image="facultyName.image"
            :faculty-name="facultyName.name"
            class="faculty-card mr-4 mb-4"
          ></faculty-card>
        </div>
      </section>
    </section>
    <section id="new-evaluation">
      <h2>新着口コミ</h2>
      <div class="evaluation-cards">
        <evaluation-card
          v-for="evaluation in newEvaluations"
          :key="evaluation.id"
          :evaluation-id="evaluation.id"
          :prefecture-image="evaluation.prefecture_image"
          :university-name="evaluation.university_name"
          :faculty-name="evaluation.faculty_name"
          :laboratory-name="evaluation.laboratory_name"
          :evaluation-items="evaluation.evaluation_items"
          class="evaluation-card mr-3 my-3"
        ></evaluation-card>
      </div>
    </section>
    <section id="good-evaluation">
      <h2>総合評価ランキング</h2>
      <div class="evaluation-cards">
        <evaluation-card
          v-for="evaluation in highEvaluations"
          :key="evaluation.id"
          :evaluation-id="evaluation.id"
          :prefecture-image="evaluation.prefecture_image"
          :university-name="evaluation.university_name"
          :faculty-name="evaluation.faculty_name"
          :laboratory-name="evaluation.laboratory_name"
          :evaluation-items="evaluation.evaluation_items"
          class="evaluation-card mr-3 my-3"
        ></evaluation-card>
      </div>
    </section>
  </div>
</template>

<script>
import AreaCard from '../components/AreaCard'
import AreaLinks from '../components/AreaLinks'
import FacultyCard from '../components/FacultyCard'
import EvaluationCard from '../components/EvaluationCard'

export default {
  name: 'Laboratories',
  components: { AreaCard, AreaLinks, FacultyCard, EvaluationCard },
  props: {
    mainPrefectures: {
      type: Array,
      default: null,
    },
    allPrefectures: {
      type: Array,
      default: null,
    },
    faculties: {
      type: Array,
      default: null,
    },
    newEvaluations: {
      type: Array,
      default: null,
    },
    highEvaluations: {
      type: Array,
      default: null,
    },
  },
}
</script>

<style lang="scss" scoped>
.top {
  > section {
    width: 90%;
    margin: 100px auto;
  }
  h2 {
    font-weight: bold;
  }
  #area {
    .area-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;

      .area-card {
        flex: 0 400px;
      }
    }

    .area-links-list {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;

      .area-links {
        flex: 0 650px;
      }
    }
  }
  #faculty {
    .faculty-category {
      font-size: 20px;
      font-weight: bold;
    }

    .faculty-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

      .faculty-card {
        flex: 0 200px;
      }
    }
  }
  #new-evaluation,
  #good-evaluation {
    .evaluation-cards {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;

      .evaluation-card {
        flex: 0 250px;
      }
    }
  }
}
</style>
