<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import CreateForm from "@/Pages/Ticket/Partials/CreateForm.vue";
import Show from "@/Pages/Ticket/Show.vue";
import Links from "@/Pages/Ticket/Components/Links.vue";

const page = route().current().split('.')[1]
const ticket = usePage().props.ticket
const replies = usePage().props.replies

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

        <Show v-if="page === 'show'">

            <template v-slot:title>
                {{ ticket.title }}
            </template>

            <template v-slot:description>
                {{ ticket.description }}
            </template>

            <template v-slot:user.name>
                {{ ticket.user.name }}
            </template>

            <template v-slot:links>
                <div v-if="ticket.links !== ''">
                    <Links :links=ticket.links />
                </div>
            </template>

            <template v-slot:replies >

                    <div v-for="reply in replies" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pb-6">
                        <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                            <div>
                                <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ reply.description }}
                                </p>
                            </div>

                            <div v-if="reply.links !== ''">
                                <Links :links=reply.links />
                            </div>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
                                <b>{{ reply.user_name }}.</b>
                            </p>
                        </div>
                    </div>

            </template>

        </Show>

        <CreateForm v-if="page === 'create'"/>

    </AuthenticatedLayout>
</template>
