<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps(['participant']);
</script>

<template>
    <Head title="Participants"></Head>

    <AuthenticatedLayout>
        <template #header>
            <!-- if we are showing this on the dashboard then don't show the breadcrumbs -->
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <Link :href="route('participants.index')">Participants</Link>
            </span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block mx-2">></span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Participant</span>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="block text-4xl mb-2 text-gray-900 dark:text-gray-100">{{ participant.name }}</h2>
                    <hr>
                    <div class="pt-4 text-gray-900 dark:text-gray-100">{{ participant.email }}</div>
                    <div class="pt-4 text-gray-900 dark:text-gray-100">{{ participant.formatted_phone }}</div>
                    <div class="mt-8">
                        <h3 class="text-2xl mb-2 text-gray-900 dark:text-gray-100">Links</h3>
                        <hr>
                        <div v-for="link in participant.links" class="pt-4 text-gray-900 dark:text-gray-100">
                            <p>{{ link.name }}</p>
                            <a :href="link.url" target="_blank">{{ link.url }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
