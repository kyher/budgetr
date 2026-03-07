<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import type { Budget, BudgetItem } from '@/types/Budget';
import { toggleItemPaid } from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';

const props = defineProps<{
    budget: Budget;
    item: BudgetItem;
}>();
</script>

<template>
    <Form
        method="patch"
        :action="
            toggleItemPaid({
                budget,
                item,
            })
        "
    >
        <button
            type="submit"
            class="cursor-pointer rounded bg-orange-700 p-1 text-xs text-white"
        >
            {{ item.paid_at ? 'Mark Unpaid' : 'Mark Paid' }}
        </button>
    </Form>
</template>
