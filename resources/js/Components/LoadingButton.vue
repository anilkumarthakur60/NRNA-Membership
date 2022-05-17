<template>
  <button
    :disabled="loading"
    class="btn-outline-danger btn-sm btn m-auto mt-3"
    :class="Classes"
    type="submit"
  >
    <div
      v-if="loading"
      class="spinner-border text-white spinner-border-sm"
      role="status"
    >
      <span class="visually-hidden">Loading...</span>
    </div>
    <slot />
  </button>
</template>

<script>
export default {
  name: "LoadingButton",
  props: {
    loading: Boolean,
    Classes: String,
  },
};
</script>
