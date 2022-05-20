

<template>
  <Head title="Welcome" />
  <div class="container mt-2">
    <!-- <div class="" v-if="$page.props.user">
      <Link
        v-if="$page.props.user.usertype == 1"
        :href="route('dashboard')"
        class="btn btn-sm btn-success my-2 px-4 fw-bold text-white"
      >
        Dashboard
      </Link>
      <Link
        v-else
        :href="route('dashboard')"
        class="btn btn-sm btn-success my-2 px-4 fw-bold text-white"
      >
        Dashboard
      </Link>
    </div>
    <div class="" v-else>
      <Link
        :href="route('login')"
        class="btn btn-sm btn-success my-2 px-4 fw-bold text-white"
      >
        Login
      </Link>
    </div> -->
    <Link
      :href="route('login')"
      class="btn btn-sm btn-success my-2 px-4 fw-bold text-white"
    >
      Login
    </Link>
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
          membertype.name
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
          <div class="col-md-6">
            <div v-if="payment_amount">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  :value="paymentypes_price"
                  :id="paymentypes_slug"
                  :false-value="paymentypes_id"
                  :true-value="null"
                  @input="onChangePaymentType(paymentypes_price)"
                  v-model="paymentypes_price"
                />
                <label class="form-check-label" :for="paymentypes_slug">
                  {{ paymentypes_name }}
                </label>
              </div>
            </div>
            <span class="text-danger" v-if="errors.paymenttype_id">{{
              errors.paymenttype_id
            }}</span>
          </div>

          <div class="col-md-3" v-if="memberShipTypesName">
            <span>{{ memberShipTypesName }}</span>
            <input
              type="number"
              readonly=""
              class="form-control"
              id="first"
              v-model="form.membership_amount"
            />
            <span class="text-danger" v-if="errors.membership_amount">{{
              errors.membership_amount
            }}</span>
          </div>
          <div class="col-md-3" v-if="payment_amount_div">
            <span>{{ paymentypes_name }}</span>
            <input
              type="number"
              readonly=""
              class="form-control"
              :id="paymentypes_slug"
              v-model="form.payment_amount"
            />
          </div>

          <div class="col-md-3" v-if="memberShipTypesName">
            <span>Make Donation"(Optional)</span>
            <input
              type="number"
              class="form-control"
              id="second"
              min="0"
              @change="domationAmountChange()"
              v-model="form.donation_amount"
            />
            <span class="text-danger" v-if="errors.donation_amount">{{
              errors.donation_amount
            }}</span>
          </div>
          <div class="col-md-3" v-if="memberShipTypesName">
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
            <loading-button
              :Classes="'btn btn-success btn-sm px-4 text-white mx-auto'"
              :loading="form.processing"
              >Submit</loading-button
            >
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { useForm, Link, Head } from "@inertiajs/inertia-vue3";
import LoadingButton from "../Components/LoadingButton.vue";

export default {
  name: "Welcome",

  remember: "form",
  props: {
    errors: Object,
    membertypes: Array,
  },
  components: {
    Link,
    Head,
    LoadingButton,
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
      checked: false,
      payment_amount: false,
      payment_amount_div: false,
      paymentypes_id: null,
      paymentypes_name: null,
      paymentypes_price: null,
      paymentypes_slug: null,
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
      payment_amount: null,
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
      //   if (objs.slug == "general-membershipt") {
      //     this.coubleDivShow = true;
      //   } else {
      //     this.coubleDivShow = false;
      //   }
      //   this.payment_amount = true;

      this.paymentypes_id = objs.paymenttype.id;
      this.paymentypes_name = objs.paymenttype.name;
      this.paymentypes_slug = objs.paymenttype.slug;
      this.paymentypes_price = objs.paymenttype.price;
      this.form.membership_amount = objs.paymenttype.price;

      //   this.memberShipTypesName = objs.name;
      //   this.form.membership_amount = objs.price;
      //   this.form.grand_total_amount = this.form.membership_amount + objs.price;

      axios.get(route("getcouplePrice", objs.id)).then((response) => {
        this.paymentypes_id = objs.paymenttype.id;
        this.paymentypes_name = objs.paymenttype.name;
        this.paymentypes_slug = objs.paymenttype.slug;
        this.paymentypes_price = objs.paymenttype.price;
        this.payment_amount = true;
        this.memberShipTypesName = objs.name;
        this.form.grand_total_amount =
          this.form.membership_amount +
          this.form.donation_amount +
          this.paymentypes_price;
        this.form.payment_amount = this.paymentypes_price;
      });
    },

    onChangePaymentType(paymentypes_price) {
      this.payment_amount_div = true;
      if (this.paymentypes_price) {
        this.form.grand_total_amount =
          this.form.membership_amount +
          this.form.donation_amount +
          this.paymentypes_price;
        this.form.payment_amount = this.paymentypes_price;
      } else {
        this.payment_amount_div = false;
        this.form.grand_total_amount =
          this.form.membership_amount +
          this.form.donation_amount +
          paymentypes_price;
        this.form.payment_amount = this.paymentypes_price;
      }
    },
    domationAmountChange() {
      this.form.grand_total_amount =
        this.form.grand_total_amount + this.form.donation_amount;
    },
  },
};
</script>
