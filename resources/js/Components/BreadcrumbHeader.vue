<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    resourceName: {
        type: String,
        required: true,
    },
    currentPage: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <nav>
        <ul>
            <li>
                <Link :href="route(resourceName)">{{ resourceName }}</Link>
            </li>
            <li v-if="currentPage !== 'index'">
                <Link :href="`/resources/${currentPage}`">{{ currentPage }}</Link>
            </li>
            <li v-if="currentPage === 'edit'">Edit</li>
        </ul>
    </nav>
</template>
