<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

interface Destination {
    id: number;
    cidade: string;
    estado: string;
}

const props = defineProps<{
    ride?: { id: number; nome: string; horario: string; destino_id: number; descricao: string | null; imagem: string | null };
    destinations: Destination[];
}>();

const form = useForm({
    nome: props.ride ? props.ride.nome : '',
    horario: props.ride ? props.ride.horario : '',
    destino_id: props.ride ? props.ride.destino_id : '',
    descricao: props.ride && props.ride.descricao ? props.ride.descricao : '',
    imagem: null as File | null,
});

const errors = ref<{ destino_id?: string; nome?: string; horario?: string; imagem?: string }>({});

const handleImageChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files.length > 0) {
        form.imagem = target.files[0];
    }
};

const submitForm = async () => {
    if (validateForm()) {
        const formData = new FormData();

        formData.append('nome', form.nome);
        formData.append('horario', form.horario);
        formData.append('destino_id', String(form.destino_id));
        formData.append('descricao', form.descricao);

        if (form.imagem) {
            formData.append('imagem', form.imagem);
        }

        const action = props.ride ? route('ride.update', props.ride.id) : route('ride.store');

        form.post(action, {
            data: formData,
            preserveState: true,
        });
    }
};

const validateForm = (): boolean => {
    let isValid = true;
    if (!form.nome) {
        isValid = false;
        errors.value.nome = 'Nome é obrigatório.';
    }
    if (!form.horario) {
        isValid = false;
        errors.value.horario = 'Horário é obrigatório.';
    }
    if (!form.destino_id) {
        isValid = false;
        errors.value.destino_id = 'Destino é obrigatório.';
    }
    return isValid;
};

</script>

<template>
    <Head title="Cadastro de Passeio" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-4">
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ props.ride ? 'Editar Passeio' : 'Cadastrar Passeio' }}
                    </h1>
                    <Link :href="route('ride.index')" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </Link>
                </div>
                <form @submit.prevent="submitForm" class="p-4 bg-white space-y-4" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" v-model="form.nome"
                                :class="['w-full p-2 rounded focus:ring-2 focus:ring-gray-200 outline-none',
                                         errors.nome ? 'border border-red-500' : 'border border-gray-300']"
                                placeholder="Nome do passeio" />
                            <span v-if="errors.nome" class="text-red-500 text-xs">{{ errors.nome }}</span>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Horário</label>
                            <select v-model="form.horario"
                                :class="['w-full p-2 rounded focus:ring-2 focus:ring-gray-200 outline-none appearance-none bg-white',
                                         errors.horario ? 'border border-red-500' : 'border border-gray-300']">
                                <option value="" disabled selected>Selecione um horário</option>
                                <option value="manha">Manhã</option>
                                <option value="tarde">Tarde</option>
                                <option value="noite">Noite</option>
                            </select>
                            <span v-if="errors.horario" class="text-red-500 text-xs">{{ errors.horario }}</span>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Destino</label>
                            <select v-model="form.destino_id"
                                :class="['w-full p-2 rounded focus:ring-2 focus:ring-gray-200 outline-none appearance-none bg-white',
                                         errors.destino_id ? 'border border-red-500' : 'border border-gray-300']">
                                <option value="" disabled selected>Selecione um destino</option>
                                <option v-for="destination in props.destinations" :key="destination.id"
                                    :value="destination.id">
                                    {{ destination.cidade }}, {{ destination.estado }}
                                </option>
                            </select>
                            <span v-if="errors.destino_id" class="text-red-500 text-xs">{{ errors.destino_id }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <div class="relative">
                            <textarea v-model="form.descricao" rows="8"
                                class="w-full p-3 border border-gray-300 rounded focus:ring-2 focus:ring-gray-200 focus:border-gray-300 outline-none resize-none bg-gray-50"
                                placeholder="Digite sua descrição" maxlength="260"></textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                {{ form.descricao.length }} / 260
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Imagem</label>
                        <input type="file" @change="handleImageChange"
                            :class="['w-full p-2 rounded focus:ring-2 focus:ring-gray-200 outline-none',
                                     errors.imagem ? 'border border-red-500' : 'border border-gray-300']" />
                        <span v-if="errors.imagem" class="text-red-500 text-xs">{{ errors.imagem }}</span>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <Link :href="route('ride.index')" type="button"
                            class="px-4 py-2 border border-red-500 text-red-500 rounded hover:bg-red-50 transition-colors">
                            Cancelar
                        </Link>
                        <button type="submit"
                            class="px-4 py-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition-colors">
                            Salvar
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
