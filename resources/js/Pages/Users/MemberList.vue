<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4" v-for="user in users.data" :key="user.id">
          <div class="card cardchild mt-3 p-2 px-3 py-3 border shadow">
            <div class="d-flex p-2 mt-2 justify-content-between rounded">
              <div class="d-flex flex-column">
                <span class="badge bg-soft-success text-success type">{{
                  user.name
                }}</span
                ><span class="number">{{ user.users_count }}</span>
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
    </div>
  </div>
</template>
<script>
import {
  InteractsWithQueryBuilder,
  Tailwind2,
} from "@protonemedia/inertiajs-tables-laravel-query-builder";
export default {
  name: "MemberList",
  props: {
    users: Object,
  },

  mixins: [InteractsWithQueryBuilder],
  components: {
    Table: Tailwind2.Table,
  },
};
</script>