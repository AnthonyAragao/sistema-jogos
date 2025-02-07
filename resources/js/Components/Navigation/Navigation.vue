<script setup>
    import { defineProps } from 'vue';
    import { Link } from '@inertiajs/vue3';

    const { competition, active } = defineProps(['competition', 'active']);
</script>

<template>
    <nav class="text-zinc-300 p-4">
        <ul class="flex space-x-4">
            <Link
                :href="`/competitions/${competition.id}/upcoming-matches`"
                :class="{'bg-[#C80037]': active === 'upcoming'}" class="font-semibold text-sm text-white uppercase px-4 py-2 rounded-lg"
            >
                Jogos programados
            </Link>

            <Link
                :href="`/competitions/${competition.id}/last-matches`"
                :class="{'bg-[#C80037]': active === 'last'}" class="font-semibold text-sm text-white uppercase px-4 py-2 rounded-lg"
            >
                Últimos resultados
            </Link>
        </ul>
    </nav>
</template>
