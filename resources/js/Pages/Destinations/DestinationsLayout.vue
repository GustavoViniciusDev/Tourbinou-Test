<script setup lang="ts">
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { PencilIcon, TrashIcon } from 'lucide-vue-next';
import { useToast } from 'vue-toastification';

interface Ride {
    id: string;
    destino_id: string;
}

interface Destination {
    id: string;
    cidade: string;
    estado: string;
    rides: Ride[];
}

const props = defineProps<{ destinations: Destination[] }>();
const toast = useToast();

const deleteForm = useForm({});

const deleteDestination = (id: string) => {
    if (confirm("Você tem certeza que deseja deletar este destino?")) {
        deleteForm.delete(route('destination.destroy', { id }), {
            preserveScroll: true,
            onSuccess: () => {
                toast.success("Destino deletado com sucesso!");
            },
            onError: () => {
                toast.error("Erro ao deletar destino.");
            }
        });
    }
};

const countRides = (destination: Destination): string => {
    const rideCount = destination.rides.length;
    if (rideCount > 0) {
        return `${rideCount} ${rideCount === 1 ? 'passeio' : 'passeios'}`;
    }
    return 'Nenhum passeio';
}
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Destinos</h1>
                <Link :href="route('register_destination')"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                Cadastrar destino
                </Link>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cidade
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Passeio
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Ações</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="destination in props.destinations" :key="destination.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ destination.cidade }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ destination.estado }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ countRides(destination) }} <!-- Exibe a contagem de passeios -->
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end items-center">
                                    <Link :href="route('destination.edit', { id: destination.id })"
                                        class="text-gray-400 hover:text-gray-500 mr-2 flex items-center">
                                    <PencilIcon class="h-5 w-5" />
                                    </Link>
                                    <button @click="deleteDestination(destination.id)"
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
