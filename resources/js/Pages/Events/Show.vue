<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps(['event', 'participants', 'showAddParticipantForm']);
const isNotDashboard = computed(() => !route().current('dashboard'));
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="">
                        <div @click="showAddParticipantForm = !showAddParticipantForm" class="cursor-pointer text-gray-800 dark:text-gray-200 text-right">
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
                    <h2 class="block mt-8 text-gray-900 dark:text-gray-100">Participants</h2>
                    <hr>
                    <div v-for="(participant, index) in participants" class="w-full mt-4 flex items-center border-b border-gray-100 pb-8">
                        <div>
                            <div class="text-lg pt-4 text-gray-900 dark:text-gray-100">{{ participant.name }}</div>
                            <div v-for="link in participant.links" class="pl-6 pt-4 text-gray-900 dark:text-gray-100">
                                <p>{{ link.name }}</p>
                                <a :href="link.url" target="_blank">{{ link.url }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
