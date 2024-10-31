<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import RadeLayout from '@/Pages/Rides/RideLayout.vue';

interface Ride{
    id:string;
    nome:string;
    horario:string;
    destino_id:string;
    descricao:string;
}

interface Destination {
    id: string;
    cidade: string;
    estado: string;
}

const props = defineProps<{ rides: Ride[], destinations: Destination[] }>();
</script>

<template>
    <Head title="Passeio" />
    <AuthenticatedLayout>
        <RadeLayout :rides="props.rides" :destinations="props.destinations" />
    </AuthenticatedLayout>
</template>
