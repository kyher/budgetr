<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { show } from '@/actions/App/Http/Controllers/Budgets/BudgetController';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { remove, store } from '@/routes/budgets';
import type { BreadcrumbItem } from '@/types';
import type { Budget } from '@/types/Budget';

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
                <li
                    v-for="budget in budgets"
                    :key="budget.id"
                    class="flex justify-between"
                >
                    <Link :href="show(budget)" class="hover:underline">{{
                        budget.name
                    }}</Link>
                    <Form method="delete" :action="remove(budget)">
                        <button
                            type="submit"
                            class="cursor-pointer rounded bg-red-500 p-1 text-xs text-white"
                        >
                            Remove Budget
                        </button>
                    </Form>
                </li>
            </ul>
            <Form
                :action="store()"
                method="post"
                class="mt-4 flex items-center gap-2"
            >
                <input
                    type="text"
                    name="name"
                    placeholder="Budget Name"
                    class="flex-1 rounded-md border border-gray-300 bg-white p-2"
                />
                <button
                    type="submit"
                    class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"
                >
                    Create Budget
                </button>
            </Form>
        </div>
    </AppLayout>
</template>
