<template>
  <member-layout>
    <section class="pb-50">
      <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
          <div class="profile-nav col-md-3 border-right">
            <div class="panel bg-light">
              <div class="user-heading round">
                <a href="#">
                  <img
                    :src="user.data.profile_photo_path"

                  />
                </a>
                <h1>{{ user.name }}</h1>
                <p>{{ user.email }}</p>
                <div class="progress">
                  <div
                    class="progress-bar progress-bar-striped bg-danger"
                    role="progressbar"
                    style="width: 75%"
                    aria-valuenow="25"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  >
                    25%
                  </div>
                </div>
                <p>status: submitted</p>
              </div>
              <div class="tab-vertical profiletab">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="vertical-tab-1-tab"
                      data-bs-toggle="tab"
                      href="#vertical-tab-1"
                      role="tab"
                      aria-controls="home"
                      aria-selected="false"
                    >
                      Profile</a
                    >
                  </li>

                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="vertical-tab-4-tab"
                      data-bs-toggle="tab"
                      href="#vertical-tab-4"
                      role="tab"
                      aria-controls="contact"
                      aria-selected="true"
                      >Edit Profile</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9 border-right">
            <div class="tab-content" id="myTabContent3">
              <div
                class="tab-pane fade"
                id="vertical-tab-1"
                role="tabpanel"
                aria-labelledby="vertical-tab-1-tab"
              >
                <div class="card rounded-0">
                  <div class="card-body">
                    <div class="border-right">
                      <div class="p-3">
                        <div class="card-block">
                          <h5
                            class="m-b-20 p-b-5 b-b-default fw-bold text-theme"
                          >
                            Basic Information
                          </h5>
                          <div class="row">
                            <div class="col-sm-6">
                              <p class="m-b-10 fw-600">Name</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.name }}
                              </h6>
                            </div>
                            <div class="col-sm-6">
                              <p class="m-b-10 fw-600">Email</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.email }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.phone">
                              <p class="m-b-10 fw-600">Phone</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.phone }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.profession">
                              <p class="m-b-10 fw-600">Profession</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.profession }}
                              </h6>
                            </div>
                            <div
                              class="col-sm-6"
                              v-if="user.data.street_address"
                            >
                              <p class="m-b-10 fw-600">Stree Address</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.street_address }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.apartment">
                              <p class="m-b-10 fw-600">Apartment</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.apartment }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.city">
                              <p class="m-b-10 fw-600">City</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.city }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.provience">
                              <p class="m-b-10 fw-600">Provience</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.provience }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.zip_code">
                              <p class="m-b-10 fw-600">ZipCode</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.zip_code }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.country">
                              <p class="m-b-10 fw-600">Country</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.country }}
                              </h6>
                            </div>

                            <div class="col-sm-6" v-if="user.data.status">
                              <p class="m-b-10 fw-600">Status</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.status }}
                              </h6>
                            </div>
                            <div class="col-sm-6" v-if="user.data.dob">
                              <p class="m-b-10 fw-600">Status</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.dob }}
                              </h6>
                            </div>
                          </div>
                          <div class="row" v-if="membership">
                            <h5
                              class="
                                m-b-20 m-t-40
                                p-b-5
                                b-b-default
                                fw-bold
                                text-theme
                              "
                            >
                              Membership Information
                            </h5>

                            <div class="col-sm-6">
                              <p class="m-b-10 fw-600">Membership type</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ membership.name }}
                              </h6>
                            </div>
                            <div class="col-sm-6">
                              <p class="m-b-10 fw-600">Applied date</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.created_at }}
                              </h6>
                            </div>
                          </div>

                          <h5
                            class="
                              m-b-20 m-t-40
                              p-b-5
                              b-b-default
                              fw-bold
                              text-theme
                            "
                          >
                            Professional Information
                          </h5>
                          <div class="row">
                            <div
                              class="col-sm-6"
                              v-if="user.data.highest_degree"
                            >
                              <p class="m-b-10 fw-600">Highest Degree</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.highest_degree }}
                              </h6>
                            </div>
                            <div
                              class="col-sm-6"
                              v-if="user.data.area_of_expertise"
                            >
                              <p class="m-b-10 fw-600">Area of Expertise</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.area_of_expertise }}
                              </h6>
                            </div>
                            <div
                              class="col-sm-6"
                              v-if="user.data.year_of_experience"
                            >
                              <p class="m-b-10 fw-600">Area of Expertise</p>
                              <h6
                                class="
                                  text-dark text-xl
                                  leading-tight
                                  text-base
                                  font-bold
                                "
                              >
                                {{ user.data.year_of_experience }}
                              </h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="tab-pane fade active show"
                id="vertical-tab-4"
                role="tabpanel"
                aria-labelledby="vertical-tab-4-tab"
              >
                <div class="card rounded-0">
                  <div class="card-body">
                    <div class="border-right editprofile">
                      <div class="p-3">
                        <div class="col-md-12">
                          <div class="bg-white">
                            <ul
                              class="nav nav-tabs nav-fill border-0 myedit"
                              id="myTab"
                              role="tablist"
                            >
                              <li class="nav-item" role="presentation">
                                <button
                                  class="nav-link active"
                                  id="profile_tab_1-tab"
                                  data-bs-toggle="tab"
                                  data-bs-target="#profile_tab_1"
                                  type="button"
                                  role="tab"
                                  aria-controls="profile_tab_1"
                                  aria-selected="true"
                                >
                                  <div class="d-flex flex-column lh-lg">
                                    <i class="fas fa-info"></i>
                                    <span>Personal Information</span>
                                  </div>
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button
                                  class="nav-link"
                                  id="profile_tab_2-tab"
                                  data-bs-toggle="tab"
                                  data-bs-target="#profile_tab_2"
                                  type="button"
                                  role="tab"
                                  aria-controls="profile_tab_2"
                                  aria-selected="false"
                                >
                                  <div class="d-flex flex-column lh-lg">
                                    <i class="fas fa-upload"></i>
                                    <span>Upload Documents</span>
                                  </div>
                                </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                <button
                                  class="nav-link"
                                  id="profile_tab_3-tab"
                                  data-bs-toggle="tab"
                                  data-bs-target="#profile_tab_3"
                                  type="button"
                                  role="tab"
                                  aria-controls="profile_tab_3"
                                  aria-selected="false"
                                >
                                  <div class="d-flex flex-column lh-lg">
                                    <i class="fas fa-user"></i>
                                    <span>Skills &amp; Expertise</span>
                                  </div>
                                </button>
                              </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                              <div
                                class="tab-pane fade active show"
                                id="profile_tab_1"
                                role="tabpanel"
                                aria-labelledby="profile_tab_1-tab"
                              >
                                <form @submit.prevent="store">
                                  <div class="row">
                                    <div class="col-md-12 form-group">
                                      <label class="text-dark fw-bold"
                                        >Select Gender</label
                                      >
                                      <select
                                        class="rounded-0 form-select"
                                        v-model="form.gender"
                                        aria-label="Default select example"
                                      >
                                        <option selected="">
                                          Select Gender
                                        </option>
                                        <option
                                          value="Male"
                                          :select="user.data.gender === 'Male'"
                                        >
                                          Male
                                        </option>
                                        <option
                                          value="Female"
                                          :select="
                                            user.data.gender === 'Female'
                                          "
                                        >
                                          Female
                                        </option>
                                        <option
                                          value="Other"
                                          :select="user.data.gender === 'Other'"
                                        >
                                          Others
                                        </option>
                                      </select>
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Profession</label
                                      ><input
                                        type="text"
                                        class="form-control"
                                        v-model="form.profession"
                                        placeholder="Eg: IT Professional"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Date of birth</label
                                      >
                                      <datepicker v-model="form.dob" />
                                    </div>

                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Address</label
                                      ><input
                                        v-model="form.street_address"
                                        type="text"
                                        class="form-control"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-sm-12 d-flex mt-3">
                                      <loading-button
                                        :Classes="'btn btn-success btn-sm px-4 text-white mx-auto'"
                                        :loading="form.processing"
                                        >Submit</loading-button
                                      >
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div
                                class="tab-pane fade mt-3"
                                id="profile_tab_2"
                                role="tabpanel"
                                aria-labelledby="profile_tab_2-tab"
                              >
                                <h5
                                  class="
                                    m-b-20
                                    p-b-5
                                    b-b-default
                                    fw-bold
                                    text-theme
                                  "
                                >
                                  Primary Documents
                                </h5>

                                <div class="row">
                                  <div class="col-md-6" v-if="user.data.image">

                                    <img
                                      :src="user.data.image"
                                      class="img-fluid"
                                    />
                                  </div>
                                </div>
                                <div class="uploadphoto">
                                  <h5
                                    class="
                                      m-b-20
                                      p-b-5
                                      b-b-default
                                      fw-bold
                                      text-theme
                                    "
                                  >
                                    Upload Documents
                                  </h5>
                                  <form @submit.prevent="storeDocument">
                                    <div class="row">
                                      <div class="col-md-6">
                                        <p class="fw-bold text-center">
                                          Upload Your Document
                                        </p>
                                        <input
                                          type="file"
                                          @input="forms.image = $event.target.files[0]"
                                        />
                                        <progress
                                          v-if="forms.progress"
                                          :value="forms.progress.percentage"
                                          max="100"
                                        >
                                          {{ forms.progress.percentage }}%
                                        </progress>
                                      </div>
                                      <div class="col-md-6">
                                        <p class="fw-bold text-center">
                                          Upload Your Photo
                                        </p>
                                        <input
                                          type="file"
                                          @input="forms.profile_photo_path = $event.target.files[0]"
                                        />
                                        <progress
                                          v-if="forms.progress"
                                          :value="forms.progress.percentage"
                                          max="100"
                                        >
                                          {{ forms.progress.percentage }}%
                                        </progress>
                                      </div>
                                      <div class="col-sm-12 d-flex mt-3">
                                        <loading-button
                                          :Classes="'btn btn-success btn-sm px-4 text-white mx-auto'"
                                          :loading="form.processing"
                                          >Submit</loading-button
                                        >
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>

                              <div
                                class="tab-pane fade"
                                id="profile_tab_3"
                                role="tabpanel"
                                aria-labelledby="profile_tab_3-tab"
                              >
                                <form @submit.prevent="storeSkills">
                                  <div class="row">
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Highest Degree</label
                                      ><input
                                        type="text"
                                        v-model="formSkills.highest_degree"
                                        class="form-control"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Area of Expertise</label
                                      ><input
                                        type="text"
                                        v-model="formSkills.area_of_expertise"
                                        class="form-control"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Years of Experience</label
                                      ><input
                                        type="text"
                                        v-model="formSkills.year_of_experience"
                                        class="form-control"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-md-6 form-group mt-3">
                                      <label class="text-dark fw-bold"
                                        >Skills</label
                                      ><input
                                        type="text"
                                        v-model="formSkills.skills"
                                        class="form-control"
                                        required=""
                                      />
                                    </div>
                                    <div class="col-sm-12 d-flex mt-3">
                                      <loading-button
                                        :Classes="'btn btn-success btn-sm px-4 text-white mx-auto'"
                                        :loading="form.processing"
                                        >Submit</loading-button
                                      >
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </member-layout>
</template>
<script>
import MemberLayout from "../../Layouts/MemberLayout.vue";
import { ref, onMounted } from "vue";

import { Link, useForm } from "@inertiajs/inertia-vue3";
import LoadingButton from "../../Components/LoadingButton.vue";
import Datepicker from "vue3-datepicker";

export default {
  components: { MemberLayout, Link, LoadingButton, Datepicker },
  props: {
    user: Object,
    membership: Object,
    errors: Object,
  },
   mounted() {
    console.log('usersdata',this.user.data);
  },

  setup(props) {
    const form = useForm({
      gender: props.user.data.gender,
      profession: props.user.data.profession,
      dob: props.user.data.dobs,
      street_address: props.user.data.street_address,
    });
    const forms = useForm({
      image: null,
      profile_photo_path: null,
    });
    const formSkills = useForm({
      highest_degree: props.user.data.highest_degree,
      area_of_expertise: props.user.data.area_of_expertise,
      year_of_experience: props.user.data.year_of_experience,
      skills: props.user.data.skills,
    });

    return { form, forms, formSkills };
  },
  methods: {
    store() {
      this.form.put(route("updateProfile"), {
        preserveScroll: true,
        onSuccess: () => {
          this.$swal({
            icon: "success",
            title: "Profile updated Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.form.reset();
        },
         onError: (errors) => {
               console.log('documentError',errors)
           },
      });
    },

    storeDocument() {
      this.forms.post(
        route("updateDocument", {
          _method: "put",
            forceFormData: true,
        }),
        {
          preserveScroll: true,
          onSuccess: () => {
            this.$swal({
              icon: "success",
              title: "Profile updated Successfully",
              showConfirmButton: false,
              timer: 1500,
            });
            this.forms.reset();
          },
           onError: (errors) => {
               console.log('documentError',errors)
           },
        }
      );
    },
    storeSkills() {
      this.formSkills.put(route("updateSkills"), {
        preserveScroll: true,
        onSuccess: () => {
          this.$swal({
            icon: "success",
            title: "Profile updated Successfully",
            showConfirmButton: false,
            timer: 1500,
          });
          this.formSkills.reset();
        },
         onError: (errors) => {
               console.log('documentError',errors)
           },
      });
    },
    //

    //
  },
};
</script>

<style>
:root {
  --theme-color: #0473ea;
  --secondary-color: #299cd7;
  --dark-color: #222;
  --white-color: #fff;
  --bg-color: #f3f1f2;
  --light-blue: #eff6fd;
  --optionalColor: #333146;
  --whiteColor: #ffffff;
  --blackColor: #262e2e;
  --postcolor: #6a7a83;
  --fontSize: 16px;
  --transition: 0.5s;
}

/* profile */

.b-b-default {
  border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
  margin-bottom: 20px;
}

.p-b-5 {
  padding-bottom: 5px !important;
}

.m-b-10 {
  margin-bottom: 10px;
}

.m-t-40 {
  margin-top: 20px;
}

.editprofile .nav-tabs .nav-link.active {
  border-color: transparent;
  background-color: #279ce3 !important;
  color: #fff !important;
  border-bottom: 4px solid #9a1550 !important;
}

.editprofile .nav-fill .nav-item .nav-link,
.editprofile .nav-justified .nav-item .nav-link {
  width: 100%;
  color: #000;
}

.editprofile .nav-tabs .nav-link {
  border-top-left-radius: 0rem !important;
  border-top-right-radius: 0rem !important;
}

.editprofile .nav-tabs .nav-link.active {
  border-color: transparent;
  background-color: #60d0ff;
  color: #fff;
  font-weight: 600;
}

.editprofile .nav-link {
  height: 77px;
  font-size: 13px;
  background-color: rgb(13 110 253 / 25%);
}

.editprofile .nav-link:hover {
  border: none;
}

.editprofile .nav-link:focus {
  outline: none;
}

.editprofile .nav-fill .nav-item,
.nav-fill > .nav-link {
  flex: 1 1 auto;
  text-align: center;
  margin-right: 3px;
}

.myedit span {
  font-size: 16px;
}

.myedit i {
  font-size: 24px;
}

.opacity-0 {
  opacity: 0;
  cursor: pointer;
}

.profilenav .topbar {
  height: 4.375rem;
}

.profilenav .badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.35rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.profilenav .rounded-circle {
  width: 40px;
  height: 40px;
}

.profilenav .topbar .topbar-divider {
  width: 0;
  border-right: 1px solid #e3e6f0;
  height: calc(4.375rem - 2rem);
  margin: auto 1rem;
}

.profilenav .topbar .dropdown-list {
  width: 20rem !important;
}

.profilenav .dropdown-menu[data-bs-popper] {
  top: 100%;
  right: 0;
  margin-top: 0.125rem;
  left: inherit;
}

.profilenav .dropdown-menu {
  min-width: unset;
}

.theme-color {
  color: var(--theme-color);
}

.profile-nav .user-heading {
  background: var(--theme-color);
  color: rgb(255, 255, 255);
  border-radius: 4px 4px 0px 0px;
  padding: 30px;
  text-align: center;
}

.profile-nav .user-heading.round a {
  border-radius: 50%;
  border: 4px solid rgb(213, 180, 70);
  display: inline-block;
  margin-bottom: 10px;
}

.profile-nav .user-heading a img {
  width: 112px;
  height: 112px;
  border-radius: 50%;
}

.profile-nav .user-heading h1 {
  font-size: 19px;
  font-weight: 600;
  margin-bottom: 5px;
  color: rgb(255, 255, 255);
}

.profile-nav .user-heading p {
  font-size: 12px;
}

.profile-nav ul {
  margin-top: 1px;
}

.profile-nav ul > li {
  border-bottom: 1px solid rgb(235, 234, 230);
  margin-top: 0px;
  line-height: 30px;
}

.profile-nav ul > li:last-child {
  border-bottom: none;
}

.profile-nav ul > li > a {
  border-radius: 0px;
  color: rgb(137, 129, 127);
  border-left: 5px solid rgb(255, 255, 255);
}

.profile-nav ul > li > a:hover,
.profile-nav ul > li > a:focus,
.profile-nav ul li.active a {
  border-left: 5px solid rgb(251, 192, 45);
  background: rgb(248, 247, 245) !important;
  color: rgb(137, 129, 127) !important;
}

.profile-nav ul > li:last-child > a:last-child {
  border-radius: 0px 0px 4px 4px;
}

.profile-nav ul > li > a > i {
  font-size: 16px;
  padding-right: 10px;
  color: rgb(188, 179, 170);
}

.profile-nav .nav > li > a {
  position: relative;
  display: block;
  padding: 10px 15px;
}

.r-activity {
  margin: 6px 0px 0px;
  font-size: 12px;
}

.profile-nav ul > li > a:hover,
.profile-nav ul > li > a:focus,
.profile-nav ul li.active a {
  border-left: 5px solid rgb(44, 41, 107);
  font-weight: 600;
  background: rgb(136, 204, 238) !important;
  color: rgb(0, 0, 0) !important;
}

.profile-nav ul > li {
  border-bottom: 1px solid rgb(235, 234, 230);
  margin-top: 0px;
  line-height: 30px;
  width: 100%;
}

.nav-stacked > li {
  float: none;
}

.profile-nav .user-heading {
  background: var(--theme-color);
  color: rgb(255, 255, 255);
  border-radius: 4px 4px 0px 0px;
  padding: 30px;
  text-align: center;
}
</style>
