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
        </tr>
      </template>

      <template #body>
        <tr v-for="user in users.data" :key="user.id">
          <td>{{ user.name }}</td>
          <td v-show="showColumn('email')">{{ user.email }}</td>
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

export default {
  mixins: [InteractsWithQueryBuilder],

  components: {
    Table: Tailwind2.Table,
    BackendLayout,
  },

  props: {
    users: Object,
  },
};
</script>