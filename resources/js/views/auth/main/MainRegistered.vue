<template>
  <section id="main-registered">
    <h2>本登録が完了しました。</h2>
    <p>
      ユーザーの本登録が完了いたしました。みんラボで口コミを閲覧するためには、ゼミ・研究室に関する口コミを1件以上投稿してもらうことが必要です。
    </p>
    <div class="qr" v-html="qr" />
    <p class="bordered">
      上記のQRコードのスクリーンショットを撮って、先輩・友人・兄弟に送信し、口コミを1件以上投稿してもらってください！<br />
      口コミが投稿されし次第、「みんラボ」のサービスをお使いいただけます。
    </p>
  </section>
</template>

<script>
export default {
  name: 'Registered',
  props: {
    qr: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

#main-registered {
  width: min(90%, 700px);
  margin: 50px auto;

  h2 {
    margin-bottom: 40px;
    text-align: center;
    font-weight: bold;
  }

  .qr {
    margin: 30px auto;
    text-align: center;
  }

  p {
    margin-right: auto;
    margin-left: auto;
  }

  .bordered {
    padding: 20px 50px;
    border: 1px solid $brass;
    color: $brass;
  }
}
</style>
