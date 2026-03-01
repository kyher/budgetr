<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import type { Budget } from '@/types/Budget';
import { show } from '@/actions/App/Http/Controllers/Budgets/BudgetController';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
];
defineProps<{
    budgets: Budget[];
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <ul>
                <li v-for="budget in budgets" :key="budget.id">
                    <Link
                        :href="show(budget)"
                        class="rounded-sm bg-blue-500 px-5 py-1.5 text-sm leading-normal text-white hover:bg-blue-600"
                        >{{ budget.name }}</Link
                    >
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
