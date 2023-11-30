<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['events']);
function formatDate(date) {
    return new Date(date).toLocaleDateString('en-US', {
        year: 'numeric'
    });
}
</script>

<template>
    <Head title="Events"></Head>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Events</h2>
                <Link :href="route('events.create')" class="px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100">Create Event</Link>
            </div>
        </template>

        <div class="py-6 sm:py-12">
            <div class="max-w-7xl lg:max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto rounded border border-gray-700">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-if="events">
                            <tr v-for="event in events" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <Link :href="route('events.show', event.id)" class="px-6 py-4 block">{{ event.name }}</Link>
                                </th>
                                <td class="px-6 py-4">
                                    {{ formatDate(event.date) }}
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Events
                                </td>
                            </tr>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
