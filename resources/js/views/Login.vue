<template>
  <div class="login">
    <section id="form">
      <h2>ログイン</h2>
      <b-form :action="endpointLogin" method="POST">
        <input type="hidden" name="_token" :value="csrf" />
        <b-form-group>
          <b-form-input
            v-model="form.email"
            name="email"
            type="email"
            required
            placeholder="メールアドレス "
          ></b-form-input>
        </b-form-group>
        <b-form-group>
          <b-form-input
            v-model="form.password"
            name="password"
            type="password"
            required
            placeholder="パスワード"
          ></b-form-input>
        </b-form-group>
        <b-form-checkbox v-model="form.remember" name="remember">
          ログイン状態を保持する
        </b-form-checkbox>
        <b-button block type="submit" variant="primary" class="login-button">ログイン</b-button>
        <a :href="routePasswordRequest">パスワードをお忘れになった方はこちら</a>
      </b-form>
      <div class="register">
        <p class="mb-0">ユーザー登録をされていない方</p>
        <a :href="routeRegister">
          <b-button variant="outline-primary" class="register-button">
            ユーザー登録（1分・無料）
          </b-button>
        </a>
      </div>
    </section>
    <section id="attention">
      <h2>注意</h2>
      <p>
        本登録が終了していても、本登録終了後に配布されたQRコードを先輩・兄弟に送信し、口コミを投稿してもらうまではログインすることができません。
        現在の登録状況が知りたい方は、<a :href="routeRegister">こちらのページ</a
        >にアクセスして、登録時に使用したメールアドレスを記入してください。
      </p>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Login',
  props: {
    endpointLogin: {
      type: String,
      default: '',
    },
    csrf: {
      type: String,
      default: '',
    },
    remember: {
      type: Boolean,
      default: false,
    },
    routePasswordRequest: {
      type: String,
      default: '',
    },
    routeRegister: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: this.remember,
      },
    }
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.login {
  width: 90%;
  max-width: 700px;
  margin: 50px auto;

  section {
    margin-bottom: 100px;

    h2 {
      padding-bottom: 10px;
      border-bottom: 1px solid $border-color;
      font-weight: bold;
    }
  }

  #form {
    h2 {
      margin-bottom: 30px;
    }

    .login-button {
      margin: 20px 0;
      padding: 10px 0;
      font-weight: bold;
    }

    .register {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 50px 0;

      .register-button {
        padding: 10px 50px;
        font-weight: bold;

        &:not(:hover) {
          background: white;
        }
      }
    }
  }

  #attention {
    p {
      margin: 10px auto;
    }
  }
}
</style>
