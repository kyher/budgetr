<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="items-centerp-6 flex min-h-screen flex-col items-center bg-gradient-to-bl from-[#ffe4e6] to-[#ccfbf1] lg:justify-center lg:p-8"
    >
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="w-full max-w-[335px] overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row"
            >
                <h1 class="text-2xl font-bold">Budgetr</h1>
                <h2 class="text-lg">
                    <p v-if="$page.props.auth.user">Welcome back!</p>
                    <p v-else>Login or register to manage your budgets</p>
                </h2>
                <div class="my-2 flex gap-2">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="inline-block rounded-sm bg-blue-500 px-5 py-1.5 text-sm leading-normal text-white hover:bg-blue-600"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="inline-block rounded-sm bg-blue-500 px-5 py-1.5 text-sm leading-normal text-white hover:bg-blue-600"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="register()"
                            class="inline-block rounded-sm bg-blue-500 px-5 py-1.5 text-sm leading-normal text-white hover:bg-blue-600"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
