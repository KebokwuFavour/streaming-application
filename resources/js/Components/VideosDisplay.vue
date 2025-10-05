<script setup>
const videos = [
  {
    id: 1,
    title: "Intro to Bunma",
    description: "Quick overview of Bunma.",
    thumbnail: "/logo.svg", // fallback poster image
    src: "/videos/vid1.mp4" // local or hosted MP4 file
  },
  {
    id: 2,
    title: "Intro to Bunma",
    description: "Quick overview of Bunma.",
    thumbnail: "/logo.svg",
    src: "/videos/vid2.mp4"
  },
  {
    id: 3,
    title: "Intro to Bunma",
    description: "Quick overview of Bunma.",
    thumbnail: "/logo.svg",
    src: "/videos/vid3.mp4"
  },
  {
    id: 4,
    title: "Intro to Bunma",
    description: "Quick overview of Bunma.",
    thumbnail: "/logo.svg",
    src: "/videos/vid4.mp4"
  }
]
</script>

<template>
  <div class="container my-5">
    <h2 class="fw-semibold fs-4 text-dark mb-4">Video Library</h2>

    <div class="row g-4">
      <div v-for="video in videos" :key="video.id" class="col-md-3">
        <div class="card h-100 shadow-sm">
          <!-- Native video player -->
          <video
            class="card-img-top"
            controls
            preload="metadata"
            :poster="video.thumbnail"
          >
            <source :src="video.src" type="video/mp4" />
            Your browser does not support the video tag.
          </video>

          <!-- Body -->
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ video.title }}</h5>
            <p class="card-text text-muted">{{ video.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>