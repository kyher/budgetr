<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { show } from '@/routes/budgets';
import { BreadcrumbItem } from '@/types';
import { Budget } from '@/types/Budget';
import { Head } from '@inertiajs/vue3';

const { budget } = defineProps<{
    budget: Budget;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
    {
        title: budget.name,
        href: show(budget),
    },
];
</script>

<template>
    <Head title="Budget: {{ budget.name }}" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <h1 class="p-4 text-2xl font-bold">
                {{ budget.name }}
            </h1>
        </div>
    </AppLayout>
</template>
>
