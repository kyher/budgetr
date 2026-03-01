<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { getTotal } from '@/lib/utils';
import { dashboard } from '@/routes';
import { show } from '@/routes/budgets';
import { BreadcrumbItem } from '@/types';
import { Budget } from '@/types/Budget';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

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

const total = computed(() => {
    return Number(getTotal(budget.items)).toFixed(2);
});

const remaining = computed(() => {
    return Number(
        getTotal(budget.items.filter((item) => !item.completed)),
    ).toFixed(2);
});
</script>

<template>
    <Head :title="headTitle" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto w-1/2">
            <h1 class="p-4 text-2xl font-bold">
                {{ budget.name }}
            </h1>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-center">Name</th>
                        <th class="px-4 py-2 text-center">Amount</th>
                        <th class="px-4 py-2 text-center">Completed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in budget.items" :key="item.id">
                        <td class="px-4 py-2 text-center">{{ item.name }}</td>
                        <td class="px-4 py-2 text-center">{{ item.amount }}</td>
                        <td class="px-4 py-2 text-center">
                            {{ item.completed ? '✓' : '✗' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4">
                <table
                    class="min-w-full divide-y divide-gray-200 bg-purple-300"
                >
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-center">Total</th>
                            <th class="px-4 py-2 text-center">Remaining</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 text-center">{{ total }}</td>
                            <td class="px-4 py-2 text-center">
                                {{ remaining }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
>
