<script setup>
    const { team } = defineProps(["team"]);
</script>

<template>
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
</template>
