<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: ''
});

function createEvent() {
    form.post(route('events.store'));
}
</script>

<template>
    <Head title="Events"></Head>

    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <Link :href="route('events.index')">Events</Link>
                </span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block mx-2">></span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Event</span>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="createEvent">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">
                                    Event Name
                                </label>
                                <input type="text" name="name" id="name" v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                <div v-if="form.errors.name">{{ form.errors.name }}</div>
                                <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Create Event</PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
