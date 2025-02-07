<script setup>
    import Layout from "../Layouts/Layout.vue";
    import CompetitionCard from "../../Components/Cards/CompetitionCard.vue";

    const { competitions } = defineProps(["competitions"]);
</script>

<template>
    <Layout>
        <div class="container max-w-5xl mx-auto py-4 bg-secondary rounded-md">
            <main class="divide-y divide-gray-500 px-8">
                <CompetitionCard
                    v-for="competition in competitions"
                    :key="competition.id"
                    :competition="competition"
                />
            </main>
        </div>
    </Layout>
</template>
