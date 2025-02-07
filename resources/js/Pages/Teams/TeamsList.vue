<script setup>
    import { ref } from "vue";
    import Layout from "../Layouts/Layout.vue";

    const { teams } = defineProps(["teams"]);
    const searchQuery = ref("");

    const searchTeam = () => {
        if (searchQuery.value === "") {
            return;
        }

        window.location.href = `/teams?search=${searchQuery.value}`;
    };
</script>

<template>
    <Layout>
        <div class="container max-w-5xl mx-auto py-4 bg-secondary rounded-md">
            <main class="px-8">
                <div class="flex items-center justify-end my-8 gap-1">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Pesquisar time"
                        class="bg-gray-800 text-white px-4 py-2 rounded-md"
                    >
                    <button
                        @click="searchTeam"
                        class="bg-primary text-black px-4 py-2 rounded-md"
                    >
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <div
                    v-if="teams.length === 0"
                    class="text-center text-white"
                >
                    Nenhum time encontrado
                </div>

                <div
                    v-else
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                >
                    <Link
                        v-for="team in teams"
                        :key="team.id"
                        :href="`/teams/${team.id}`"
                        class="bg-gray-800 rounded-sm p-4 flex items-center space-x-4"
                    >
                        <img
                            :src="team.crest"
                            :alt="team.name"
                            class="size-10"
                        >
                        <h2 class="text-gray-200 font-semibold"> {{ team.name }} </h2>
                    </Link>
                </div>
            </main>
        </div>
    </Layout>
</template>
