<template>
  <backend-layout>
    <div class="row">
      <div class="col-12 d-flex">
        <Link
          :href="route('userTypes.index')"
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
                  <div class="mb-3">
                    <label for="" class="form-label"></label>
                    <input
                      type="text"
                      v-model="form.name"
                      class="form-control"
                      placeholder="User Type Name "
                    />
                    <span class="text-danger" v-if="errors.name">{{
                      errors.name
                    }}</span>
                  </div>
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

export default {
  components: {
    BackendLayout,
    Link,
    LoadingButton,
  },

  props: {
    errors: Object,
    userType: Object,
  },

  setup(props) {
    const form = useForm({
      name: props.userType.name,
    });
    return { form };
  },
  methods: {
    store() {
      this.form.put(route("userTypes.update", this.userType.id), {
        preserveScroll: true,
        onSuccess: () => {
          this.$swal({
            icon: "success",
            title: "UserType has been updated Successfully",
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
