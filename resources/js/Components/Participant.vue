<script setup>
import { ref } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
const showParticipantLinks = ref(false);

defineProps({
    participant: {
        type: Object,
        required: true,
    },
    showPhoneAndEmail: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>
    <li class="py-4">
        <div class="flex items-center space-x-4">
            <div class="flex-1 min-w-0">
                <p class="text-xl font-medium text-gray-900 truncate dark:text-white">
                    {{ participant.name }}
                </p>
                <div v-if="showPhoneAndEmail">
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        {{ participant.email }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        {{ participant.formatted_phone }}
                    </p>
                </div>
            </div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                <PrimaryButton @click="showParticipantLinks = !showParticipantLinks">
                    <span v-if="!showParticipantLinks">Show Links</span>
                    <span v-else>Hide Links</span>
                </PrimaryButton>
            </div>
        </div>
        <div v-if="showParticipantLinks" class="mt-4 pl-4">
            <div v-if="participant.links.length > 0" v-for="link in participant.links" class="mt-3 text-gray-900 dark:text-gray-100">
                <p class="mb-1 pb-1 border-b border-gray-700">{{ link.name }}</p>
                <a class="text-sm dark:text-gray-400" :href="link.url" target="_blank" :title="link.url">{{ link.url }}</a>
            </div>
            <div v-else>
                <p class="text-gray-900 dark:text-gray-100">No Links</p>
            </div>
        </div>
    </li>
</template>
