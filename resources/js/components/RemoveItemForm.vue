<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { removeItem } from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';
import type { Budget, BudgetItem } from '@/types/Budget';

defineProps<{
    budget: Budget;
    item: BudgetItem;
}>();
</script>

<template>
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
</template>
