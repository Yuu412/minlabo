<template>
  <footer>
    <b-icon class="to-page-top" icon="arrow-up-short" @click="toPageTop" />
    <div class="logo-and-menu">
      <div class="logo">
        <img src="/img/minlabo_logo/logo_1.png" alt="みんラボ ロゴ" />
      </div>
      <div class="menu">
        <!--todo: ホームのリンクをどこにするか確認する-->
        <a href="">ホーム</a>
        <a :href="routeTerm">利用規約</a>
        <a :href="routePolicy">プライバシーポリシー</a>
      </div>
    </div>
    <div class="copyright-and-sns">
      <p class="copyright mb-0">Copyright &copy; {{ year }} みんラボ Inc All rights reserved</p>
      <div class="sns mr-5">
        <a href="https://www.instagram.com/?hl=ja"
          ><font-awesome-icon :icon="['fab', 'instagram']" class="icon mx-3"></font-awesome-icon
        ></a>
        <a href="https://twitter.com/"
          ><font-awesome-icon :icon="['fab', 'twitter']" class="icon mx-3"></font-awesome-icon
        ></a>
        <a href="https://www.facebook.com/"
          ><font-awesome-icon :icon="['fab', 'facebook-f']" class="icon mx-3"></font-awesome-icon
        ></a>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
  props: {
    year: {
      type: String,
      default: '',
    },
    routeTerm: {
      type: String,
      default: '',
    },
    routePolicy: {
      type: String,
      default: '',
    },
  },
  methods: {
    toPageTop() {
      window.scrollTo({
        top: 0,
        // todo: 指定しているがスムーススクロールにならない。原因を突き止めて修正する。
        behavior: 'smooth',
      })
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

footer {
  position: relative;

  .to-page-top {
    position: absolute;
    right: 0;
    color: $sky-blue;
    font-size: 100px;

    &:hover {
      transform: scale(1.5);
      transition: 0.3s;
      color: $dark-blue;
      cursor: pointer;
    }
  }

  .logo-and-menu {
    padding: 20px 0 40px 0;

    .logo {
      padding-bottom: 20px;
      text-align: center;

      img {
        max-width: 300px;
        height: auto;
      }
    }

    .menu {
      text-align: center;

      a {
        padding: 0 20px;
        color: $black;
        font-weight: bold;
      }
    }
  }

  .copyright-and-sns {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 20px 0;
    background-color: $sky-blue;
    text-align: center;

    .copyright {
      flex: 1;
      margin-left: 15%;
      color: #eee;
    }

    .sns {
      font-size: 28px;

      a {
        color: #eee;

        &:hover {
          .icon {
            transform: scale(1.5, 1.5);
            transition: 0.3s;
          }
        }
      }
    }
  }
}
</style>
