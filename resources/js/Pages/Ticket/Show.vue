<script setup>
import {Link, router, useForm, usePage} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import ReplyForm from "@/Pages/Ticket/Partials/ReplyForm.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const ticket = usePage().props.ticket
const replies = usePage().props.replies
const user = usePage().props.auth.user
const ticketID = usePage().props.ticket.id

const replyForm = useForm({
    'description': '',
    'ticket_id': ticketID,
    'files': []
})

const closeForm = useForm({
    'id': ticketID
})

const sendReply = function () {
    replyForm.post(route('reply.store'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            router.get('/ticket/show/' + `${ticketID}`)
        }
    })
}

const closeTicket = function (){
    closeForm.put(route('ticket.close'), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            router.get('/ticket/show/' + `${ticketID}`)
        }


    })
}

</script>

<template>
    <section>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            <slot name="title"/>
                        </h2>
                    </header>

                    <div>
                        <p class="mt-1 text-gray-600 dark:text-gray-400 mb-3">
                            <slot name="description"/>
                        </p>

                    </div>

                    <slot name="links"/>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-right">
                        <b><slot name="user.name"/>.</b>
                    </p>

                </div>
            </div>
        </div>

        <slot v-if="replies !== []" name="replies"/>

        <div v-if="ticket.status !== 'Fechado'" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                <form @submit.prevent="sendReply" class="space-y-6">

                    <InputLabel for="reply" value="Resposta" class="text-left"/>
                    <textarea
                        id="reply"
                        rows="4"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                    focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500
                    dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        v-model="replyForm.description"
                        required
                        autofocus
                        placeholder="Escreva sua resposta aqui..."
                    ></textarea>

                    <InputError class="mt-2" :message="replyForm.errors.description"/>

                    <InputLabel for="files" value="Anexos"/>

                    <TextInput
                        id="files"
                        type="file"
                        multiple
                        class="mt-1 block w-full"
                        autocomplete="files"
                        v-model="replyForm.files"
                        @input="replyForm.files = $event.target.files"
                    />

                    <InputError class="mt-2" :message="replyForm.errors.files"/>

                    <div class="flex justify-between gap-4">
                        <PrimaryButton :disabled="replyForm.processing">Responder</PrimaryButton>
                        <div v-if="user.type === 'Cliente'&& ticket.status === 'Em atendimento' ">

                            <form @submit.prevent="closeTicket" class="space-y-6">

                                <SecondaryButton :disabled="closeForm.processing" >Finalizar</SecondaryButton>

                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</template>
