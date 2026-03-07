<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import type { Budget } from '@/types/Budget';
import { addItem } from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';

const props = defineProps<{
    budget: Budget;
}>();
</script>

<template>
    <Form
        :action="addItem(budget)"
        method="post"
        class="mt-4 flex flex-col gap-4"
        reset-on-success
        #default="{ errors }"
    >
        <p v-if="errors.name" class="text-red-500">{{ errors.name }}</p>
        <input
            type="text"
            name="name"
            placeholder="Item Name"
            class="rounded border border-gray-300 bg-white p-2"
        />
        <p v-if="errors.amount" class="text-red-500">
            {{ errors.amount }}
        </p>
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
</template>
