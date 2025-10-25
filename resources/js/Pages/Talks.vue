<script setup>
import NavBar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    
    <!-- Head element for the title of the page -->
    <Head title="Talks Page" />
    <!-- /Head element for the title of the page -->

    <!-- Navbar -->
    <NavBar />
    <!-- /Navbar -->

    <section class="talks-section">
        <div class="container">
            <h1 class="section-title">Talks</h1>
            <p class="section-description">
                Welcome to the Talks section! Here you can find insightful discussions and presentations on various topics.
            </p>
            <!-- Add more content related to talks here -->
        </div>
    </section>

    <!-- Footer -->
    <Footer />
    <!-- /Footer -->
</template>