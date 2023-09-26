<script setup>
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user

</script>

<template>
    <section>
        <header class="pb-5">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Chamadas</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Lista de chamadas.
            </p>
        </header>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Titulo
                    </th>
                    <th scope="col" class="px-6 py-3 text-right">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
                </thead>

                <tbody v-for="ticket in usePage().props.tickets">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ ticket.title }}
                    </th>
                    <td class="px-6 py-4 text-right">
                        {{ ticket.status }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a :href="route('ticket.show', ticket.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
