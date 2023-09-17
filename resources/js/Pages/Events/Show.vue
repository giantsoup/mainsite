<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from "vue";

const props = defineProps(['event']);
const isNotDashboard = computed(() => !route().current('dashboard'));
</script>

<template>
    <Head title="Event"></Head>

    <AuthenticatedLayout>
        <template #header>
            <!-- if we are showing this on the dashboard then don't show the breadcrumbs -->
            <template v-if="isNotDashboard">
                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <Link :href="route('events.index')">Events</Link>
                </span>
                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block mx-2">></span>
                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Event</span>
            </template>
            <template v-else>
                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Current Event</span>
            </template>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">This is the single event page.</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
