<template>
  <div class="top">
    <section id="about">
      <div class="card">
        <h2>みんラボってどんなサービス？</h2>
        <video src=""><p>動画を再生するにはvideoタグをサポートしたブラウザが必要です。</p></video>
        <p>
          サービス紹介をここに書きます。<br />
          サービスの紹介を<br />
          ここに書きます。<br />
          サービスの紹介をここに<br />
          書きます。
        </p>
      </div>
    </section>
    <section id="area">
      <h2>どこのゼミ・研究室の口コミが見られるの？</h2>
      <div class="area-counts">
        <img src="img/japanmap.png" alt="日本地図" width="90%" height="90%" />
        <area-count
          v-for="(area, index) in areas"
          :key="area.name"
          :name="area.name"
          :count="area.count"
          :color="colors[index]"
        />
      </div>
    </section>
    <section id="sign-up">
      <h2>無料登録はたったの３ステップ！</h2>
      <div class="steps">
        <simple-card src="" class="simple-card" text="基本情報を入力" />
        <simple-card src="" class="simple-card" text="兄弟・先輩に口コミフォームを送信する" />
        <simple-card src="" class="simple-card" text="QRコードから投稿してもらう" />
      </div>
      <div class="descriptions">
        <div class="description">
          <p class="title">最短5分で入力完了</p>
          <p>基本情報の入力はメールアドレス、大学名、学部、学科のたった4項目だけなので、最短1分で終了します！</p>
        </div>
        <div class="line" />
        <div class="description">
          <p class="title">QRコードで簡単に送信</p>
          <!--            todo: 間に一行空白があるが、これが本当に必要か吉田さんに確認する。-->
          <p>QRコードで簡単に口コミ投稿フォームを共有することができます。</p>
          <!--            todo: 'みんラボの全国のすべての口コミ'という言い回し変な気がするので確認-->
          <p>
            兄弟・先輩にゼミ・研究室の口コミを書いてもらうことで、みんラボの全国のすべての口コミをご覧いただけます。
          </p>
        </div>
      </div>
    </section>
    <register-button :link="routeRegister" class="regsiter-button" />
  </div>
</template>

<script>
import AreaCount from '../components/AreaCount'
import SimpleCard from '../components/SimpleCard'
import RegisterButton from '../components/RegisterButton'

export default {
  name: 'Top',
  components: { AreaCount, SimpleCard, RegisterButton },
  props: {
    areas: {
      type: Array,
      default: null,
    },
    routeRegister: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      colors: ['blue', 'green', 'red', 'yellow', 'pink'],
    }
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.top {
  > section {
    margin: 100px 0;
    text-align: center;

    h2 {
      font-size: 36px;
      font-weight: bold;
    }
  }

  #about {
    margin-bottom: 15vw;

    .card {
      h2 {
        margin-bottom: 30px;
      }

      @include card();
      width: 90%;
      max-width: $main-max-width;
      margin-right: auto;
      margin-left: auto;
      padding: 50px 0;

      video {
        width: 80%;
        margin: 20px auto;
        border: 1px solid $black;
      }

      p {
        font-size: 22px;
        font-weight: bold;
      }
    }
  }

  #area {
    margin-bottom: 15vw;

    h2 {
      margin-bottom: 40px;
    }

    .area-counts {
      position: relative;
      height: 800px;

      img {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 50%;
        //height: auto;
      }

      .area-count {
        position: absolute;

        &:nth-of-type(1) {
          right: 5%;
          top: 15%;
        }
        &:nth-of-type(2) {
          right: 10%;
          bottom: 30%;
        }
        &:nth-of-type(3) {
          left: 50%;
          bottom: 5%;
          transform: translateX(-50%);
        }
        &:nth-of-type(4) {
          left: 30%;
          top: 5%;
        }
        &:nth-of-type(5) {
          left: 10%;
          top: 50%;
          transform: translateY(-50%);
        }
      }
    }
  }
  #sign-up {
    h2 {
      margin-bottom: 100px;
    }

    .steps {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      width: 80%;
      margin-right: auto;
      margin-left: auto;

      .simple-card {
        flex: 0 300px;
        padding: 20px;
      }
    }

    .descriptions {
      display: flex;
      justify-content: space-around;
      width: 80%;
      margin: 40px auto;

      .description {
        max-width: 500px;
        padding: 50px 0;

        &:first-of-type {
          //border-right: 1px solid $border-color;
        }

        .title {
          font-size: 22px;
          font-weight: bold;
        }

        p:not(.title) {
          width: 79%;
          margin: 0 auto;
        }
      }

      .line {
        border-right: 1px solid $border-color;
      }
    }
  }

  .register-button {
    width: 400px;
    margin: 0 auto 200px auto;
    font-size: 24px;
  }
}
</style>
