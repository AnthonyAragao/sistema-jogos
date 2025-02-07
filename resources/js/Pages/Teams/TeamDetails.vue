<script setup>
    import Layout from "../Layouts/Layout.vue";
    import TeamInfo from "../../Components/Team/TeamInfo.vue";
    import TeamActions from "../../Components/Team/TeamActions.vue";
    import TeamSquad from "../../Components/Team/TeamSquad.vue";

    const { team } = defineProps(["team"]);
</script>

<template>
    <Head :title="`Detalhes do time ${team.name}`" />

    <Layout>
        <div class="grid grid-cols-2 items-center">
            <TeamInfo :team="team" />
            <TeamActions :teamId="team.id" />
        </div>

        <TeamSquad :squad="team.squad" />
    </Layout>
</template>
