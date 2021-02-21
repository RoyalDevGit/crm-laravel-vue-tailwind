<template>
<div>
    <div class="w-12 h-12 border-8 border-gray-600 dark:border-gray-200 rounded-full loader"></div>
</div>
</template>

<script>
export default {
    name: "Spinner"
}
</script>

<style scoped>
@keyframes loader-rotate {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(360deg);
    }
}
.loader {
    border-right-color: transparent;
    animation: loader-rotate 1s linear infinite;
}
</style>
