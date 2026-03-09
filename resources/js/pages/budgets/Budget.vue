<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import AddItemForm from '@/components/AddItemForm.vue';
import BudgetTable from '@/components/BudgetTable.vue';
import BudgetTotals from '@/components/BudgetTotals.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { show } from '@/routes/budgets';
import type { BreadcrumbItem } from '@/types';
import type { Budget } from '@/types/Budget';

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

const headTitle = computed(() => {
    return `Budget: ${budget.name}`;
});
</script>

<template>
    <Head :title="headTitle" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto w-2/3">
            <h1 class="p-4 text-2xl font-bold">
                {{ budget.name }}
            </h1>
            <BudgetTable :budget="budget" />
            <BudgetTotals :budget="budget" />
            <AddItemForm :budget="budget" />
        </div>
    </AppLayout>
</template>
>
