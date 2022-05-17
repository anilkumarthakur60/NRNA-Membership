<template>
  <backend-layout>
    <div class="row">
      <div class="col-12 d-flex">
        <Link
          :href="route('users.index')"
          class="btn btn-sm btn-info my-2 px-3 ms-auto"
        >
          View All List
        </Link>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="store">
              <div class="row">
                <div class="col-sm-12">
                  <Multiselect
                    mode="tags"
                    v-model="form.usertypes"
                    :closeOnSelect="false"
                    :searchable="true"
                    :createTag="false"
                    :options="usertypes"
                  ></Multiselect>
                </div>
                <div class="col-sm-12 d-flex">
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
  </backend-layout>
</template>

<script>
import BackendLayout from "../../Layouts/BackendLayout.vue";

import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Components/LoadingButton.vue";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    BackendLayout,
    Link,
    LoadingButton,
    Multiselect,
  },

  props: {
    errors: Object,
    usertypes: Array,
    user: Object,
  },

  setup(props) {
    const form = useForm({
      usertypes: props.usertypes,
    });
    return { form };
  },
  methods: {
    store() {
      this.form.put(route("users.update", this.user.id), {
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
  },
};
</script>
