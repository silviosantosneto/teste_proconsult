<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, usePage} from '@inertiajs/vue3';
import Table from "@/Components/Table.vue";

</script>

<template>
    <Head title="Suporte" />

    <AuthenticatedLayout>
        <template #header>
            <div  class="flex justify-between h-5">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Suporte</h2>
                <div v-if="usePage().props.auth.user.type === 'Cliente'">

                    <Link :href="route('ticket.create')"
                          class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Criar
                    </Link>

                </div>
            </div>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                    <Table/>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
