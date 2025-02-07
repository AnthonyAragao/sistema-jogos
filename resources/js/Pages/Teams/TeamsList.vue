<script setup>
    import Layout from "../Layouts/Layout.vue";

    const { teams } = defineProps(["teams"]);
</script>

<template>
    <Layout>
        <div class="container max-w-5xl mx-auto py-4 bg-secondary rounded-md">
            <main class="divide-y divide-gray-500 px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
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
