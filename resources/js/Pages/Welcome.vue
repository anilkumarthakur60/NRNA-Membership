

<template>
  <Head title="Welcome" />
  <div class="container mt-5">
    <form @submit.prevent="store" method="post">
      <div
        class="btn-group w-50"
        v-for="(membertype, index) in membertypes"
        :key="index"
      >
        <input
          type="radio"
          class="btn-check"
          name="options-outlined"
          :id="membertype.slug"
          v-model="form.membertype_id"
          :value="membertype.id"
          @input="OnChangeMemberType(membertype)"
          autocomplete="off"
          required
        />
        <label class="btn btn-outline-primary" :for="membertype.slug">{{
          membertype.name + " amount:" + membertype.price
        }}</label>

        <span class="text-danger" v-if="errors.membertype_id">{{
          errors.membertype_id
        }}</span>
      </div>
      <div class="row">
        <div class="mt-3 row">
          <div class="col-md-6 my-2">
            <span>Full Name</span>
            <input
              type="text"
              v-model="form.name"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.name">{{
              errors.name
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Email</span>
            <input
              type="email"
              v-model="form.email"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.email">{{
              errors.email
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Phone Number</span>
            <input
              type="tel"
              v-model="form.phone"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.phone">{{
              errors.phone
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Street Address</span>
            <input
              type="text"
              v-model="form.street_address"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.street_address">{{
              errors.street_address
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Apartment, Suite, etc</span>
            <input
              type="text"
              v-model="form.apartment"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.apartment">{{
              errors.apartment
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>City</span>
            <input
              type="text"
              v-model="form.city"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.city">{{
              errors.city
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Provinance</span>
            <input
              type="text"
              v-model="form.provience"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.provience">{{
              errors.provience
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Zip/Postal Code</span>
            <input
              type="text"
              v-model="form.zip_code"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.zip_code">{{
              errors.zip_code
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <span>Country</span>
            <input
              type="text"
              v-model="form.country"
              required
              class="form-control"
            />
            <span class="text-danger" v-if="errors.country">{{
              errors.country
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <h6>Status</h6>
            <div
              class="btn-group"
              role="group"
              aria-label="Basic radio toggle button group"
            >
              <input
                type="radio"
                class="btn-check"
                value="citizenship"
                v-model="form.status"
                id="btnradio11"
                autocomplete="off"
                required
              />
              <label class="btn btn-outline-primary rounded-3" for="btnradio11"
                >Citizenship</label
              >

              <input
                type="radio"
                class="btn-check"
                value="permanent_resident"
                v-model="form.status"
                required
                id="btnradio22"
                autocomplete="off"
              />
              <label
                class="btn btn-outline-primary rounded-3 mx-2"
                for="btnradio22"
                >Permanent Resident</label
              >

              <input
                type="radio"
                class="btn-check"
                value="other"
                v-model="form.status"
                required
                id="btnradio33"
                autocomplete="off"
              />
              <label class="btn btn-outline-primary rounded-3" for="btnradio33"
                >Other</label
              >
            </div>
            <span class="text-danger" v-if="errors.status">{{
              errors.status
            }}</span>
          </div>
          <div class="col-md-6 my-2">
            <div class="mb-3 row">
              <label
                for="staticEmail"
                class="col-sm-4 col-form-label text-right"
                >Image</label
              >
              <div class="col-sm-8">
                <input
                  type="file"
                  class="form-control"
                  @change="previewImage"
                  id="staticEmail"
                  @input="form.image = $event.target.files[0]"
                />
                <span class="text-danger" v-if="errors.image">{{
                  errors.image
                }}</span>
                <img v-if="url" :src="url" class="w-25 my-2" />
              </div>
            </div>
          </div>
          <div class="col-md-6" v-if="coubleDivShow">
            <div
              class="btn-group w-50"
              v-for="(payments, index) in paymentypes"
              :key="index"
            >
              <input
                type="radio"
                class="btn-check"
                name="options-radios"
                :value="payments.id"
                @input="onChangePaymentType(payments)"
                :id="payments.slug"
                v-model="form.paymenttype_id"
                autocomplete="off"
              />
              <label class="btn btn-outline-primary" :for="payments.slug">{{
                payments.name + " amount" + payments.price
              }}</label>
            </div>
            <span class="text-danger" v-if="errors.paymenttype_id">{{
              errors.paymenttype_id
            }}</span>
          </div>

          <div class="col-md-4" v-if="memberShipTypesName">
            <span>{{ memberShipTypesName }}</span>
            <input
              type="number"
              required
              class="form-control"
              id="first"
              v-model="form.membership_amount"
            />
            <span class="text-danger" v-if="errors.membership_amount">{{
              errors.membership_amount
            }}</span>
          </div>
          <div class="col-md-4" v-if="memberShipTypesName">
            <span>Make Donation"(Optional)</span>
            <input
              type="number"
              class="form-control"
              id="second"
              @change="domationAmountChange()"
              v-model="form.donation_amount"
            />
            <span class="text-danger" v-if="errors.donation_amount">{{
              errors.donation_amount
            }}</span>
          </div>
          <div class="col-md-4" v-if="memberShipTypesName">
            <span>Total Fee</span>
            <input
              type="number"
              class="form-control"
              readonly=""
              v-model="form.grand_total_amount"
              id="total"
            />
            <span class="text-danger" v-if="errors.grand_total_amount">{{
              errors.grand_total_amount
            }}</span>
          </div>
          <div class="col-12 d-flex my-2">
            <button
              type="submit"
              class="btn btn-success btn-sm px-4 text-white mx-auto"
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  name: "Welcome",

  remember: "form",
  props: {
    errors: Object,
    paymentypes: Array,
    membertypes: Array,
  },
  data() {
    return {
      url: null,
      citizenship: "citizenship",
      permanentResident: "permanentResident",
      other: "other",
      memberShipTypesName: null,
      coubleDivShow: false,
      membership_amount: null,
      donation_amount: null,
      grand_total_amount: null,
    };
  },
  setup() {
    const form = useForm({
      name: null,
      image: null,
      email: null,
      street_address: null,
      apartment: null,
      city: null,
      provience: null,
      zip_code: null,
      country: null,
      status: null,
      image: null,
      referal_code: null,
      membertype_id: null,
      paymenttype_id: null,
      phone: null,

      membership_amount: null,
      donation_amount: null,
      grand_total_amount: null,
    });

    return { form };
  },
  methods: {
    checkFirst(firstValue) {
      if (firstValue == 0) {
        return true;
      } else {
        return false;
      }
    },
    store() {
      if (this.$refs.photo) {
        this.form.image = this.$refs.photo.files[0];
      }
      this.form.post(route("membershipStore"), {
        onSuccess: () => this.form.reset(),
      });
    },
    previewImage(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    OnChangeMemberType(objs) {
      if (objs.slug == "general-membershipt") {
        this.coubleDivShow = true;
      } else {
        this.coubleDivShow = false;
      }
      this.memberShipTypesName = objs.name;
      this.form.membership_amount = objs.price;
      this.form.grand_total_amount = this.form.membership_amount + objs.price;
    },

    onChangePaymentType(objs) {
      this.form.grand_total_amount =
        this.form.membership_amount + this.form.donation_amount + objs.price;
    },
    domationAmountChange() {
      this.form.grand_total_amount =
        this.form.grand_total_amount + this.form.donation_amount;
    },
  },
};
</script>
