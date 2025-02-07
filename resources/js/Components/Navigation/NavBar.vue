<script setup>
    import { usePage } from '@inertiajs/vue3';

    const page = usePage();

    const isActive = (path) => {
        return page.url.startsWith(path);
    };
</script>

<template>
    <nav>
        <ul class="flex justify-center space-x-8 bg-[#010A0F] text-zinc-300 p-6 rounded-md border-b border-gray-500">
            <Link
                href="/competitions"
                class="font-semibold text-sm text-white uppercase"
                :class="{
                    'relative after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-[25px] after:h-1 after:bg-primary after:rounded-t-lg': isActive('/competitions')
                }"
            >

                <i class="fas fa-futbol"></i> Competições
            </Link>

            <Link
                href="/teams"
                class="font-semibold text-sm text-white uppercase"
                :class="{
                    'relative after:content-[\'\'] after:absolute after:left-0 after:right-0 after:-bottom-[25px] after:h-1 after:bg-primary after:rounded-t-lg': isActive('/teams')
                }"
            >
                <i class="fas fa-users"></i> Times
            </Link>
        </ul>
    </nav>
</template>
