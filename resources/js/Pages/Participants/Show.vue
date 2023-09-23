<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {ref} from "vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps(['participant', 'available_participants', 'exclusions']);

const formLink = useForm({
    name: ''
    , url: ''
    , participant_id: props.participant.id
});

const formExclusion = useForm({
    excluded_participant_id: ''
    , participant_id: props.participant.id
});

function createLink() {
    formLink.post(route('links.store'), {
        preserveScroll: true,
        onSuccess: () => {
            formLink.reset();
        }
    });
}

function createExclusion() {
    formExclusion.post(route('exclusions.store'), {
        preserveScroll: true,
        onSuccess: () => {
            formExclusion.reset();
        }
    });
}

const showAddLinkForm = ref(false);
const showAddExclusionForm = ref(false);
</script>

<template>
    <Head title="Participants"></Head>

    <AuthenticatedLayout>
        <template #header>
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
                    <Link :href="route('participants.edit', [participant.id])" class="inline-block mt-6 px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100">Edit Participant</Link>
                    <div class="mt-8">
                        <h3 class="text-2xl mb-2 text-gray-900 dark:text-gray-100">Links</h3>
                        <hr>
                        <div @click="showAddLinkForm = !showAddLinkForm" class="mt-4 cursor-pointer text-gray-800 dark:text-gray-200 text-right">
                            <span v-if="!showAddLinkForm">Add Link</span>
                            <span v-if="showAddLinkForm">Hide Add Link</span>
                        </div>
                        <div v-if="showAddLinkForm">
                            <form @submit.prevent="createLink" class="max-w-lg">
                                <div class="text-gray-900 dark:text-gray-100">
                                    <div class="mb-4">
                                        <div class="mt-3">
                                            <InputLabel for="name" value="Name" />
                                            <TextInput
                                                id="name"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="formLink.name"
                                            />
                                            <InputError class="mt-1" :message="formLink.errors.name" />
                                        </div>
                                        <div class="mt-3">
                                            <InputLabel for="url" value="URL" />
                                            <TextInput
                                                id="url"
                                                type="text"
                                                class="mt-1 block w-full"
                                                v-model="formLink.url"
                                            />
                                            <InputError class="mt-1" :message="formLink.errors.url" />
                                        </div>
                                        <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': formLink.processing }" :disabled="formLink.processing">Add Link</PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-for="link in participant.links" class="flex justify-between items-center pt-4 text-gray-900 dark:text-gray-100">
                            <div>
                                <p>{{ link.name }}</p>
                                <a :href="link.url" target="_blank">{{ link.url }}</a>
                            </div>
                            <Link :href="route('links.destroy', [link.id])" method="delete" as="button" class="inline-block mt-6 px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100">Delete</Link>
                        </div>
                    </div>
                    <div class="mt-8">
                        <h3 class="text-2xl mb-2 text-gray-900 dark:text-gray-100">Exclusions</h3>
                        <hr>
                        <div @click="showAddExclusionForm = !showAddExclusionForm" class="mt-4 cursor-pointer text-gray-800 dark:text-gray-200 text-right">
                            <span v-if="!showAddExclusionForm">Add Exclusion</span>
                            <span v-if="showAddExclusionForm">Hide Add Exclusion</span>
                        </div>
                        <div v-if="showAddExclusionForm">
                            <form @submit.prevent="createExclusion" class="max-w-lg">
                                <div class="text-gray-900 dark:text-gray-100">
                                    <div class="mb-4">
                                        <div class="mt-3">
                                            <InputLabel for="excluded_participant_id" value="Excluded" />
                                            <SelectInput
                                                id="excluded_participant_id"
                                                v-model="formExclusion.excluded_participant_id"
                                                :options="Object.values(available_participants)"
                                                option-value="id"
                                                option-label="name"
                                                :default-option="{
                                                    id: '',
                                                    name: 'Select a Participant'
                                                }"
                                                :disabled="formExclusion.processing"
                                            />
                                            <InputError :message="formExclusion.errors.excluded_participant_id" />
                                        </div>
                                        <PrimaryButton type="submit" class="mt-4" :class="{ 'opacity-25': formExclusion.processing }" :disabled="formExclusion.processing">Add Exclusion</PrimaryButton>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-for="(exclusion_name, exclusion_id) in exclusions" class="flex justify-between items-center pt-4 text-gray-900 dark:text-gray-100">
                            <div>
                                <p>{{ exclusion_name }}</p>
                            </div>
                            <Link :href="route('exclusions.destroy', [exclusion_id])" method="delete" as="button" class="mt-6 px-6 py-2 rounded bg-teal-500 hover:bg-teal-600 text-cyan-100">Delete</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
