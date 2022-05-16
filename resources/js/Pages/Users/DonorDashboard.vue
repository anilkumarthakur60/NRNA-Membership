<template>
  <member-layout>
    <h1>Donor Dashboard</h1>
    <div class="" v-if="user.referal_code">
      <div id="app" v-cloak>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div
                class="
                  form-control
                  wizard-form-control
                  d-flex
                  align-items-center
                  testing-code
                  px-20px
                  mb-10px
                "
              >
                <span class="code text-red">{{
                  route("joinInvitaionLink", user.referal_code)
                }}</span>
                <span
                  class="btn btn-info text-white copy-btn ml-auto"
                  @click.stop.prevent="copyTestingCode"
                >
                  Copy
                </span>
                <input
                  type="hidden"
                  id="testing-code"
                  :value="route('joinInvitaionLink', user.referal_code)"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="" v-else>
      <Link :href="route('generateLink')">Generate Link</Link>
    </div>
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
  methods: {
    copyTestingCode() {
      let testingCodeToCopy = document.querySelector("#testing-code");
      testingCodeToCopy.setAttribute("type", "text");
      testingCodeToCopy.select();

      try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        alert("Testing code was copied " + msg);
      } catch (err) {
        alert("Oops, unable to copy");
      }

      testingCodeToCopy.setAttribute("type", "hidden");
      window.getSelection().removeAllRanges();
    },

    baseUrl() {
      return route("front.index");
    },
  },
};
</script>