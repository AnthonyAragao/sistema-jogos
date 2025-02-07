<script setup>
    import { Link } from '@inertiajs/vue3';

    const { items, active } = defineProps(['items', 'active']);
</script>

<template>
    <nav class="text-zinc-300 p-4">
        <ul class="flex space-x-4">
            <Link
                v-for="item in items"
                :key="item.name"
                :href="item.href"
                :class="{
                    'bg-[#C80037]': active === item.name,
                    'bg-[#0F2D37]': active !== item.name
                }"
                class="font-semibold text-sm text-white uppercase px-4 py-2 rounded-lg cursor-pointer"
            >
                {{ item.label }}
            </Link>
        </ul>
    </nav>
</template>
