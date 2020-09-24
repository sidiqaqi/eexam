
<template>
  <button :disabled="loading">
    <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: Boolean
  }
};
</script>
