<script setup>
import {useForm, usePage} from '@inertiajs/vue3';
import ReplyForm from "@/Pages/Ticket/Partials/ReplyForm.vue";
import Links from "@/Pages/Ticket/Components/Links.vue";

const ticket = usePage().props.ticket
const replies = usePage().props.replies
const user = usePage().props.auth.user

const form = useForm({
    'reply': '',
    'ticketID': ticket.id
})

</script>

<template>
    <section>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ ticket.title }}</h2>

                    </header>

                    <div>
                        <p class="mt-1 text-gray-600 dark:text-gray-400 mb-3">
                            {{ ticket.description }}
                        </p>

                    </div>

                    <div v-if="ticket.links !== ''">
                        <Links :links=ticket.links />
                    </div>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
                        Cliente: <b>{{ ticket.user.name }}.</b>
                    </p>

                </div>
            </div>
        </div>

        <div v-if="replies !== []">
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
                        Colaborador: <b>{{ reply.user_name }}.</b>
                    </p>
                </div>
            </div>
        </div>

        <ReplyForm v-if="ticket.user_can_respond && ticket.status !== 'Fechado'"/>

    </section>
</template>
