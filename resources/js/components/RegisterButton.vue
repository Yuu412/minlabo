<template>
  <a :href="link" class="register-button">
    今すぐユーザー登録
  </a>
</template>

<script>
export default {
  name: 'RegisterButton',
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

.register-button {
  display: block;
  padding: 20px;
  border-radius: 5em;
  background: linear-gradient(to right, #619dfb, #e68cff);
  text-align: center;
  color: $white;
  font-weight: bold;

  &:hover {
    text-decoration: none;
    color: $white;
    opacity: 0.7;
  }
}
</style>
