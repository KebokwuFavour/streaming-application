<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <!-- <p class="text-sm text-red-600">
            {{ message }}
        </p> -->

        <p class="text-danger small">
    {{ message }}
</p>
    </div>
</template>
