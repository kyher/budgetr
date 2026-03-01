export type Budget = {
    id: number;
    name: string;
    items: BudgetItem[];
};

export type BudgetItem = {
    id: number;
    name: string;
    amount: number;
    completed: boolean;
};
