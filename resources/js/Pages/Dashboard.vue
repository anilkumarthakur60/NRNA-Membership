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
          <th>Action</th>
        </tr>
      </template>

      <template #body>
        <tr v-for="user in users.data" :key="user.id">
          <td>{{ user.name }}</td>
          <td v-show="showColumn('email')">{{ user.email }}</td>
          <td>
            <ToggleButton
              id="changed-font"
              @change="onChangeEventHandler(user.id)"
              :width="80"
              :height="30"
              :speed="480"
              :value="user.userType"
              :labels="{ checked: 'Active', unchecked: 'Inactive' }"
            />
            {{ hodor }}
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
import BackendLayout from "../Layouts/BackendLayout.vue";
import ToggleButton from "../Components/ToggleButton.vue";

import { Head, InertiaLink, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

export default {
  mixins: [InteractsWithQueryBuilder],
  components: {
    Table: Tailwind2.Table,
    BackendLayout,
    Link,
    ToggleButton,
    InertiaLink,
  },

  props: {
    users: Object,
  },
  methods: {
    onChangeEventHandler(id) {
      console.log(id);
      axios
        .get(route("users.changeUserStatus", id))
        .then((response) => (this.info = response));
    },
  },
};
</script>