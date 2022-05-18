<template>
  <div class="bg-sky-100">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex">
          <Link :href="route('front.index')" class="btn btn-info">Home</Link>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div
              class="col-md-4"
              v-for="(usertype, index) in usertypes"
              :key="index"
            >
              <div
                class="
                  card
                  cardchild
                  mt-3
                  p-2
                  px-3
                  py-3
                  border
                  bg-white
                  shadow-lg
                  rounded-lg
                "
              >
                <div class="d-flex p-2 mt-2 justify-content-between rounded">
                  <div class="d-flex flex-column">
                    <span
                      class="badge bg-success text-white type fs-6 fw-bold"
                      :class="membertypeBadgeClass(index)"
                      >{{ usertype.name }}</span
                    ><span class="number fs-2">{{ usertype.users_count }}</span>
                  </div>
                  <div class="d-flex flex-column">
                    <img
                      src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/220px-User_icon_2.svg.png"
                      class="logo1"
                      height="40"
                      width="40"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 mt-3">
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
                <th
                  v-show="showColumn('email')"
                  @click.prevent="sortBy('email')"
                >
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
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {
  InteractsWithQueryBuilder,
  Tailwind2,
} from "@protonemedia/inertiajs-tables-laravel-query-builder";

import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
export default {
  name: "MemberList",
  props: {
    users: Object,
    usertypes: Array,
  },
  mixins: [InteractsWithQueryBuilder],
  components: {
    Table: Tailwind2.Table,
    Link,
  },

  methods: {
    membertypeBadgeClass(id) {
      if (id % 2 == 0) {
        return "bg-soft-success";
      } else {
        return "bg-soft-danger";
      }
    },
  },
};
</script>



<style >
.bg-soft-success {
  background-color: rgb(204, 245, 231) !important;
  color: #198754 !important;
}
.bg-soft-danger {
  background-color: rgb(255, 232, 204) !important;
  color: #dc3545 !important;
}
</style>
