<script setup>
import VideosDisplay from '@/Components/VideosDisplay.vue';
import Footer from '@/Components/Footer.vue';
import NavBar from '@/Components/NavBar.vue';
import { Head, Link } from '@inertiajs/vue3';
import useRouter from "@router";
import axios from "axios";
import { ref } from 'vue';

const router = useRouter();

const email = ref("");
const amount = ref(5000); // amount in NGN (₦5000 for example)
const isProcessing = ref(false);

// function to handle ticket purchase via paystack
const payWithPaystack = (() => {
  isProcessing.value = true;

  let handler = PaystackPop.setup({
    key: "pk_test_xxxxxxxxxxxxxxxx", // Replace with your Paystack public key
    email: email.value,
    amount: amount.value * 100, // Paystack expects amount in Kobo
    currency: "NGN",
    callback: function (response) {
      // send reference to backend for verification
      axios.post("/tickets/verify", {
        reference: response.reference,
      })
      .then((res) => {
        alert("Payment successful! Ticket activated.");
      })
      .catch((err) => {
        console.error(err);
        alert("Payment verification failed.");
      })
      .finally(() => {
        isProcessing.value = false;
      });
    },
    onClose: function () {
        //   isProcessing.value = false;
        //   alert("Transaction was not completed, window closed.");
        
        axios.post("/tickets/verify", {
            reference: "response.reference",
        })
        .then((res) => {
            alert("Transaction Failed! \n\n But for test purposes a 5mins ticket has been activated for you now, confirm the flow and let us discuss further improvements.");

            // // reload the page
            // router.reload();
            router.push('/talks');
            // window.location.href = '/streams';
        })
        .catch((err) => {
            console.error(err);
            alert("Payment verification failed.");
        })
        .finally(() => {
            isProcessing.value = false;
        });
    },
  });

  handler.openIframe();
});

const purchaseMovieTicket = (() => {

  // invoke the payWithPaystack function
  payWithPaystack();

});

</script>

<template>

    <!-- Head element for the title of the page -->
    <Head title="Streams Page" />
    <!-- /Head element for the title of the page -->

  <span class="screen-darken"></span>
   
   <!-- loader Start -->
  <div class="loader simple-loader">
     <div class="loader-body">
        <!-- <img src="assets/images/loader.gif" alt="loader" class="img-fluid " width="300"> -->
        <!-- <img src="logo.svg" alt="loader" class="img-fluid " width="300"> -->
      </div>
  </div>
  <!-- loader END -->

  <main class="main-content">
    <!--Nav Start-->
    <NavBar />
    <!--Nav End-->

    <!-- Upcoming Start -->
    <div class="container-fluid">
        <div class="overflow-hidden">
            <section class="upcomimg-block section-padding-top">
                <div class="d-flex align-items-center justify-content-between px-1 mb-2 pb-1 mb-md-4 pb-md-0">
                    <!-- <h5 class="main-title text-capitalize mb-0">Upcoming</h5> -->
                    <h5 class="main-title text-capitalize mb-0">upcoming</h5>
                </div>
                <div class="card-style-slider">
                    <div class="position-relative swiper swiper-card" data-slide="6" data-laptop="6" data-tab="3"
                        data-mobile="2" data-mobile-sm="1" data-autoplay="false" data-loop="false" data-navigation="true"
                        data-pagination="true">
                        <ul class="p-0 swiper-wrapper m-0  list-inline">
                            <li class="swiper-slide">
                              <div class="iq-card card-hover">
                                <div class="block-images position-relative w-100">
                                  <div class="img-box w-100">
                                    <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                      <img src="assets/images/movies/related/kung-fu-panda-portrait.webp" alt="movie-card"
                                        class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                    </a>
                                  </div>
                                  <div class="card-description with-transition">
                                    <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                      <li class="fw-semi-bold">
                                        <a href="#" tabindex="0" class="font-size-14 ">
                                          Action </a>
                                      </li>
                                    </ul>
                                    <div class="cart-content">
                                      <div class="content-left">
                                        <h5 class="iq-title text-capitalize">
                                          <a href="#">Kung Fu Panda</a>
                                        </h5>
                                      </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                      <div class="iq-play-button iq-button">
                                        <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                        </a>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/upcoming/red-portrait.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <a href="#">Red</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <!-- <a href="video-player" class="btn btn-info w-100">Play Now
                                          </a> -->
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/related/lost-in-space-portrait.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <a href="#">Lost In Space</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/upcoming/the-dragon-king-portrait.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <a href="#">The Dragon King</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                
                                    </div>
                                    <div class="position-absolute z-1 primium-product d-flex align-items-center justify-content-center"
                                      data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Premium" data-bs-original-title="Premium">
                                      <i class="ph-fill ph-crown "></i>
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/upcoming/sonil-portrait.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <a href="#">Sonil</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English
                                                            (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/related/charlie-chaplin-portrait.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <!-- <a href="video-player">Charlie Chaplin</a> -->
                                            <a href="#">Charlie Chaplin</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <!-- <a href="video-player" class="btn btn-info w-100">Play Now
                                          </a> -->
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                            <li class="swiper-slide">
                                <div class="iq-card card-hover">
                                  <div class="block-images position-relative w-100">
                                    <div class="img-box w-100">
                                      <a @click.prevent="purchaseMovieTicket" href="#" class="position-relative top-0 bottom-0 start-0 end-0">
                                        <img src="assets/images/movies/upcoming/07.webp" alt="movie-card"
                                          class="img-fluid object-cover w-100 d-block border-0 rounded-3">
                                      </a>
                                    </div>
                                    <div class="card-description with-transition">
                                      <ul class="genres-list p-0 mb-2 d-flex align-items-center flex-wrap list-inline">
                                        <li class="fw-semi-bold">
                                          <!-- <a href="view-all-movie.html" tabindex="0" class="font-size-14 ">
                                            Action </a> -->
                                          <a href="#" tabindex="0" class="font-size-14 ">
                                            Action </a>
                                        </li>
                                      </ul>
                                      <div class="cart-content">
                                        <div class="content-left">
                                          <h5 class="iq-title text-capitalize">
                                            <a href="#">onepeoc</a>
                                          </h5>
                                          <!-- <div class="d-flex align-items-center gap-3">
                                            <div class="d-flex align-items-center gap-2">
                                              <i class="ph ph-translate"></i>
                                              <small class="font-size-12">English (UK)</small>
                                            </div>
                                          </div> -->
                                        </div>
                                      </div>
                                      <div class="d-flex align-items-center justify-content-center gap-2 mt-3">
                                        <!-- <a href="watchlist-detail.html"
                                          class="d-flex align-items-center justify-content-center flex-shrink-0 border-0 add-to-wishlist-btn btn btn-secondary"
                                          data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                          data-bs-title="Add to Watchlist">
                                          <i class="ph ph-plus font-size-18"></i>
                                        </a> -->
                                        <div class="iq-play-button iq-button">
                                          <a @click.prevent="purchaseMovieTicket" href="#" class="btn btn-info w-100">Play Now
                                          </a>
                                        </div>
                                      </div>
                                
                                    </div>
                                  </div>
                                
                                </div>
                            </li>
                        </ul>
                        <div class="swiper-button swiper-button-next"></div>
                        <div class="swiper-button swiper-button-prev"></div>
                    </div>
                </div>
            </section>
            <!-- Upcoming End -->

            <section class="mb-5">
              
                <div class="offcanvas overflow-y-auto widget-shopping-cart-content offcanvas-end offcanvas-sidebar sidebar-container on-rtl end border-left-0"
                    tabindex="-1" id="offcanvasReview" aria-modal="true" role="dialog">
                    <div class="offcanvas-header position-relative border-bottom">
                        <h5 class="offcanvas-title fw-500" id="offcanvasReviewLabel">
                            Add Review </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form>
                
                            <!-- Add Nonce for security -->
                            <input type="hidden" id="st_ajax_nonce" name="st_ajax_nonce" value="a19cf1e628"><input type="hidden"
                                name="_wp_http_referer" value="/product/wp/streamit/tvshows/vikings/"> <input id="cm_id" type="hidden"
                                name="comment_id" value="">
                
                            <!-- Hidden fields for post type and post ID -->
                            <input id="cm_post_type" type="hidden" name="post_type" value="tvshow">
                            <input id="cm_post_id" type="hidden" name="post_id" value="1">
                
                            <!-- User ID for logged-in users -->
                            <input id="cm_user_id" type="hidden" name="user_id" value="12">
                
                            <!-- Display logged-in user's name -->
                            <div class="form-group">
                                <input id="cm_name" name="cm_name" type="hidden" value="Marvin McKinney">
                                <input id="cm_email" name="cm_email" type="hidden" value="marvin@demo.com">
                                <p class="mt-0 text-heading">Logged in as: Marvin McKinney</p>
                            </div>
                
                            <!-- Rating section -->
                            <div class="form-group mb-4">
                                <label class="form-label mb-3">Your Rating</label>
                                <div class="star-rating" id="starRating">
                                    <input type="radio" id="star5" name="rating" value="5">
                                    <label for="star5" title="5 stars"><i class="ph-fill ph-star" aria-hidden="true"></i></label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4" title="4 stars"><i class="ph-fill ph-star" aria-hidden="true"></i></label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3" title="3 stars"><i class="ph-fill ph-star" aria-hidden="true"></i></label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2" title="2 stars"><i class="ph-fill ph-star" aria-hidden="true"></i></label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1" title="1 star"><i class="ph-fill ph-star" aria-hidden="true"></i></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label flex-grow-1" for="Description">
                                    Your Review
                                </label>
                                <textarea id="Description" class="form-control review-text-area" rows="8" cols="45"></textarea>
                            </div>
                
                            <!-- Submit button -->
                            <div class="iq-button">
                                <a href="https://templates.iqonic.design/streamit-dist/frontend/html/javascript(void)" class="btn btn-info text-capitalize">
                                    <span class="button-text">Submit Review</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- Upcoming End -->
  </main>

  <!-- footer -->
  <Footer />

</template>
