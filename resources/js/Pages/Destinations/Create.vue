<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';

interface Estado {
    sigla: string;
    nome: string;
}

interface Cidade {
    id: number;
    nome: string;
}

const cidade = ref<string>('Recife');
const estado = ref<string>('');
const estados = ref<Estado[]>([]);
const cidades = ref<Cidade[]>([]);

const fetchEstados = async () => {
    try {
        const response = await fetch('https://servicodados.ibge.gov.br/api/v2/malhas');
        const data = await response.json();
        estados.value = data.map((estado: { sigla: string; nome: string }) => ({
            sigla: estado.sigla,
            nome: estado.nome,
        }));
    } catch (error) {
        console.error('Erro ao buscar estados:', error);
    }
};

const fetchCidades = async (estadoSigla: string) => {
    try {
        const response = await fetch(`https://servicodados.ibge.gov.br/api/v2/malhas/${estadoSigla}/cidades`);
        const data = await response.json();
        cidades.value = data.map((cidade: { id: number; nome: string }) => ({
            id: cidade.id,
            nome: cidade.nome,
        }));
    } catch (error) {
        console.error('Erro ao buscar cidades:', error);
    }
};

const salvar = () => {
    console.log('Salvando...', { cidade: cidade.value, estado: estado.value });
};

const cancelar = () => {
    console.log('Cancelando...');
};

const voltar = () => {
    console.log('Voltando...');
};

// Chamar fetchEstados quando o componente for montado
onMounted(fetchEstados);
</script>

<template>
    <Head title="Cadastro de Destino" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-4">
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Destino</h1>
                    <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                        voltar
                    </button>
                </div>
                <form @submit.prevent="salvar" class="p-4 bg-white space-y-4">
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select id="estado" v-model="estado"
                            @change="fetchCidades(estado)"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled>Selecione um estado</option>
                            <option v-for="est in estados" :key="est.sigla" :value="est.sigla">{{ est.nome }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <select id="cidade" v-model="cidade"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled>Selecione uma cidade</option>
                            <option v-for="cid in cidades" :key="cid.id" :value="cid.nome">{{ cid.nome }}</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="cancelar"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Salvar
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>
