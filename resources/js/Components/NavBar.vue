<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">
          <!-- <i class="bi bi-camera-reels-fill me-2"></i> Bunma -->
          <img src="logo.svg" alt="Bunma Logo" class="d-inline-block align-text-top" style="height: 50px; width: 100px;" />
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-start">
            
            <li class="nav-item" v-if="$page.props.auth.user || !$page.props.auth.user">
                <Link href="/" class="nav-link" :class="{ active: $page.url === '/' }">
                    Home
                </Link>
            </li>

            <li class="nav-item" v-if="$page.props.auth.user || !$page.props.auth.user">
                <Link href="/suggest" class="nav-link" :class="{ active: $page.url === '/suggest' }">
                    Suggest
                </Link>
            </li>

            <li class="nav-item" v-if="$page.props.auth.user || !$page.props.auth.user">
                <Link href="/tickets" class="nav-link" :class="{ active: $page.url === '/tickets' }">
                    My Tickets
                </Link>
            </li>
            

            <!-- <li class="nav-item" v-if="$page.props.auth.user || !$page.props.auth.user">
                <Link href="/admin" class="nav-link" :class="{ active: $page.url === '/admin' }">
                    Admin
                </Link>
            </li> -->
            
            <li class="nav-item" v-if="!$page.props.auth.user">
              <Link
                :href="route('login')"
                class="btn btn-sm btn-info text-white px-5 py-2 ms-2 me-2 mb-3 mb-md-0"
              >
                Log in
              </Link>
            </li>

            <!-- <li class="nav-item" v-if="!$page.props.auth.user && canRegister">
              <Link
                :href="route('register')"
                class="btn btn-primary ms-2"
              >
                Register
              </Link>
            </li> -->

            <li class="nav-item dropdown" v-if="$page.props.auth.user">
              <a
                class="nav-link dropdown-toggle" :class="{ active: $page.url === '/streams' || $page.url === '/logout' }"
                href="#"
                id="userDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                {{$page.props.auth.user.name || 'Streams'}}
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                  <Link
                    :href="route('streams')"
                    class="dropdown-item" :class="{ active: $page.url === '/streams' }"
                  >
                    Streams
                  </Link>
                </li>
                <li>
                  <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="dropdown-item" :class="{ active: $page.url === '/logout' }"
                  >
                    Logout
                  </Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

</template>

<style scoped>
/* .active {
  color: blue;
} */

 .active, a:hover {
  color: #007aff;
 }

 a:active {
  color: #007aff;
  background-color: whitesmoke;
 }
</style>