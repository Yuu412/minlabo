<template>
  <a :href="link" class="faculty-card p-3">
    <img :src="src" :alt="facultyName" class="mx-auto" />
    <p class="mt-3 mb-0">{{ facultyName }}</p>
  </a>
</template>

<script>
export default {
  name: 'FacultyCard',
  props: {
    facultyName: {
      type: String,
      default: '',
    },
    facultyImage: {
      type: String,
      default: '',
    },
  },
  computed: {
    src() {
      return '/img/faculty_logo/' + this.facultyImage
    },
    link() {
      return 'faculty-result/' + this.facultyName
    },
  },
}
</script>

<style lang="scss" scoped>
.faculty-card {
  display: flex;
  flex-direction: column;
  border-radius: 0.5em;
  background-color: #1d93e9;
  text-align: center;

  &:hover {
    background-color: darken(#1d93e9, 10%);
    text-decoration: none;
  }

  img {
    width: 70%;
    height: auto;
  }

  p {
    color: #eee;
    font-size: 18px;
    font-weight: bold;
  }
}
</style>
