<script setup>
    const { squad } = defineProps(["squad"]);
</script>

<template>
    <h2 class="text-2xl font-semibold text-white mt-16">Jogadores</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <div
            v-for="player in squad"
            :key="player.id"
            class="bg-gray-800 rounded-sm p-4 flex items-center space-x-4"
        >
            <p class="text-gray-200">
                <strong class="text-white">{{ player.name }}</strong> - {{ player.position }}
            </p>
        </div>
    </div>
</template>
