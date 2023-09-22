<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    first_name: ''
    , last_name: ''
    , email: ''
    , phone: ''
    , event_id: null
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
    <Head title="Participants"></Head>

    <AuthenticatedLayout>
        <template #header>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <Link :href="route('participants.index')">Participants</Link>
                </span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block mx-2">></span>
            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Participants</span>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
        </div>
    </AuthenticatedLayout>
</template>
