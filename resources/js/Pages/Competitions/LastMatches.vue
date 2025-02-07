<script setup>
    import DefaultLayoutVue from "../Layouts/DefaultLayout.vue";
    import Navigation from "../../Components/Navigation/Navigation.vue";

    const { matches, competition } = defineProps(["matches", "competition"]);
</script>

<template>
    <DefaultLayoutVue>
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

            <main>
                <div class="divide-y divide-gray-500 text-white px-8">
                    <div
                        v-for="match in matches.data"
                        :key="match.id"
                        class="p-4 grid grid-cols-2 items-start gap-2 hover:bg-gray-800 transition-colors duration-150"
                    >
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <img
                                            :src="match.homeTeam.emblem"
                                            :alt="match.homeTeam.name"
                                            class="size-10"
                                        >
                                        <h2 class="text-zinc-200 font-semibold">{{ match.homeTeam.name }}</h2>
                                    </div>
                                </div>

                                <p class="text-white">
                                    {{ match.homeTeam.goals }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <img
                                        :src="match.awayTeam.emblem"
                                        :alt="match.awayTeam.name"
                                        class="size-10"
                                    >
                                    <h2 class="text-zinc-200 font-semibold">{{ match.awayTeam.name }}</h2>
                                </div>

                                <p class="text-white">
                                    {{ match.awayTeam.goals }}
                                </p>
                            </div>
                        </div>

                        <div class="ml-auto text-right text-sm space-y-1">
                            <p class="text-zinc-200">
                                <i class="fas fa-calendar-alt"></i> {{ new Date(match.info.date).toLocaleString() }}
                            </p>
                            <p class="text-zinc-200">
                                <i class="fas fa-info-circle"></i> {{ match.info.status }}
                            </p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </DefaultLayoutVue>
</template>
