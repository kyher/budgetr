<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import type { Budget, BudgetItem } from '@/types/Budget';
import { updateItem } from '@/actions/App/Http/Controllers/BudgetItems/BudgetItemController';
import { ref } from 'vue';
import Dialog from './ui/dialog/Dialog.vue';
import DialogTrigger from './ui/dialog/DialogTrigger.vue';
import { DialogContent, DialogDescription } from './ui/dialog';
import DialogHeader from './ui/dialog/DialogHeader.vue';
import DialogTitle from './ui/dialog/DialogTitle.vue';

defineProps<{
    budget: Budget;
    item: BudgetItem;
}>();

const open = ref(false);
</script>

<template>
    <Dialog v-model:open="open">
        <DialogTrigger
            class="cursor-pointer rounded bg-green-500 p-1 text-xs text-white"
        >
            Update Item
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Update item</DialogTitle>
                <DialogDescription>
                    <Form
                        method="patch"
                        :action="
                            updateItem({
                                budget,
                                item,
                            })
                        "
                        #default="{ errors }"
                        class="flex flex-col gap-4"
                        reset-on-success
                        @success="open = false"
                    >
                        <p v-if="errors.name" class="text-red-500">
                            {{ errors.name }}
                        </p>
                        <input
                            name="name"
                            placeholder="Name..."
                            :defaultValue="item.name"
                            class="rounded border border-gray-300 bg-white p-2"
                        />
                        <p v-if="errors.amount" class="text-red-500">
                            {{ errors.amount }}
                        </p>
                        <input
                            type="number"
                            step="0.01"
                            name="amount"
                            :defaultValue="item.amount.value"
                            placeholder="Total..."
                            class="rounded border border-gray-300 bg-white p-2"
                        />
                        <p v-if="errors.remaining" class="text-red-500">
                            {{ errors.remaining }}
                        </p>
                        <input
                            type="number"
                            step="0.01"
                            name="remaining"
                            :defaultValue="item.remaining.value"
                            placeholder="Remaining total..."
                            class="rounded border border-gray-300 bg-white p-2"
                        />
                        <button
                            type="submit"
                            class="cursor-pointer rounded bg-blue-500 p-1 text-xs text-white"
                        >
                            Update
                        </button>
                    </Form>
                </DialogDescription>
            </DialogHeader>
        </DialogContent>
    </Dialog>
</template>
