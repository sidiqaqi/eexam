<template>
  <a @click.prevent="logout" href="#">Keluar</a>
</template>
<script>
export default {
  methods: {
    logout() {
      this.$inertia.post(this.$route("logout"), this.form);
    }
  }
};
</script>
