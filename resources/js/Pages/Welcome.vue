<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import NavBar from "@/Components/NavBar.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

function handleImageError() {
  document.getElementById("screenshot-container")?.classList.add("!hidden");
  document.getElementById("docs-card")?.classList.add("!row-span-1");
  document.getElementById("docs-card-content")?.classList.add("!flex-row");
  document.getElementById("background")?.classList.add("!hidden");
}

// // Re-initialize Bootstrap collapse elements on mount
// onMounted(() => {
//   //   // Force Bootstrap collapse re-init
//   //   const collapseElementList = [].slice.call(document.querySelectorAll(".collapse"));
//   //   collapseElementList.map((el) => new bootstrap.Collapse(el, { toggle: false }));

//   const collapseElements = document.querySelectorAll(".collapse");

//   collapseElements.forEach((el) => {
//     // Ensure Bootstrap collapse is bound to each
//     new bootstrap.Collapse(el, { toggle: false });
//   });
// });

const collapse = ref(null);
let bsCollapse = null;

onMounted(() => {
  if (collapse.value) {
    // ✅ Initialize Bootstrap collapse only once
    bsCollapse = new window.bootstrap.Collapse(collapse.value, {
      toggle: false,
    });
  }
});
</script>

<template>
  
  <!-- Head element for the title of the page -->
  <Head title="Welcome Page" />
  <!-- /Head element for the title of the page -->

  <!-- Navbar -->
    <NavBar />
  <!-- /Navbar -->

  <!-- main content -->
  <div>

    <!-- Hero Section -->
    <section class="bg-dark text-white text-center py-5">
      <div class="container">
        <h1 class="display-4 fw-bold">Welcome to Bunma</h1>
        <p class="lead mb-4">
          Your Gateway to Real-Time Streaming. Streams that feel like a cinema.
        </p>
        <!-- <a href="#" class="btn btn-lg btn-primary me-2">
          <i class="bi bi-play-fill"></i> Explore Screenings
        </a> -->
        <Link href="/streams" class="btn btn-lg btn-info text-white me-2">
          <i class="bi bi-play-fill"></i> Explore Streams
        </Link>
        <!-- <a href="#" class="btn btn-lg btn-outline-light"> Learn More </a> -->
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
      <div class="container">
        <div class="row text-center mb-4">
          <h2 class="fw-bold">Why Choose Bunma?</h2>
          <p class="text-muted">Built with reliability, speed, and quality at its core</p>
        </div>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body text-center">
                <i class="bi bi-broadcast fs-1 text-info mb-3"></i>
                <h5 class="fw-bold">Seamless Streaming</h5>
                <p class="text-muted">
                  Enjoy high-quality streams without interruptions.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body text-center">
                <i class="bi bi-shield-lock fs-1 text-info mb-3"></i>
                <h5 class="fw-bold">Secure Platform</h5>
                <p class="text-muted">
                  Your data and streams are protected with top-notch security.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body text-center">
                <i class="bi bi-speedometer2 fs-1 text-info mb-3"></i>
                <h5 class="fw-bold">Fast & Reliable</h5>
                <p class="text-muted">Experience lightning-fast performance at scale.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <Footer />
    <!-- /Footer -->
  </div>
  <!-- main content -->

</template>

<style>
body {
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}
</style>
