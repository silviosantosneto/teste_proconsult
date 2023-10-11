<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {router, useForm} from '@inertiajs/vue3';

const form = useForm({
    title: 'Titulo de Teste',
    description: 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
    files: null
});

const storeTicket = function (){
    form.post(route('ticket.store'), {
        onSuccess: () => {
            router.get('/dashboard')
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
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Chamado de suporte</h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Preencha os dados para abrir um chamado
                        </p>
                    </header>

                    <form @submit.prevent="storeTicket" class="mt-6 space-y-6">
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
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
                                focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                v-model="form.description"
                                required
                                placeholder="Escreva sua descrição aqui..."
                            ></textarea>

                            <InputError class="mt-2" :message="form.errors.description"/>
                        </div>

                        <div>
                            <InputLabel for="files" value="Anexos"/>

                            <input
                                id="files"
                                type="file"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900
                                dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600
                                focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                @input="form.files = $event.target.files"
                                multiple
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
