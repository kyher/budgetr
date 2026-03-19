<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { addItem } from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';
import type { Budget } from '@/types/Budget';

defineProps<{
    budget: Budget;
}>();
</script>

<template>
    <Form
        :action="addItem(budget)"
        method="post"
        class="mt-4 flex max-w-sm flex-col gap-4"
        reset-on-success
        #default="{ errors }"
    >
        <p v-if="errors.name" class="text-red-500">{{ errors.name }}</p>
        <label for="name">Item Name</label>
        <input
            type="text"
            id="name"
            name="name"
            class="rounded border border-gray-300 bg-white p-2"
        />
        <p v-if="errors.amount" class="text-red-500">
            {{ errors.amount }}
        </p>
        <label for="amount">Item Amount</label>
        <input
            type="number"
            step="0.01"
            id="amount"
            name="amount"
            class="rounded border border-gray-300 bg-white p-2"
        />
        <button
            type="submit"
            class="cursor-pointer rounded bg-blue-700 p-2 text-white"
        >
            Add Item
        </button>
    </Form>
</template>
