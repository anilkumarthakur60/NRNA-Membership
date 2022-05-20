<template>
  <backend-layout>
    <div class="card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-sm-4">
            <div class="card rounded-lg shadow-lg">
              <div class="card-body">
                <h5 class="text-sm">
                  Name :
                  <span class="text-xs">
                    {{ user.name }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Email :
                  <span class="text-xs">
                    {{ user.email }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Street Address :
                  <span class="text-xs">
                    {{ user.street_address }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Apartment :
                  <span class="text-xs">
                    {{ user.apartment }}
                  </span>
                </h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card rounded-lg shadow-lg">
              <div class="card-body">
                <h5 class="text-sm">
                  City :
                  <span class="text-xs">
                    {{ user.city }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Provience :
                  <span class="text-xs">
                    {{ user.provience }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Zip Code :
                  <span class="text-xs">
                    {{ user.zip_code }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Country :
                  <span class="text-xs">
                    {{ user.country }}
                  </span>
                </h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card rounded-lg shadow-lg">
              <div class="card-body">
                <h5 class="text-sm">
                  Status :
                  <span class="text-xs">
                    {{ user.status }}
                  </span>
                </h5>
                <h5 class="text-sm">
                  Phone :
                  <span class="text-xs">
                    {{ user.phone }}
                  </span>
                </h5>
                <h5 v-if="user.membertype">
                  Member Type :
                  <span class="text-xs">
                    {{ user.membertype.name }}
                  </span>
                </h5>
                <h5 v-if="user.paymenttype">
                  Counple/Single :
                  <span class="text-xs">
                    {{ user.paymenttype.name }}
                  </span>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table- table-striped table-succes table-hover"
              >
                <thead class="thead-inverse">
                  <tr>
                    <th>SN</th>
                    <th>Amount</th>
                    <th>Currency Code</th>
                    <th>Payer Name</th>
                    <th>Payer Email Address</th>
                    <th>Address Line 1</th>
                    <th>Area 2nd</th>
                    <th>Area 1'st</th>
                    <th>Postal Code</th>
                    <th>Country code</th>
                    <th>Payer Id</th>
                    <th>Token</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in user.payment_infos" :key="index">
                    <td scope="row">{{ index + 1 }}</td>
                    <td>{{ user.amount }}</td>
                    <td>{{ user.currency_code }}</td>
                    <td>{{ user.payer_name }}</td>
                    <td>{{ user.payer_email_address }}</td>
                    <td>{{ user.address_line_1 }}</td>
                    <td>{{ user.admin_area_2 }}</td>
                    <td>{{ user.admin_area_1 }}</td>
                    <td>{{ user.postal_code }}</td>
                    <td>{{ user.country_code }}</td>
                    <td>{{ user.payer_payer_id }}</td>
                    <td>{{ user.token }}</td>
                    <td>{{ user.status }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </backend-layout>
</template>
<script>
import BackendLayout from "../../Layouts/BackendLayout.vue";

export default {
  components: {
    BackendLayout,
  },
  props: {
    user: Object,
  },
};
</script>
