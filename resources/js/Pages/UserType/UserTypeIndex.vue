<template>
  <backend-layout>
    <div class="row">
      <div class="col-12 d-flex">
        <Link
          :href="route('userTypes.create')"
          class="btn btn-sm btn-info my-2 px-3 ms-auto"
          >Add New</Link
        >
      </div>
    </div>

    <Table
      :filters="queryBuilderProps.filters"
      :search="queryBuilderProps.search"
      :columns="queryBuilderProps.columns"
      :on-update="setQueryBuilder"
      :meta="users"
    >
      <template #head>
        <tr>
          <th @click.prevent="sortBy('id')">Id</th>
          <th @click.prevent="sortBy('name')">Name</th>
          <th>UserCount</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </template>

      <template #body>
        <tr v-for="user in users.data" :key="user.id">
          <td v-show="showColumn('id')">{{ user.id }}</td>
          <td v-show="showColumn('name')">{{ user.name }}</td>
          <td v-show="showColumn('users_count')">{{ user.users_count }}</td>
          <td>
            <Link
              :href="route('userTypes.edit', user.id)"
              class="btn btn-sm btn-info text-white"
              >Edit</Link
            >
          </td>
          <td>
            <button
              v-if="user.users_count == 0"
              class="btn btn-sm btn-danger text-white"
              @click="destroy(user.id)"
            >
              Delete
            </button>
          </td>
        </tr>
      </template>
    </Table>
  </backend-layout>
</template>

<script>
import {
  InteractsWithQueryBuilder,
  Tailwind2,
} from "@protonemedia/inertiajs-tables-laravel-query-builder";
import BackendLayout from "../../Layouts/BackendLayout.vue";

import { useForm, Link, Head } from "@inertiajs/inertia-vue3";

export default {
  mixins: [InteractsWithQueryBuilder],

  components: {
    Table: Tailwind2.Table,
    BackendLayout,
    Link,
  },

  props: {
    users: Object,
  },
  methods: {
    destroy(id) {
      this.$swal({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.delete(this.route("userTypes.destroy", id), {
            preserveScroll: true,
            onSuccess: () => {
              this.$swal("Deleted!", "Your file has been deleted.", "success");
            },
          });
        }
      });
    },
  },
};
</script>
