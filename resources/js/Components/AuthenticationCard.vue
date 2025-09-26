<template>
    <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div> -->

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-light py-5">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-100" style="max-width: 400px;">
            <div class="card shadow-sm mt-4">
                <div class="card-body p-4">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
