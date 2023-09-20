<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['event', 'participants', 'showAddParticipantForm']);
const isNotDashboard = computed(() => !route().current('dashboard'));
const showAddParticipantForm = ref(false);

const form = useForm({
    first_name: ''
    , last_name: ''
    , email: ''
    , phone: ''
    , event_id: props.event.id
});
function createParticipant() {
    form.post(route('participants.store'),
        {
            preserveScroll: true
            , onSuccess: () => {
                // form.defaults();
                form.reset();
            }
        }
    );
}
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="">
                        <div @click="showAddParticipantForm = !showAddParticipantForm" class="cursor-pointer text-gray-800 dark:text-gray-200 text-right">
                            <span v-if="!showAddParticipantForm">Add Participants</span>
                            <span v-if="showAddParticipantForm">Hide Add Participants</span>
                        </div>
                        <div v-if="showAddParticipantForm">
                            <form @submit.prevent="createParticipant">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="mb-4">
                                        <div>
                                            <label for="first_name" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">First Name</label>
                                            <input type="text" name="first_name" id="first_name" v-model="form.first_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                            <div v-if="form.errors.first_name">{{ form.errors.first_name }}</div>
                                        </div>
                                        <div>
                                            <label for="last_name" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" v-model="form.last_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                            <div v-if="form.errors.last_name">{{ form.errors.last_name }}</div>
                                        </div>
                                        <div>
                                            <label for="email" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">Email</label>
                                            <input type="text" name="email" id="email" v-model="form.email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                            <div v-if="form.errors.email">{{ form.errors.email }}</div>
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">Phone</label>
                                            <input type="text" name="phone" id="phone" v-model="form.phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                            <div v-if="form.errors.phone">{{ form.errors.phone }}</div>
                                        </div>
                                        <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Add Participant</PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2 class="block mt-8 text-gray-900 dark:text-gray-100">Participants</h2>
                    <hr>
                    <div v-for="participant in participants" class="mt-4 flex items-center">
                        <div class="pt-4 text-gray-900 dark:text-gray-100">{{ participant.first_name }} {{ participant.last_name }}</div>
                        <div class="pt-4 text-gray-900 dark:text-gray-100 ml-4">{{ participant.email }}</div>
                        <div class="pt-4 text-gray-900 dark:text-gray-100 ml-4">{{ participant.phone }}</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
