<script setup xmlns="http://www.w3.org/1999/html">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Participant from "@/Components/Participant.vue";

const props = defineProps(['event', 'participants', 'showAddParticipantForm', 'matches']);
const isNotDashboard = computed(() => !route().current('dashboard'));
const eventHasMatches = computed(() => props.matches.length > 0);
const showAddParticipantForm = ref(false);

const form = useForm({
    first_name: ''
    , last_name: ''
    , email: ''
    , phone: ''
    , event_id: props.event.id
    , redirect: 'events.index'
});
function createParticipant() {
    form.post(route('participants.store'),
        {
            preserveScroll: true
            , onSuccess: () => {
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

        <div class="py-12 text-gray-800 dark:text-gray-200">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between">
                        <h2 class="text-2xl">Event Matches</h2>
                        <div v-if="!eventHasMatches && isNotDashboard">
                            <Link :href="route('events.runLottery', props.event.id)">
                                <PrimaryButton>Run Lottery</PrimaryButton>
                            </Link>
                        </div>
                        <div v-if="eventHasMatches && isNotDashboard">
                            <Link :href="route('events.rerunLottery', props.event.id)">
                                <PrimaryButton>Re-Run Lottery</PrimaryButton>
                            </Link>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto mt-4 rounded border border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Participant
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Matched Participant
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <template v-if="eventHasMatches">
                                    <tr v-for="match in matches" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ match.participant.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ match.matched_participant.name }}
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            No matches yet
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="">
                        <div v-if="isNotDashboard" @click="showAddParticipantForm = !showAddParticipantForm" class="cursor-pointer text-gray-800 dark:text-gray-200 text-right">
                            <span v-if="!showAddParticipantForm">Add Participants</span>
                            <span v-if="showAddParticipantForm">Hide Add Participants</span>
                        </div>
                        <div v-if="showAddParticipantForm">
                            <form @submit.prevent="createParticipant" class="max-w-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="mb-4">
                                        <div class="mt-3">
                                            <InputLabel for="first_name" value="First Name" />
                                            <TextInput
                                                id="first_name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.first_name"
                                            />
                                            <InputError class="mt-1" :message="form.errors.first_name" />
                                        </div>
                                        <div class="mt-3">
                                            <InputLabel for="last_name" value="Last Name" />
                                            <TextInput
                                                id="last_name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.last_name"
                                            />
                                            <InputError class="mt-1" :message="form.errors.last_name" />
                                        </div>
                                        <div class="mt-3">
                                            <InputLabel for="email" value="Email" />
                                            <TextInput
                                                id="email"
                                                type="email"
                                                class="mt-1 block w-full"
                                                v-model="form.email"
                                            />
                                            <InputError class="mt-1" :message="form.errors.email" />
                                        </div>
                                        <div class="mt-3">
                                            <InputLabel for="phone" value="Phone" />
                                            <TextInput
                                                id="phone"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="form.phone"
                                            />
                                            <InputError class="mt-1" :message="form.errors.phone" />
                                        </div>
                                        <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Add Participant</PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h2 class="block mt-8 pb-4 text-2xl text-gray-900 dark:text-gray-100 border-b border-gray-700">Participants</h2>
                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                        <Participant v-if="participants.length > 0" v-for="participant in participants" :participant="participant" />
                        <li v-else>
                            <p>No Participants have been added to this event.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
