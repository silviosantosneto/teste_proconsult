<script setup>
defineProps({
    links: {
        type: Array,
    },
});
</script>

<template>

        <p class="mt-1 text-lg">
            <a
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                v-for="link in links"
                :href="link.url"
            >
                {{ link.name }}&nbsp;
            </a>
        </p>

</template>
