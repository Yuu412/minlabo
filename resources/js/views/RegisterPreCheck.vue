<template>
  <section id="form" class="register">
    <h2>ユーザー仮登録 確認画面</h2>
    <p>
      登録内容をご確認の上、「送信する」ボタンを押してください。<br />
      ご入力いただいたメールアドレスに仮登録確認メールが送信されます。
    </p>
    <p class="caption"><b>基本情報</b></p>
    <b-form :action="endpointRegister" method="POST" class="form">
      <input type="hidden" name="_token" :value="csrf" />
      <table>
        <tr>
          <th>
            <label for="email">メールアドレス（ID）</label>
          </th>
          <td>
            <input id="email" type="hidden" name="email" :value="email" />
            <p>{{ email }}</p>
          </td>
        </tr>
        <tr>
          <th>
            <label for="password">パスワード</label>
          </th>
          <td>
            <input id="password" type="hidden" name="password" :value="password" />
            <p>{{ passwordMask }}</p>
          </td>
        </tr>
      </table>

      <div class="buttons">
        <b-button variant="outline-primary" class="button" @click="back">修正する</b-button>
        <b-button type="submit" variant="primary" class="button">送信する</b-button>
      </div>
    </b-form>
  </section>
</template>
<script>
export default {
  name: 'RegisterPreCheck',
  props: {
    csrf: {
      type: String,
      default: '',
    },
    endpointRegister: {
      type: String,
      default: '',
    },
    email: {
      type: String,
      default: '',
    },
    password: {
      type: String,
      default: '',
    },
    passwordMask: {
      type: String,
      default: '',
    },
  },
  methods: {
    back() {
      window.history.back()
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.register {
  width: 90%;
  max-width: $main-max-width;
  margin: 50px auto;

  h2 {
    margin-bottom: 50px;
    padding-bottom: 10px;
    border-bottom: 1px solid $border-color;
    font-weight: bold;
  }

  .caption {
    margin-top: 30px;
    font-size: 18px;
  }

  .form {
    margin-top: 30px;

    table {
      width: 100%;
      border-bottom: 1px solid $border-color;
      border-right: 1px solid $border-color;

      tr {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border-top: 1px solid $border-color;
        border-left: 1px solid $border-color;

        th {
          flex: 0 300px;
          padding-left: 15px;
          font-weight: normal;

          label {
            margin-bottom: 0;
          }
        }

        td {
          flex: 1;
          padding: 25px 15px;
          border-left: 1px solid $border-color;

          p {
            margin-bottom: 0;
          }
        }
      }
    }

    .buttons {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      margin: 80px 0;

      .button {
        width: 200px;
        font-size: 18px;
        font-weight: bold;

        &:first-of-type {
          margin-right: 20px;
        }
      }
    }
  }
}
</style>
