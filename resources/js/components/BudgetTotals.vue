<script setup lang="ts">
import type { Budget } from '@/types/Budget';

const props = defineProps<{
    budget: Budget;
}>();
</script>

<template>
    <div class="mt-4">
        <table class="min-w-full divide-y divide-gray-200 bg-purple-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-center">Total</th>
                    <th class="px-4 py-2 text-center">Remaining</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-center">
                        {{ budget.total }}
                    </td>
                    <td class="px-4 py-2 text-center">
                        {{ budget.remaining }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
