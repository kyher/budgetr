<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout
        :breadcrumbs="breadcrumbs"
        class="bg-gradient-to-bl from-[#ffe4e6] to-[#ccfbf1]"
    >
        <slot />
    </AppLayout>
</template>
