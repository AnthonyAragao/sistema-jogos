<script setup>
    import DefaultLayoutVue from "../Layouts/DefaultLayout.vue";

    const { competitions } = defineProps(["competitions"]);
</script>

<template>
    <DefaultLayoutVue>
        <div class="container max-w-5xl mx-auto py-4 bg-secondary rounded-md">
            <nav class="bg-secondary text-zinc-300 p-4 rounded-md">
                <ul class="flex space-x-4">
                    <a
                        href=""
                        class="font-semibold text-sm text-white uppercase bg-[#C80037] px-4 py-2 rounded-lg"
                    >
                        Competições
                    </a>
                    <a
                        href=""
                        class="font-semibold text-sm text-white uppercase bg-[#0F2D37] px-4 py-2 rounded-lg"
                    >
                        Times
                    </a>
                </ul>
            </nav>

            <main>
                <div class="divide-y divide-gray-500 px-8">
                    <Link
                        :href="`/competitions/${competition.id}/upcoming-matches`"
                        v-for="competition in competitions"
                        :key="competition.id"
                        class="p-4 flex justify-between items-center"
                    >
                        <div class="flex items-center gap-2">
                            <img
                                :src="competition.emblem"
                                :alt="competition.name"
                                class="size-12"
                            />
                            <h2 class="text-zinc-200 font-semibold">{{ competition.name }}</h2>
                        </div>
                        <i class="fas fa-chevron-right text-white"></i>
                    </Link>
                </div>
            </main>
        </div>
    </DefaultLayoutVue>
</template>
