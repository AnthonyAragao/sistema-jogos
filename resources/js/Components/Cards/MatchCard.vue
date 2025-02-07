<script setup>
    import { defineProps } from "vue";
    
    const { match } = defineProps(["match"]);
</script>

<template>
    <div
        class="p-4 grid grid-cols-2 items-start gap-2 hover:bg-gray-800 transition-colors duration-150"
    >
        <div class="flex flex-col gap-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img
                        :src="match.homeTeam.emblem"
                        :alt="match.homeTeam.name"
                        class="size-10"
                    />
                    <h2 class="text-zinc-200 font-semibold">
                        {{ match.homeTeam.name }}
                    </h2>
                </div>
                <p class="text-white">{{ match.homeTeam.goals }}</p>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <img
                        :src="match.awayTeam.emblem"
                        :alt="match.awayTeam.name"
                        class="size-10"
                    />
                    <h2 class="text-zinc-200 font-semibold">
                        {{ match.awayTeam.name }}
                    </h2>
                </div>
                <p class="text-white">{{ match.awayTeam.goals }}</p>
            </div>
        </div>

        <div class="ml-auto text-right text-sm space-y-1">
            <p class="text-zinc-200">
                <i class="fas fa-calendar-alt"></i>
                {{ new Date(match.info.date).toLocaleString() }}
            </p>
            <p class="text-zinc-200">
                <i class="fas fa-info-circle"></i> {{ match.info.status }}
            </p>
        </div>
    </div>
</template>
