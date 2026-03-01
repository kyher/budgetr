<script setup lang="ts">
import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <AuthLayout
        :title="title"
        :description="description"
        class="bg-gradient-to-bl from-[#ffe4e6] to-[#ccfbf1]"
    >
        <slot />
    </AuthLayout>
</template>
