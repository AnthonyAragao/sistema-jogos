<script setup>
    import NavBar from '../../Components/Navigation/NavBar.vue';
</script>

<template>
    <header class="bg-primary text-gray-800 p-4 text-center font-bold uppercase tracking-wider">
        Football Info
    </header>

    <NavBar />

    <div class="container max-w-5xl mx-auto py-8">
        <slot></slot>
    </div>
</template>

<style>
    body {
        background-color: #010A0F;
    }
</style>
