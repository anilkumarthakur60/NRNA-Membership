<template>
  <button :disabled="loading" class="" :class="Classes" type="submit">
    <div
      v-if="loading"
      class="spinner-border text-white spinner-border-sm me-3"
      role="status"
    >
      <span class="visually-hidden text-success"> Loading...</span>
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
