<script setup>
import Footer from '@/Components/Footer.vue';
import NavBar from '@/Components/NavBar.vue';
import { Head, usePage } from '@inertiajs/vue3';
import axios from "axios";
import { ref, onMounted, reactive, computed } from 'vue';


// get Inertia page props (defined in handleInertiaRequests middleware share method)
const pageProps = usePage()

// tickets array from backend
const userTickets = computed(() => pageProps.props.userTickets || [])

// helper function to check if user has ticket for provided movie id
const hasTicket = (movieId) => {
  return userTickets.value.some(ticket => ticket.movie_id === movieId)
}

// movies data (for demo purposes, static array)
const movies = reactive(
  [
    { id: 1, img: 'assets/images/movies/related/kung-fu-panda-portrait.webp', title: 'Kung Fu Panda' },
    { id: 2, img: 'assets/images/movies/upcoming/07.webp', title: 'One Piece' },
    { id: 3, img: 'assets/images/movies/related/charlie-chaplin-portrait.webp', title: 'Charlie Chaplin' },
    { id: 4, img: 'assets/images/movies/upcoming/sonil-portrait.webp', title: 'Sonil' },
    { id: 5, img: 'assets/images/movies/upcoming/the-dragon-king-portrait.webp', title: 'The Dragon King' },
    { id: 6, img: 'assets/images/movies/related/lost-in-space-portrait.webp', title: 'Lost In Space' },
    { id: 7, img: 'assets/images/movies/upcoming/red-portrait.webp', title: 'Red' },
  ]
);

// payment processing state
const email = ref("");
const amount = ref(5000);
const isProcessing = ref(false);

const payWithPaystack = (movieId) => {
  isProcessing.value = true;

  let handler = PaystackPop.setup({
    key: "pk_test_xxxxxxxxxxxxxxxx", // Replace with your Paystack public key
    email: email.value,
    amount: amount.value * 100,
    currency: "NGN",
    callback: function (response) {
      axios.post("/tickets/verify", { reference: response.reference })
        .then(() => {
          alert("Payment successful! Ticket activated.");
        })
        .catch(() => {
          alert("Payment verification failed.");
        })
        .finally(() => {
          isProcessing.value = false;
        });
    },
    onClose: function () {
      axios.post("/tickets/verify", { reference: "response.reference", movieId: movieId })
        .then(() => {
          alert("Transaction Failed! For testing, a 5-min ticket was activated.");
          window.location.href = '/talks';
        })
        .finally(() => {
          isProcessing.value = false;
        });
    },
  });

  handler.openIframe();
};

const purchaseMovieTicket = (movieId) => {
  payWithPaystack(movieId);
};


// --- fix: re-initialize scripts when Vue mounts
onMounted(() => {
  // // Initialize Bootstrap tooltips if used
  // const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  // [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));

  // Initialize Swiper if needed
  if (window.Swiper) {
    new Swiper('.swiper-card', {
      slidesPerView: 4,
      spaceBetween: 15,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        100: { slidesPerView: 1 },
        320: { slidesPerView: 1 },
        576: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        992: { slidesPerView: 4 },
        1200: { slidesPerView: 5 },
      }
    });
  }

  // // Hide any loader overlay
  // document.querySelector('.loader')?.classList.add('d-none');
  // document.body.style.backgroundColor = "#fff"; // ensure black overlay is cleared

});
</script>

<template>
  <Head title="Streams Page" />

  <main class="main-content bg-light min-vh-100">
    <NavBar />

    <div class="container-fluid py-5">
      <section class="section-padding-top">
        <div class="d-flex flex-wrap-reverse align-items-center justify-content-between px-1 mb-4">
          <h5 class="main-title text-uppercase text-info fw-bold mb-0">
            Upcoming
          </h5>
          <p class="text-uppercase text-info mb-0">
            Available tickets: {{ $page.props.userTickets.length }}
          </p>
        </div>

        <div class="card-style-slider">
          <div class="position-relative swiper swiper-card">
            <ul class="p-0 swiper-wrapper m-0 list-inline">
              <li class="swiper-slide" v-for="movie in movies" :key="movie.id">
                <div class="card card-hover border-0 shadow-sm">
                  <img
                    :src="movie.img"
                    class="card-img-top rounded-top-3"
                    :alt="`${movie.title} image`"
                  />
                  <div class="card-body text-center">
                    <h6 class="fw-bold mb-2">{{ movie.title }}</h6>
                    <button
                      class="btn btn-info w-100 text-light"
                      @click.prevent="purchaseMovieTicket(movie.id)"
                      :disabled="isProcessing || hasTicket(movie.id)"
                    >
                      {{ isProcessing ? 'Processing...' : hasTicket(movie.id) ? 'Ticket Purchased' : 'Get Ticket Now' }}
                    </button>
                  </div>
                </div>
              </li>
            </ul>

            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
          </div>
        </div>
      </section>
    </div>

    <Footer />
  </main>
</template>

<style scoped>
.main-content {
  background-color: #f8f9fa;
  transition: background-color 0.3s ease;
}
</style>
