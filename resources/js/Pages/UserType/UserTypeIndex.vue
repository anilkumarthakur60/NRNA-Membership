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
          <th @click.prevent="sortBy('id')">Id</th>
          <th @click.prevent="sortBy('name')">Name</th>
          <th>UserCount</th>
        </tr>
      </template>

      <template #body>
        <tr v-for="user in users.data" :key="user.id">
          <td v-show="showColumn('id')">{{ user.id }}</td>
          <td v-show="showColumn('name')">{{ user.name }}</td>
          <td v-show="showColumn('users_count')">{{ user.users_count }}</td>
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
