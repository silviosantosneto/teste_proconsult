<script setup>
import {Link, usePage} from '@inertiajs/vue3';

const user = usePage().props.auth.user
const errors = usePage().props.errors

</script>

<template>
    <section>
        <header class="pb-5 flex justify-between">
            <div>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Chamadas</h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Lista de chamadas.
                </p>
            </div>
            <div v-if="usePage().props.auth.user.type === 'Cliente'">

                <Link :href="route('ticket.create')"
                      class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border
                          border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase
                          tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white
                          active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2
                          focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition
                          ease-in-out duration-150">
                    Abrir
                </Link>

            </div>
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
                        <a :href="route('ticket.show', ticket.id)"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <div v-if="errors" class="bg-white dark:bg-gray-800 pt-2 dark:border-gray-700 text-center">
        <span class="px-6 py-4 pt-2 pb-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ errors[user.type] }}
        </span>
    </div>
</template>
