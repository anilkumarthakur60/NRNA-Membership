

<template>
  <Head title="Welcome" />
  <div class="container mt-5">
    <form @submit.prevent="store(user)" method="post">
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
          </div>
          <div class="col-md-6 my-2">
            <span>Email</span>
            <input
              type="email"
              v-model="form.email"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Phone Number</span>
            <input
              type="tel"
              v-model="form.phone"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Street Address</span>
            <input
              type="text"
              v-model="form.street_address"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Apartment, Suite, etc</span>
            <input
              type="text"
              v-model="form.apartment"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>City</span>
            <input
              type="text"
              v-model="form.city"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Provinance</span>
            <input
              type="text"
              v-model="form.provience"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Zip/Postal Code</span>
            <input
              type="text"
              v-model="form.zip_code"
              required
              class="form-control"
            />
          </div>
          <div class="col-md-6 my-2">
            <span>Country</span>
            <input
              type="text"
              v-model="form.country"
              required
              class="form-control"
            />
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
                <img v-if="url" :src="url" class="w-25 my-2" />
              </div>
            </div>

            <span v-if="form.errors.name" class="text-danger">{{
              form.errors.name
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
    user: Object,
  },
  data(props) {
    return {
      url: null,
      citizenship: "citizenship",
      permanentResident: "permanentResident",
      other: "other",
      memberShipTypesName: null,

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
    store(user) {
      if (this.$refs.photo) {
        this.form.image = this.$refs.photo.files[0];
      }
      this.form.post(route("joinInvitaionLinkPost", user.referal_code));
    },
    previewImage(e) {
      const file = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
    OnChangeMemberType(objs) {
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
