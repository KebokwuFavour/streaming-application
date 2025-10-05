<script setup>
const videos = [
  {
    id: 1,
    title: "Intro to Laravel 12",
    description: "Quick overview of Laravel 12 features.",
    // thumbnail: "https://www.youtube.com/watch?v=RlPNh_PBZb4",
    thumbnail: "/logo.svg",
    url: "https://www.youtube.com/embed/dQw4w9WgXcQ"
  },
  {
    id: 2,
    title: "Vue 3 Basics",
    description: "Learn the fundamentals of Vue 3 composition API.",
    thumbnail: "https://www.youtube.com/watch?v=RlPNh_PBZb4",
    // thumbnail: "/logo.svg",
    url: "https://www.youtube.com/embed/oHg5SJYRHA0"
  },
  {
    id: 3,
    title: "Bootstrap 5 UI",
    description: "Building responsive layouts with Bootstrap 5.",
    thumbnail: "https://www.youtube.com/watch?v=RlPNh_PBZb4",
    // thumbnail: "/logo.svg",
    url: "https://www.youtube.com/embed/9bZkp7q19f0"
  }
]
</script>

<template>
  <div class="container my-5">
    <h2 class="fw-semibold fs-4 text-dark mb-4">Video Library</h2>

    <div class="row g-4">
      <div v-for="video in videos" :key="video.id" class="col-md-3">
        <div class="card h-100 shadow-sm">
          <!-- Thumbnail -->
          <img :src="video.thumbnail" class="card-img-top" alt="video thumbnail" />

          <!-- Body -->
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ video.title }}</h5>
            <p class="card-text text-muted">{{ video.description }}</p>

            <!-- Video iframe -->
            <div class="ratio ratio-16x9 mt-2">
              <iframe
                :src="video.url"
                title="video player"
                allowfullscreen
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
