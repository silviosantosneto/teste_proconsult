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
