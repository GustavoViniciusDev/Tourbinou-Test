<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { MapPinIcon, ClockIcon } from 'lucide-vue-next';

const props = defineProps<{
    rides: {
        id: number;
        nome: string;
        descricao: string;
        destino_id: number;
        horario: string;
        imagem: string;
        destination: {
            cidade: string;
            estado: string;
        }
    }[]
}>();

const formatHorario = (horario: string) => {
    return horario.charAt(0).toUpperCase() + horario.slice(1);
};
</script>

<template>
    <Head title="Loja" />
    <AuthenticatedLayout>
        <div class="min-h-screen bg-gray-100 p-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="ride in props.rides" :key="ride.id"
                         class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                        <img :src="ride.imagem ? '/storage/' + ride.imagem : '/placeholder.svg?height=300&width=400'" :alt="ride.nome" class="w-full h-48 object-cover" />

                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ ride.nome }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ ride.descricao }}</p>
                            <div class="flex gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-500 text-white">
                                    <MapPinIcon class="w-4 h-4 mr-1" />
                                    {{ ride.destination.cidade }}, {{ ride.destination.estado }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700">
                                    <ClockIcon class="w-4 h-4 mr-1" />
                                    {{ formatHorario(ride.horario) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
