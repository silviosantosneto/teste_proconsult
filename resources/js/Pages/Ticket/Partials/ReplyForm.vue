<script setup>
import {Link, useForm, usePage} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const form = useForm({
    'description': '',
    'ticket_id': usePage().props.ticket.id,
    'files': []
})

</script>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

            <form @submit.prevent="form.post(route('ticket.reply-store'))" class="space-y-6">

                <InputLabel for="reply" value="Resposta" class="text-left"/>

                <textarea
                    id="reply"
                    rows="4"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    v-model="form.description"
                    placeholder="Escreva sua resposta aqui..."
                    autofocus
                ></textarea>

                <InputError class="mt-2" :message="form.errors.description"/>

                <div>
                    <InputLabel for="files" value="Anexos"/>

                    <TextInput
                        id="files"
                        type="file"
                        multiple
                        class="mt-1 block w-full"
                        autocomplete="files"
                        @input="form.files = $event.target.files"
                    />

                    <InputError class="mt-2" :message="form.errors.files"/>

                </div>

                <div class="flex justify-between gap-4">
                    <PrimaryButton :disabled="form.processing">Responder</PrimaryButton>
                    <div v-if="usePage().props.auth.user.type === 'Cliente'">

                        <Link :href="route('ticket.end', usePage().props.ticket.id)"
                              class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            Finalizar
                        </Link>

                    </div>
                </div>
            </form>

        </div>
    </div>
</template>
