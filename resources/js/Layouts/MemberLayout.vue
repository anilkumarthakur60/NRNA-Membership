<template>
  <div
    class="
      side-navbar
      active-nav
      d-flex
      justify-content-between
      flex-wrap flex-column
    "
    id="sidebar"
  >
    <ul class="nav flex-column text-white w-100">
      <a href="#" class="nav-link h3 text-white my-2">
        {{ $page.props.user.name }}
      </a>
      <li class="nav-link">
        <Link :href="route('dashboard')">
          <i class="bx bx-conversation"></i>
          <span class="mx-2">Dashboard</span>
        </Link>
      </li>
      <li class="nav-link">
        <Link :href="route('profile.show')">
          <i class="bx bx-user-check"></i>
          <span class="mx-2">Profile</span>
        </Link>
      </li>
      <li class="nav-link">
        <Link :href="route('logout')" method="post">
          <i class="bx bx-user-check"></i>
          <span class="mx-2">Logout</span>
        </Link>
      </li>
    </ul>
  </div>

  <!-- Main Wrapper -->
  <div class="p-1 my-container active-cont">
    <!-- Top Nav -->
    <nav class="navbar top-navbar navbar-light bg-light px-5">
      <button class="btn border-0" id="menu-btn">
        <i class="bx bx-menu"></i>
      </button>
    </nav>

    <slot></slot>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";

import { Head, Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
  },
  name: "MemberLayout",
};
</script>

<style >
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  min-height: 100vh;
  background-color: #fff;
}

.side-navbar {
  width: 180px;
  height: 100%;
  position: fixed;
  margin-left: -300px;
  background-color: #100901;
  transition: 0.5s;
}

.nav-link:active,
.nav-link:focus,
.nav-link:hover {
  background-color: #ffffff26;
}

.my-container {
  transition: 0.4s;
}

.active-nav {
  margin-left: 0;
}

/* for main section */
.active-cont {
  margin-left: 180px;
}

#menu-btn {
  background-color: #100901;
  color: #fff;
  margin-left: -62px;
}

.my-container input {
  border-radius: 2rem;
  padding: 2px 20px;
}
</style>