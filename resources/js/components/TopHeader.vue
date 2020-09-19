<template>
  <header class="top-header">
    <logged-in-nav
      v-if="isLogin"
      :route-post="routePost"
      :route-my-page="routeMyPage"
      :route-log-out="routePost"
      :endpoint-logout="endpointLogout"
      :csrf="csrf"
    />
    <not-logged-in-nav v-else :route-register="routeRegister" :route-login="routeLogin" :route-post="routePost" />
    <div class="flex">
      <div class="sentence">
        <h2>
          研究室・ゼミ選択の<br />
          後悔をゼロに。
        </h2>
        <p>
          対面での情報共有が難しい中、<br />
          皆さんのゼミ・研究室選択への後悔を少しでも減らしたい。<br />
          そんな想いで立ち上がった学生団体です。
        </p>
        <login-button class="button" :link="routeLogin" />
        <register-button class="button" :link="routeRegister" />
      </div>
      <img src="" alt="" />
    </div>
  </header>
</template>

<script>
import LoggedInNav from './LoggedInNav'
import NotLoggedInNav from './NotLoggedInNav'
import LoginButton from './LoginButton'
import RegisterButton from './RegisterButton'

export default {
  name: 'TopHeader',
  components: { LoggedInNav, NotLoggedInNav, LoginButton, RegisterButton },
  props: {
    routeRegister: {
      type: String,
      default: '',
    },
    routeLogin: {
      type: String,
      default: '',
    },
    routePost: {
      type: String,
      default: '',
    },
    routeMyPage: {
      type: String,
      default: '',
    },
    endpointLogout: {
      type: String,
      default: '',
    },
    csrf: {
      type: String,
      default: '',
    },
    isLogin: {
      type: Boolean,
      default: false,
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.top-header {
  .flex {
    display: flex;
    justify-content: space-around;
    padding-top: 50px;
    background: linear-gradient($sky-blue, $body-bg);

    .sentence {
      h2 {
        line-height: 1.5em;
        font-size: 48px;
        font-weight: bold;
      }

      p {
        margin: 20px 0 30px 0;
        line-height: 1.8em;
        font-size: 18px;
        font-weight: bold;
      }

      .button {
        width: 250px;
        margin: 20px 0;
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 18px;
      }
    }
  }
}
</style>
