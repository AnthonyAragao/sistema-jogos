<script setup>
    const { teamId } = defineProps(["teamId"]);
</script>

<template>
    <div class="flex flex-col gap-4">
        <Link
            :href="`/teams/${teamId}/matches`"
            class="w-full bg-primary text-center py-4 rounded-md uppercase font-bold text-black cursor-pointer"
        >
            Ver próximas partidas
        </Link>

        <Link
            :href="`/teams/${teamId}/last-matches`"
            class="w-full bg-black text-center py-4 rounded-md uppercase font-bold text-primary border border-primary hover:bg-primary hover:text-black cursor-pointer"
        >
            Ver últimas partidas
        </Link>
    </div>
</template>
