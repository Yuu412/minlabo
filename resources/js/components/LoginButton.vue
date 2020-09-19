<template>
  <a :href="link" class="login-button">
    ログイン
  </a>
</template>

<script>
export default {
  name: 'LoginButton',
  props: {
    link: {
      type: String,
      default: '',
    },
  },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/app';

.login-button {
  display: block;
  padding: 20px;
  border: 1px solid $purple-border;
  border-radius: 5em;
  background-color: white;
  text-align: center;
  color: $purple-text;
  font-weight: bold;

  &:hover {
    text-decoration: none;
    color: $purple-text;
    opacity: 0.7;
  }
}
</style>
