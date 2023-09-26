<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {useForm} from '@inertiajs/vue3';

const form = useForm({
    title: '',
    description: '',
    files: []
});
</script>

<template>
    <section>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Chamado de suporte</h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Preencha os dados para abrir um chamado
                        </p>
                    </header>

                    <form @submit.prevent="form.post(route('ticket.create-store'))" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="title" value="Titulo"/>

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                                autocomplete="title"
                                placeholder="Escreva seu titulo aqui ..."
                            />

                            <InputError class="mt-2" :message="form.errors.title"/>
                        </div>

                        <div>
                            <InputLabel for="description" value="Descrição"/>

                            <textarea
                                id="description"
                                rows="4"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                v-model="form.description"
                                placeholder="Escreva sua descrição aqui..."
                            ></textarea>

                            <InputError class="mt-2" :message="form.errors.description"/>
                        </div>

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

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Criar</PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</template>
