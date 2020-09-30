<template>
  <section id="form" class="register">
    <h2>無料ユーザー登録<span>（</span>1分<span>）</span></h2>
    <div class="caption">
      <p><b>基本情報</b></p>
      <p><span>＊</span>必須</p>
    </div>
    <b-form :action="endpointRegisterPreCheck" method="POST" class="form">
      <input type="hidden" name="_token" :value="csrf" />
      <table>
        <tr>
          <th>
            <label for="email">メールアドレス（ID）</label>
          </th>
          <td>
            <b-form-input id="email" v-model="form.email" class="input" name="email" type="email" required />
            <p>ログイン時のIDとなります。</p>
          </td>
        </tr>
        <tr>
          <th>
            <label for="password">パスワード</label>
          </th>
          <td>
            <b-form-input
              id="password"
              v-model="form.password"
              class="input"
              name="password"
              type="password"
              required
            />
            <p>8文字以上、16文字以内でご入力ください</p>
          </td>
        </tr>
        <tr>
          <th>
            <label for="password-confirm">パスワードの確認</label>
          </th>
          <td>
            <b-form-input
              id="password-confirm"
              v-model="form.passwordConfirm"
              class="input"
              name="password_confirmation"
              type="password"
              required
            />
          </td>
        </tr>
      </table>

      <div class="next-button-wrapper">
        <b-button type="submit" variant="primary" class="next-button">次へ</b-button>
      </div>
    </b-form>
  </section>
</template>
<script>
export default {
  name: 'Register',
  props: {
    csrf: {
      type: String,
      default: '',
    },
    endpointRegisterPreCheck: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
        passwordConfirm: '',
      },
    }
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
    padding-bottom: 10px;
    border-bottom: 1px solid $border-color;
    font-weight: bold;

    span {
      font-weight: normal;
    }
  }

  .caption {
    display: flex;
    align-items: center;
    margin-top: 40px;

    b {
      font-size: 20px;
    }

    span {
      padding: 0 5px 0 20px;
      color: $red;
    }
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

          &:after {
            content: '＊';
            padding-left: 15px;
            color: $red;
          }
        }

        td {
          flex: 1;
          padding: 20px 10px;
          border-left: 1px solid $border-color;

          .input {
            max-width: 700px;
          }

          p {
            margin: 5px 0 0 0;
          }
        }
      }
    }

    .next-button-wrapper {
      margin: 50px 0;
      text-align: center;

      .next-button {
        width: 200px;
        font-size: 18px;
        font-weight: bold;
      }
    }
  }
}
</style>
