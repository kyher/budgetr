export type Budget = {
    id: number;
    name: string;
    items: BudgetItem[];
    total: number;
    remaining: number;
};

export type BudgetItem = {
    id: number;
    name: string;
    amount: number;
    paid_at: Date | null;
};
