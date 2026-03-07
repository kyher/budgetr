<script setup lang="ts">
import type { Budget } from '@/types/Budget';
import TogglePaidForm from './TogglePaidForm.vue';
import UpdateRemainingItemTotal from './UpdateRemainingItemTotal.vue';
import RemoveItemForm from './RemoveItemForm.vue';
import UpdateItemForm from './UpdateItemForm.vue';

const props = defineProps<{
    budget: Budget;
}>();
</script>

<template>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 text-center">Name</th>
                <th class="px-4 py-2 text-center">Total</th>
                <th class="px-4 py-2 text-center">Remaining</th>
                <th class="px-4 py-2 text-center">Paid At</th>
                <th class="px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in budget.items" :key="item.id">
                <td class="px-4 py-2 text-center">{{ item.name }}</td>
                <td class="px-4 py-2 text-center">
                    {{ item.amount.label }}
                </td>
                <td class="px-4 py-2 text-center">
                    {{ item.remaining.label }}
                </td>
                <td class="px-4 py-2 text-center">
                    {{ item.paid_at ? item.paid_at : '-' }}
                </td>
                <td class="flex gap-2 px-4 py-2 text-center">
                    <TogglePaidForm :budget="budget" :item="item" />
                    <UpdateItemForm :budget="budget" :item="item" />
                    <RemoveItemForm :budget="budget" :item="item" />
                </td>
            </tr>
        </tbody>
    </table>
</template>
