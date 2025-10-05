<script setup>
import { Head, Link } from "@inertiajs/vue3";
import NavBar from "@/Components/NavBar.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    
    <!-- Head element for the title of the page -->
    <Head title="Suggest Page" />
    <!-- /Head element for the title of the page -->

    <!-- Navbar -->
    <NavBar />
    <!-- /Navbar -->

    <!-- Main content -->
    <div class="container my-5">
        <div class="row">
            <div class="col-11 col-md-9 mx-auto">
                <div class="card p-4 shadow-lg">
                    <h3 class="text-center mb-4">Suggest A Movie</h3>
                    <!-- <h2 class="card-title mb-4 text-center">Movie Suggestion Form</h2> -->
                    <form id="suggestionForm">
                        <div class="mb-3">
                            <label for="movieTitle" class="form-label">Movie Title</label>
                            <input type="text" class="form-control border-info" id="movieTitle" placeholder="Enter movie title" />
                        </div>
                        <div class="mb-3">
                            <label for="movieGenre" class="form-label">Genre</label>
                            <input type="text" class="form-control border-info" id="movieGenre" placeholder="Enter movie genre" />
                        </div>
                        <div class="mb-3">
                            <label for="movieDescription" class="form-label">Description</label>
                            <textarea class="form-control border-info" id="movieDescription" rows="4" placeholder="Enter movie description"></textarea>
                        </div>
                        <button type="button" class="btn btn-info">Submit Suggestion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main content -->

    <!-- Footer -->
    <Footer />
    <!-- /Footer -->

</template>