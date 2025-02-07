<script setup>
    import Layout from "../Layouts/Layout.vue";
    import Navigation from "../../Components/Navigation/Navigation.vue";
    import MatchCard from "../../Components/Cards/MatchCard.vue";

    const { matches, competition ,lastMatches} = defineProps(["matches", "competition", "lastMatches"]);
    const items = [
        { name: 'upcoming', label: 'Jogos programados', href: `/competitions/${competition.id}/upcoming-matches` },
        { name: 'last', label: 'Últimos resultados', href: `/competitions/${competition.id}/last-matches` }
    ];
</script>

<template>
    <Head
        title="Partidas"
        meta="Veja as próximas partidas e os últimos resultados da competição"
    />

    <Layout>
        <div v-if="competition.id == null">
            <p class="text-center text-white mt-4">Nenhuma competição encontrada</p>
        </div>

        <div v-else class="flex items-center gap-2">
            <img
                :src="competition.emblem"
                :alt="competition.name"
                class="size-12"
            >
            <h2 class="text-gray-200 text-2xl font-semibold"> {{ competition.name }} </h2>
        </div>

        <div
            v-if="matches.data.length !== 0"
            class="container max-w-5xl mx-auto py-4 rounded-md bg-secondary mt-4"
        >
            <Navigation
                :items="items"
                :active="lastMatches ? 'last' : 'upcoming'"
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
