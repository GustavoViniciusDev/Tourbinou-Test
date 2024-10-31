<script setup lang="ts">
import { ref, computed } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { PencilIcon, TrashIcon } from 'lucide-vue-next'
import { useToast } from 'vue-toastification';

interface Ride {
    id: string;
    nome: string;
    horario: string;
    destino_id: string;
    descricao: string | null; // Permitir que a descrição seja nula
}

interface Destination {
    id: string;
    cidade: string;
    estado: string;
}

const props = defineProps<{ rides: Ride[], destinations: Destination[] }>()
const toast = useToast()

const deleteForm = useForm({});

const deleteRide = (id: string) => {
    if (confirm("Você tem certeza que deseja deletar este passeio?")) {
        deleteForm.delete(route('ride.destroy', { id }), {
            preserveScroll: true,
            onSuccess: () => {
                toast.success("Passeio deletado com sucesso!");
            },
            onError: () => {
                toast.error("Erro ao deletar passeio.");
            }
        });
    }
}

const destinationMap = computed(() => {
    return props.destinations.reduce((map, destination) => {
        map[destination.id] = destination
        return map
    }, {} as Record<string, Destination>)
})

const truncateDescription = (descricao: string | null, maxLength: number = 50): string => {
    if (!descricao) return 'Sem descrição'; // Retorna 'Sem descrição' se a descrição for nula
    return descricao.length > maxLength ? descricao.slice(0, maxLength) + '...' : descricao;
}
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Passeios</h1>
                <Link :href="route('register_ride')"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                    Cadastrar passeio
                </Link>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nome
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Horário
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Destino
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descrição
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Ações</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-if="props.rides.length === 0">
                                <td colspan="5" class="px-6 py-4 text-center text-sm font-medium text-gray-500">
                                    Nenhum passeio cadastrado
                                </td>
                            </tr>
                            <tr v-for="ride in props.rides" :key="ride.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ride.nome }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ ride.horario }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ destinationMap[ride.destino_id]?.cidade }} - {{
                                    destinationMap[ride.destino_id]?.estado }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                    {{ truncateDescription(ride.descricao, 50) }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center">
                                    <Link :href="route('ride.edit', { id: ride.id })"
                                        class="text-gray-400 hover:text-gray-500 mr-2 flex items-center">
                                        <PencilIcon class="h-5 w-5" />
                                    </Link>
                                    <button @click="deleteRide(ride.id)"
                                        class="text-gray-400 hover:text-gray-500 flex items-center">
                                        <TrashIcon class="h-5 w-5" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</template>
