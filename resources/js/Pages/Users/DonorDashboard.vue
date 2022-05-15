<template>
  <member-layout>
    <h1>Donor Dashboard</h1>
    <Link :href="route('generateLink')">Generate Link</Link>
  </member-layout>
</template>
<script>
import MemberLayout from "../../Layouts/MemberLayout.vue";

import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: { MemberLayout, Link },
  props: {
    user: Object,
  },
};
</script>