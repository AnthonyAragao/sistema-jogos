<script setup>
    import { defineProps } from "vue";
    import { Link } from "@inertiajs/vue3";

    const { competition } = defineProps(["competition"]);
</script>

<template>
    <Link
        :href="`/competitions/${competition.id}/upcoming-matches`"
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
</template>
