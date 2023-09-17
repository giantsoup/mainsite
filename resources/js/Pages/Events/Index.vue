<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['events']);
</script>

<template>
    <Head title="Events"></Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Events</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">This is the events page.</div>
                    <ul class="p-6 text-gray-900 dark:text-gray-100">
                        <li v-for="event in events" :key="event.id">
                            <Link :href="route('events.show', event.id)">{{ event.name }}</Link></li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
