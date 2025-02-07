<script setup>
    import Layout from "../Layouts/Layout.vue";
    const { team } = defineProps(["team"]);
</script>

<template>
    <Layout>
        <div class="grid grid-cols-2 items-center">
            <div class="flex items-center gap-4 mt-8">
                <img :src="team.crest" :alt="team.name" class="size-28">

                <div class="text-lg text-white">
                    <p><strong>Nome:</strong> {{ team.name }}</p>
                    <p><strong>Cidade:</strong> {{ team.area.name }}</p>
                    <p><strong>Fundação:</strong> {{ team.founded }}</p>
                    <p><strong>Estádio:</strong> {{ team.venue }}</p>
                    <p><strong>Website: </strong>
                        <a :href="team.website" target="_blank" class="italic underline text-sm">{{ team.website }}</a>
                    </p>
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <Link
                    :href="`/teams/${team.id}/matches`"
                    class="w-full bg-primary text-center py-4 rounded-md uppercase font-bold text-black cursor-pointer"
                >
                    Ver próximas partidas
                </Link>

                <Link
                    :href="`/teams/${team.id}/last-matches`"
                    class="w-full bg-black text-center py-4 rounded-md uppercase font-bold text-primary border border-primary hover:bg-primary hover:text-black cursor-pointer"
                >
                    Ver últimas partidas
                </Link>
            </div>
        </div>


        <h2 class="text-2xl font-semibold text-white mt-16">Jogadores</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <div
                v-for="player in team.squad"
                :key="player.id"
                class="bg-gray-800 rounded-sm p-4 flex items-center space-x-4"
            >
                <p class="text-gray-200">
                    <strong class="text-white">{{ player.name }}</strong> - {{ player.position }}
                </p>
            </div>
        </div>
    </Layout>
</template>
