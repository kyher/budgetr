export type Budget = {
    id: number;
    name: string;
    items: BudgetItem[];
    total: string;
    remaining: string;
};

export type BudgetItem = {
    id: number;
    name: string;
    amount: {
        label: string;
        value: number;
    };
    remaining: {
        label: string;
        value: number;
    };
    paid_at: Date | null;
};
