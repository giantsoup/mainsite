<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";

// define prop for output which will be text from api
const output = ref('');

const runTest = () => {
    // call the runTest method in the controller
    // this will return the output from the api
    // and set it to the output prop
    axios.get(route('playground.runTest'))
        .then(response => {
            console.log(response.data);

            output.value = response.data;
        })
        .catch(error => {
            console.log(error);
        });
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button class="inline-block px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100" @click="runTest">Run Test</button>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 output">
                        <pre>{{ output }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
