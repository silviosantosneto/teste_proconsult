<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import CreateForm from "@/Pages/Ticket/Partials/CreateForm.vue";
import Show from "@/Pages/Ticket/Show.vue";

const page = route().current().split('.')[1]

</script>

<template>
    <Head title="Ticket" ><title>Ticket</title></Head>

    <AuthenticatedLayout>
        <template #header>
            <div  class="flex justify-between h-5">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                  <a :href="route('dashboard')">Suporte</a>
                </h2>
            </div>

        </template>

        <Show v-if = "page === 'show'"/>

        <CreateForm v-if = "page === 'create'"/>

    </AuthenticatedLayout>
</template>
