<script setup>
    import Layout from "../Layouts/Layout.vue";
    import MatchCard from "../../Components/Cards/MatchCard.vue";
    import Navigation from "../../Components/Navigation/Navigation.vue"

    const { team, matches, lastMatches } = defineProps(["team", "matches", "lastMatches"]);
</script>

<template>
   <Layout>
        <main>
            <div class="flex flex-col justify-center items-center gap-4 mt-8">
                <img :src="team.crest" :alt="team.name" class="size-28">
                <h2 class="text-xl font-bold text-white">{{ team.name }}</h2>

                <Navigation
                    :items="[
                        { name: 'upcoming', label: 'Jogos programados', href: `/teams/${team.id}/matches` },
                        { name: 'last', label: 'Últimos resultados', href: `/teams/${team.id}/last-matches` }
                    ]"
                    :active="lastMatches ? 'last' : 'upcoming'"
                />
            </div>


            <div class="divide-y divide-gray-500 text-white px-8 mt-8">
                <MatchCard
                    v-for="match in matches.data"
                    :key="match.id"
                    :match="match"
                />
            </div>
        </main>
   </Layout>
</template>
