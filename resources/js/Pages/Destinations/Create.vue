<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted, toRefs } from 'vue';

interface Estado {
    id: number;
    sigla: string;
    nome: string;
}

interface Cidade {
    id: number;
    nome: string;
}


const props = defineProps<{ destination?: { id:string; cidade: string; estado: string } }>();
const estados = ref<Estado[]>([]);
const cidades = ref<Cidade[]>([]);

const form = useForm({
    cidade: props.destination?.cidade || '',
    estado: props.destination?.estado || '',
});

const buscarEstados = async () => {
    try {
        const response = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        estados.value = await response.json();
    } catch (error) {
        console.error('Erro ao buscar estados:', error);
    }
};

const buscarCidades = async (uf: string) => {
    try {
        const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`);
        cidades.value = await response.json();
    } catch (error) {
        console.error('Erro ao buscar cidades:', error);
    }
};

onMounted(() => {
    buscarEstados();
    if (form.estado) {
        buscarCidades(form.estado);
    }
});
</script>

<template>
    <Head title="Cadastro de Destino" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-4">
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Destinos</h1>
                    <Link :href="route('destination.index')"
                          class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                        Voltar
                    </Link>
                </div>
                <form @submit.prevent="form.post(route(props.destination ? 'destination.update' : 'destination.store', { id: props.destination?.id }))" class="p-4 bg-white space-y-4">
                    <div>
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select id="estado" v-model="form.estado" @change="buscarCidades(form.estado)"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled>Selecione um estado</option>
                            <option v-for="est in estados" :key="est.id" :value="est.sigla">{{ est.nome }}</option>
                        </select>
                    </div>
                    <div>
                        <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                        <select id="cidade" v-model="form.cidade"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" disabled>Selecione uma cidade</option>
                            <option v-for="cid in cidades" :key="cid.id" :value="cid.nome">{{ cid.nome }}</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button"
                        class="px-4 py-2 border border-red-500 text-red-500 rounded hover:bg-red-50 transition-colors">
                            Cancelar
                        </button>
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
