<script setup>
import { Head } from '@inertiajs/vue3';
import WebLayout from "@/Layouts/WebLayout.vue";

defineProps({
    currentYear: {
        type: Number,
        default: () => (new Date()).getFullYear(),
    },
});
</script>

<template>
    <WebLayout>
        <Head title="Home" />

        <div class="relative flex justify-center min-h-screen bg-center bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="max-w-screen-xl md:min-w-[800px] mx-auto p-6 lg:p-8">
                <!--Header-->
                <div class="text-center">
                    <h1 class="block mt-8 text-4xl text-gray-900 dark:text-gray-100">Hi, I'm Taylor 👋</h1>
                </div>

                <!--Main-->
                <div class="mt-10 max-w-[800px]">
                    <h2 class="text-center text-2xl text-gray-900 dark:text-gray-100">Welcome to my digital hub!</h2>
                    <h2 class="text-2xl text-gray-900 dark:text-gray-100 leading-9 mt-6">I am a seasoned Full Stack Developer specializing in PHP and the Laravel framework. Discover the perfect blend of expertise and creativity as we bring your digital ideas to life.</h2>

                    <h3 class="mt-12 text-center text-2xl text-gray-900 dark:text-gray-100">About Me</h3>
                    <p class="mt-6 text-gray-900 dark:text-gray-100">I am a Full Stack Developer specializing in PHP, particularly with the robust Laravel framework. Over the past few years, I've been the sole developer for a small company, handling a diverse range of responsibilities – from crafting innovative features to meticulously debugging, and overseeing database management and devops tasks.</p>
                    <p class="mt-4 text-gray-900 dark:text-gray-100">As a self-taught professional, I am always eager to expand my knowledge and consistently prioritize delivering optimal solutions for clients. I advocate for a thoughtful and thorough approach, valuing precision over speed in every project I undertake. My commitment to quality work extends beyond the code, aiming to ensure an exceptional end-user experience.</p>
                    <p class="mt-4 text-gray-900 dark:text-gray-100">I take great pride in my work, striving for excellence in every aspect of development. If you're seeking a dedicated developer with a meticulous mindset, a hunger for knowledge, and a commitment to delivering high-caliber results, I look forward to collaborating on your next project.</p>
                </div>

                <!--Footer-->
                <div class="flex justify-center mt-16 px-6">
                    <div class="ml-4 text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        <p>&copy; {{ currentYear }} Taylor Oyer Development. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
