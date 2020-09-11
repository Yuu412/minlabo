<template>
  <footer>
    <p class="copyright mb-0">Copyright &copy; {{ year }} みんラボ Inc All rights reserved</p>
    <div class="icons mr-5">
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
  },
}
</script>

<style lang="scss" scoped>
footer {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 20px 0;
  background-color: #1d93e9;
  text-align: center;
  color: #eee;

  .copyright {
    flex: 1;
    margin-left: 15%;
  }

  .icons {
    font-size: 20px;

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
</style>
