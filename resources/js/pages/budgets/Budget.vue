<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
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
    const reducedTotal = budget.items.reduce(
        (acc, item) => acc + item.amount,
        0,
    );
    return Number(reducedTotal).toFixed(2);
});
</script>

<template>
    <Head :title="headTitle" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto w-1/2">
            <h1 class="p-4 text-2xl font-bold">
                {{ budget.name }}
            </h1>
            <ul>
                <li
                    v-for="item in budget.items"
                    :key="item.id"
                    class="flex items-center justify-between border-t p-4"
                >
                    <span>{{ item.name }}</span>
                    <span>{{ item.amount }}</span>
                </li>
            </ul>
            <div class="ml-auto w-fit">
                <p class="text-2xl font-bold">
                    Total:
                    {{ total }}
                </p>
            </div>
        </div>
    </AppLayout>
</template>
>
