<script setup>
    import Layout from "../Layouts/Layout.vue";
    import Navigation from "../../Components/Navigation/Navigation.vue";
    import MatchCard from "../../Components/Cards/MatchCard.vue";

    const { matches, competition } = defineProps(["matches", "competition"]);
</script>

<template>
    <Layout>
        <div class="flex items-center gap-2">
            <img
                :src="competition.emblem"
                :alt="competition.name"
                class="size-12"
            >
            <h2 class="text-gray-200 text-2xl font-semibold"> {{ competition.name }} </h2>
        </div>

        <div class="container max-w-5xl mx-auto py-4 rounded-md bg-secondary mt-4">
            <Navigation
                :competition="competition"
                active="last"
            />

            <main class="divide-y divide-gray-500 text-white px-8">
                <MatchCard
                    v-for="match in matches.data"
                    :key="match.id"
                    :match="match"
                />
            </main>
        </div>
    </Layout>
</template>
