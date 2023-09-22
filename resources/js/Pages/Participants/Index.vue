<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps(['participants']);
</script>

<template>
    <Head title="Participants"></Head>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Participants</h2>
                <Link :href="route('participants.create')" class="px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100">Add Participant</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="p-6 text-gray-900 dark:text-gray-100">
                        <li v-for="participant in participants" :key="participant.id">
                            <Link :href="route('participants.show', participant.id)" class="block py-2">{{ participant.name }}</Link>
                            <hr>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
