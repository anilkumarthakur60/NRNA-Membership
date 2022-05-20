<template>
  <backend-layout>
    <Table
      :filters="queryBuilderProps.filters"
      :search="queryBuilderProps.search"
      :columns="queryBuilderProps.columns"
      :on-update="setQueryBuilder"
      :meta="users"
    >
      <template #head>
        <tr>
          <th @click.prevent="sortBy('name')">Name</th>
          <th v-show="showColumn('email')" @click.prevent="sortBy('email')">
            Email
          </th>
          <th>Show Detail</th>
        </tr>
      </template>

      <template #body>
        <tr v-for="user in users.data" :key="user.id">
          <td>{{ user.name }}</td>
          <td v-show="showColumn('email')">{{ user.email }}</td>

          <td>
            <Link
              :href="route('users.show', user.id)"
              class="btn btn-sm btn-info text-white"
              >View Detail</Link
            >
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
  methods: {},
};
</script>
