<template>
  <member-layout>
    <h6>Donor Dashboard</h6>
    <div class="" v-if="user.referal_code">
      <div id="app" v-cloak>
        <div class="container">
          <div class="row justify-content-center align-item-center">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <!-- <div
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
              </div> -->

                  <form @submit.prevent="store()">
                    <div class="row">
                      <div class="mb-3 col-12">
                        <label for="" class="form-label">Invite Link to </label>
                        <input
                          type="email"
                          class="form-control"
                          v-model="form.email"
                          aria-describedby="helpId"
                          placeholder=""
                        />

                        <span class="text-danger" v-if="errors.email">{{
                          errors.email
                        }}</span>
                      </div>
                      <div class="col-12 d-flex">
                        <loading-button
                          :Classes="'btn btn-success btn-sm px-4 text-white mx-auto'"
                          :loading="form.processing"
                          >Submit</loading-button
                        >
                      </div>
                    </div>
                  </form>
                </div>
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

import { Link, useForm } from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Components/LoadingButton.vue";
export default {
  components: { MemberLayout, Link, LoadingButton },
  props: {
    user: Object,
    errors: Object,
  },

  setup() {
    const form = useForm({
      email: null,
    });
    return { form };
  },
  methods: {
    store() {
      this.form.post(route("sendInivationLink"), {
        preserveScroll: true,
        onSuccess: () => {
          this.$swal({
            icon: "success",
            title: "User has been created Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.form.reset();
        },
      });
    },
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
