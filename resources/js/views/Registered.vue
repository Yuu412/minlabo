<template>
  <section id="registered">
    <h2>仮登録が完了しました。</h2>
    <p>
      以下のメールアドレスへ「ユーザー本登録用リンク」を添付したメールを送信しましたので、メールの内容を確認し、本登録手続きを完了させてください。
    </p>
    <p class="email">
      {{ email }}
    </p>
    <p class="spam-attention">
      お使いのメールアドレスによっては、みんラボからのメールが誤って迷惑メールフォルダに振り分けられる可能性がありますのでご注意ください。
    </p>
    <p>
      しばらくしても登録確認メールが届かない場合、ご入力していただいたメールアドレスが間違っていた可能性があります。お手数ですが、再度ご登録いただくか、みんラボのお問い合わせアドレスまでご連絡ください。
    </p>
  </section>
</template>

<script>
export default {
  name: 'Registered',
  props: {
    email: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

#registered {
  width: 90%;
  max-width: 800px;
  margin: 50px auto;

  h2 {
    margin-bottom: 40px;
    text-align: center;
    font-weight: bold;
  }

  .email {
    margin: 30px 0 50px 0;
    padding: 20px 50px;
    background-color: $white;
    border: 1px solid $gray;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
  }

  .spam-attention {
    margin-bottom: 40px;
    padding: 20px 50px;
    border: 1px solid $brass;
    color: $brass;
  }
}
</style>
