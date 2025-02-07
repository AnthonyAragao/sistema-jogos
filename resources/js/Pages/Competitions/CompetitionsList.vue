<script setup>
    import DefaultLayoutVue from "../Layouts/DefaultLayout.vue";
    import CompetitionCard from "../../Components/Cards/CompetitionCard.vue";

    const { competitions } = defineProps(["competitions"]);
</script>

<template>
    <DefaultLayoutVue>
        <div class="container max-w-5xl mx-auto py-4 bg-secondary rounded-md">
            <nav class="bg-secondary text-zinc-300 p-4 rounded-md">
                <ul class="flex space-x-4">
                    <a href="" class="font-semibold text-sm text-white uppercase bg-[#C80037] px-4 py-2 rounded-lg">
                        Competições
                    </a>
                    <a href="" class="font-semibold text-sm text-white uppercase bg-[#0F2D37] px-4 py-2 rounded-lg">
                        Times
                    </a>
                </ul>
            </nav>

            <main class="divide-y divide-gray-500 px-8">
                <CompetitionCard
                    v-for="competition in competitions"
                    :key="competition.id"
                    :competition="competition"
                />
            </main>
        </div>
    </DefaultLayoutVue>
</template>
