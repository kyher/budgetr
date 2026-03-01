<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { getTotal } from '@/lib/utils';
import { dashboard } from '@/routes';
import { show } from '@/routes/budgets';
import { toggleCompletion } from '@/routes/budgets/items';
import type { BreadcrumbItem } from '@/types';
import type { Budget } from '@/types/Budget';
import {
    addItem,
    removeItem,
    toggleItemCompletion,
} from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';

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
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in budget.items" :key="item.id">
                        <td class="px-4 py-2 text-center">{{ item.name }}</td>
                        <td class="px-4 py-2 text-center">
                            {{ Number(item.amount).toFixed(2) }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            {{ item.completed ? '✅' : '❌' }}
                        </td>
                        <td class="flex gap-2 px-4 py-2 text-center">
                            <Form
                                method="patch"
                                :action="
                                    toggleItemCompletion({
                                        budget,
                                        item,
                                    })
                                "
                            >
                                <button
                                    type="submit"
                                    class="cursor-pointer rounded bg-orange-700 p-1 text-xs text-white"
                                >
                                    {{
                                        item.completed
                                            ? 'Mark Incomplete'
                                            : 'Mark Complete'
                                    }}
                                </button>
                            </Form>
                            <Form
                                method="delete"
                                :action="
                                    removeItem({
                                        budget,
                                        item,
                                    })
                                "
                            >
                                <button
                                    type="submit"
                                    class="cursor-pointer rounded bg-red-500 p-1 text-xs text-white"
                                >
                                    Remove item
                                </button>
                            </Form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Form
                :action="addItem(budget)"
                method="post"
                class="mt-4 flex flex-col gap-4"
                reset-on-success
            >
                <input
                    type="text"
                    name="name"
                    placeholder="Item Name"
                    class="rounded border border-gray-300 bg-white p-2"
                />
                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    placeholder="Item Amount"
                    class="rounded border border-gray-300 bg-white p-2"
                />
                <button
                    type="submit"
                    class="cursor-pointer rounded bg-blue-500 p-2 text-white"
                >
                    Add Item
                </button>
            </Form>
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
