<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <!-- <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label> -->

    <label class="form-label fw-medium small text-dark">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
